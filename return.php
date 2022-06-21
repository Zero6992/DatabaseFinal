<?php
session_start();
$conn = require('config.php');

if (empty($_POST['task_type']) || empty($_POST['location']) || empty($_POST['time']) || empty($_POST['problem'])) {
	function_alert('資料不完全!!!');
} else {
	$task_type = $_POST['task_type'];
	$location = $_POST['location'];
	$time = $_POST['time'];
	$problem = $_POST['problem'];
	$user_id = $_SESSION['user_id'];

	$insert_sql = "INSERT INTO task(task_type,location,time,problem,user_id) VALUES('$task_type','$location','$time','$problem','$user_id');";	// ******** update your personal settings ******** 

	if ($conn->query($insert_sql) === TRUE) {
		function_alert('回報成功!!');
	} else {
		echo ("Error description: " . $conn->error);
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
?>