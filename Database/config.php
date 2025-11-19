<?php
$config = [
	'host' => 'localhost',
	'user' => 'root',
	'password' => '',
	'name' => 'penggajian',
	'port' => 3306,
];

$mysqli = new mysqli(
	$config['host'],
	$config['user'],
	$config['password'],
	$config['name'],
	$config['port']
);

if ($mysqli->connect_errno) {
	die('Database connection failed: '.$mysqli->connect_error);
}

function db_connection()
{
	global $mysqli;
	return $mysqli;
}

