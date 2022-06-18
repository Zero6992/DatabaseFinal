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

// 是否登出
if (!isset($_SESSION["loggedin"])) {
	function_notLogIn("您已登出!請重新登入!");
}
//一頁幾筆
define("PAGE_LIMIT", 10);
// 是否為管理員
$admin = 'none';
if ($_SESSION['user_type'] == 2) {
	$admin = 'initial';
}
$topMargin = '15rem';
if ($_SESSION['user_type'] == 2) {
	$topMargin = '24rem';
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

	$sth_count = $conn->query($sql_count);
	if (empty($sth_count)) {
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
		function_alert("查無資料!");
		$result = $conn->query($sql);
	} else {
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

		$result = $conn->query($sql);
	}
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


function function_alert($message)
{

	// Display the alert box  
	echo "<script>alert('$message');
    </script>";
	return false;
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>HomePage</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	<style>
		body {
			background-color: #bbbf95;
		}

		.mainTitle {

			cursor: pointer;
			color: #127a7a;
			font-size: 2.8rem;
			padding: 0.2rem;
			float: left;
			margin-left: 2%;
			margin-top: 1.5rem;


		}



		.returnForm {
			display: flex;
			margin-top: 30rem;
			justify-content: center;
			align-items: center;
		}

		.topBar {

			width: auto;
			float: right;
			margin-top: 1rem;
			border-bottom: solid rgba(10, 25, 77, 0.3) 0.2rem;

		}

		.topBar a {
			color: black;
		}

		.admin {

			width: auto;
			float: right;
			margin-top: 1rem;
			border-bottom: solid rgba(10, 25, 77, 0.3) 0.2rem;

		}

		.admin a {
			color: #720017;
		}

		.Pboard li {
			font-size: 1.5rem;
			font-weight: bold;
			display: inline-block;
			padding: 1.6rem 2rem;
		}

		.Pboard a {
			text-align: center;

			text-decoration: none;
		}

		.Pboard a:hover {
			color: #B9e5f3;
			background-color: black;
			background-size: 50% 30%;
			transition: 1s;
			border: solid rgba(10, 25, 77, 1) 0.2rem;
		}

		.searchGroup {
			position: absolute;
			width: 95%;
			margin: 2.4rem;
		}

		.searchBar {
			display: inline-flex;
			float: right;
			margin-bottom: 0.2rem;



		}

		.searchSelection {
			bottom: 3px;
			width: 33%;
			height: 3rem;
			background: #21252c;
			border: none;
			font-size: 0.9rem;
			font-weight: bold;
			float: left;
			color: #c6d6e6;
			padding-left: 2rem;
			border-radius: 5px;
			cursor: pointer;
		}

		.searchSelection:hover {
			color: #fff;
			background-color: rgb(39, 34, 34);
			display: list-item;
			transition: 1s;

		}

		.searchSelection:focus {
			color: #fff;
			background-color: rgb(39, 34, 34);
			display: list-item;
			transition: 1s;

		}

		.searchSelection::selection {
			color: #fff;
			background-color: rgb(39, 34, 34);
			transition: 1s;
		}

		.searchText {
			width: 100%;
			height: 3rem;
			background: #21252c;
			border: none;
			font-size: 0.9rem;
			font-weight: bold;
			float: left;
			color: #c6d6e6;
			padding-left: 1rem;
			border-radius: 5px;
		}

		.searchText:focus {
			color: #fff;
			background-color: rgb(39, 34, 34);
			outline: none;
			transition: 1s;
		}

		.container-1 {
			width: 300px;
			vertical-align: middle;
			white-space: nowrap;
			position: relative;
		}

		.submit {
			cursor: pointer;
			padding-left: 1rem;
			border-left: 2px solid rgba(105, 177, 177, 0.3);
			position: absolute;
			top: 33%;
			margin-left: 14.3rem;
			z-index: 1;
			color: #4f5b66;
		}

		.board {

			overflow: auto;
			background-color: rgb(39, 34, 34);
			border-radius: 30px;
			border-collapse: collapse;
			color: rgb(238, 231, 231);
			cursor: default;
			box-shadow: 11px 3px 30px #4f5b66;
		}

		.board tr {
			border-top: 0.1rem solid rgb(109, 93, 93);
		}

		.boardTitle {
			font-size: 1.25rem;
			font-weight: bolder;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			background-color: rgb(54, 52, 52);


		}

		.boardInput {
			font-size: 1.15rem;
			font-weight: 400;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			padding: 0.8rem;
		}

		.action {
			display: inline-grid;
			flex-direction: column-reverse;
			width: 6rem;
			height: 5rem;
		}
		.fa-pencil{
			background-color:#4bc45b;
		}
		.fa-trash-o{
			background-color:#ff4b5b;
		}
		.action button{
			font-size: 0.9rem;
			margin: 0.3rem;
			font-weight: 700;
			
			border-radius: 10px;
			cursor: pointer;

		}
		.fa-pencil{
			background-color:#4bc45b;
		}
		
		.status {
			display: inline-block;
			font-size: 1.1rem;
			font-weight: bolder;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			border-radius: 40%;
			padding: 0.75rem 0.8rem;
			color: #2b2b2b;
			margin: 1rem 0px;
			border-style: solid;
			border-width: 2px;
			border-color: #c6d6e6;

		}

		.page-item {
			font-size: 1.2rem;
			font-weight: bold;
			border: solid black 0.2rem;
			display: inline-block;
			padding: 1.1rem 1.3rem;
		}

		.page-item:hover {
			background-color: rgb(39, 34, 34);
			color: #fff;
			transition: 1s;
		}

		.page-itemactive {
			font-size: 1.2rem;
			font-weight: bold;
			border: solid black 0.2rem;
			display: inline-block;
			padding: 1.1rem 1.3rem;
			background-color: rgb(39, 34, 34);

			transition: 1s;
		}

		.page-itemactive a {
			color: #fff;
		}

		.page-link {
			text-align: center;
			color: black;
			text-decoration: none
		}

		.page-link:hover {
			color: #fff;
		}

		.admin {
			display: <?= $admin ?>;
		}

		.searchGroup {
			top: <?= $topMargin ?>;
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
				<td class="boardTitle">地點</td>
				<td class="boardTitle">狀態</td>
				<td class="boardTitle">通報人ID</td>
				<td class="boardTitle">案件簡述</td>
				<td class="boardTitle">管理</td>
			</tr>
		</thead>
		<tbody>
			<?php while ($board = $result->fetch_assoc()) : ?>

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

					<td class="boardInput" name="locatio"><?php print $board['location'] ?></td>
					<td class="status" name="task_status" bgcolor="<?php if ($board['flag'] === '未處理') {
																		echo "#A7414A";
																	} elseif ($board['flag'] === '處理中') {
																		echo "#F28A30";
																	} elseif ($board['flag'] === '已處理') {
																		echo "#ADFF2F";
																	} ?>"><?php print $board['flag'] ?></td>
					<td class="boardInput" name="user_ID"><?php print $board['user_id'] ?></td>
					<td class="boardInput" name="problem"><?php print $board['problem'] ?></td>

					<td class="action"><button class="fa fa-trash-o" aria-hidden="true">刪除</button><button class="fa fa-pencil"  aria-hidden="true">編輯</button></td>
				</tr>
			<?php endwhile ?>



		</tbody>
	</table>
	<nav>
		<ul class="pagination">
			<li class="page-item"><a class="page-link" href="taskManage.php?page=<?php print $previousPage ?>">前一頁</a></li>
			<?php for ($i = 1; $i <= $totalPages; $i++) : ?>
				<li class="page-item<?php if ($page == $i) print 'active' ?>"><a class="page-link" href="taskManage.php?page=<?php print $i ?>"><?php print $i ?></a></li>
			<?php endfor ?>
			<li class="page-item"><a class="page-link" href="taskManage.php?page=<?php print $nextPage ?>">下一頁</a></li>
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