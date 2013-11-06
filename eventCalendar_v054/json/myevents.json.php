<?php
header('Content-type: text/json');
//$user = Phpfox::getUserId();
//include '/Users/antonio/sites/nextplease.dev/module/user/include/service/auth.class.php';
echo '[';
$separator = "";
$days = 16;
	echo '	{ "date": "1380931200000", "type": "meeting", "title": "Test Last Year", "description": "$user", "url": "http://www.event3.com/" },';
	echo '	{ "date": "1377738000000", "type": "meeting", "title": "Test Next Year", "description": "Lorem Ipsum dolor set", "url": "http://www.event3.com/" }';

echo ']';
?>