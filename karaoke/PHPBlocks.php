<!DOCTYPE html>
<html>
	<head>
		<title>Karaoke Search Songs</title>

		<!-- required meta tags for bootstrap -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	
		<!-- Custom styles for this template -->
		<link href="starter-template.css" rel="stylesheet">
		<link href="navbar.css" rel="stylesheet">
		<link href="modifiers.css" rel="stylesheet">

	<head>
<body>

	<!-- implements Bootstrap guidelines for showing a nav bar at top of page -->
	<?php require_once('nav_bar.php'); ?>

	<main role="main" class="container starter-template">
		<div class="container">
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" class="container-fluid">
				<div class="row">
		  			<div class="col-sm-3">
		  				<!--<label>SELECT:</label>-->
		  				<select name="choice" class="form-control" id="exampleFormControlSelect1">
				    		<option value="title" selected>Song</option>
							<option value="artist">Artist</option>
							<option value="contributions.cname">Contributor</option>
						</select>
		  			</div>
		  			<div class="col-sm-7 form-group">
				  		<!-- <label>SEARCH:</label>-->
					  	<input type="text" name="criteria" size="15" maxlength="50" required="required" class="form-control" id="exampleFormControlInput1" placeholder="Search a song">
					</div>
					<div class="col-sm">
					<input type="submit" name="search" class="btn btn-block btn-primary" id="btn-padding" value="SEARCH">
					</div>
				</div>
			</form>
		</div>
				<?php

					try{

  						include 'info.php';

						$dsn = "mysql:host=courses;dbname=$username";
						$pdo = new PDO($dsn, $username, $password);
						  
						$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

						$sql = "SELECT * FROM song;";

						if(isset($_POST['search'])) {
							$choice = $_POST['choice'];
							$criteria = $_POST['criteria'];
							if($choice == "contributions.cname")
							{
								$sql = "SELECT song.songID, title, artist, contributions.cname, contributions.contribution FROM song, contributions WHERE contributions.songID = song.songID AND $choice = \"$criteria\";";  
							}
							if($choice == "artist" xor $choice == "title")
							{
								$sql = "SELECT * FROM song WHERE $choice = \"$criteria\";";
							}
						}//End of if
  
  						$res = $pdo->prepare($sql);
  						$res->execute(array());
  
						//***********************************************************
						//Table with radio buttons in first column
						//***********************************************************
						echo "<br>";
						echo "<div class=\"container>\">"; 
							echo "<table class=\"table  table-hover\" border=1 cellpadding=5>";
							echo "<thead class=\"thead-dark\">
						    		<tr>
										<th scope=\"col\">#</th>
										<th scope=\"col\">Song Name</th>
										<th scope=\"col\">Artist</th>
								 	</tr>
								 </thead>";
							while(($row = $res->fetch(PDO::FETCH_ASSOC)) != NULL)
							{
								echo"<tr>";
								//Resetting our condition
								$i = 1;
								  
								foreach($row as $attrname => $attrvalue)
								{
									//This controls what column we tie our button to
									if($i == 1)
									{
										//This ties our attrvalue to a radiobutton
										echo"<td><input type=\"radio\" name=\"id\" value=\"$attrvalue\"></td>";
									}
									else
									{
										echo"<td>$attrvalue</td>";
									}
									
									$i = $i + 1;
								}//End of foreach loop
								//$i = 0;
								  
								echo"</tr>";
							}//End of while loop
							echo"</table>";
						echo "</div>";	  
						echo"</br></br>";
						  
						//Username Field and Label
						echo "<div class=\"form-group\">";
							echo"<label>Username:</label>";
							echo"</br><input type=\"text\" class=\"form-control\" placeholder=\"username\" name=\"user\" required>";
						echo "<div>";
						echo"</br></br>";
						  
						//Payment Field and Label
						echo"Priority Pay (If Applicable):";
						echo"</br>$<input type=\"number\" name=\"priority\">";
						  
						echo"</br>";
						  
						//Edit this button to INSERT into submission field
						echo"<input type =\"submit\" name=\"addToQueue\" value=\"SUBMIT\">";
						  
						//Code to run after the Add to queue button is clicked
						if(isset($_POST['addToQueue']))
						{
							$User = $_POST['user'];
							$Pay = $_POST['priority'];
							$Id = $_POST['id'];
							  
							//Seems redundant but if just used simple If/else, the else would always run for some reason
							//Forces user to select a song AND input a username
							//!!!This is important as both these fields need to be entered for insertion to work properly
							if($User == "" or $Id == NULL)
							{
								echo"</br>Enter a username and select a song.";
							}
							  
	 						//When the user has selected a song and username then we check for if pay has been filled
	  						//!!!Payed is an optional field
							if($User != "" AND $Id != NULL)
							{						
		  						//Seems redundant but if just used simple If/else, the else would always run for some reason
		  						if($Pay == "")
		  						{
			  						//Need to finish
			  						$sqlInsert = ";";
		  						}
		  						if($Pay != "")
		  						{
			  						//Need to finish
			  						$sqlInsert = ";";
		  						}
	  						}
  						}
  
  

  
						//**************************************************************
						//Table with buttons in first column that delete
						//**************************************************************
						/*
						//!!!!!!EDIT THIS TO FIT THE CORRECT TABLE, CRITERIA, AND VARIABLE NAMES!!!!!!
						  $sql = "SELECT * FROM song;";
						  $res = $pdo->prepare($sql);
						  $res->execute(array());
						  
						  echo"<table>";
						  while(($row = $res->fetch(PDO::FETCH_ASSOC)) != NULL)
						  {
							  echo"<tr>";
							  //Resetting our condition
							  $i = 1;
							  
							  foreach($row as $attrname => $attrvalue)
							  {
								  //This controls what column we tie our button to
								  if($i == 1)
								  {
									  //This ties our attrvalue to a button
									  echo"<td><button name=\"played\" type=\"submit\" value=\"$attrvalue\">PLAYED</button></td>";
								  }
								  else
								  {
								      echo"<td>$attrvalue</td>";
								  }
								  $i = $i + 1;
							  }//End of foreach loop
							  //$i = 0;
							  
							  echo"</tr>";
						  }//End of while loop
						  echo"</table>";

						  //$id2 = $_POST['played'];
						  //echo"</br></br>$id2";
						  
						  //Controls when to execute our DELETE sql statement
						  if(isset($_POST['played'])) {

							  //!!!!!!DELETE THIS OUTPUT
							  $songID = $_POST['played'];
							  echo"$songID";
							  //!!!!!!FIX THIS DELETE STATMENT TO MATCH THE SUBMISSION TABLE
							  $sql = "DELETE FROM song WHERE songID = \"$songID\";";
							  $res = $pdo->prepare($sql);
						      $res->execute(array());
						  }//End of if
						*/
					}//End of try block
					catch(PDOexception $e)
					{
						  echo "Connection to database failed: " . $e->getMessage();
					}//End of catch block
				?>

			
		</div>
		<!-- Bootstrap core JavaScript ================================================== -->
    	<!-- Placed at the end of the document so the pages load faster -->
    	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	</main>
</body>
</html>
