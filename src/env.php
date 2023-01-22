<?php
session_start();


$mysql_user = "root";
$mysql_password = "ccchlccc123";


$app = array();
$app['mysql_user'] = $mysql_user;
$app['mysql_password'] = $mysql_password;
$app['mysql_dbname'] = "quiznight";
$app["project_id"] = getenv('GCLOUD_PROJECT');

$servername = null;
$username = $app['mysql_user'];
$password = $app['mysql_password'];
$dbname = $app['mysql_dbname'];
$dbport = null;

$conn = new mysqli($servername, $username, $password, $dbname, 
	$dbport, "/cloudsql/quiz-night-bck:europe-west1:quiznight-data");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "\nConnected successfully\n";

?>