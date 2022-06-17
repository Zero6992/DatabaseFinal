<?php
session_start();
include 'notLogIn.php';
// ******** update your personal settings ******** 
$servername = "localhost";
$username = "team10";
$password = "Ce8l68";
$dbname = "team10";

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

// 是否登出
if (!isset($_SESSION["loggedin"])) {
	function_notLogIn("您已登出!請重新登入!");
}
define("PAGE_LIMIT", 10);
// 是否為管理員
$admin = 'none';
if ($_SESSION['user_type'] == 2) {
	$admin = 'initial';
}
$topMargin = '20rem';
if($_SESSION['user_type'] == 2){
	$topMargin = '27rem';
}

// 將參數存為陣列，好處理
$urlParams = [];
parse_str($_SERVER['QUERY_STRING'], $urlParams);






//處理搜尋
$sqlMethod = '';



// 讀取所有資料
if (!empty($urlParams['searchText'])) {
	switch ($urlParams['searchType']) {
		case 'task_ID':
			$sqlMethod = '=';
			break;
		case 'task_type':
			$sqlMethod = 'like';
			$urlParams['searchText'] = "'%" . $urlParams['searchText'] . "%'";
			break;
		case 'location':
			$sqlMethod = 'like';
			$urlParams['searchText'] = "'%" . $urlParams['searchText'] . "%'";
			break;
		case 'user_ID':
			$sqlMethod = '=';
			break;
	}

	// 分頁數
	$sql_count = sprintf(
		"SELECT count(*) AS totalRows from `team10`.`task` where %s %s %s",
		$urlParams['searchType'],
		$sqlMethod,
		$urlParams['searchText']
	);
	echo ($sql_count);
	$sth_count = $conn->query($sql_count);
	$result_count = $sth_count->fetch_assoc();
	$totalRows = $result_count['totalRows'];
	$totalPages = ceil($totalRows / PAGE_LIMIT);

	//抓各頁資料
	$page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;
	$previousPage = (($page - 1) < 1) ? 1 : ($page - 1);
	$nextPage = (($page + 1) > $totalPages) ? $totalPages : ($page + 1);

	$sql =  sprintf(
		"select * from `team10`.`task` where %s %s %s LIMIT %s, %s",
		$urlParams['searchType'],
		$sqlMethod,
		$urlParams['searchText'],
		($page - 1) * PAGE_LIMIT,
		PAGE_LIMIT
	);
	echo ($sql);
	$result = $conn->query($sql);
} else {

	// 分頁數
	$sql_count = "SELECT count(*) AS totalRows FROM `team10`.`task`";
	$sth_count = $conn->query($sql_count);
	$result_count = $sth_count->fetch_assoc();
	$totalRows = $result_count['totalRows'];
	$totalPages = ceil($totalRows / PAGE_LIMIT);

	//抓各頁資料
	$page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;
	$previousPage = (($page - 1) < 1) ? 1 : ($page - 1);
	$nextPage = (($page + 1) > $totalPages) ? $totalPages : ($page + 1);

	// 讀取所有資料
	$sql =  sprintf(
		"select * from `team10`.`task` LIMIT %s, %s",
		($page - 1) * PAGE_LIMIT,
		PAGE_LIMIT
	);
	$result = $conn->query($sql);
}


?>

<!DOCTYPE html>
<html>

<head>
	<title>HomePage</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="./task.css">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	<style>
		.admin{
			display: <?= $admin ?>;
		}
	</style>
</head>

<body>

	<div class="Pboard">
		<a href="./homepage.php">
			<h1 class="mainTitle">師大環境通報系統</h1>
		</a>
		<nav>
			<ul class="topBar">
				<li><a href="./task.php">案件查詢</a></li>
				<li><a href="./track.php">回報案件追蹤</a></li>
				<li><a href="./contact.php">聯絡我們</a></li>
				<li><a href="./profile.php">個人資料</a></li>
				<li><a href="./logout.php">登出</a></li>
			</ul>
			<ul class="admin">
				<li><a href="#">管理案件</a></li>
				<li><a href="#">管理使用者</a></li>
				<li><a href="#">管理公司</a></li>
			</ul>
		</nav>
	</div>

	<form action="task.php" method="get">
		<div class="searchGroup">

			<div class="searchBar">
				<select class="searchSelection" name="searchType">
					<option value="task_ID">案件ID</option>
					<option value="task_type">案件類別</option>
					<option value="location">地點</option>
					<option value="user_ID">通報人ID</option>
				</select>
				<div class="container-1">
					<span class="submit" name="submit" type="submit" onClick="submitForm()"><i class="fa fa-search"></i></span>
					<input type="search" class="searchText" name="searchText" placeholder="搜尋...">
				</div>
			</div>
	</form>
	<table width="100%" class="board">
		<thead>
			<tr align="center">
				<td class="boardTitle">案件ID</td>
				<td class="boardTitle">案件類別</td>
				<td class="boardTitle">案件通報時間</td>
				<td class="boardTitle">地點</td>
				<td class="boardTitle">狀態</td>
				<td class="boardTitle">通報人ID</td>
			</tr>
		</thead>
		<tbody>
			<?php while ($board = $result->fetch_assoc()) : ?>
				<?php
				if ($board['task_type'] == 1) {
					$board['task_type'] = '廢棄物';
				} else if ($board['task_type'] == 2) {
					$board['task_type'] = '落葉';
				} else if ($board['task_type'] == 3) {
					$board['task_type'] = '髒污清潔';
				} else if ($board['task_type'] == 4) {
					$board['task_type'] = '器物損壞';
				} else if ($board['task_type'] == 5) {
					$board['task_type'] = '其他';
				} ?>
				<?php
				if ($board['flag'] == 0) {
					$board['flag'] = '未處理';
				} else if ($board['flag'] == 1) {
					$board['flag'] = '處理中';
				} else if ($board['flag'] == 2) {
					$board['flag'] = '已處理';
				} ?>
				<tr align="center">
					<td class="boardInput" name="task_ID"><?php echo $board['task_id'] ?></td>
					<td class="boardInput" name="task_type"><?php print $board['task_type'] ?></td>
					<td class="boardInput" name="task_time"><?php print $board['time'] ?></td>
					<td class="boardInput" name="locatio"><?php print $board['location'] ?></td>
					<td class="status" name="task_status" bgcolor="<?php if ($board['flag'] === '未處理') {
																		echo "#A7414A";
																	} elseif ($board['flag'] === '處理中') {
																		echo "#F28A30";
																	} elseif ($board['flag'] === '已處理') {
																		echo "#ADFF2F";
																	} ?>"><?php print $board['flag'] ?></td>
					<td class="boardInput" name="user_ID"><?php print $board['user_id'] ?></td>
				</tr>
			<?php endwhile ?>



		</tbody>
	</table>
	<nav>
		<ul class="pagination">
			<li class="page-item"><a class="page-link" href="task.php?page=<?php print $previousPage ?>">前一頁</a></li>
			<?php for ($i = 1; $i <= $totalPages; $i++) : ?>
				<li class="page-item<?php if ($page == $i) print 'active' ?>"><a class="page-link" href="task.php?page=<?php print $i ?>"><?php print $i ?></a></li>
			<?php endfor ?>
			<li class="page-item"><a class="page-link" href="task.php?page=<?php print $nextPage ?>">下一頁</a></li>
		</ul>
	</nav>

	</div>
	</div>

	<script>
		function submitForm() {
			document.forms[0].submit();
		}
	</script>

</body>

</html>