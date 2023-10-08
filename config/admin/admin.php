<?php

return [

    // 画像の設定
    'image' => [
        'no_image_url' => '/assets/admin/images/admin/no-image.png',
        'dimensions' => [
            'width'  => 110,
            'height' => 110,
        ],
        'allowed_extension' => 'jpg,jpeg,png,gif',
        'max_sizes' => [
            'kb' => 1024 * 1024,
            'gb' => 1,
        ],
    ],

];