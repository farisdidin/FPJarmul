<?php

$allowedExts = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma");
$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

if ((($_FILES["file"]["type"] == "video/mp4")
|| ($_FILES["file"]["type"] == "audio/mp3")
|| ($_FILES["file"]["type"] == "audio/wma")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg"))

&& ($_FILES["file"]["size"] < 20000000)
&& in_array($extension, $allowedExts))

  {
  if ($_FILES["file"]["error"] > 0)
    {
    $message= "Return Code: " . $_FILES["file"]["error"] . "<br />";
    
    $_REQUEST["message"]= $message;
    header("Location: upload.php");
    
    }
  else
    {
    // echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    // echo "Type: " . $_FILES["file"]["type"] . "<br />";
    // echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    // echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
    $_REQUEST["message"]= "Upload File Successful";

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
        $_REQUEST["message"]= $_FILES["file"]["name"] . " already exists. ";
        // echo $_FILES["file"]["name"] . " already exists. ";
        header("Location: upload.php");
      }
    else
      {
        
        move_uploaded_file($_FILES["file"]["tmp_name"],
        "upload/" . $_FILES["file"]["name"]);
        $message= "Stored in: " . "upload/" . $_FILES["file"]["name"];
        $_REQUEST["message"] = $message;
        header("Location: upload.php");
      }
    }
  }
else
  {
  echo "Invalid file";
  }
?>