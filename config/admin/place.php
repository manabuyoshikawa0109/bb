<?php

return [

    // Googleマップの設定
    'google_map_url' => 'https://www.google.co.jp/maps/?hl=ja',

    // 画像の設定
    'image' => [
        'no_image_url' => '/assets/common/images/no-image-600×400.png',
        'dimensions' => [
            'width'  => 600,
            'height' => 400,
        ],
        'allowed_extension' => 'jpg,jpeg,png,gif',
        'max_sizes' => [
            'kb' => 1024 * 1024,
            'gb' => 1,
        ],
    ],

];
