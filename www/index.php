<?php
echo "www"; 

$request = $_SERVER['REQUEST_URI'];
echo $request;
 
exit; 
switch ($request) {
    case '/' :
        require __DIR__ . '/views/index.php';
        break;
    case '' :
        require __DIR__ . '/views/index.php';
        break;
    case '/about' :
        require('views/about.php');
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}