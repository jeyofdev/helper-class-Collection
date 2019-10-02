<?php

    // Autoload
    require dirname(__DIR__) . '/vendor/autoload.php';


    // php errors
    $whoops = new \Whoops\Run;
    $whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();


    // Run the methods of Class 'Collection'
    $post = new jeyofdev\Helper\ManipulateArray\Collection($_POST);

    $post["name"] = "jean";
    dd($post["name"]);