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

    dump($list->get("0")->keys());
    dump($list->get("0")->keys("php"));
    dump($list->extract("name")->keys("Marc"));

    dump($list->get("0")->get());
    dump($list->extract("name")->get());