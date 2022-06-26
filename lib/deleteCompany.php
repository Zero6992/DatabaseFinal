<?php
session_start();
$conn=require('config.php');

$id = $_GET['id'];

// 刪除此使用者提交過的任務
$sql = sprintf(
	"DELETE from payment WHERE company_id = %d;",
	$id
);
$result = $conn->query($sql);

if (!$result) {
	function_alert('刪除失敗!!');
} else {
	function_alert('刪除成功!!');
}

function function_alert($message)
{
	// Display the alert box  
	echo "<script>
	 alert('$message');
     window.location.href='companyManage.php';
    </script>";
	return false;
}
