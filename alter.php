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
				<?php
					if ($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['BookID'])) {
						include("mysql/conn.php");
						$result = mysql_query("SELECT * FROM book_info WHERE BookID=" . $_GET['BookID']);
						$row = mysql_fetch_array($result);
						mysql_close($con);
					}
				?>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					Old BookID: <input type="text" name="OldBookID" value="<?php echo $row['BookID'] ?>" /> <br /><br />
					BookID: <input type="text" name="BookID" value="<?php echo $row['BookID'] ?>" /> <br />
					Name: <input type="text" name="Name" value="<?php echo $row['Name'] ?>" /> <br />
					Author: <input type="text" name="Author" value="<?php echo $row['Author'] ?>" /> <br />
					Published Date: <input type="text" name="Pubdate" value="<?php echo $row['Published Date'] ?>" /> <br />
					Subject: <input type="text" name="Subject" value="<?php echo $row['Subject'] ?>" /> <br />
					Publisher: <input type="text" name="Publisher" value="<?php echo $row['Publisher'] ?>" /> <br />
					Price: <input type="text" name="Price" value="<?php echo $row['Price'] ?>" /> <br />
					AddOn: <input type="text" name="AddOn" value="<?php echo $row['AddOn'] ?>" /> <br />
					<input type="submit" name="submit" /> <br />
				</form>
			</div>
			<div>
				<?php
					$attr = array("BookID", "Name", "Author", "Pubdate", "Subject", "Publisher", "Price", "AddOn");
					for ($x=0; $x<count($attr); $x++) {
						if ($_POST[$attr[$x]]) {
							if ($values)
								$values = $values . ", ";
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

						mysql_query("UPDATE book_info SET " . $values . "WHERE BookID=" . $_POST['OldBookID']);
						echo "<tr>";
						for ($x=0; $x<count($attr); $x++)
							echo "<td>" . htmlspecialchars($_POST[$attr[$x]]) . "</td>";
						echo "</tr>";
						echo "</table>";
						echo "修改成功";

						mysql_close($con);
					}
				?>
			</div>
		</div>
	</div>
	
</div>

</body>
</html>
