<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../src/config/db.php';
require '../src/config/dbcalendar.php';

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Let's get started, $name");

    return $response;
});

// Customer Routes
require '../src/routes/customers.php';

// Calendar Routes
require '../src/routes/calendar.php';


$app->run();