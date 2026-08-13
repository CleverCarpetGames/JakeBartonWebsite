(function () {
  'use strict';
  var title = document.querySelector('[data-title-slug]');
  var slug = document.querySelector('[data-slug]');
  if (title && slug) title.addEventListener('input', function () {
    slug.value = title.value.toLowerCase().trim().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
  });

  var container = document.getElementById('studioComponents');
  var editor = document.querySelector('.studio-editor');
  Array.prototype.forEach.call(document.querySelectorAll('[data-color-picker]'), function (picker) {
    var value = picker.parentElement.querySelector('[data-color-value]');
    picker.addEventListener('input', function () { value.value = picker.value; });
    value.addEventListener('input', function () { if (/^#[0-9a-f]{6}$/i.test(value.value)) picker.value = value.value; });
  });
  if (!container || !editor) return;
  var dirty = false;
  var visualPreview = document.getElementById('studioVisualPreview');
  var visualSelection = null;
  var inspectorTitle = document.querySelector('[data-inspector-title]');
  var inspectorHelp = document.querySelector('[data-inspector-help]');
  var inspectorText = document.querySelector('[data-inspector-text]');
  var inspectorImage = document.querySelector('[data-inspector-image]');
  var visualText = document.querySelector('[data-visual-text]');
  var visualImage = document.querySelector('[data-visual-image]');
  var inspectorProperties = document.querySelector('[data-inspector-properties]');
  var componentActions = document.querySelector('[data-component-actions]');
  var undoButton = document.querySelector('[data-studio-undo]');
  var history = [], historyTimer = null, restoringHistory = false;

  function storageControls(){return Array.prototype.slice.call(editor.querySelectorAll('[name^="card_"],.studio-fields input:not([type="file"]),.studio-fields textarea,.studio-fields select,#studioComponents input:not([type="file"]),#studioComponents textarea,#studioComponents select'));}
  function captureState() {
    var frameDocument=visualPreview&&visualPreview.contentDocument;
    return {
      controls:storageControls().map(function(field){return{value:field.value,checked:field.checked,selected:field.selectedIndex};}),
      files:Array.prototype.map.call(editor.querySelectorAll('input[type="file"]'),function(field){return field.files&&field.files[0]?field.files[0].name:'';}),
      components:container.innerHTML,
      preview:frameDocument&&frameDocument.body?frameDocument.body.innerHTML:'',
      previewStyle:frameDocument&&frameDocument.body?frameDocument.body.getAttribute('style')||'':''
    };
  }
  function updateUndoButton(){if(undoButton)undoButton.disabled=history.length<2;}
  function recordHistory(){if(restoringHistory)return;var state=captureState(),key=JSON.stringify(state);if(!history.length||history[history.length-1].key!==key)history.push({key:key,state:state});if(history.length>60)history.shift();updateUndoButton();}
  function scheduleHistory(){clearTimeout(historyTimer);historyTimer=setTimeout(recordHistory,220);}
  function restoreState(state){
    var previousSelection=visualSelection?Object.assign({},visualSelection):null;
    restoringHistory=true;container.innerHTML=state.components;
    var fields=storageControls();Array.prototype.forEach.call(fields,function(field,index){var saved=state.controls[index];if(!saved)return;if(field.type==='checkbox'||field.type==='radio')field.checked=saved.checked;else if(field.tagName==='SELECT')field.selectedIndex=saved.selected;else field.value=saved.value;});Array.prototype.forEach.call(editor.querySelectorAll('input[type="file"]'),function(field){field.value='';});
    Array.prototype.forEach.call(container.querySelectorAll('[data-component]'),function(section){bind(section);Array.prototype.forEach.call(section.querySelectorAll('[data-image-editor]'),initImageEditor);});Array.prototype.forEach.call(container.querySelectorAll('[data-autogrow]'),autogrow);refresh();rebuildScenes();
    var frameDocument=visualPreview&&visualPreview.contentDocument;if(frameDocument&&frameDocument.body&&state.preview){frameDocument.body.innerHTML=state.preview;frameDocument.body.setAttribute('style',state.previewStyle);}
    if(previousSelection&&previousSelection.component!==null&&componentElement(previousSelection.component)){
      visualSelection=previousSelection;
      if(previousSelection.field){var restoredField=storedField(previousSelection);if(restoredField){if(previousSelection.field==='paragraphs'&&previousSelection.paragraph!==null){var restoredParagraphs=restoredField.value.split(/\n\s*\n/);previousSelection.value=restoredParagraphs[previousSelection.paragraph]||'';}else previousSelection.value=restoredField.value;}}
      selectVisual(previousSelection);
    }else if(previousSelection&&previousSelection.component===null){visualSelection=previousSelection;showPageInspector();}
    else{visualSelection=null;inspectorTitle.textContent='Select something';inspectorHelp.textContent='Click text, an image, or a section inside the preview.';inspectorText.hidden=true;inspectorImage.hidden=true;inspectorProperties.innerHTML='';componentActions.hidden=true;}
    dirty=true;restoringHistory=false;updateUndoButton();
  }
  if(undoButton)undoButton.addEventListener('click',function(){clearTimeout(historyTimer);recordHistory();if(history.length<2)return;history.pop();restoreState(history[history.length-1].state);});
  if(visualPreview){visualPreview.addEventListener('load',function(){setTimeout(function(){if(!history.length)recordHistory();},120);});setTimeout(function(){if(!history.length&&visualPreview.contentDocument&&visualPreview.contentDocument.body&&visualPreview.contentDocument.body.children.length)recordHistory();},500);}

  var sidebarToggle = document.querySelector('[data-sidebar-toggle]');
  if (sidebarToggle) sidebarToggle.addEventListener('click', function () {
    document.body.classList.toggle('studio-sidebar-collapsed');
    localStorage.setItem('studio-sidebar-collapsed', document.body.classList.contains('studio-sidebar-collapsed') ? '1' : '0');
  });
  if (localStorage.getItem('studio-sidebar-collapsed') === '1') document.body.classList.add('studio-sidebar-collapsed');
  var engineCollapse = document.querySelector('[data-engine-collapse]');
  if (engineCollapse) engineCollapse.addEventListener('click', function () { document.querySelector('[data-studio-engine]').classList.toggle('is-hierarchy-collapsed'); });
  var engineExpand = document.querySelector('[data-engine-expand]');
  if (engineExpand) engineExpand.addEventListener('click', function () { document.querySelector('[data-studio-engine]').classList.remove('is-hierarchy-collapsed'); });

  function componentElement(index) { return container.querySelectorAll('[data-component]')[index] || null; }
  function storedField(selection) {
    var component = selection && selection.component !== null ? componentElement(selection.component) : null;
    if (!component || !selection.field) return null;
    return component.querySelector('[data-field="' + selection.field + '"]');
  }
  function setStoredText(selection, value) {
    var field = storedField(selection); if (!field) return;
    if (selection.field === 'paragraphs' && selection.paragraph !== null) {
      var paragraphs = field.value.split(/\n\s*\n/); paragraphs[selection.paragraph] = value; field.value = paragraphs.join('\n\n');
    } else field.value = value;
    dirty = true;
  }
  function setStoredColor(selection, color) {
    var field = null;
    if (selection.cardColor) field = editor.querySelector('[name="' + selection.cardColor + '"]');
    else if (selection.themeColor) field = editor.querySelector('[name="theme[' + selection.themeColor + ']"]');
    else if (selection.component !== null && selection.colorField) field = componentElement(selection.component).querySelector('[data-field="' + selection.colorField + '"]');
    if (!field) return false;
    field.value = color; field.dispatchEvent(new Event('input', {bubbles:true}));
    if (field.matches('[data-color-value]')) {
      var picker = field.parentElement.querySelector('[data-color-picker]'); if (picker) picker.value = color;
    }
    dirty = true; if(selection.cardColor)updateCardPreview(); return true;
  }
  function sendPreview(data) { if (visualPreview && visualPreview.contentWindow) visualPreview.contentWindow.postMessage(data, location.origin); }
  function niceLabel(value) { return value.replace(/_/g, ' ').replace(/\b\w/g, function(c){return c.toUpperCase();}); }
  function liveSetting(index, field, value) {
    if (['background','text_color','overlay_color'].indexOf(field) !== -1) sendPreview({type:'studio-update-color',component:index,colorField:field,color:value});
    else if (field === 'paragraphs') sendPreview({type:'studio-update-paragraphs',component:index,value:value});
    else if (['title','heading','eyebrow','subtitle','caption','quote','link_label','role_label','role','disciplines_label','disciplines','built_with_label','built_with','client_label','client'].indexOf(field) !== -1) sendPreview({type:'studio-update-text',component:index,field:field,paragraph:null,value:value});
    else if (field !== 'image' && field !== 'type') sendPreview({type:'studio-update-setting',component:index,field:field,value:value});
  }
  function imageDropControl(source,index,key){
    var component=componentElement(index);if(!component)return null;
    var row=document.createElement('label');row.className='studio-property studio-asset-drop';
    var label=document.createElement('span');label.textContent=key==='image'?'Image':niceLabel(key);row.appendChild(label);
    var box=document.createElement('span');box.className='studio-asset-drop-box';
    var preview=document.createElement('img');preview.alt='';preview.src=source.value||'/assets/project-covers/tb-logo.jpg';
    var copy=document.createElement('span');copy.innerHTML='<strong>Drop image here</strong><small>or click to choose</small>';
    var storedPicker=key==='image'?component.querySelector('[data-image-upload]'):component.querySelector('[data-asset-upload="'+key+'"]');
    if(!storedPicker){storedPicker=document.createElement('input');storedPicker.type='file';storedPicker.accept='image/png,image/jpeg,image/webp,image/gif,image/svg+xml';storedPicker.dataset.assetUpload=key;storedPicker.hidden=true;component.appendChild(storedPicker);refresh();}
    var picker=document.createElement('input');picker.type='file';picker.accept='image/png,image/jpeg,image/webp,image/gif,image/svg+xml';
    function useFile(file){if(!file||file.type.indexOf('image/')!==0)return;try{var transfer=new DataTransfer();transfer.items.add(file);storedPicker.files=transfer.files;}catch(ignore){}var url=URL.createObjectURL(file);preview.src=url;box.classList.add('has-file');var storedPreview=component.querySelector('[data-image-preview]');if(key==='image'&&storedPreview)storedPreview.src=url;sendPreview({type:key==='image'?'studio-update-image':'studio-update-decoration',component:index,imageField:key,url:url});dirty=true;scheduleHistory();}
    picker.addEventListener('change',function(){useFile(picker.files[0]);});
    box.addEventListener('dragover',function(event){event.preventDefault();box.classList.add('is-dragover');});
    box.addEventListener('dragleave',function(){box.classList.remove('is-dragover');});
    box.addEventListener('drop',function(event){event.preventDefault();box.classList.remove('is-dragover');useFile(event.dataTransfer.files[0]);});
    box.append(preview,copy,picker);row.appendChild(box);return row;
  }
  function videoDropControl(source,index){
    var component=componentElement(index);if(!component)return null;
    var row=document.createElement('label');row.className='studio-property studio-asset-drop';
    var label=document.createElement('span');label.textContent='Video';row.appendChild(label);
    var box=document.createElement('span');box.className='studio-asset-drop-box studio-video-drop-box';
    var preview=document.createElement('video');preview.muted=true;preview.playsInline=true;if(source.value)preview.src=source.value;
    var copy=document.createElement('span');copy.innerHTML='<strong>Drop video here</strong><small>MP4, WebM, OGV, or MOV · up to 100 MB</small>';
    var storedPicker=component.querySelector('[data-asset-upload="video"]');
    if(!storedPicker){storedPicker=document.createElement('input');storedPicker.type='file';storedPicker.accept='video/mp4,video/webm,video/ogg,video/quicktime';storedPicker.dataset.assetUpload='video';storedPicker.hidden=true;component.appendChild(storedPicker);refresh();}
    var picker=document.createElement('input');picker.type='file';picker.accept='video/mp4,video/webm,video/ogg,video/quicktime';
    function useFile(file){if(!file||file.type.indexOf('video/')!==0)return;try{var transfer=new DataTransfer();transfer.items.add(file);storedPicker.files=transfer.files;}catch(ignore){}var url=URL.createObjectURL(file);preview.src=url;preview.play().catch(function(){});box.classList.add('has-file');sendPreview({type:'studio-update-video',component:index,url:url});dirty=true;scheduleHistory();}
    picker.addEventListener('change',function(){useFile(picker.files[0]);});
    box.addEventListener('dragover',function(event){event.preventDefault();box.classList.add('is-dragover');});
    box.addEventListener('dragleave',function(){box.classList.remove('is-dragover');});
    box.addEventListener('drop',function(event){event.preventDefault();box.classList.remove('is-dragover');useFile(event.dataTransfer.files[0]);});
    box.append(preview,copy,picker);row.appendChild(box);
    var useImage=document.createElement('button');useImage.type='button';useImage.textContent='Use still image instead';
    useImage.addEventListener('click',function(){source.value='';storedPicker.value='';preview.removeAttribute('src');box.classList.remove('has-file');var imageField=component.querySelector('[data-field="image"]');sendPreview({type:'studio-remove-video',component:index,imageUrl:imageField&&imageField.value?imageField.value:'/assets/project-covers/tb-logo.jpg'});dirty=true;scheduleHistory();});
    row.appendChild(useImage);return row;
  }
  function inspectorControl(source, index, isPage) {
    var field = source.dataset.field || source.name || '';
    if (!field || field === 'type' || source.type === 'file') return null;
    var key = field.replace(/^theme\[|\]$/g, '');
    if(!isPage&&['image','decoration_1','decoration_2'].indexOf(key)!==-1)return imageDropControl(source,index,key);
    if(!isPage&&key==='video')return videoDropControl(source,index);
    var row = document.createElement('label'); row.className = 'studio-property';
    var label = document.createElement('span'); label.textContent = niceLabel(key); row.appendChild(label);
    var control;
    var color = source.type === 'color' || /^theme\[/.test(field) || key === 'background' || key === 'card_tag_background' || /_color$/.test(key);
    if (color) return null;
    var range = {overlay_opacity:[0,1,.05],card_overlay_opacity:[0,.8,.02],card_image_scale:[20,100,1],zoom:[50,200,1],image_width:[35,100,1],corner_radius:[0,80,1],card_corner_radius:[0,80,1],left_margin:[0,240,2],right_margin:[0,240,2],section_gap:[0,160,2],padding_top:[0,240,2],padding_right:[0,240,2],padding_bottom:[0,240,2],padding_left:[0,240,2]}[key];
    if (/_width$/.test(key) && key !== 'image_width') range=[10,100,1];
    if (/_margin_(left|right|top|bottom)$/.test(key)) range=[-300,400,2];
    if (source.type === 'checkbox' || key === 'looping') { control=document.createElement('input'); control.type='checkbox'; control.checked=source.type==='checkbox'?source.checked:source.value==='1'; row.classList.add('is-toggle'); }
    else if (key === 'image_position' || key === 'card_image_position') { control=document.createElement('select'); [['left top','Top left'],['top','Top'],['right top','Top right'],['left','Left'],['center','Center'],['right','Right'],['left bottom','Bottom left'],['bottom','Bottom'],['right bottom','Bottom right']].forEach(function(item){var option=document.createElement('option');option.value=item[0];option.textContent=item[1];option.selected=source.value===item[0];control.appendChild(option);}); }
    else if (key === 'image_alignment') { control=document.createElement('select'); [['start','Left'],['center','Center'],['end','Right']].forEach(function(item){var option=document.createElement('option');option.value=item[0];option.textContent=item[1];option.selected=source.value===item[0];control.appendChild(option);}); }
    else if (key === 'card_image_fit') { control=document.createElement('select'); [['cover','Fill + crop'],['contain','Fit whole image']].forEach(function(item){var option=document.createElement('option');option.value=item[0];option.textContent=item[1];option.selected=source.value===item[0];control.appendChild(option);}); }
    else if (range) { var defaults={overlay_opacity:.42,zoom:100,image_width:66,corner_radius:10,left_margin:100,right_margin:40,section_gap:80,padding_top:100,padding_bottom:100};var isVideoCard=!isPage&&componentElement(index)&&componentElement(index).querySelector('[data-field="type"]').value==='video_card';var fallback=isVideoCard&&/^padding_/.test(key)?0:(/_width$/.test(key)?100:(/_margin_/.test(key)?0:(defaults[key]!==undefined?defaults[key]:range[0])));var wrap=document.createElement('div'); wrap.className='studio-range'; control=document.createElement('input'); control.type='range'; control.min=range[0]; control.max=range[1]; control.step=range[2]; control.value=source.value!==''?source.value:fallback; var output=document.createElement('output'); output.textContent=control.value; wrap.append(control,output); row.appendChild(wrap); }
    else if (source.tagName === 'TEXTAREA' || key === 'description' || key === 'paragraphs' || key === 'quote') { control=document.createElement('textarea'); control.rows=key==='paragraphs'?8:4; control.value=source.value; }
    else { control=document.createElement('input'); control.type=source.type==='number'?'number':'text'; control.value=source.value; }
    if (!range) row.appendChild(control);
    control.addEventListener('input', function(){
      if(source.type==='checkbox') source.checked=control.checked; else if(key==='looping')source.value=control.checked?'1':'0'; else source.value=control.value;
      if(range) row.querySelector('output').textContent=control.value;
      source.dispatchEvent(new Event('input',{bubbles:true})); dirty=true;
      if (isPage && /^theme\[/.test(field)) sendPreview({type:'studio-update-color',component:null,themeColor:key,color:control.value});
      else if (!isPage) liveSetting(index,key,(source.type==='checkbox'||key==='looping')?control.checked:control.value);
      if(isPage)updateCardPreview();
    });
    return row;
  }
  function showComponentInspector(index) {
    var component=componentElement(index); if(!component || !inspectorProperties) return;
    inspectorProperties.innerHTML='';
    Array.prototype.forEach.call(component.querySelectorAll('[data-field]'),function(source){
      var focused = visualSelection && visualSelection.component === index && (visualSelection.field || visualSelection.imageField);
      var layoutFields = ['image_position','image_width','image_alignment','overlay_opacity','corner_radius','left_margin','right_margin','section_gap','padding_top','padding_bottom'];
      var textLayout=/^(eyebrow|title|heading|paragraphs|caption|quote|link_label)_(width|margin_left|margin_right|margin_top|margin_bottom)$/.test(source.dataset.field);
      if (visualSelection && visualSelection.field && focused && source.dataset.field.indexOf(visualSelection.field+'_') !== 0) return;
      if (visualSelection && visualSelection.imageField && focused && source.dataset.field!==visualSelection.imageField && layoutFields.indexOf(source.dataset.field) === -1) return;
      if (!visualSelection || !visualSelection.field) { if(textLayout)return; }
      if (visualSelection && visualSelection.component === index && visualSelection.field && source.dataset.field === visualSelection.field) return;
      var row=inspectorControl(source,index,false);if(row)inspectorProperties.appendChild(row);
    });
    componentActions.hidden=false;
  }
  function showPageInspector() {
    visualSelection={component:null}; inspectorTitle.textContent='Page + card'; inspectorHelp.textContent='Publishing, card details, and global page colors.';
    inspectorText.hidden=true; inspectorImage.hidden=true; componentActions.hidden=true; inspectorProperties.innerHTML='';
    var preview=document.createElement('div');preview.className='studio-card-preview';preview.innerHTML='<img alt="Card cover preview"><div class="studio-card-preview-shade" data-card-color="card_overlay_color"></div><div class="studio-card-preview-tags" data-card-color="card_tag_background"></div><div class="studio-card-preview-copy" data-card-color="card_text_color"><strong></strong><span></span></div>';inspectorProperties.appendChild(preview);
    var backgroundTarget=document.createElement('button');backgroundTarget.type='button';backgroundTarget.className='studio-card-background-target';backgroundTarget.dataset.cardColor='card_background';backgroundTarget.textContent='Select card background color';inspectorProperties.appendChild(backgroundTarget);
    var fields=['title','slug','subtitle','sort_order','description','tags','filters','card_image_fit','card_image_scale','card_image_position','card_overlay_opacity','card_corner_radius','published'];
    fields.forEach(function(name){var source=editor.querySelector('[name="'+name+'"]');var row=source&&inspectorControl(source,null,true);if(row)inspectorProperties.appendChild(row);});
    var coverSource=editor.querySelector('[name="cover_upload"]');
    if(coverSource){var cover=document.createElement('label');cover.className='studio-property studio-asset-drop';cover.innerHTML='<span>Card cover</span>';var box=document.createElement('span');box.className='studio-asset-drop-box';var coverPreview=document.createElement('img');coverPreview.src=(editor.querySelector('[name="cover"]')||{}).value||'/assets/project-covers/tb-logo.jpg';coverPreview.alt='';var coverCopy=document.createElement('span');coverCopy.innerHTML='<strong>Drop cover here</strong><small>or click to choose</small>';var picker=document.createElement('input');picker.type='file';picker.accept='image/png,image/jpeg,image/webp,image/gif,image/svg+xml';function useCover(file){if(!file)return;try{var transfer=new DataTransfer();transfer.items.add(file);coverSource.files=transfer.files;}catch(ignore){}var url=URL.createObjectURL(file);coverPreview.src=url;preview.querySelector('img').src=url;box.classList.add('has-file');dirty=true;scheduleHistory();}picker.addEventListener('change',function(){useCover(picker.files[0]);});box.addEventListener('dragover',function(event){event.preventDefault();box.classList.add('is-dragover');});box.addEventListener('dragleave',function(){box.classList.remove('is-dragover');});box.addEventListener('drop',function(event){event.preventDefault();box.classList.remove('is-dragover');useCover(event.dataTransfer.files[0]);});box.append(coverPreview,coverCopy,picker);cover.appendChild(box);inspectorProperties.appendChild(cover);}
    var deletePage=document.createElement('button');deletePage.type='button';deletePage.className='studio-page-delete';deletePage.textContent='Delete this page';deletePage.addEventListener('click',function(){var form=document.querySelector('.studio-delete');if(form&&confirm('Delete this page permanently?'))form.requestSubmit();});inspectorProperties.appendChild(deletePage);
    Array.prototype.forEach.call(inspectorProperties.querySelectorAll('[data-card-color]'),function(target){
      target.addEventListener('click',function(event){event.stopPropagation();var cardColor=target.classList.contains('studio-card-preview-tags')&&event.target.closest('i')?'card_tag_text':target.dataset.cardColor;visualSelection={component:null,cardColor:cardColor};inspectorTitle.textContent='Card '+niceLabel(cardColor.replace(/^card_/,''));inspectorHelp.textContent='Choose or drag a color from the palette.';});
      target.addEventListener('dragover',function(event){event.preventDefault();});
      target.addEventListener('drop',function(event){var color=event.dataTransfer.getData('application/x-jb-color')||event.dataTransfer.getData('text/plain');if(/^#[0-9a-f]{6}$/i.test(color)){event.preventDefault();var cardColor=target.classList.contains('studio-card-preview-tags')&&event.target.closest('i')?'card_tag_text':target.dataset.cardColor;visualSelection={component:null,cardColor:cardColor};setStoredColor(visualSelection,color);scheduleHistory();}});
    });
    updateCardPreview();
  }
  function updateCardPreview(){
    var preview=document.querySelector('.studio-card-preview');if(!preview)return;
    function value(name,fallback){var field=editor.querySelector('[name="'+name+'"]');return field&&field.value!==''?field.value:fallback;}
    var image=preview.querySelector('img');image.src=value('cover','/assets/project-covers/tb-logo.jpg');image.style.objectPosition=value('card_image_position','center');image.style.objectFit=value('card_image_fit','cover');image.style.transform='scale('+(Number(value('card_image_scale','100'))/100)+')';preview.style.background=value('card_background','#111111');preview.style.borderRadius=value('card_corner_radius','28')+'px';preview.style.setProperty('--card-overlay',value('card_overlay_opacity','.34'));preview.style.setProperty('--card-overlay-color',value('card_overlay_color','#000000'));preview.style.setProperty('--card-text',value('card_text_color','#ffffff'));preview.style.setProperty('--card-tag',value('card_tag_background','#c6c5bc'));preview.style.setProperty('--card-tag-text',value('card_tag_text','#ffffff'));preview.querySelector('strong').textContent=value('title','Untitled project');preview.querySelector('.studio-card-preview-copy span').textContent=value('subtitle','');var tags=value('tags','').split(',').map(function(tag){return tag.trim();}).filter(Boolean);preview.querySelector('.studio-card-preview-tags').innerHTML=tags.map(function(tag){return '<i>'+escapeHtml(tag)+'</i>';}).join('');
  }
  function beginPaint(color, swatch) {
    if (visualSelection && (visualSelection.colorField || visualSelection.themeColor || visualSelection.cardColor)) {
      if (setStoredColor(visualSelection, color)) {
        if(!visualSelection.cardColor)sendPreview({type:'studio-update-color', component:visualSelection.component, field:visualSelection.field, paragraph:visualSelection.paragraph, colorField:visualSelection.colorField, themeColor:visualSelection.themeColor, color:color});
        endPaint();
        if (visualSelection.component !== null) showComponentInspector(visualSelection.component); else showPageInspector();
        return;
      }
    }
    Array.prototype.forEach.call(document.querySelectorAll('[data-drag-color]'), function (item) { item.classList.toggle('is-active', item === swatch); });
    document.querySelector('[data-studio-engine]').classList.add('is-paint-mode');
    document.querySelector('[data-color-help]').textContent = 'Paint mode is on. Click any compatible part of the preview.';
    sendPreview({type:'studio-paint-mode', color:color});
  }
  function endPaint() {
    Array.prototype.forEach.call(document.querySelectorAll('[data-drag-color]'), function (item) { item.classList.remove('is-active'); });
    document.querySelector('[data-studio-engine]').classList.remove('is-paint-mode');
    document.querySelector('[data-color-help]').textContent = 'Click a color to recolor the selection, or drag a color directly onto text, a background, the rail, canvas, or footer.';
  }
  function selectVisual(data) {
    visualSelection = data;
    var component = data.component !== null ? componentElement(data.component) : null;
    var heading = component ? component.querySelector('.studio-component-head h2') : null;
    inspectorTitle.textContent = data.imageField ? 'Image' : (data.field ? data.field.replace(/_/g, ' ').replace(/\b\w/g, function(c){return c.toUpperCase();}) : (heading ? heading.textContent : 'Page canvas'));
    inspectorHelp.textContent = heading ? heading.textContent : 'Global page color';
    if (data.field) { inspectorText.hidden = false; visualText.value = data.value || ''; visualText.focus(); }
    else inspectorText.hidden = true;
    inspectorImage.hidden = true;
    if (component) showComponentInspector(data.component); else if (data.component === null) showPageInspector();
  }
  window.addEventListener('message', function (event) {
    if (event.origin !== location.origin || !event.data) return;
    if (event.data.type === 'studio-preview-ready') recordHistory();
    if (event.data.type === 'studio-select') selectVisual(event.data);
    if (event.data.type === 'studio-apply-color') {
      selectVisual(event.data);
      if (setStoredColor(event.data, event.data.color)) sendPreview({type:'studio-update-color', component:event.data.component, field:event.data.field, paragraph:event.data.paragraph, colorField:event.data.colorField, themeColor:event.data.themeColor, color:event.data.color});
      endPaint();
    }
  });
  if (visualText) visualText.addEventListener('input', function () {
    if (!visualSelection || !visualSelection.field) return;
    setStoredText(visualSelection, visualText.value);
    sendPreview({type:'studio-update-text', component:visualSelection.component, field:visualSelection.field, paragraph:visualSelection.paragraph, value:visualText.value});
  });
  if (visualImage) visualImage.addEventListener('change', function () {
    if (!visualSelection || !visualSelection.imageField || !visualImage.files[0]) return;
    var component = componentElement(visualSelection.component);
    var storedUpload = component && component.querySelector('[data-image-upload]');
    if (storedUpload) {
      try { var transfer=new DataTransfer(); transfer.items.add(visualImage.files[0]); storedUpload.files=transfer.files; } catch(ignore) {}
      var storedPreview=component.querySelector('[data-image-preview]'); if(storedPreview) storedPreview.src=URL.createObjectURL(visualImage.files[0]);
    }
    sendPreview({type:'studio-update-image',component:visualSelection.component,imageField:visualSelection.imageField,url:URL.createObjectURL(visualImage.files[0])}); dirty=true;
  });
  Array.prototype.forEach.call(document.querySelectorAll('[data-drag-color]'), function (swatch) {
    swatch.addEventListener('dragstart', function (event) { event.dataTransfer.setData('application/x-jb-color', swatch.dataset.dragColor); event.dataTransfer.setData('text/plain', swatch.dataset.dragColor); event.dataTransfer.effectAllowed = 'copy'; document.querySelector('[data-studio-engine]').classList.add('is-paint-mode'); });
    swatch.addEventListener('dragend', function () { document.querySelector('[data-studio-engine]').classList.remove('is-paint-mode'); });
    swatch.addEventListener('click', function () { beginPaint(swatch.dataset.dragColor, swatch); });
  });
  var customColor = document.querySelector('[data-custom-swatch]');
  if (customColor) {
    customColor.draggable = true;
    customColor.addEventListener('dragstart', function (event) { event.dataTransfer.setData('application/x-jb-color', customColor.value); event.dataTransfer.setData('text/plain', customColor.value); event.dataTransfer.effectAllowed='copy'; document.querySelector('[data-studio-engine]').classList.add('is-paint-mode'); });
    customColor.addEventListener('dragend', function () { document.querySelector('[data-studio-engine]').classList.remove('is-paint-mode'); });
  }
  var applyColor = document.querySelector('[data-apply-custom-color]');
  if (applyColor) applyColor.addEventListener('click', function () {
    beginPaint(customColor.value, null);
  });
  var draggedScene = null;
  function bindScene(button) {
    if(button.dataset.sceneBound) return; button.dataset.sceneBound='1';
    button.addEventListener('click', function () { var index=Number(button.dataset.sceneComponent); visualSelection={component:index,field:null,imageField:null}; sendPreview({type:'studio-scroll-component', component:index}); showComponentInspector(index); });
    button.addEventListener('dragstart', function (event) { draggedScene = button; button.classList.add('is-dragging'); event.dataTransfer.effectAllowed='move'; });
    button.addEventListener('dragend', function () { button.classList.remove('is-dragging'); draggedScene=null; });
    button.addEventListener('dragover', function (event) { if(draggedScene && draggedScene!==button) event.preventDefault(); });
    button.addEventListener('drop', function (event) {
      event.preventDefault(); if (!draggedScene || draggedScene===button) return;
      var from=Number(draggedScene.dataset.sceneComponent), to=Number(button.dataset.sceneComponent);
      var nodes=container.querySelectorAll('[data-component]'), moving=nodes[from], reference=nodes[to];
      if (!moving || !reference) return;
      reference.parentNode.insertBefore(moving, from<to ? reference.nextSibling : reference);
      button.parentNode.insertBefore(draggedScene, from<to ? button.nextSibling : button);
      sendPreview({type:'studio-move-component',from:from,to:to});
      Array.prototype.forEach.call(document.querySelectorAll('[data-scene-component]'),function(scene,index){scene.dataset.sceneComponent=index;scene.querySelector('span').textContent=String(index+1).padStart(2,'0');});
      refresh(); dirty=true; scheduleHistory();
    });
  }
  function rebuildScenes() {
    var list=document.querySelector('.studio-scene-list'); if(!list)return;
    Array.prototype.forEach.call(list.querySelectorAll('[data-scene-component]'),function(node){node.remove();});
    Array.prototype.forEach.call(container.querySelectorAll('[data-component]'),function(section,index){var button=document.createElement('button');button.type='button';button.draggable=true;button.dataset.sceneComponent=index;var title=section.querySelector('.studio-component-head h2');button.innerHTML='<span>'+String(index+1).padStart(2,'0')+'</span>'+escapeHtml(title?title.textContent:'Section');list.appendChild(button);bindScene(button);});
  }
  Array.prototype.forEach.call(document.querySelectorAll('[data-scene-component]'), bindScene);
  var pageInspector=document.querySelector('[data-page-inspector]'); if(pageInspector)pageInspector.addEventListener('click',showPageInspector);
  var addPanel=document.querySelector('.studio-add');
  var scrollAdd = document.querySelector('[data-scroll-add]'); if (scrollAdd) scrollAdd.addEventListener('click', function(){if(addPanel)addPanel.classList.add('is-open');});
  if(addPanel)addPanel.addEventListener('click',function(event){if(event.target===addPanel)addPanel.classList.remove('is-open');});
  var closeAdd=document.querySelector('[data-close-add]');if(closeAdd)closeAdd.addEventListener('click',function(){addPanel.classList.remove('is-open');});
  document.addEventListener('keydown',function(event){if(event.key==='Escape'&&addPanel)addPanel.classList.remove('is-open');});
  var duplicate=document.querySelector('[data-duplicate-component]'); if(duplicate)duplicate.addEventListener('click',function(){
    if(!visualSelection||visualSelection.component===null)return; var source=componentElement(visualSelection.component), clone=source.cloneNode(true);
    Array.prototype.forEach.call(clone.querySelectorAll('input[type=file]'),function(input){input.value='';}); source.parentNode.insertBefore(clone,source.nextSibling); bind(clone); Array.prototype.forEach.call(clone.querySelectorAll('[data-image-editor]'),initImageEditor); refresh(); rebuildScenes(); dirty=true; sendPreview({type:'studio-clone-component',component:visualSelection.component}); showComponentInspector(visualSelection.component+1); scheduleHistory();
  });
  var remove=document.querySelector('[data-delete-component]'); if(remove)remove.addEventListener('click',function(){
    if(!visualSelection||visualSelection.component===null||!confirm('Delete this section?'))return; var index=visualSelection.component,section=componentElement(index);if(section)section.remove();refresh();rebuildScenes();dirty=true;sendPreview({type:'studio-delete-component',component:index});showPageInspector();scheduleHistory();
  });
  Array.prototype.forEach.call(document.querySelectorAll('[data-viewport-size]'), function(button){button.addEventListener('click',function(){var frame=document.querySelector('.studio-viewport-frame');frame.className='studio-viewport-frame is-'+button.dataset.viewportSize;});});
  editor.addEventListener('input', function () { dirty = true; scheduleHistory(); });
  editor.addEventListener('change', function () { dirty = true; scheduleHistory(); });
  window.addEventListener('beforeunload', function (event) {
    if (!dirty) return;
    event.preventDefault(); event.returnValue = '';
  });

  function autogrow(textarea) {
    textarea.style.height = 'auto';
    textarea.style.height = Math.max(110, textarea.scrollHeight) + 'px';
  }
  Array.prototype.forEach.call(document.querySelectorAll('[data-autogrow]'), function (textarea) {
    autogrow(textarea); textarea.addEventListener('input', function () { autogrow(textarea); });
  });

  function initImageEditor(box) {
    var input = box.querySelector('[data-image-file]');
    var preview = box.querySelector('[data-image-preview]');
    if (!input || !preview) return;
    function show(file) {
      if (!file || file.type.indexOf('image/') !== 0) return;
      preview.src = URL.createObjectURL(file); box.classList.add('has-new-image'); dirty = true;
    }
    input.addEventListener('change', function () { show(input.files[0]); });
    box.addEventListener('dragover', function (event) { event.preventDefault(); box.classList.add('is-dragover'); });
    box.addEventListener('dragleave', function () { box.classList.remove('is-dragover'); });
    box.addEventListener('drop', function (event) {
      event.preventDefault(); box.classList.remove('is-dragover');
      if (!event.dataTransfer.files.length) return;
      try { input.files = event.dataTransfer.files; } catch (ignore) {}
      show(event.dataTransfer.files[0]);
    });
  }
  Array.prototype.forEach.call(document.querySelectorAll('[data-image-editor]'), initImageEditor);

  function escapeHtml(value) {
    var div = document.createElement('div'); div.textContent = value; return div.innerHTML;
  }
  function refresh() {
    Array.prototype.forEach.call(container.querySelectorAll('[data-component]'), function (section, index) {
      var number = section.querySelector('.studio-component-head span');
      if (number) number.textContent = 'SECTION ' + (index + 1);
      Array.prototype.forEach.call(section.querySelectorAll('[data-field]'), function (field) {
        field.name = 'components[' + index + '][' + field.getAttribute('data-field') + ']';
      });
      var upload = section.querySelector('[data-image-upload]');
      if (upload) upload.name = 'component_image_' + index;
      Array.prototype.forEach.call(section.querySelectorAll('[data-asset-upload]'),function(asset){asset.name='component_asset_'+index+'_'+asset.dataset.assetUpload;});
    });
  }
  function bind(section) {
    var handle = section.querySelector('.studio-drag-handle');
    var dragReady = false;
    if (handle) {
      handle.addEventListener('pointerdown', function () { dragReady = true; });
      handle.addEventListener('pointerup', function () { dragReady = false; });
    }
    section.addEventListener('dragstart', function (event) {
      if (!dragReady) { event.preventDefault(); return; }
      section.classList.add('is-dragging'); event.dataTransfer.effectAllowed = 'move';
    });
    section.addEventListener('dragend', function () { section.classList.remove('is-dragging'); dragReady = false; refresh(); dirty = true; scheduleHistory(); });
    section.addEventListener('dragover', function (event) {
      event.preventDefault();
      var dragging = container.querySelector('.is-dragging');
      if (!dragging || dragging === section) return;
      var bounds = section.getBoundingClientRect();
      container.insertBefore(dragging, event.clientY < bounds.top + bounds.height / 2 ? section : section.nextElementSibling);
    });
    section.querySelector('[data-remove]').addEventListener('click', function () {
      if (confirm('Remove this section from the page?')) { section.remove(); refresh(); rebuildScenes(); scheduleHistory(); }
    });
    Array.prototype.forEach.call(section.querySelectorAll('[data-move]'), function (button) {
      button.addEventListener('click', function () {
        if (button.dataset.move === 'up' && section.previousElementSibling) container.insertBefore(section, section.previousElementSibling);
        if (button.dataset.move === 'down' && section.nextElementSibling) container.insertBefore(section.nextElementSibling, section);
        refresh(); section.scrollIntoView({behavior:'smooth', block:'center'}); scheduleHistory();
      });
    });
  }
  Array.prototype.forEach.call(container.querySelectorAll('[data-component]'), bind);
  Array.prototype.forEach.call(document.querySelectorAll('[data-add-component]'), function (button) {
    button.addEventListener('click', function () {
      var fields = JSON.parse(button.dataset.fields || '[]');
      var section = document.createElement('section');
      section.className = 'studio-panel studio-component'; section.setAttribute('data-component', '');
      var inputs = fields.map(function (field) {
        var label = field.replace(/_/g, ' ').replace(/\b\w/g, function (c) { return c.toUpperCase(); });
        if (field === 'paragraphs') return '<label class="studio-text-editor">' + label + '<textarea data-field="paragraphs" rows="9" data-autogrow placeholder="Separate paragraphs with a blank line"></textarea></label>';
        var color = ['background', 'text_color', 'overlay_color'].indexOf(field) !== -1;
        var opacity = field === 'overlay_opacity';
        if (field === 'image') return '<label>Image<div class="studio-image-editor" data-image-editor><img src="/assets/project-covers/tb-logo.jpg" alt="Image placeholder" data-image-preview><div><strong>Drop an image here</strong><span>or click to choose one</span></div><input type="file" data-image-upload data-image-file accept="image/png,image/jpeg,image/webp,image/gif,image/svg+xml"></div><details><summary>Image path</summary><input data-field="image" value="/assets/project-covers/tb-logo.jpg" data-image-path></details></label>';
        if (field === 'video') return '<input data-field="video" value="">';
        if (field === 'looping') return '<input data-field="looping" value="1">';
        if (field === 'zoom') return '<input data-field="zoom" value="100">';
        if (/^padding_(top|right|bottom|left)$/.test(field)) return '<input data-field="' + field + '" value="0">';
        return '<label class="' + (['title','quote','caption'].indexOf(field) !== -1 ? 'studio-text-editor' : '') + '">' + label + '<input data-field="' + escapeHtml(field) + '"' + (color ? ' type="color" value="#132b4f"' : '') + (opacity ? ' type="number" min="0" max="1" step="0.05" value="0.42"' : '') + '></label>';
      }).join('');
      section.draggable = true;
      section.innerHTML = '<div class="studio-component-head"><div class="studio-drag-handle" title="Drag to reorder"><b>⋮⋮</b><span>NEW SECTION</span><h2>' + escapeHtml(button.dataset.label) + '</h2></div><div><button type="button" data-move="up">↑</button><button type="button" data-move="down">↓</button><button type="button" class="is-danger" data-remove>Remove</button></div></div><input type="hidden" data-field="type" value="' + escapeHtml(button.dataset.addComponent) + '">' + inputs;
      container.appendChild(section); bind(section); Array.prototype.forEach.call(section.querySelectorAll('[data-image-editor]'), initImageEditor); Array.prototype.forEach.call(section.querySelectorAll('[data-autogrow]'), function (area) { autogrow(area); area.addEventListener('input', function(){autogrow(area);}); }); refresh(); rebuildScenes(); dirty = true; addPanel.classList.remove('is-open'); var newIndex=container.querySelectorAll('[data-component]').length-1; sendPreview({type:'studio-add-component',component:newIndex,componentType:button.dataset.addComponent}); showComponentInspector(newIndex); scheduleHistory();
    });
  });
  editor.addEventListener('submit', function () {
    refresh(); dirty = false;
    var saveButton=document.querySelector('[data-studio-save]');
    if(saveButton){saveButton.disabled=true;saveButton.textContent='Saving…';}
  });
  refresh();
}());
