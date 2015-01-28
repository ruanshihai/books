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
					if ($_SERVER['REQUEST_METHOD'] == "POST") {
						for ($x=0; $x<count($attr); $x++) {
							if ($_POST[$attr[$x]]) {
								if ($values)
									$values = $values . " AND ";
								$values = $values . $attr[$x] . "=" . '"' . $_POST[$attr[$x]] . '"';
								$url = $url . "&" . $attr[$x] . "=" . $_POST[$attr[$x]];
							}
						}

						$recordscount = 0;
						if ($values) {
							include("mysql/conn.php");
							$result = mysql_query("SELECT COUNT(*) FROM book_info WHERE $values");
							$recordscount = mysql_fetch_array($result)[0];
							mysql_close($conn);
						}
						header("Location:search.php?pageid=1&recordscount=$recordscount$url");
						exit();
					}

					if (isset($_GET['pageid'])) {
						$recordscount = $_GET['recordscount'];
						if ($recordscount > 0) {
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

							$pageid = $_GET['pageid'];
							$pagescount = ($recordscount+9)/10;
							for ($x=0; $x<count($attr); $x++) {
								if ($_GET[$attr[$x]]) {
									if ($values)
										$values = $values . " AND ";
									$values = $values . $attr[$x] . "=" . '"' . $_GET[$attr[$x]] . '"';
									$url = $url . "&" . $attr[$x] . "=" . $_GET[$attr[$x]];
								}
							}

							include("mysql/conn.php");

							$result = mysql_query("SELECT * FROM book_info WHERE $values LIMIT " . (($pageid-1)*10) . ", 10");
							while ($row = mysql_fetch_array($result)) {
								echo "<tr>";
								for ($x=0; $x<count($attr); $x++)
									echo "<td>" . htmlspecialchars($row[$attr[$x]]) . "</td>";
								echo "<td><a href=" . "alter.php?BookID=" . $row['BookID'] . ">" . "修改" . "</a></td>";
								echo "</tr>";
							}
							echo "</table>";
							
							if ($pageid > 1) {
								$pageupid = $pageid-1;
								echo '<a href="search.php?pageid=' . $pageupid . '&recordscount=' . $recordscount . $url . '"' . 'style="margin:0 10px"> 上一页 <a/>';
							}
							if ($pageid < $pagescount) {
								$pagedownid = $pageid+1;
								echo '<a href="search.php?pageid=' . $pagedownid . '&recordscount=' . $recordscount . $url . '"' . 'style="margin:0 10px"> 下一页 <a/>';
							}
							echo "<span style='float: right; margin-right: 128px'>共" . $recordscount  . "条结果</span>";

							mysql_close($con);
						}
					}
				?>
			</div>
		</div>
	</div>
	
</div>
</body>
</html>
