<?php
session_start();
$conn=require('config.php');
// 設定一頁幾筆
define("PAGE_LIMIT", 5);

// 是否為管理員
$admin = require('isAdmin.php');
$topMargin = '20rem';
if ($_SESSION['user_type'] == '管理員') {
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
		case 'problem':
			$sqlMethod = 'like';
			$urlParams['searchText'] = "'%" . $urlParams['searchText'] . "%'";
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
			float: left;
			position: relative;
			padding: 1rem 2rem 0.5rem 2.5rem;
			border: 3px solid #776e62;
			transition: padding 0.3s ease-in-out;
		}

		.mainTitle::before {
			content: "";
			position: absolute;
			top: 0.5rem;
			left: 0.5rem;
			z-index: -1;
			height: 100%;
			width: 100%;
			background-color: #dddfca;
			border-right: 3px solid #dddfca;
			border-bottom: 3px solid #dddfca;
			-webkit-transition: all 0.3s ease-in-out;
			transition: all 0.3s ease-in-out;

		}

		.mainTitle:hover {
			padding: 0.75rem 2.25rem;
		}

		.mainTitle:hover::before {
			top: 0;
			left: 0;
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
			color: #127a7a;
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
			border-color: #ffffff;
			cursor: pointer;	
			background-image: linear-gradient(45deg, transparent 50%, #000000 50%);
			background-position: 25%;
			background-size: 400%;
			-webkit-transition: background 500ms ease-in-out, color 500ms ease-in-out;
		}

		.Pboard a:hover {
			color: #ffffff;
			background-position: 100%;
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

		.textArea {
			font-size: 1.15rem;
			border: none;
			background-color: rgb(39, 34, 34);
			color: #fff;
			display: flex;
			padding: 0.5rem;
			resize: none;
			float: left;
			width: 95%;
			outline: none;
		}

		.inputText {
			font-size: 1.5rem;
			font-weight: bolder;
			margin: 0.4rem;
			width: 100%;
			height: 100%;
			border-radius: 20px;
			text-align: center;

		}

		.action_td {
			display: inline-grid;
		}

		.action {
			display: inline-grid;
			flex-direction: column-reverse;
			width: 6rem;
			height: 2rem;
		}

		.fa-pencil {
			background-color: #4bc45b;
		}

		.fa-trash-o {
			background-color: #ff4b5b;
		}

		.action input {
			font-size: 1rem;
			font-weight: 700;
			border-radius: 10px;
			cursor: pointer;
			width: 100%;
			height: 80%;
			margin: 0.3rem;

		}

		.action input:hover {}

		.status {
			display: inline-block;
			font-size: 1.1rem;
			font-weight: bolder;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			border-radius: 40%;
			padding: 0.8rem;
			color: #2b2b2b;
			margin: 5%
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
		@media screen and (min-width:1420px) {
			.topBar {
				position: absolute;
				right: 0rem;
			}

			.admin {
				position: relative;
				top: 7.8rem;
			}
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
				<li><a href="./taskManage.php">管理案件</a></li>
				<li><a href="./userManage.php">管理使用者</a></li>
				<li><a href="#">管理公司</a></li>
			</ul>
		</nav>
	</div>

	<form action="taskManage.php" method="get">
		<div class="searchGroup">

			<div class="searchBar">
				<select class="searchSelection" name="searchType">
					<option value="task_ID">案件ID</option>
					<option value="task_type">案件類別</option>
					<option value="location">地點</option>
					<option value="problem">案件簡述</option>
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
				<form action="./editTask.php?id=<?php print $board['task_id'] ?>" method="post" name="taskAction">
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
						<td class="boardInput">
							<select class="inputText" name="task_type">
								<option value="廢棄物" <?php if ($board['task_type'] == '廢棄物') {
														print 'selected';
													} ?>>廢棄物</option>
								<option value="落葉" <?php if ($board['task_type'] == '落葉') {
														print 'selected';
													} ?>>落葉</option>
								<option value="髒污清潔" <?php if ($board['task_type'] == '髒污清潔') {
															print 'selected';
														} ?>>髒污清潔</option>
								<option value="器物損壞" <?php if ($board['task_type'] == '器物損壞') {
															print 'selected';
														} ?>>器物損壞</option>
								<option value="其他" <?php if ($board['task_type'] == '其他') {
														print 'selected';
													} ?>>其他</option>
							</select>
						</td>

						<td class="boardInput" name="location"><?php print $board['location'] ?></td>
						<td class="status">
							<select class="inputText" name="task_status">
								<option value="未處理" <?php if ($board['flag'] == '未處理') {
														print 'selected';
													} ?>>未處理</option>
								<option value="處理中" <?php if ($board['flag'] == '處理中') {
														print 'selected';
													} ?>>處理中</option>
								<option value="已處理" <?php if ($board['flag'] == '已處理') {
														print 'selected';
													} ?>>已處理</option>
							</select>
						</td>
						<td class="boardInput" name="user_ID"><?php print $board['user_id'] ?></td>
						<td class="boardInput" name="problem"><textarea class="textArea" readonly="true" rows="2" cols="10"><?php print $board['problem'] ?></textarea> </td>

						<td class="action_td">
							<div class="action">
								<input value="編輯" class="fa fa-pencil" type="submit" aria-hidden="true" onclick="editTask()">
							</div>
				</form>
				<form action="./deleteTask.php?id=<?php print $board['task_id'] ?>" method="post" name="taskAction" class="action">
					<input value="刪除" class="fa fa-trash-o" type="submit" aria-hidden="true" onclick="return confirm('確認要刪除?')">
				</form>
				</td>
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


		function editTask() {
			document.taskAction.action = "./editTask.php"
		}
	</script>

</body>

</html>