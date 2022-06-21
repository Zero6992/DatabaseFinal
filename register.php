<?php
session_start();

?>
<!DOCTYPE html>

<head>
	<title>師大環境通報系統註冊</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<style>
		body {
			background-color: #bbbf95;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.bigTitle {
			cursor: default;
			font-size: 3rem;
			text-shadow: black 1rem 0.1em 0.2em;
			display: flex;
			justify-content: center;
		}

		.signUpArea {
			background-color: #23345c;
			border-radius: 2rem;
			box-shadow: -10px 10px 0px 0px black;
			color: aliceblue;
			width: 35rem;
			padding: 2rem;
			margin-top: 20rem;
		}

		.signUpArea p {
			cursor: default;
			font-size: 1.4rem;
			font-weight: bolder;
		}


		.inputText {
			width: 32rem;
			height: 2.5rem;
			margin-left: 0.rem;
			border-radius: 20px;
			text-align: center;

		}

		.inputText:focus {
			background-color: azure;
			transition: 1s;
			outline: none
		}


		.button {
			float: right;
			margin-left: 3rem;
			width: 7rem;
			font-size: 2rem;
			background-color: black;
			color: aliceblue;
			border-radius: 7%;
			box-shadow: 4px 3px 4px rgb(63, 134, 192);
			font-weight: bold;

		}

		.button:hover {
			color: #e76f45;
			background-color: aliceblue;
			box-shadow: 4px 3px 4px rgb(139, 28, 28);
			transition: 1s;
			cursor: pointer;
		}
	</style>
</head>

<body>
	<form class="signUpArea" action="" method="post" name="signUpForm">
		<h1 class="bigTitle">師大環境通報系統註冊</h1>

		<p>姓名</p>
		<input class="inputText" placeholder="請輸入姓名......(20字以內)" type="text" name="userName" />

		<p>信箱</p>
		<input class="inputText" placeholder="請輸入信箱......" type="text" name="userMail" />

		<p>帳號</p>
		<input class="inputText" placeholder="請輸入帳號......(20字以內)" type="text" name="userAccount" />

		<p>密碼</p>
		<input class="inputText" placeholder="請輸入密碼......(20字以內)" type="password" name="userPassword" />

		<p>
			<input style="margin-right: 1rem" class="button" type="submit" value="註冊" onclick="SignUpDone()" />
			<input style="margin-left:1rem" class="button" type="submit" value="返回" onclick="cancel()" />
		</p>

	</form>


	<script>
		function cancel() {
			document.signUpForm.action = "./index.php"
			document.signInForm.submit()
		}

		function SignUpDone() {
			document.signUpForm.action = "./signUp.php"
			document.signInForm.submit()
		}
	</script>
</body>

</html>