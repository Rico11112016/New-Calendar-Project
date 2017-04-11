<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

// Get month, week and days
$app->get('/api/calendar', function (Request $request, Response $response) {

    $sql = "SELECT month_name FROM months"; // WHERE month_id = 1";
    $sql2 = "SELECT week_nr, day_nr FROM weeks_and_days GROUP BY week_nr, day_nr";

    try {
    // Get DB Object
    $dbcalendar = new dbcalendar();
    //Connect
    $dbcalendar = $dbcalendar->connect();

    $stmt = $dbcalendar->query($sql);
    $stmt2 = $dbcalendar->query($sql2);

    $r = $stmt->fetchAll(PDO::FETCH_OBJ);
 
    while($r2 = $stmt2->fetchAll(PDO::FETCH_OBJ)) {
    $r['week'] = $r2;
    };
    return $response->withJson($r);
  
    } catch(PDOException $e) {
        $error = array('error' => array('text' => $e->getMessage()));
        return $response->withJson($error,500);
    }
});

// Add days in month
$app->post('/api/calendar/add', function (Request $request, Response $response) {
    $year = $request->getParam('Year');
    $month = $request->getParam('Month');
    $day = $request->getParam('Day');

    $day = 1;
    while($day < 31) {
        $day = $day + 1;
        $sql = "INSERT INTO `days` (`Year`, `Month`, `Day`) VALUES ('2017', '1', '$day')";
         

    try {
        // Get DB Object
        $dbcalendar = new dbcalendar();
        // Connect
        $dbcalendar = $dbcalendar->connect();
        
        $stmt = $dbcalendar->prepare($sql);

        $stmt->bindParam(':Year', $year);
        $stmt->bindParam('Month', $month);
        $stmt->bindParam('Day', $day);

        $stmt->execute();

        echo '{"notice": {"text": "Days Added"}';

    } catch(PDOException $e) {
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
    };
});