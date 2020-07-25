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
    $sql = "SELECT * FROM users where user_id=".$_SESSION['admin'];
    $result = mysqli_query($conn, $sql);
    $userRow = mysqli_fetch_assoc($result);
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
                        <a class="nav-link text-warning" href="insert.php">Add a pet</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item ">
                        <span class="nav-link">
                            <img class="rounded" style="height: 40px; width: 40px" src="<?php echo $userRow['image'];?>">
                            Hi <?php echo $userRow['userName']; ?>
                        </span>
                    </li>
                    <li class="nav-item my-auto">
                        <a href="login/logout.php?logout" class="nav-link  btn btn-outline-warning">Log out</a>
                    </li>
                </ul>   
            </div>
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
    <div class="mx-auto font-weight-bold mt-2 w-50 bg-info py-3">
        <form action="actions/a_insert.php" method ="post" >
            <div class="form-row justify-content-center">
                <div class="form-group col-md-4 mb-2">
                    <label for="name">Name: </label>
                    <input type="text" class="form-control" name="name" placeholder="Pet Name">
                </div>
                <div class="form-group col-md-4 mb-2">
                    <label for="location">Location: </label>
                    <input type="text" class="form-control" name="location" placeholder="address">
                </div>
            </div>
            <div class="form-row justify-content-center">
                <div class="form-group col-md-4 mb-2">
                    <label for="type">Type: </label>
                    <input type="text" class="form-control" name="type" 
                    placeholder="Small, Large, Senior">
                </div>
                <div class="form-group col-md-4 mb-2">
                    <label for="age">Age: </label>
                    <input type="text" class="form-control" name="age" placeholder="pet age">
                </div>
            </div>
            <div class="form-group col-md-8 mb-2 mx-auto px-0">
                <label for="image">Image: </label>
                <input type="text" class="form-control" name="image" placeholder="Pet image path">
            </div>
            <div class="form-group col-md-8 mb-2 mx-auto px-0">
                <label for="description">Description: </label>
                <input type="text" class="form-control" name="description" placeholder="Pet short description">
            </div>
            <div class="form-group col-md-8 mb-2 mx-auto px-0">
                <label for="hobbies">Hobbies: </label>
                <input type="text" class="form-control" name="hobbies" placeholder="pet hobbies">
            </div>  
            <div class="form-group col-md-4 mx-auto">
                <input type="submit" class="btn btn-danger form-control" value="Submit">
            </div>
        </form>
    </div>
    <div class="card-footer text-white bg-transparent text-center font-weight-bold"> &copy; 2020 </div>
</body>
</html>
<?php ob_end_flush(); ?>