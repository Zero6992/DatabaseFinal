<?php
session_start();
if ($_SESSION["user_type"] !== '管理員') {
	function_notPermisson("權限不足!返回首頁!");
} else {
	$conn = require('config.php');
	$id = $_GET['id'];
	$sql = sprintf(
		"DELETE from task WHERE task_id = %d",
		$id
	);

	$result = $conn->query($sql);
	if (!$result) {
		function_alert('刪除失敗!!');
	} else {
		function_alert('刪除成功!!');
	}
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

function function_notPermisson($message)
{
	// Display the alert box  
	echo "<script>alert('$message');
	 window.location.href='taskManage.php';
	</script>";
	return false;
}
