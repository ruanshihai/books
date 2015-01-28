<!DOCTYPE html>
<?php
	session_start();

	//检测是否登录，若没登录则转向登录界面
	if(!isset($_SESSION['username'])){
	    header("Location:login.html");
	    exit();
}
?>
<html>
<head>
<title>Books管理后台</title>
<link rel="stylesheet" href="css/main.css" />
<script type="text/javascript" src="js/register.js"></script>
</head>

<body>
<div>
	<div class="content">
		<?php include('nav.html') ?>
		<div class="right">
			<?php
				if ($_POST['submit']) {
					include("mysql/conn.php");

					$username = $_POST['username'];
					$password = $_POST['password'];
					mysql_query("INSERT INTO managers VALUES('$username', '$password')");

					echo "注册成功，<a href='register.php'>点击返回</a>";
					mysql_close($conn);
				} else {
					echo <<< eof
					<form method="post" action="register.php" onsubmit="return InputCheck(this)">
						username: <input type="text" name="username" /> <br />
						password: <input type="text" name="password" /> <br />
						<input type="submit" name="submit" />
					</form>
eof;
				}
			?>
		</div>
	</div>
</div>
</body>
</html>
