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
					$values = "";
					for ($x=0; $x<count($attr); $x++) {
						if ($_POST[$attr[$x]]) {
							if ($values)
								$values = $values . ", ";
							$values = $values . $attr[$x] . "=" . '"' . $_POST[$attr[$x]] . '"';
						}
					}

					if ($values) {
						include("mysql/conn.php");
						
						mysql_query("INSERT INTO book_info SET " . $values);
						echo "数据插入成功" . "<br />";
						echo "<table>";
						echo "<tr>";
						echo "<th>BookID</th>";
						echo "<th>Name</th>";
						echo "<th>Author</th>";
						echo "<th>Published Date</th>";
						echo "<th>Subject</th>";
						echo "<th>Publisher</th>";
						echo "<th>Price</th>";
						echo "<th>AddOn</th>";
						echo "</tr>";
						echo "<tr>";
						for ($x=0; $x<count($attr); $x++)
							echo "<td>" . htmlspecialchars($_POST[$attr[$x]]) . "</td>";
						echo "</tr>";
						echo "</table>";

						mysql_close($con);
					}
				?>
			</div>
		</div>
	</div>
	
</div>

</body>
</html>