<!DOCTYPE html>
<?php
	require_once('../common/global.php');
	login_handle();
?>
<html>
<head>
<title>Books管理后台</title>
<link rel="stylesheet" typr="text/css" href="../css/main.css" />
<link rel="stylesheet" type="text/css" href="../css/info.css">
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
					require_once("../db/conn.php");
					require_once("../common/security.php");

					$result = db_query("SELECT DISTINCT Subject FROM book_info");
					$sum_classified = 0;
					while ($row = db_fetch_array($result)) {
						$subject = $row['Subject'];
						if (!$subject)
							continue;
						$res = db_query("SELECT COUNT(*) FROM book_info WHERE Subject='" . sql_transform($subject) . "'");
						$count = db_fetch_array($res)[0];
						$sum_classified += $count;

						echo "<tr>";
						echo "<td>" . html_transform($subject) . "</td>";
						echo "<td>" . $count . "</td>";
						echo "</tr>";
					}

					$result = db_query("SELECT COUNT(*) FROM book_info");
					$count = db_fetch_array($result)[0];
					echo "<tr>";
					echo "<td>" . "无分类" . "</td>";
					echo "<td>" . ($count-$sum_classified) . "</td>";
					echo "</tr>";

					echo "<tr>";
					echo "<td>" . "总库存" . "</td>";
					echo "<td>" . $count . "</td>";
					echo "</tr>";

					db_close($con);
				?>
			</table>
		</div>
	</div>
</div>
</body>
<script type="text/javascript" src="../js/info.js"></script>
</html>
