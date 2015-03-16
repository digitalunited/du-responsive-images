# Responsive Images for developers #

##Why?!?
TODO

##How?!?
TODO

##Useage
```php
\DigitalUnited\ResponsiveImage::render([
    'imgId' => $imgId,
    'output' => 'img'
    'ratio' => '4x3',
    'imgAttributes' => [
        'class' => [],
        'alt' =>  $alt,
    ],
    'wrapperAttributes' => [
        'class' => [],
    ],
    'divWithBgImageAttributes' => [
        'class' => ['cover']
    ]
])->render();
```

##Options

### imgId
A WordPress attachment image id.

### Output (All is not implemented yet)
- img: Regular img-tag (Not implemented, yet)
- img: Regular img wrapped in a div with kept aspect-ratio. The img behaves normal if the ratio setting is omitted.

### Ratio (Optional)
The following aspect ratios are available.
- string "ratio-1x1"
- string "ratio-2x1"
- string "ratio-4x1"
- string "ratio-4x3"
- string "ratio-16x9"
- string "ratio-1x2"
- string "ratio-1x4"
- string "ratio-3x4"
- string "ratio-9x16"

### Ratio (Only valid when "output = img-ratio" or "output = img")

### imgAttributes and wrapperAttributes (Only valid when "output = img")
HTML attributes added to the wrapper-div and the img-tag when using img output mode

### divWithBgImageAttributes (Only valid when "output = div")
Output as div has 2 premade helper classes to avoid inline styling, "cover" and "contain". 

##TODO
- Caching of rendering
- Ratios with bootstrap breakpoints
- Use printplugin for Lazysizes