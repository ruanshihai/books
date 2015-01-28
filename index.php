<!DOCTYPE html>
<?php
	include('books.php');
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
</head>

<body>
<div>
	<div class="content">
		<?php include('nav.html') ?>
		<div class="right">
			<table class="info">
				<tr>
					<th>类别</th>
					<th>图书数量</th>
				</tr>
				<?php
					include("mysql/conn.php");

					$result = mysql_query("SELECT DISTINCT Subject FROM book_info");
					$sum_classified = 0;
					while ($row = mysql_fetch_array($result)) {
						$subject = in($row['Subject'], true);
						if (!$subject)
							continue;
						$res = mysql_query("SELECT COUNT(*) FROM book_info WHERE Subject='" . $subject . "'");
						$count = mysql_fetch_array($res)[0];
						$sum_classified += $count;

						echo "<tr>";
						echo "<td>" . htmlspecialchars($subject) . "</td>";
						echo "<td>" . $count . "</td>";
						echo "</tr>";
					}

					$result = mysql_query("SELECT * FROM book_info");
					echo "<tr>";
					echo "<td>" . "无分类" . "</td>";
					echo "<td>" . (mysql_num_rows($result)-$sum_classified) . "</td>";
					echo "</tr>";

					echo "<tr>";
					echo "<td>" . "总库存" . "</td>";
					echo "<td>" . mysql_num_rows($result) . "</td>";
					echo "</tr>";

					mysql_close($con);
				?>
			</table>
		</div>
	</div>
</div>
</body>
</html>
