<?php

    // Autoload
    require dirname(__DIR__) . '/vendor/autoload.php';


    // php errors
    $whoops = new \Whoops\Run;
    $whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();


    // Run the methods of Class 'Collection'
    $collection = new jeyofdev\Helper\ManipulateArray\Collection();

    $collection
        ->set("username", "john")
        ->set("note", 15);


    dump($collection->getDatas());