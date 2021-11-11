<?php
$server = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "covid";

$conn = new mysqli($server, $dbuser, $dbpassword, $dbname);
if ($conn->connect_error) {
	die ("Database failed");
}
