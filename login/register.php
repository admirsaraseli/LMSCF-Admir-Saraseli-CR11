<?php
    ob_start();
    session_start(); // start a new session or continues the previous
    if( isset($_SESSION['user'])!="" ){
        header("Location: home.php" ); // redirects to home.php
    }
    include_once '../actions/db_connect.php';
    $error = false;
    if ( isset($_POST['btn-signup']) ) {

        // sanitize user input to prevent sql injection
        $name = trim($_POST['name']);

        //trim - strips whitespace (or other characters) from the beginning and end of a string
        $name = strip_tags($name);

        // strip_tags — strips HTML and PHP tags from a string

        $name = htmlspecialchars($name);
        // htmlspecialchars converts special characters to HTML entities
        $email = trim($_POST[ 'email']);
        $email = strip_tags($email);
        $email = htmlspecialchars($email);

        $pass = trim($_POST['pass']);
        $pass = strip_tags($pass);
        $pass = htmlspecialchars($pass);

        // basic name validation
        if (empty($name)) {
            $error = true ;
            $nameError = "Please enter your full name.";
        } else if (strlen($name) < 3) {
            $error = true;
            $nameError = "Name must have at least 3 characters.";
        } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
            $error = true ;
            $nameError = "Name must contain alphabets and space.";
        }

        //basic email validation
        if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $error = true;
            $emailError = "Please enter valid email address." ;
        } else {
            // checks whether the email exists or not
            $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
            $result = mysqli_query($conn, $query);
            $count = mysqli_num_rows($result);
            if($count!=0){
                $error = true;
                $emailError = "Provided Email is already in use.";
            }
        }
        // password validation
        if (empty($pass)){
            $error = true;
            $passError = "Please enter password.";
        } else if(strlen($pass) < 6) {
            $error = true;
            $passError = "Password must have atleast 6 characters." ;
        }

        // password hashing for security
        $password = hash('sha256' , $pass);

        // if there's no error, continue to signup
        if( !$error ) {

        $query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')";
        $res = mysqli_query($conn, $query);
            if ($res) {
                $errTyp = "success";
                $errMSG = "Successfully registered, you may login now";
                unset($name);
                unset($email);
                unset($pass);
            } else  {
                $errTyp = "danger";
                $errMSG = "Something went wrong, try again later..." ;
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Login & Registration System</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body class="bg-info">
  
    <div class="container bg-light w-50 mt-4">
        <h3 class="text-center text-red my-3"><?php if ( isset($errMSG) ) {echo  $errMSG; }?></h3>
        <div id="login-row" class="row justify-content-center ">
          <div id="login-column" class="col-sm-8">
            <form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete= "off">
                <h3 class="text-center text-info">Register</h3>
                <div class="form-group">
                    <label for="name" class="text-info">Yourname:</label><br>
                    <input type="text" name="name" id="name" class="form-control" placeholder= "Enter Full Name" value="<?php echo $name;?>" maxlength="50">
                    <span class="text-danger"><?php  echo $nameError; ?></span >
                </div>
                <div class="form-group">
                    <label for="username" class="text-info">Username:</label><br>
                    <input type="email" name="email" id="email" class="form-control" placeholder= "Enter Your Email" value="<?php echo $email;?>" maxlength="40">
                    <span class="text-danger"><?php  echo $emailError; ?></span >
                </div>
                <div class="form-group">
                    <label for="password" class="text-info">Password:</label><br>
                    <input type="password" name="pass" id="password" class="form-control" placeholder="Enter Password"  maxlength="15">
                    <span class="text-danger"><?php  echo $passError; ?></span>
                </div>
                <div class="form-group">
                    <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                    <input type="submit" name="btn-signup" class="btn btn-info btn-md" value="Sign Up">
                    <a href="../index.php" class="ml-5 btn btn-outline-info ">
                    Sign in here 
                    </a>
                </div>
            </form>
          </div>
        </div>
    </div>  
</body >
</html >
<?php  ob_end_flush(); ?>