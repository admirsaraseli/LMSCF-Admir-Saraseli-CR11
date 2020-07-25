<?php 
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';

    // if session is not set this will redirect to login page
    if( !isset($_SESSION['admin']) && !isset($_SESSION['user']) ) {
        header("Location: login/login.php");
        exit;
    }
    // select logged-in admins details
    $sql = "SELECT * FROM users WHERE user_id=".$_SESSION['superadmin'];
    $result = mysqli_query($conn, $sql);
    $userRow = mysqli_fetch_assoc($result);

	if ($_GET['id']) {
		$id = $_GET['id'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Adopt-a-pet</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
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
                        <a class="nav-link text-info" href="insert.php">Add a pet</a>
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

	<div class="container mt-4 mx-auto text-center">
		<h3 class="text-white">Do you really want to delete this user?</h3>
		<form action ="actions/a_delete_user.php" method="post">
			<input type="hidden" name="id" value="<?php echo $id ?>" />
		    <button class="btn btn-danger" type="submit">Yes, delete it!</button >
		    <a href="superadmin.php"><button class="btn btn-secondary" type="button">No, go back!</button></a>
		</form>
	</div>
	<div class="card-footer text-white bg-transparent text-center font-weight-bold"> &copy; 2020 </div>
</body>
</html>

<?php
}
?>
<?php ob_end_flush(); ?>