<?php
//header('Content-type: text/json');
//$user = Phpfox::getUserId();
//include '/Users/antonio/sites/nextplease.dev/module/user/include/service/auth.class.php';
//echo '[';
//$separator = "";
//$days = 16;
//	echo '	{ "date": "1380931200000", "type": "meeting", "title": "Test Last Year", "description": "$user", "url": "http://www.event3.com/" },';
//	echo '	{ "date": "1377738000000", "type": "meeting", "title": "Test Next Year", "description": "Lorem Ipsum dolor set", "url": "http://www.event3.com/" }';
//
//echo ']';

$json_data = json_decode(file_get_contents('/Users/antonio/sites/nextplease.dev/eventCalendar_v054/json/events.json'), true);

$newData = Array(
            'date' => $_POST['date'],
            'type' => $_POST['type'],
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'url' => $_POST['url']
        );

$json_data[] = $newData;

file_put_contents('/Users/antonio/sites/nextplease.dev/eventCalendar_v054/json/events.json', json_encode($json_data));

echo print_r($json_data);

?>