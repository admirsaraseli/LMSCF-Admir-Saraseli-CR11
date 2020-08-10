<?php
    ob_start();
    session_start();
    require_once '../actions/db_connect.php';

    // it will never let you open login page if session is set
    if (isset($_SESSION['user'])!="") {
        header("Location: ../index.php");
        exit;
    }else if(isset($_SESSION['admin'])!=""){
        header("Location: ../admin.php");
        exit;
    }else if(isset($_SESSION['superadmin'])!=""){
        header("Location: ../super_admin.php");
        exit;
    }

    $error = false;

    if( isset($_POST['btn-login']) ) {

        // prevent sql injections/ clear user invalid inputs
        $email = trim($_POST['email']);
        $email = strip_tags($email);
        $email = htmlspecialchars($email);

        $pass = trim($_POST[ 'pass']);
        $pass = strip_tags($pass);
        $pass = htmlspecialchars($pass);
        // prevent sql injections / clear user invalid inputs

        if(empty($email)){
        $error = true;
        $emailError = "Please enter your email address.";
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $error = true;
            $emailError = "Please enter valid email address.";
        }   

        if (empty($pass)){
            $error = true;
            $passError = "Please enter your password." ;
        }

        // if there's no error, continue to login
        if (!$error) {
            $password = hash( 'sha256', $pass); // password hashing
            $res=mysqli_query($conn, "SELECT * FROM users WHERE userEmail='$email'" );
            $row=mysqli_fetch_array($res, MYSQLI_ASSOC);
            $count = mysqli_num_rows($res); // if uname/pass is correct it returns must be 1 row

            if( $count == 1 && $row['userPass' ]==$password ) {
                if ($row["status"] == 'admin'){
                    $_SESSION["admin"] = $row['user_id'];
                    header( "Location: ../admin.php");
                }else if ($row["status"] == 'superadmin'){
                    $_SESSION['superadmin'] = $row['user_id'];
                    header( "Location: ../super_admin.php");    
                }else {
                    $_SESSION['user'] = $row['user_id'];
                    header( "Location: ../index.php");    
                }
                
            }else {
                $errMSG = "Incorrect Credentials, Try again..." ;
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Login & Registration System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
   
    <div class="container row mx-auto my-4 bg-warning w-75">
        <div class="col-sm-6 text-center my-auto mx-auto p-0">
            <h1>Adopt a friend :)</h1>
        </div>
        <div class="col-sm-6 text-center mx-auto my-auto p-0">
            <img class="img-fluid" src="../img/logo.png" >    
        </div>
    </div>
    <div class="container loginn bgg w-50 my-4 py-3">
        <h3 class="text-center text-danger my-3"><?php if ( isset($errMSG) ) {echo  $errMSG; }?></h3>
        <form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete= "off">
            <h3 class="text-center text-info mb-3">Login</h3>
            <div class="form-group col-sm-8 mx-auto px-0">
                <label for="username" class="text-info">Username:</label><br>
                <input type="email" name="email" id="email" class="form-control" placeholder= "Your Email" value="<?php echo $email;?>" maxlength="40">
                <span class="text-danger"><?php  echo $emailError; ?></span >
            </div>
            <div class="form-group col-sm-8 mx-auto px-0">
                <label for="password" class="text-info">Password:</label><br>
                <input type="password" name="pass" id="password" class="form-control" placeholder="Your Password"  maxlength="15">
                <span class="text-danger"><?php  echo $passError; ?></span>
            </div>
            <div class="form-group col-sm-8 mx-auto px-0">
                <label for="remember-me" class="text-info my-auto"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
            </div>
            <div class="form-group col-sm-8 mx-auto px-0">  
                <input type="submit" name="btn-login" class="btn btn-info btn-md mb-2" value="Sign In">
                <a href="register.php" class=" btn btn-outline-info btn-md mb-2">
                Sign up here 
                </a>
            </div>
        </form>  
    </div> 
</body>
</html>
<?php ob_end_flush(); ?>