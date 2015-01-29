<!DOCTYPE html>
<?php
	require_once('../common/global.php');
	login_handle();
?>
<html>
<head>
<title>Books管理后台</title>
<link rel="stylesheet" type="text/css" href="../css/main.css" />
<link rel="stylesheet" type="text/css" href="../css/register.css" />
</head>

<body>
<div>
	<div class="content">
		<?php include('nav.html') ?>
		<div class="right">
			<div id="reg">
				<form method="post" action="#" onsubmit="return SubmitHandle(this)">
					username: <input type="text" name="username" /> <br />
					password: <input type="text" name="password" /> <br />
					<input type="submit" name="submit" />
				</form>
			</div>
			<div id="goback">
				<p>注册成功，<a href='register.php'>点击返回</a></p>
			</div>
		</div>
	</div>
</div>
</body>
<script type="text/javascript" src="../js/common.js"></script>
<script type="text/javascript" src="../js/register.js"></script>
</html>
