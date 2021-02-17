<?php
function connect_db()
{
	$server = 'localhost';
	$user = 'vf_test_dbconn';
	$pass = 'v8qcrWPk';
	$database = 'vf_test';
	$connection = new mysqli($server, $user, $pass, $database);

	return $connection;
}
?>
