<!doctype html>
<html lang='en'>
<head>
	<!--
			Karaoke Search Page
			Cody Farrey
	-->

	<!-- Required meta tags -->
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
	<meta name="description" content="Karaoke Search Page">
	<eta name="author" content="Cody Farrey">
	<!-- This is the public bootstrap, we want to replace this with the copy on our server eventually -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
	<title>Karaoke Song Search</title>

	<!-- Custom styles for this template -->
	<link href="cf-template.css" rel="stylesheet">
</head>
<body>
	<!-- Navbar -->
	<header>
	<nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background-color: #64C2EC;">
		<a class="navbar-brand" href="/index.php"><div style="float: left;"><img class="rounded-circle" src="img/profpic.jpg" alt="karaoke project preview" width="50" height="50"></div>Cody Farrey<small>/* Software Development Portfolio */</small></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse"
		data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault"
		aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class ="collapse navbar-collapse" id="navbarsExampleDefault">
			<ul class="nav navbar-nav ml-auto">
				<li class ="nav-item active">
					<a class="nav-link" href="/index.php">Home<span class="sr-only">(current)</span></a>
				</li>
          		<li class="nav-item dropdown">
            		<a class="nav-link dropdown-toggle" href="/projects.php" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Projects</a>
            		<div class="dropdown-menu" aria-labelledby="dropdown01">
              		<a class="dropdown-item" href="/projects.php">C++ Programming</a>
              		<a class="dropdown-item" href="/projects.php">Web Development</a>
              		<a class="dropdown-item" href="/projects.php">Personal Projects</a>
            		</div>
          		</li>
          		<li class="nav-item dropdown">
            		<a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Social</a>
            		<div class="dropdown-menu" aria-labelledby="dropdown02">
              		<a class="dropdown-item" href="https://www.linkedin.com/in/codyfarrey/">linkedIn</a>
            		</div>
          		</li>
          		<li class="nav-item">
            		<a class="nav-link" href="/contact.php">Contact</a>
          		</li>
				<li class="nav-item">
            		<a class="nav-link" href="docs/codyfarrey-secure-resume.pdf">Resume</a>
          		</li>
			</ul>
		</div>
	</nav>
	</header>
	<main role="main" class="container cf-template">
			<!-- Code for search page here -->
			<div class="container">
				<form action="" method="POST" class="container-fluid">
					<div class="row">
						<div class="col-sm-3">
							<select name="search_params" class="form-control">
								<option value="song.title" selected>Song</option>
								<option value="song.artist">Artist</option>
								<option value="contributors.name">Contributor</option>
							</select>
						</div>
						<div class="col-sm-7 form-group">
							<input type="text" name="search_criteria" class="form-control">
						</div>
						<div class="col-sm">
							<input type="submit" name="search" class="btn btn-block btn-primary" value="Search">
							<br>
						</div>
					</div>
				</form>
			</div>
			<!--
				Try catch to get database information and display it
			-->
			<?php
			$username =	"cody";
			$password = "notahardpassword";

			$searchQuery = "SELECT * FROM song";

			try {
				# This will be put into a seperate file eventually.

				# Declaring database
				$dsn = "mysql:host=localhost;dbname=$username";
				$pdo = new PDO($dsn, $username, $password);

				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$query = "SELECT * FROM song;";

				# If the search button is pressed
				if ($_SERVER['REQUEST_METHOD']=='POST' and isset($_POST['search'])) {
					$searchQuery = "SELECT DISTINCT song.songID, title, artist FROM song, contributors, contributions WHERE contributions.songID = song.songID AND contributors.cID = contributions.cID AND " . $_POST['search_params'] . " LIKE '%" . $_POST['search_criteria'] . "%';";
				}
				$res = $pdo->query($searchQuery);
				echo "<form action='' method='POST' class='container-fluid'>";
				echo "<table class='table table-hover' border=1 cellpadding=5>";
				echo "<tr><th>ID</th><th>Title</th><th>Artist</th></tr>";
				foreach($res as $row) {
					echo "<tr>";
					echo "<td><input class='form-check-input' type='radio' name='songID' value='" . $row['songID'] . "'</td>";
					echo "<td>" . $row['title'] . "</td>";
					echo "<td>" . $row['artist'] . "</td>";
					echo "</tr>";	
				}
				echo "</table>";
				echo "<br>";
				#<!-- Creating the Sign Up button in PHP -->
				echo"<h6>Name: </h6>";
				echo"<input type='text' name='username' class='form-control'>";
				echo"<input class='btn btn-primary btn-block' type='submit' 
				name='sub' value='Submit'>";
				echo"</form>";

				if (isset($_POST['sub'])) {
					$user = $_POST['username'];
					$id = $_POST['songID'];

					if($user != "" and $id != NULL) {
						# Doing a select statement to search for a user with that name
						$sql = "SELECT uID FROM user WHERE name = '$user'";
						$res = $pdo->prepare($sql);
						$res->execute(array());

						# If the above statement returns null (That user has no name in the database), insert the user into the database.
						if($res->fetch(PDO::FETCH_ASSOC) == null) {
							$sql = "INSERT INTO user (name) values ('$user')";
							$res = $pdo->prepare($sql);
							$res->execute(array());
						}
#
#						$sql = "SELECT uID FROM user WHERE name = '$user'";
#						$res = $pdo->prepare($sql);
#						$res->execute(array());
#
#						while(($row = $res->fetch(PDO::FETCH_ASSOC)) != NULL) {
#							foreach($row as $attrname => $attrvalue) {
#								$user = $attrvalue;
#							}
#						}
					} else {
						echo "Please enter a valid name and chose a song.";
					}
				}
			} catch (PDOexception $e) {
				echo "Connection Error: " . $e->getMessage();
			}
			?>
	</main>
	<footer class="footer">
		<div class="container">
			<span class="text-muted">Copyright &copy; Cody Farrey</span>
		</div>
	</footer>
	<!-- These are the javascript scripts that are required for bootstrap to run -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</body>
</html>