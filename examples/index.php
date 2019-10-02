<?php

    // Autoload
    require dirname(__DIR__) . '/vendor/autoload.php';


    // php errors
    $whoops = new \Whoops\Run;
    $whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();


    // Run the methods of Class 'Collection'
    $list = new jeyofdev\Helper\ManipulateArray\Collection([
        ["name" => "Jean", "language" => "php", "country" => "us"],
        ["name" => "Marc", "language" => "javascript", "country" => "en"],
        ["name" => "Emily", "language" => "python", "country" => "fr"]
    ]);

    dump($list->lists("name", "language"));
    dump($list->extract("language"));
    dump($list->extract("language")->join(", "));