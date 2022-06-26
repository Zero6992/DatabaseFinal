<?php
session_start();
$conn = require('config.php');

$id = $_GET['id'];
$user_type = $_POST['user_type'];
$name = $_POST['name'];
$mail = $_POST['mail'];
$account = $_POST['account'];

// 更新SQL
$sql = sprintf(
	"UPDATE user SET user_type = '%s', name = '%s', mail = '%s', account = '%s'  WHERE user_id = %d",
	$user_type,
	$name,
	$mail,
	$account,
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
     window.location.href='userManage.php';
    </script>";
	return false;
}
