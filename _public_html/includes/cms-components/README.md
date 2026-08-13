# Custom Portfolio Studio components

Add a PHP file to this directory to register a reusable page section. Return an array with:

```php
<?php
return [
    'type' => 'case_study_gallery',
    'label' => 'Case study gallery',
    'fields' => ['heading', 'image', 'caption'],
    'render' => static function (array $block): void {
        // Render escaped public markup for the component here.
    },
];
```

The component becomes available automatically under “Add a section” in Portfolio Studio. Component CSS can live in `assets/css/work-detail.css`; interactive behavior can be added through a dedicated script loaded by the detail renderer.
