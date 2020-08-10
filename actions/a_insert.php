<?php
    ob_start();
    session_start();
    require_once 'db_connect.php'; 

    // if session is not set this will redirect to login page
    if( !isset($_SESSION['admin']) && !isset($_SESSION['user']) ) {
        header("Location: ../login/login.php");
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
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="admin.php">All cuties<span class="sr-only">(current)</span></a>
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
  	
    <div class="container mt-4 mx-auto text-center">
		<?php
			// Escape user inputs for security
			$name = mysqli_real_escape_string($conn, $_POST['name']);
			$image = mysqli_real_escape_string($conn, $_POST['image']);
			$location = mysqli_real_escape_string($conn, $_POST['location']);
			$description = mysqli_real_escape_string($conn, $_POST['description']);
			$age = mysqli_real_escape_string($conn, $_POST['age']);
			$type = mysqli_real_escape_string($conn, $_POST['type']);
			$hobbies = mysqli_real_escape_string($conn, $_POST['hobbies']);

			// attempt insert query execution
			$sql = "INSERT INTO animals 
			(name, image, location, age, description, type, hobbies) 
			VALUES 
			('$name', '$image', '$location', '$age', '$description', '$type', '$hobbies')";
			
			if (mysqli_query($conn, $sql)) {
			    echo "<h1 class='text-white'>New pet created.<h1>";
			    header("Refresh: 3; url= ../admin.php");
			} else {
			    echo "<h1 class='text-red'>Something went wrong, please try again: </h1>" .
			         "<p>"  . $sql . "</p>" .
			         mysqli_error($conn);
			}
			mysqli_close($conn);		
		?>
    </div>
    <div class="card-footer text-dark bg-transparent text-center font-weight-bold"> &copy; 2020 </div>
</body>
</html>
<?php ob_end_flush(); ?>