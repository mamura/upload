<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;

return function (App $app) {
    $app->get('/', '\App\Controllers\HomeController:index');
    $app->post('/', '\App\Controllers\HomeController:upload');
};
