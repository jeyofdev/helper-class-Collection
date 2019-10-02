<?php

    // Autoload
    require dirname(__DIR__) . '/vendor/autoload.php';


    // php errors
    $whoops = new \Whoops\Run;
    $whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();


    // Run the methods of Class 'Collection'
    $list = new jeyofdev\Helper\ManipulateArray\Collection([
        ["name" => "Jean", "language" => "php", "note" => "11"],
        ["name" => "Marc", "language" => "javascript", "note" => "15"],
        ["name" => "Emily", "language" => "python", "note" => "13"]
    ]);

    dump($list->extract("note")->max());
    dump($list->max("note"));

    dump($list->extract("note")->min());
    dump($list->min("note"));