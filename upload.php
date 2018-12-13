<?php
require_once("auth.php"); 

if(isset($_POST['logout'])){
  session_start();
  unset($_SESSION["user"]);
  header("Location: login.php");
}
var_dump($_REQUEST["message"]);
$videos=array();
if ($handle = opendir('./upload')) {

  while (false !== ($entry = readdir($handle))) {

      if ($entry != "." && $entry != "..") {

          // echo "$entry\n";
          array_push($videos,$entry);
      }
  }

  closedir($handle);
}
print_r($videos);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>TCtreaming | Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
  <link rel="stylesheet" href="css/styles.css" type="text/css" media="screen"/>

  <!-- Load projekktor css -->
  <link rel="stylesheet" href="http://projekktor.wlodkowski.net/lib/release/1.3.04/themes/maccaco/projekktor.style.css" type="text/css" media="screen"/>

  <!-- Load jquery -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

  <!-- load projekktor js -->
  <script type="text/javascript" src="http://projekktor.wlodkowski.net/lib/release/1.3.04/projekktor-1.3.04.js"></script>  
</head>

<body>
  <div class="limiter">
    <div class="container-login100">
      <nav class="navbar navbar-expand-lg fixed-top navbar-dark" style="background-color: black;">
        <div class="container">
          <a class="navbar-brand m-r-30" href="index.php">TCtreaming</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" href="enroll-class.php">Enroll Course</a>
              </li> -->
              <li class="nav-item">
                <a class="nav-link" href="choose-class.php">Courses</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="upload.php">Upload</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="recorded.php">Video</a>
              </li>
            </ul>
            <div class="div-inline my-2 my-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Hi, <?php echo $_SESSION["username"]; ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <form action="" method="POST">
                <input type="submit" class="dropdown-item" name="logout" value="Logout"/>
              </form>
              </div>
            </li>
            </div>
          </div>    
        </div>
      </nav>
      <div class="container" style="margin-top: 60px;" >
        <div class="jumbotron text-center text-white" style="background-color: transparent !important">
          <h1 class="m-b-10">Upload</h1>
          <?php
            if(isset($_REQUEST["message"])){
              echo "<h2>";
              echo $_REQUEST["message"];
              echo "</h2>";
            }
          ?>
        </div>
        <div class="row justify-content-center">
          <div class="col-2"></div>
          <div class="col-8">
            <form method="POST" action="upload_file.php" enctype="multipart/form-data" >
              <div class="form-group files">
                <input type="file" class="form-control" multiple="" name="file" >
              </div>
              <div class="container-login100-form-btn">
                <input type="submit" class="login100-form-btn" name="upload" value="Upload"/>
              </div>
            </form>
          </div>
          <div class="col-2"></div>
        </div>
      </div>
    </div>
  </div>

<!--===============================================================================================-->	
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/tilt/tilt.jquery.min.js"></script>
<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
</script>
<script src="js/main.js"></script>

</body>
</html>