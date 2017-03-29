<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

// Get All Customers
$app->get('/api/calendar', function (Request $request, Response $response) {

    // echo 'CALENDAR'; });

    $sql = "SELECT * FROM days";

    try {
    // Get DB Object
    $dbcalendar = new dbcalendar();
    //Connect
    $dbcalendar = $dbcalendar->connect();

    $stmt = $dbcalendar->query($sql);
    $calendar = $stmt->fetchAll(PDO::FETCH_OBJ);
    $dbcalendar = null;
    echo json_encode($calendar);
    } catch(PDOException $e) {
        echo '{"error": {"text": '.$e->getMessage().'}';
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