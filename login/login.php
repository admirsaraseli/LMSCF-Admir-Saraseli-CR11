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
                    header( "Location: ../superadmin.php");    
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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <div class="container row row-cols-1 row-cols-md-3 row-cols-lg-3 mx-auto my-4 bg-warning w-75">
        <div class="col text-center my-auto mx-auto">
            <h1>Adopt a friend :)</h1>
        </div>
        <div class="col mx-auto my-auto">
            <div class='card text-left bg-transparent w-75'>
                <img class="img-fluid mx-auto" src="../img/logo.png" >
            </div>
        </div>
    </div>
    <div class="container bg-light w-50 mt-4">
        <h3 class="text-center text-danger my-3"><?php if ( isset($errMSG) ) {echo  $errMSG; }?></h3>
        <div id="login-row" class="row justify-content-center align-items-center">
          <div id="login-column" class="col-sm-8">
            <form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete= "off">
                <h3 class="text-center text-info">Login</h3>
                <div class="form-group">
                    <label for="username" class="text-info">Username:</label><br>
                    <input type="email" name="email" id="email" class="form-control" placeholder= "Your Email" value="<?php echo $email;?>" maxlength="40">
                    <span class="text-danger"><?php  echo $emailError; ?></span >
                </div>
                <div class="form-group">
                    <label for="password" class="text-info">Password:</label><br>
                    <input type="password" name="pass" id="password" class="form-control" placeholder="Your Password"  maxlength="15">
                    <span class="text-danger"><?php  echo $passError; ?></span>
                </div>
                <div class="form-group">
                    <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                    <input type="submit" name="btn-login" class="btn btn-info btn-md" value="Sign In">
                    <a href="register.php" class="ml-5 btn btn-outline-info ">
                    Sign up here 
                    </a>
                </div>
            </form>
          </div>
        </div>
    </div>  
</body>
</html>
<?php ob_end_flush(); ?>