<?php
	ob_start();
	session_start();
	require_once 'actions/db_connect.php'; 

	// if session is not set this will redirect to login page
	if( !isset($_SESSION['admin']) && !isset($_SESSION['user']) ) {
		header("Location: login/login.php");
		exit;
	}
	if( isset($_SESSION['user']) ) {
		header("Location: index.php");
		exit;
	}
	if( isset($_SESSION['superadmin']) ) {
		header("Location: super_admin.php");
		exit;
	}
	// select logged-in admins details
	$sql = "SELECT * FROM users WHERE user_id=".$_SESSION['admin'];
	$result = mysqli_query($conn, $sql);
	$userRow = mysqli_fetch_assoc($result);
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
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  	<header>   
	    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
					<li class="nav-item active">
						<a class="nav-link" href="admin.php">All cuties <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-warning" href="insert.php">Add a pet</a>
					</li>
				</ul>
			</div>
			<span class="ml-auto text-white mr-3">
                <img class="rounded" style="height: 40px; width: 40px" src="<?php echo $userRow['image'];?>">
                Hi <?php echo $userRow['userName']; ?>
            </span>
            <a href="login/logout.php?logout" class="nav-link  btn btn-outline-warning">Log out</a>
		</nav>
	</header>
	<div class="container row row-cols-1 row-cols-md-3 row-cols-lg-3 mx-auto my-4 bg-warning w-75">
        <div class="col  my-auto">
            <form class="form-inline my-2 my-lg-0 text-center ">
                <input class="form-control ml-auto mr-sm-2" type="search" id="search" placeholder="Search">
                <button class="btn btn-dark my-2 my-sm-0 mr-auto" type="submit">Search</button>
            </form>
            <p id="result"></p>
        </div>
        <div class="col text-center my-auto mx-auto">
            <h2>Adopt a friend :)</h2>
        </div>
        <div class="col text-center my-auto">
            <div class='card bg-transparent'>
                <img class="img-fluid mx-auto" src="img/logo.png" style="width: 60%">
            </div>
        </div>
    </div>
    <div class="container-fluid row row-cols-1 row-cols-md-2 row-cols-lg-4 mx-auto my-4">
    <?php
		$sql = "SELECT * FROM animals";
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
						<a href='update.php?id=".$row['animal_id']."' class='btn btn-outline-warning  mx-auto '>Update Pet</a>
						<a href='delete.php?id=".$row['animal_id']."' class='btn btn-outline-danger  mx-auto '>Delete Pet</a>	
					</div>
				</div>
			</div>";
		}

		// Free result set
		mysqli_free_result($result);
		// Close connection
		mysqli_close($conn);
	?>
	</div>
	<div class="card-footer text-white bg-transparent text-center font-weight-bold"> &copy; 2020 </div>
	
</body>
</html>
<?php ob_end_flush(); ?>