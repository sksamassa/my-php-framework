<?php
    require_once  __DIR__.'/../vendor/autoload.php';
    

    $app = new \Sksamassa\MyFramework\src\Application();

    $app -> router -> get('/',
        function(){
            return 'Hello World!';
        }
    );
    $app -> router -> get('/contact', 'contact');

    $app -> run();