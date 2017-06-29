<?php
    $base = __DIR__ . '/../app/';

    $folders = [
        'lib',
        'model',
        'route'
    ];

    foreach($folders as $folder){
        foreach(glob($base . "$folder/*.php") as $k => $filename){
            require $filename;
        }
    }