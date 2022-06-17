<?php
session_start();
include 'notLogIn.php';
// ******** update your personal settings ******** 
$servername = "localhost";
$username = "root";
$password = "wendy1102";
$dbname = "project";

// Connecting to and selecting a MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn->set_charset("utf8")) {
	printf("Error loading character set utf8: %s\n", $conn->error);
	exit();
}

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

if(!isset($_SESSION["loggedin"])){
	function_notLogIn('您已登出!請重新登入!');
}

if (empty($_POST['task_type']) || empty($_POST['location']) || empty($_POST['time']) || empty($_POST['problem'])) {
	function_alert('資料不完全!!!');
} else {
	$task_type = $_POST['task_type'];
	$location = $_POST['location'];
	$time = $_POST['time'];
	$problem = $_POST['problem'];
	$user_id = $_SESSION['user_id'];

	$insert_sql = "INSERT INTO TASK (task_type,location,time,problem,user_id) VALUES('$task_type','$location','$time','$problem','$user_id');";	// ******** update your personal settings ******** 

	if ($conn->query($insert_sql) === TRUE) {
		function_alert('回報成功!!');
	} else {
		function_alert('回報失敗!!');
	}
}



function function_alert($message)
{
	// Display the alert box  
	echo "<script>alert('$message');
     window.location.href='homepage.php';
    </script>";
	return false;
}
