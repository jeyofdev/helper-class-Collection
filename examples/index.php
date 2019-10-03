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
        ["name" => "Marc", "language" => "javascript", "note" => "8"],
        ["name" => "Emily", "language" => "python", "note" => "13"]
    ]);


    function hasTheAverage ($note)
    {
        return ($note >= 10) ? $note : null;
    }


    function hasNotTheAverage ($note)
    {
        return ($note < 10) ? $note : null;
    }


    dump($list->extract("name"));

    dump($list->extract("note")->filter("hasTheAverage"));
    dump($list->extract("note")->filter("hasNotTheAverage"));