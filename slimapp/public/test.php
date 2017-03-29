<?php
$day = 0;
$month = 1;
$year = 2017;
while($day < 31) {
    
    $day = $day + 1;
    echo '{"Year":"2017", "Month":"1", "Day":'; echo "'$day'"; echo '}';
};