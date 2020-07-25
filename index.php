<?php
	ob_start();
	session_start();
	require_once 'actions/db_connect.php';

	// if session is not set this will redirect to login page
	if( !isset($_SESSION['admin']) && !isset($_SESSION['user']) ) {
		header("Location: login/login.php");
		exit;
	}
	// select logged-in users details
	$res=mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
	$res2=mysqli_query($conn, "SELECT * FROM users" );
	$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Adopt-a-pet</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="Adopt-pet-shop">
	<meta name="keywords" content="HTML, Bootstrap, MySQL, PHP">
	<meta name="author" content="Admir Saraseli">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>   
	    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
					<li class="nav-item active">
						<a class="nav-link" href="index.php">All cuties<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="general.php">Small&Large</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="senior.php">Seniors</a>
					</li>
				</ul>
				<ul class="navbar-nav ml-auto">
		        	<li class="nav-item ">
			        	<span class="nav-link">
			        		<img class="rounded" style="height: 40px; width: 40px" src="<?php echo $userRow['image'];?>">
			        		Hi <?php echo $userRow['userName']; ?>
			        	</span>
			        </li>
			        <li class="nav-item ">
			        	<a href="login/logout.php?logout" class="nav-link  btn btn-outline-warning">Log out</a>
			        </li>
		        </ul>	
			</div>
		</nav>
	</header>
	<div class="container row row-cols-1 row-cols-md-3 row-cols-lg-3 mx-auto my-4 bg-warning">
		<div class="col text-center my-auto">
	        <form class="form-inline my-2 my-lg-0">
				<input class="form-control mr-sm-2" type="search" id="search" placeholder="Search">
				<button class="btn btn-dark my-2 my-sm-0" type="submit">Search</button>
			</form>
			<p id="result"></p>
		</div>
		<div class="col text-center my-auto mx-auto">
			<h2>Adopt a friend :)</h2>
		</div>
		<div class="col text-center my-auto">
			<div class='card bg-transparent'>
				<img src="img/logo.png" style="width: 80%">
			</div>
		</div>
    </div>
    	
    <div class="container-fluid row row-cols-1 row-cols-md-2 row-cols-lg-4 mx-auto my-4">
    <?php
		$sql = "SELECT * FROM animals ";
		$result = mysqli_query($conn, $sql);
		// fetch the next row (as long as there are any) into $row
		while($row = mysqli_fetch_assoc($result)) {
			echo "
			<div class='col mb-4'>
				<div class='card px-1 py-1 bg-light h-100'>
					<h3 class='card-title'>Meet: ". $row['name']." </h3>
					<img src='" .$row['image']." ' class='card-img-top' alt='...' >
					<div class='card-body'>
						<p class='card-text'>". $row['description']."</p>
						<h6 class='card-text'>Type: <span class='text-info mr-3'>".$row['type'].",</span>
						Age:<span class='text-info'> ".$row['age']."</span></h6>
						<h6 class='card-text'>Hobbies: <span class='text-info'>".$row['hobbies']."</span> </h6>
						<h6 class='card-text'>Address: <span class='text-info'>".$row['location']."</span> </h6>      
					</div>
					<div class='card-footer text-center p-1'>
						<a href='adopt.php?id=".$row['animal_id']."' class='btn btn-outline-success  mx-auto '>Take me home</a>
					</div>
				</div>
			</div>";
		}

		// Free result set
		mysqli_free_result($result);
		// Close connection
		mysqli_close($conn);
	?>
	
		<script>
			// Variable to hold request
			var request;
			​
			// Bind to the submit event of our form
			$("#search").keyup(function(event){
			​
			// Prevent default posting of form - put here to work in case of errors
			event.preventDefault();
			​
			// Abort any pending request
			if (request) {
			   request.abort();
			}
			// setup some local variables
			var $form = $(this);
			​
			// Let's select and cache all the fields
			var $inputs = $form.find("input, select, button, textarea");
			​
			// Serialize the data in the form
			var serializedData = $form.serialize();
			​
			// console.log(serializedData);
			var search = document.getElementById("search").value;
			if(search.length > 0){
				$inputs.prop("disabled", true);
				​
				// Fire off the request to /form.php
				request = $.ajax({
				   url: "search.php",
				   type: "post",
				   data: serializedData
				});
				​
				// Callback handler that will be called on success
				request.done(function (response, textStatus, jqXHR){
				   // Log a message to the console
				   document.getElementById("result").innerHTML= response;
				   // console.log(response);
				});
				​
				// Callback handler that will be called on failure
				request.fail(function (jqXHR, textStatus, errorThrown){
				   // Log the error to the console
				   console.error(
				       "The following error occurred: "+
				       textStatus, errorThrown
				   );
				});
				​
				// Callback handler that will be called regardless
				// if the request failed or succeeded
				request.always(function () {
				   // Reenable the inputs
				   $inputs.prop("disabled", false);
				});
			}else {
			document.getElementById("result").innerHTML = "";
			}
		</script>
	</div>
	<div class="card-footer text-white bg-transparent text-center font-weight-bold"> &copy; 2020 </div>

</body>
</html>
<?php ob_end_flush(); ?>