<!DOCTYPE html>
<?php
	require_once('common/global.php');
	login_handle();
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
						$result = mysql_query("SELECT * FROM book_info WHERE BookID=" . in($_GET['BookID'], true));
						$row = mysql_fetch_array($result);
						mysql_close($con);
					}
				?>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<p style="display:none">Old BookID: <input type="text" name="OldBookID" value="<?php echo $row['BookID'] ?>" /> </p>
					BookID: <input type="text" name="BookID" value="<?php echo htmlspecialchars($row['BookID']) ?>" /> <br />
					Name: <input type="text" name="Name" value="<?php echo htmlspecialchars($row['Name']) ?>" /> <br />
					Author: <input type="text" name="Author" value="<?php echo htmlspecialchars($row['Author']) ?>" /> <br />
					Published Date: <input type="text" name="Pubdate" value="<?php echo htmlspecialchars($row['Published Date']) ?>" /> <br />
					Subject: <input type="text" name="Subject" value="<?php echo htmlspecialchars($row['Subject']) ?>" /> <br />
					Publisher: <input type="text" name="Publisher" value="<?php echo htmlspecialchars($row['Publisher']) ?>" /> <br />
					Price: <input type="text" name="Price" value="<?php echo htmlspecialchars($row['Price']) ?>" /> <br />
					AddOn: <input type="text" name="AddOn" value="<?php echo htmlspecialchars($row['AddOn']) ?>" /> <br />
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
							$values = $values . $attr[$x] . "=" . '"' . in($_POST[$attr[$x]], true) . '"';
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

						mysql_query("UPDATE book_info SET " . $values . "WHERE BookID=" . in($_POST['OldBookID'], true));
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
<script type="text/javascript" src="../js/alter.js"></script>
</html>
