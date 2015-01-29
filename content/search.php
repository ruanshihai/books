<!DOCTYPE html>
<?php
	require_once('../common/global.php');
	login_handle();
?>
<html>
<head>
<title>Books管理后台</title>
<link rel="stylesheet" type="text/css" href="../css/main.css" />
<link rel="stylesheet" type="text/css" href="../css/search.css">
</head>
<body>
<div>
	<div class="content">
		<?php include('nav.html') ?>
		<div class="right">
			<div id="submit">
				<form method="post" action="#" onsubmit="return SearchHandle(this)">
					BookID: <input type="text" name="BookID" /> <br />
					Name: <input type="text" name="Name" /> <br />
					Author: <input type="text" name="Author" /> <br />
					Published Date: <input type="text" name="Pubdate" /> <br />
					Subject: <input type="text" name="Subject" /> <br />
					Publisher: <input type="text" name="Publisher" /> <br />
					Price: <input type="text" name="Price" /> <br />
					AddOn: <input type="text" name="AddOn" /> <br />
					<input type="submit" name="submit" /> <br />
				</form>
			</div>
			<div id="info">
				<table id="record">
					<tr>
						<th>BookID</th>
						<th>Name</th>
						<th>Author</th>
						<th>Published Date</th>
						<th>Subject</th>
						<th>Publisher</th>
						<th>Price</th>
						<th>AddOn</th>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
</body>
<script type="text/javascript" src="../js/common.js"></script>
<script type="text/javascript" src="../js/search.js"></script>
</html>
