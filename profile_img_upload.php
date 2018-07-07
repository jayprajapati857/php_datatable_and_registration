<?php

if($_FILES["file"]["error"] > 0)
  {
  	echo "Error: " . $_FILES["file"]["error"] . "<br>";
  }
else
  {
  if($_FILES["file"]["type"] == 'image/jpeg' || $_FILES["file"]["type"] == 'image/gif' || $_FILES["file"]["type"] == 'image/png' || $_FILES["file"]["type"] == 'image/jpg')
  {
    $imgPath="prfile_pictures/";
    copy($_FILES["file"]["tmp_name"],$imgPath.$_FILES["file"]["name"]);
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp Name: " . $_FILES["file"]["tmp_name"] ."<br>";
    echo "Stored in: " . $imgPath ."<br>";
    echo "<a href='file_upload.php'>&lt;&lt;Back</a>";
  }
  else
  {
  	echo "You cant upload this file";	
	echo "<a href='file_upload.php'>&lt;&lt;Back</a>";
  }
 }
?>