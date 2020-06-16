<?php

$con = mysql_connect("mysql5.000webhost.com","a4238009_vbtipp","******");
if (!$con) {
	die('Nem tud csatlakozni az adatbázishoz: ' . mysql_error());
}

mysql_select_db("a4238009_vbtipp", $con);

define('TIMEZONE', 'Europe/Budapest');
date_default_timezone_set(TIMEZONE);

?>
