<!DOCTYPE html>
<html>
 <!-- Cody Farrey: z18000722 
      Dillon Chamberlin: z1768426
      Sam Mayszak: z1654675
      Alonso Arteaga: z1791049 
	-->
	<head>
	<title>Song Queue</title>
	<!-- required meta tags for bootstrap -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

	<!-- Custom styles for this template -->
	<link href="./css/starter-template.css" rel="stylesheet">
	<link href="./css/navbar.css" rel="stylesheet">
	<link href="./css/modifiers.css" rel="stylesheet">
</head>
<body>
	<!-- implements bootstrap guidelines for showing a nav bar at the top of the page -->
	<?php require_once('nav_bar.php'); ?>

	<!-- everything below this line will show up below the nav bar -->
	<main role="main" class="container starter-template">
		<div class="container">
			<!-- htmlspecialchars is used to output content inside the textboxes as an html special character
				i.e. 'cats & dogs' would be sent to server as 'cats &amp; dogs'. 
				used to prevent sql injection -->
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
			<?php
			try{

				include 'info.php';

				$dsn = "mysql:host=courses;dbname=$username";
				$pdo = new PDO($dsn, $username, $password);

				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				//**************************************************************
				//Table with buttons in first column that delete
				//**************************************************************
			  echo "<div class=\"container\">";
				  echo"<h1>Priority Queue:</h1>";
			  $sql = "SELECT kFile.kID, user.name, song.title, song.artist, submission.amtPaid
			  	FROM submission, user, song, kFile 
			  	WHERE amtPaid IS NOT NULL AND submission.kID = kFile.kID 
			  	AND submission.uID = user.uID 
			  	AND kFile.songID = song.songID 
			  	AND played = \"0\" 
			  	ORDER BY submission.amtPaid DESC;";
			  $res = $pdo->prepare($sql);
			  $res->execute(array());
			  
			  
			  //Show the Priority table
			 	echo "<table class=\"table table-hover\" border=1 cellpadding=5>";
					echo "<thead class=\"thead-dark\">
									<tr>
										<th scope=\"col\">play btn</th>
										<th scope=\"col\">User</th>										                   
									 	<th scope=\"col\">Song</th>
									  <th scope=\"col\">Artist</th>
										<th scope=\"col\">Amt paid</th>
									</th>";
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
						  	echo"<td><button name=\"playedPriority\" type=\"submit\" value=\"$attrvalue\">PLAYED:$attrvalue</button></td>";
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
			  
			 	echo"</br>";
			  
			 	//Controls when to execute our UPDATE sql statement of the paid queue
			  if(isset($_POST['playedPriority']))
			  {

					$kID = $_POST['playedPriority'];
					$sql = "SELECT * FROM submission 
						WHERE kID = $kID 
						AND amtPaid IS NOT NULL ORDER BY amtPaid DESC;";
			  	$res = $pdo->prepare($sql);
			  	$res->execute(array());
				  
			  	//Gets the other information needed for the update statement (uid and time)
			  	$row = $res->fetch(PDO::FETCH_ASSOC);
				  $i = 1;
				  foreach($row as $attrname => $attrvalue)
				  {
					  if($i == 2)
					  {
						  $uID = $attrvalue;
				  	}

				  	if($i == 3)
				  	{
				      $time = $attrvalue;
				  	}
				  	$i = $i + 1;
			  	} 
			  
			  	//Executes the update statement
				  $sql = "UPDATE submission SET played = TRUE 
				  	WHERE kID = $kID 
				  	AND uID = $uID AND time = \"$time\";";
				  $res = $pdo->prepare($sql);
			  	$res->execute(array());

				  //Refreshes the page so the played result is removed from the table	  
				  echo"<META HTTP-EQUIV=\"refresh\" CONTENT=\"1\">";
		  	}//End of if
		  
		 	//*************************************************************

			echo"</br></br>";  
			
			echo "<div class=\"container\">";
				echo"<h2>Free Queue:</h2>";  
				$sql = "SELECT kFile.kID, user.name, song.title, song.artist 
					FROM submission, user, song, kFile 
					WHERE amtPaid IS NULL 
					AND submission.kID = kFile.kID 
					AND submission.uID = user.uID 
					AND kFile.songID = song.songID 
					AND played = \"0\" 
					ORDER BY submission.time ASC;";
				$res = $pdo->prepare($sql);
			  $res->execute(array());
			  
			  //Shows the Free table
		  	echo"<table class=\"table table-hover\" border=1 cellpadding=5>";
		  	echo "<thead class=\"thead-dark\">
                  <tr>
                    <th scope=\"col\">play btn</th>
                    <th scope=\"col\">User</th>                                      
                    <th scope=\"col\">Song</th>
                    <th scope=\"col\">Artist</th>
                  </th>";
				
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
						  	echo"<td><button name=\"playedFree\" type=\"submit\" value=\"$attrvalue\">PLAYED:$attrvalue</button></td>";
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
  
 		 	echo"</br>";
  
  		//Controls when to execute our UPDATE sql statement for the free queue
  		if(isset($_POST['playedFree']))
  		{

	  		$kID = $_POST['playedFree'];
	  		$sql = "SELECT * FROM submission 
	  			WHERE kID = $kID 
	  			AND amtPaid IS NULL 
	  			ORDER BY time ASC;";
	  		$res = $pdo->prepare($sql);
			  $res->execute(array());
	  
	 			//Gets the other information needed for the update statement (uid and time)
	 			$row = $res->fetch(PDO::FETCH_ASSOC);
	  		$i = 1;
	  		foreach($row as $attrname => $attrvalue)
	  		{
		  		if($i == 2)
		  		{
			 			$uID = $attrvalue;
		  		}
		  		if($i == 3)
		  		{
		      	$time = $attrvalue;
		  		}
		  		$i = $i + 1;
	  		} 
	  
	  		//Executes the update statement
	  		$sql = "UPDATE submission SET played = TRUE 
	  			WHERE kID = $kID 
	  			AND uID = $uID 
	  			AND time = \"$time\";";
			  $res = $pdo->prepare($sql);
			  $res->execute(array());
			  
			  //Refreshes the page so the played result is removed from the table
			  echo"<META HTTP-EQUIV=\"refresh\" CONTENT=\"1\">";

  		}//End of if
  
  


			  
//End of try block
}
catch(PDOexception $e)
{
	  echo "Connection to database failed: " . $e->getMessage();
}//End of catch block
?>

	</div>
	</main>

	<!-- Bootstrap core JavaScript ================================================== -->
  	<!-- Placed at the end of the document so the pages load faster -->
   	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
   	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
 	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	</main>

</body>
</html>
