<?php
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
// print_r($videos);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
        foreach($videos as $video){
            echo "ada ".$video;
            echo '<video width="320" height="240"  controls>';
            echo '   <source src="http://10.151.252.163/upload/'.$video.'" type="video/mp4">';
            echo '   <!-- <source src="movie.ogg" type="video/ogg"> -->';
            echo '   Your browser does not support the video tag.';
            echo '</video>';
        }
    ?>
</body>
</html>
