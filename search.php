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
</head>

<body>

<div>
	<div class="content">
		<?php include('nav.html') ?>
		<div class="right">
			<div>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
			<div>
				<?php
					$attr = array("BookID", "Name", "Author", "Pubdate", "Subject", "Publisher", "Price", "AddOn");
					for ($x=0; $x<count($attr); $x++) {
						if ($_POST[$attr[$x]]) {
							if ($values)
								$values = $values . " AND ";
							$values = $values . $attr[$x] . "=" . '"' . $_POST[$attr[$x]] . '"';
						}
					}

					if ($values) {
						include("mysql/conn.php");

						echo <<< eof
						<table>
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
eof;

						$result = mysql_query("SELECT * FROM book_info WHERE " . $values);
						while ($row = mysql_fetch_array($result)) {
							echo "<tr>";
							for ($x=0; $x<count($attr); $x++)
								echo "<td>" . htmlspecialchars($row[$attr[$x]]) . "</td>";
							echo "<td><a href=" . "alter.php?BookID=" . $row['BookID'] . ">" . "修改" . "</a></td>";
							echo "</tr>";
						}
						echo "</table>";
						echo "共" . mysql_num_rows($result)  . "条结果";

						mysql_close($con);
					}
				?>
			</div>
		</div>
	</div>
	
</div>

</body>
</html>
