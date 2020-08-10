<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php'; 

    // if session is not set this will redirect to login page
    if( !isset($_SESSION['admin']) && !isset($_SESSION['user']) && !isset($_SESSION['superadmin']) ) {
        header("Location: login/login.php");
        exit;
    }
    if( isset($_SESSION['user']) ) {
        header("Location: index.php");
        exit;
    }
    if( isset($_SESSION['admin']) ) {
        header("Location: admin.php");
        exit;
    }
    // select logged-in superadmins details
    $sql = "SELECT * FROM users WHERE user_id=".$_SESSION['superadmin'];
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
        <nav class="navbar navbar-expand navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="super_admin.php">All users <span class="sr-only">(current)</span></a>
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
        
    <div class="container-fluid row row-cols-1 row-cols-md-2 row-cols-lg-4 mx-auto my-4">
    <?php
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);
        // fetch the next row (as long as there are any) into $row
        while($row = mysqli_fetch_assoc($result)) {
            echo "
            <div class='col mb-4'>
                <div class='card px-1 py-1 bg-light h-100'>
                    <h3 class='card-title'>Name: ". $row['userName']." </h3>
                    <img src='" .$row['image']." ' class='card-img-top' alt='...' >
                    <div class='card-body'>
                        <h6 class='card-text'>Email: <span class='text-info mr-3'>".$row['userEmail']."</span></h6>
                        <h6 class='card-text'>Status: <span class='text-info'>".$row['status']."</span> </h6>     
                    </div>
                    <div class='card-footer text-center p-1'>  
                        <a href='deleteUser.php?id=".$row['user_id']."' class='btn btn-outline-danger  mx-auto '>Delete user</a>
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