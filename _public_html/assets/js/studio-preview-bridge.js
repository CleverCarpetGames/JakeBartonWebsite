(function () {
  'use strict';
  var selected = null;
  var paintColor = null;

  function componentFor(node) { return node && node.closest ? node.closest('[data-studio-component]') : null; }
  function payloadFor(node) {
    var component = componentFor(node);
    var textNode = node.closest('[data-studio-field]');
    var imageNode = node.closest('[data-studio-image-field]');
    var colorNode = node.closest('[data-studio-color-field]');
    var themeNode = node.closest('[data-studio-theme-color]');
    return {
      type: 'studio-select',
      component: component ? Number(component.dataset.studioComponent) : null,
      field: textNode ? textNode.dataset.studioField : null,
      imageField: imageNode ? imageNode.dataset.studioImageField : null,
      paragraph: textNode && textNode.dataset.studioParagraph !== undefined ? Number(textNode.dataset.studioParagraph) : null,
      value: textNode ? textNode.textContent.trim() : '',
      colorField: textNode ? (textNode.dataset.studioColorField || 'text_color') : (colorNode ? colorNode.dataset.studioColorField : null),
      themeColor: !component && themeNode ? themeNode.dataset.studioThemeColor : null
    };
  }
  function select(node) {
    if (selected) selected.classList.remove('studio-preview-selected');
    selected = node.closest('[data-studio-field], [data-studio-image-field], [data-studio-color-field], [data-studio-component]') || node;
    selected.classList.add('studio-preview-selected');
    parent.postMessage(payloadFor(node), location.origin);
  }
  document.addEventListener('click', function (event) {
    if (event.target.closest('.jb-detail-close, a')) return;
    if (paintColor) {
      event.preventDefault(); event.stopPropagation(); select(event.target);
      var paintPayload = payloadFor(event.target);
      if (paintPayload.colorField || paintPayload.themeColor) {
        paintPayload.type = 'studio-apply-color'; paintPayload.color = paintColor;
        parent.postMessage(paintPayload, location.origin);
        paintColor = null; document.body.classList.remove('is-studio-painting');
      }
      return;
    }
    event.preventDefault(); event.stopPropagation(); select(event.target);
  }, true);
  document.addEventListener('dragover', function (event) {
    var types = event.dataTransfer && event.dataTransfer.types ? Array.prototype.slice.call(event.dataTransfer.types) : [];
    if (types.indexOf('application/x-jb-color') !== -1 || types.indexOf('text/plain') !== -1) {
      event.preventDefault(); event.dataTransfer.dropEffect = 'copy';
      document.body.classList.add('is-studio-painting');
    }
  });
  document.addEventListener('dragleave', function (event) { if (!event.relatedTarget) document.body.classList.remove('is-studio-painting'); });
  document.addEventListener('drop', function (event) {
    var color = event.dataTransfer.getData('application/x-jb-color') || event.dataTransfer.getData('text/plain');
    if (!/^#[0-9a-f]{6}$/i.test(color)) return;
    event.preventDefault(); select(event.target);
    var payload = payloadFor(event.target); payload.type = 'studio-apply-color'; payload.color = color;
    parent.postMessage(payload, location.origin);
    document.body.classList.remove('is-studio-painting');
  });
  window.addEventListener('message', function (event) {
    if (event.origin !== location.origin || !event.data) return;
    var data = event.data;
    if (data.type === 'studio-paint-mode') {
      paintColor = data.color;
      document.body.classList.toggle('is-studio-painting', !!paintColor);
      if (paintColor) document.body.style.setProperty('--studio-paint-color', paintColor);
    }
    if (data.type === 'studio-scroll-component') {
      var section = document.querySelector('[data-studio-component="' + data.component + '"]');
      if (section) { section.scrollIntoView({behavior:'smooth', block:'center'}); select(section); }
    }
    if (data.type === 'studio-move-component') {
      var components = Array.prototype.slice.call(document.querySelectorAll('[data-studio-component]'));
      var moving = components[data.from];
      var reference = components[data.to];
      if (moving && reference && moving !== reference) {
        reference.parentNode.insertBefore(moving, data.from < data.to ? reference.nextSibling : reference);
        Array.prototype.forEach.call(document.querySelectorAll('[data-studio-component]'), function(node,index){node.dataset.studioComponent=index;});
      }
    }
    if (data.type === 'studio-update-text') {
      var selector = '[data-studio-component="' + data.component + '"] [data-studio-field="' + data.field + '"]';
      var nodes = document.querySelectorAll(selector);
      var node = data.paragraph === null || data.paragraph === undefined ? nodes[0] : nodes[data.paragraph];
      if (node) node.textContent = data.value;
    }
    if (data.type === 'studio-update-paragraphs') {
      var paragraphNodes = document.querySelectorAll('[data-studio-component="' + data.component + '"] [data-studio-field="paragraphs"]');
      var values = String(data.value || '').split(/\n\s*\n/);
      Array.prototype.forEach.call(paragraphNodes,function(node,index){node.textContent=values[index]||'';});
    }
    if (data.type === 'studio-update-image') {
      var image = document.querySelector('[data-studio-component="' + data.component + '"] [data-studio-image-field="' + data.imageField + '"]');
      if (image) image.src = data.url;
    }
    if (data.type === 'studio-update-video') {
      var videoSection = document.querySelector('[data-studio-component="' + data.component + '"]');
      if (videoSection) {
        var video = videoSection.querySelector('video');
        if (!video) {
          video=document.createElement('video');video.muted=true;video.playsInline=true;
          if (videoSection.classList.contains('jb-detail-hero')) {
            var still=videoSection.querySelector(':scope > img');
            if(still){video.poster=still.src;still.remove();}
            videoSection.insertBefore(video,videoSection.firstChild);
          } else {
            videoSection.replaceChildren(video);
          }
        }
        video.src=data.url;video.dataset.studioVideoField='video';video.autoplay=true;video.loop=true;video.controls=false;video.play().catch(function(){});
      }
    }
    if (data.type === 'studio-remove-video') {
      var mediaSection=document.querySelector('[data-studio-component="' + data.component + '"]');
      if(mediaSection&&mediaSection.classList.contains('jb-detail-hero')){
        var oldVideo=mediaSection.querySelector(':scope > video');if(oldVideo)oldVideo.remove();
        var image=document.createElement('img');image.src=data.imageUrl;image.alt='';image.dataset.studioImageField='image';
        mediaSection.insertBefore(image,mediaSection.firstChild);
      }
    }
    if (data.type === 'studio-update-decoration') {
      var decorationSection=document.querySelector('[data-studio-component="'+data.component+'"]');
      var decoration=decorationSection&&decorationSection.querySelector(data.imageField==='decoration_1'?'.jb-detail-orbit-one':'.jb-detail-orbit-two');
      if(decoration)decoration.src=data.url;
      else if(decorationSection){decoration=document.createElement('img');decoration.className='jb-detail-orbit '+(data.imageField==='decoration_1'?'jb-detail-orbit-one':'jb-detail-orbit-two');decoration.alt='';decoration.src=data.url;decorationSection.appendChild(decoration);}
    }
    if (data.type === 'studio-update-color') {
      var target = data.component === null ? document.body : document.querySelector('[data-studio-component="' + data.component + '"]');
      if (!target) return;
      if (data.field && data.colorField && data.colorField !== 'text_color') {
        var colorNodes = target.querySelectorAll('[data-studio-field="' + data.field + '"]');
        var colorNode = data.paragraph === null || data.paragraph === undefined ? colorNodes[0] : colorNodes[data.paragraph];
        if (colorNode) colorNode.style.setProperty('color', data.color);
        return;
      }
      var map = {background:'--artwork-background',overlay_color:'--hero-overlay',text_color:'--hero-text'};
      if (target.classList.contains('jb-detail-intro')) map = {background:'--intro-background',text_color:'--intro-text'};
      if (target.classList.contains('jb-detail-system')) map = {background:'--section-background',text_color:'--section-text'};
      if (target.classList.contains('jb-detail-quote')) map = {background:'--quote-background',text_color:'--quote-text'};
      if (data.themeColor) map = {canvas:'--page-canvas',ink:'--page-ink',rail:'--page-rail',footer_background:'--footer-background',footer_text:'--footer-text',footer_word:'--footer-word'};
      var property = data.themeColor ? map[data.themeColor] : map[data.colorField];
      if (property) target.style.setProperty(property, data.color);
    }
    if (data.type === 'studio-update-setting') {
      var settingTarget = document.querySelector('[data-studio-component="' + data.component + '"]');
      if (!settingTarget) return;
      if (data.field === 'looping') {
        var settingVideo=settingTarget.querySelector('video');
        if(settingVideo){settingVideo.loop=!!data.value;settingVideo.autoplay=!!data.value;settingVideo.controls=!data.value;if(data.value)settingVideo.play().catch(function(){});else settingVideo.pause();}
        return;
      }
      if (data.field === 'zoom') {
        settingTarget.style.setProperty('--video-zoom', String(Number(data.value) / 100));
        return;
      }
      var textLayout=data.field.match(/^(eyebrow|title|heading|paragraphs|caption|quote|link_label)_(width|margin_left|margin_right|margin_top|margin_bottom)$/);
      if(textLayout){
        var property=textLayout[2]==='width'?'maxWidth':'margin'+textLayout[2].replace('margin_','').replace(/^./,function(letter){return letter.toUpperCase();});
        var unit=textLayout[2]==='width'?'%':'px';
        Array.prototype.forEach.call(settingTarget.querySelectorAll('[data-studio-field="'+textLayout[1]+'"]'),function(node){node.style[property]=String(data.value)+unit;});
        return;
      }
      var settingMap = {
        image_width:[settingTarget.classList.contains('jb-detail-system')?'--product-width':'--artwork-width','%'], image_alignment:[settingTarget.classList.contains('jb-detail-system')?'--product-align':'--image-align',''], corner_radius:['--block-radius','px'], left_margin:['--block-left','px'], right_margin:['--block-right','px'], section_gap:['--block-gap','px'],
        padding_top:['--block-padding-top','px'], padding_right:['--block-padding-right','px'], padding_bottom:['--block-padding-bottom','px'], padding_left:['--block-padding-left','px'],
        overlay_opacity:['--hero-overlay-opacity',''], image_position:['--hero-position','']
      };
      var setting = settingMap[data.field];
      if (setting) {
        var settingValue=data.value;
        if(data.field==='image_alignment')settingValue=settingTarget.classList.contains('jb-detail-system')?({start:'flex-start',center:'center',end:'flex-end'}[data.value]||'center'):data.value;
        settingTarget.style.setProperty(setting[0], String(settingValue) + setting[1]);
        if(data.field==='image_width'&&settingTarget.classList.contains('jb-detail-system'))settingTarget.querySelector('.jb-detail-product-shot').style.setProperty('--product-width',String(data.value)+'%');
        if(data.field==='image_alignment'&&settingTarget.classList.contains('jb-detail-system'))settingTarget.querySelector('.jb-detail-product-shot').style.setProperty('--product-align',String(settingValue));
        if(data.field==='image_alignment'&&settingTarget.classList.contains('jb-detail-brand'))settingTarget.querySelector('.jb-detail-brand-logo').style.justifySelf=String(settingValue);
      }
    }
    if (data.type === 'studio-delete-component') {
      var deleting = document.querySelector('[data-studio-component="' + data.component + '"]');
      if (deleting) deleting.remove();
      Array.prototype.forEach.call(document.querySelectorAll('[data-studio-component]'),function(node,index){node.dataset.studioComponent=index;});
    }
    if (data.type === 'studio-clone-component' && data.component >= 0) {
      var cloning = document.querySelector('[data-studio-component="' + data.component + '"]');
      if (cloning) cloning.parentNode.insertBefore(cloning.cloneNode(true),cloning.nextSibling);
      Array.prototype.forEach.call(document.querySelectorAll('[data-studio-component]'),function(node,index){node.dataset.studioComponent=index;});
    }
    if (data.type === 'studio-add-component') {
      var selectors = {hero:'.jb-detail-hero',intro:'.jb-detail-intro',artwork:'.jb-detail-brand',product:'.jb-detail-system',quote:'.jb-detail-quote',video_card:'.jb-video-card'};
      var selector = selectors[data.componentType];
      var template = document.querySelector('template[data-studio-template="' + data.componentType + '"]');
      var source = template && template.content.firstElementChild
        ? template.content.firstElementChild.cloneNode(true)
        : (selector ? document.querySelector(selector) : null);
      var main = document.querySelector('.jb-detail-main');
      if (!source && data.componentType === 'video_card' && main) {
        source=document.createElement('section');source.className='jb-video-card';source.innerHTML='<div class="jb-video-card-empty" data-studio-video-field="video">Drop a video in Portfolio Studio</div>';
      }
      if (source && main) {
        var added = source.cloneNode(true);
        added.dataset.studioComponent = data.component;
        Array.prototype.forEach.call(added.querySelectorAll('[data-studio-field]'),function(node){node.textContent='';});
        Array.prototype.forEach.call(added.querySelectorAll('[data-studio-image-field]'),function(node){node.src='/assets/project-covers/tb-logo.jpg';node.alt='Image placeholder';});
        main.appendChild(added);
        Array.prototype.forEach.call(document.querySelectorAll('[data-studio-component]'),function(node,index){node.dataset.studioComponent=index;});
        added.scrollIntoView({behavior:'smooth',block:'center'});
        select(added);
      }
    }
  });
  parent.postMessage({type:'studio-preview-ready'}, location.origin);
}());
