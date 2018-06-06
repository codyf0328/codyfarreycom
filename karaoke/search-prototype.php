<html>
<head><title>Search a Song</title></head>
<body>

<form method="POST">
	<select name="searchParam">
	  <option value="title">title</option>
	  <option value="artist">artist</option>
	  <option value="name">contributor</option>
	</select>
	<br>
	<input type="text" name="searchKey">
	<br>
	<input type="submit" name="sub">
</form>

<?php
$username = "z1800722";
$password = "1995Mar25";

$searchQuery = "SELECT DISTINCT song.songID, title, artist FROM song, contributors, contributions WHERE contributions.songID = song.songID AND contributors.cID = contributions.cID AND " . $_POST['searchParam'] . " LIKE '%" . $_POST['searchKey'] . "%';";

try {

	$dsn = "mysql:host=courses;dbname=z1800722";
	$pdo = new PDO($dsn, $username, $password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if ($_SERVER['REQUEST_METHOD']=='POST' and isset($_POST['sub'])) {
		$res = $pdo->query($searchQuery);
	} else {
		$res = $pdo->query("SELECT * FROM song;");
	}
	echo "<table border=1>";
	echo "<tr><th>ID</th><th>Title</th><th>Artist</th></tr>";
	foreach($res as $row) {
		echo "<tr>";
		echo "<td>" . $row['songID'] . "</td>";
		echo "<td>" . $row['title'] . "</td>";
		echo "<td>" . $row['artist'] . "</td>";
		echo "</tr>";	
	}
	echo "</table>";

} catch (PDOexception $e) {
	echo "Connection Error: " . $e->getMessage();
}

?>

</body>
</html>
