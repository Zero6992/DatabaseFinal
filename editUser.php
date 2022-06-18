<?php
session_start();
include 'notLogIn.php';
// ******** update your personal settings ******** 
$servername = "localhost";
$username = "root";
$password = "wendy1102";
$dbname = "team10";

/*
$servername = "localhost";
$username = "team10";
$password = "Ce8l68";
$dbname = "team10";
*/

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

$id = $_GET['id'];
$task_type = $_POST['task_type'];
$task_status = $_POST['task_status'];
// 存進資料庫為數字
if ($task_status == '處理中') {
	$task_status = 1;
} else if ($task_status == '已處理') {
	$task_status = 2;
} else {
	$task_status = 0;
}
// 更新SQL
$sql = sprintf(
	"UPDATE task SET task_type = '%s', flag = %d WHERE task_id = %d",
	$task_type,
	$task_status,
	$id
);

$result = $conn->query($sql);
if (!$result) {
	function_alert('更新失敗!!');
} else {
	 function_alert('更新成功!!');
}

function function_alert($message)
{
	// Display the alert box  
	echo "<script>
	 alert('$message');
     window.location.href='taskManage.php';
    </script>";
	return false;
}
