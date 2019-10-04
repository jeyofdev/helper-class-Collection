<?php

    // Autoload
    require dirname(__DIR__) . '/vendor/autoload.php';


    // php errors
    $whoops = new \Whoops\Run;
    $whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();


    // Run the methods of Class 'Collection'
    // $list = new jeyofdev\Helper\ManipulateArray\Collection([
    //     "php", "javascript", "python", "html", "css", "java"
    // ]);


    // dump($list);

    // dump($list->extractPart(2));
    // dump($list->extractPart(-3, 2));
    // dump($list->extractPart(0, 3));

    

    $collection = new jeyofdev\Helper\ManipulateArray\Collection();
    
    dump($collection->set("username", "john")
    ->set("note", 15));

    dump($collection->empty());