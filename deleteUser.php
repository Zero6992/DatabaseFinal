<?php
session_start();
$conn = require('config.php');
$conn -> query("set foreign_key_checks=0");
$id = $_GET['id'];

// 刪除使用者
$sql = sprintf(
	"DELETE from user WHERE user_id = %d;",
	$id
);

$result = $conn->query($sql);
if (!$result) {
	$conn -> query("set foreign_key_checks=1");
	function_alert('刪除失敗!!');
} else {
	$conn -> query("set foreign_key_checks=1");
	function_alert('刪除成功!!');
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
