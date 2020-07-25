<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';

    // if session is not set this will redirect to login page
    if( !isset($_SESSION['admin']) && !isset($_SESSION['user']) ) {
        header("Location: login/login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Adopt-a-pet</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="Travel Agency">
	<meta name="keywords" content="HTML, Bootstrap, MySQL, PHP">
	<meta name="author" content="Admir Saraseli">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
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
		$sql = "SELECT * FROM animals WHERE animals.type in ('large','small')";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($result)) {
			echo "
			<div class='col mb-4'>
				<div class='card px-1 py-1 bg-light h-100'>
					<h3 class='card-title'>Meet: ". $row['name']." </h3>
					<img src='" .$row['image']." ' class='card-img-top' alt='...' >
					<div class='card-body'>
						<p class='card-text'>". $row['description']."</p>
						<h5 class='card-text'> ".$row['type']." ,
						<span class='text-info ml-3'> ".$row['age']."</span></h5>
						<h5 class='card-text'> ".$row['hobbies']." </h5>
						<h5 class='card-text'> ".$row['location']." </h5>     
					</div>
					<div class='card-footer text-center p-1'>
						<a href='details.php?title=".$row['title']."&image=".$row['image']."&author=".$row['name']."&status=".$row['status']."&isbn=".$row['isbn']."&desc=".$row['description']."&date=".$row['publish_date']."&type=".$row['type']."&publisher=".$row['publisher_name']."' class='btn btn-outline-info btn-sm mx-auto w-75'>Take me home</a>
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