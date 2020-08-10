<?php
	session_start();
	if( !isset($_SESSION['admin']) && !isset($_SESSION['user']) && !isset($_SESSION['superadmin']) ){
	 header( "Location: login/login.php");
	} else if(isset($_SESSION[ 'user'])!="") {
	 header("Location: index.php");
	} else if(isset($_SESSION[ 'admin'])!="") {
	 header("Location: admin.php");
	} else if(isset($_SESSION[ 'superadmin'])!="") {
	 header("Location: superadmin.php");
	}

	if  (isset($_GET['logout'])) {
	 unset($_SESSION['user' ]);
	 unset($_SESSION['admin']);
	 unset($_SESSION['superadmin']);
	 session_unset();
	 session_destroy();
	 header("Location: login.php");
	 exit;
	}
?>