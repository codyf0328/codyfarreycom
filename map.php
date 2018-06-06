<!doctype html>
<html lang='en'>
<head>
	<!-- Required meta tags -->
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
	<meta name="description" content="Cody Farrey's Computer Science Resume">
	<meta name="author" content="Cody Farrey">
	<!-- This is the public bootstrap, we want to replace this with the copy on our server eventually -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
	<title>Cody Farrey - Software Development Portfolio</title>

	<!-- Custom styles for this template -->
	<link href="cf-template.css" rel="stylesheet">
	<link href="map-template.css" rel="stylesheet">
</head>
<body>
	<section class="hero-image">
		<?php require('nav-bar.php') ?>
		<div id="map"></div>
		<script>
			var map;
			function initMap() {
				map = new google.maps.Map(document.getElementById('map'), {
					center: {lat:-34.398, lng: 150.644},
					zoom: 8
				});
			}
		</script>
		<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"
		async defer></script>
	</section>

	<section class="row-two">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h2>Cody Farrey's Software Development Portfolio</h2>
			<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum. </p>
			<p><a href="#" class="btn btn-primary btn-large">Contact Me</a></p>
			</div>
		</div>
	</section>

	<section class="row-three">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 sec-one">
		<h2>Potential</br> Employers</h2>
		<p>Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh. Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus ipsum ante quis turpis. Nulla facilisi. Ut fringilla. Suspendisse potenti. Nunc feugiat mi a tellus consequat imperdiet. Vestibulum sapien. Proin quam. Etiam ultrices. Suspendisse in justo eu magna luctus suscipit. </p>
		<p><a href="#" class="btn btn-primary btn-large">Resume</a></p>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 sec-two">
		<h2>Potential</br>Collaborators</h2>
		<p>Integer lacinia sollicitudin massa. Cras metus. Sed aliquet risus a tortor. Integer id quam. Morbi mi. Quisque nisl felis, venenatis tristique, dignissim in, ultrices sit amet, augue. Proin sodales libero eget ante. Nulla quam. Aenean laoreet. Vestibulum nisi lectus, commodo ac, facilisis ac, ultricies eu, pede. Ut orci risus, accumsan porttitor, cursus quis, aliquet eget, justo.</p>
		<p><a href="#" class="btn btn-primary btn-large">Contact Me</a></p>
		</div>
	</div>
	</section>

	<section class="row-four">
	<div class="row text-center">
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
			<a href="#"><img src = "/img/twitter-128-icon.png" width="128" height="128" alt="twitter-icon"></a>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
			<a href="#"><img src = "/img/linkedin-128-icon.png" width="128" height="128" alt="linkedin-icon"></a>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
			<a href="#"><img src = "/img/facebook-128-icon.png" width="128" height="128" alt="facebook-icon"></a>
		</div>
	</div>
	</section>
	
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