<?php

return [
    'template' => [
        'wrapper_start' => TEMPLATE_PATH . "wrapperstart.php",
        ':view' => ':action_view',
        'wrapper_end' => TEMPLATE_PATH . "wrapperend.php",
        'nav' => TEMPLATE_PATH . "nav.php"
    ],
    'header_resources' => [
        'css' => [
            'bootstrap' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css',
            'css' => CSS . "style.css",
        ]
    ],
    'footer_resources' => [
        'js' => [
            'bootstrap' => "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js",
        ]
    ],

];


