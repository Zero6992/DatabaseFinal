<?php
session_start();

include 'notLogIn.php';
// ******** update your personal settings ******** 
/*
$servername = "localhost";
$username = "root";
$password = "wendy1102";
$dbname = "team10";
*/

$servername = "localhost";
$username = "team10";
$password = "Ce8l68";
$dbname = "team10";


// Connecting to and selecting a MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);
// 編碼
if (!$conn->set_charset("utf8")) {
	printf("Error loading character set utf8: %s\n", $conn->error);
	exit();
}

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// 是否登出
if (!isset($_SESSION["loggedin"])) {
	function_notLogIn("您已登出!請重新登入!");
}


return $conn;
?>