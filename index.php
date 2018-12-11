<?php 

require_once("auth.php"); 

if(isset($_POST['logout'])){
  session_start();
  unset($_SESSION["user"]);
  header("Location: login.php");
}




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
      <div class="container">
        <div class="row">
          <div class="col-4"></div>
          <div class="col-4"></div>
          <div class="col-4">
    				<form class="login100-form validate-form" action="" method="POST">
              <input type="submit" class="login100-form-btn" name="logout" value="Logout"/>
            </form>
          </div>
        </div>
      </div>
      <div class="text-center text-white m-b-10">
        <h1 class="m-b-10">Local Video Streaming</h1>
        <h2>Final Project Multimedia Networking</h2>
      </div>
      <div  class = "row">
        <div class = "col-md-7 col-sm-7 col-xs-7">
          <div id="player_a" class="projekktor" style="float:left">
            <noscript><p>No JavaScript support.</p></noscript>
          </div>
          
          <div style="float:left">
            <script type="text/javascript">
              $(document).ready(function() {
                projekktor('#player_a', {
                  poster: '',
                  title: 'Projekktor - RTMP support',
                  playerFlashMP4: 'http://projekktor.wlodkowski.net/lib/release/1.3.09/swf/StrobeMediaPlayback/StrobeMediaPlayback.swf',
                  playerFlashMP3: 'http://projekktor.wlodkowski.net/lib/release/1.3.09/swf/StrobeMediaPlayback/StrobeMediaPlayback.swf',
                  width: 640,
                  height: 385,
                  platforms: ['browser', 'flash', 'vlc'],
                  //platforms: ['browser', 'android', 'ios', 'native', 'flash', 'vlc'],
                  playlist: [
                    {
                      0: {src: 'rtmp://10.151.252.147/live/test', type:'video/flv'},
                  
                    },
                    {
                      0: {src: 'rtmp://10.151.252.147/live/test', type:'video/flv'}
                    }
                  ]  
                }, 
                function(player) {
                  window.p = player;
                  p.setDebug(true);
                }
                );
              });
            </script>
            
          </div>         
        </div>

        <div class = "col-md-5 col-sm-5 col-xs-5">
          <iframe id="iframe" class= "chat-frame" src="http://localhost:3000" scrolling="yes"></iframe>
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
  <script>
    $(window).bind("load",function(){
      console.log('<?php echo $_SESSION['user']['username']?>')
      iframe.contentWindow.postMessage("<?php echo $_SESSION['user']['username']?>", '*');
      console.log("top");

    });
  </script><!--===============================================================================================-->

  <script src="js/main.js"></script>

</body>
</html>
