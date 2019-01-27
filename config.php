<?php 
 $mysql_host = "localhost";
 $mysql_database = "qrcode";
 $mysql_user = "root";
 $mysql_password = "";

 $con = mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_database);
if (mysqli_connect_errno())
  {
  echo "Failed to connecit to MySQL: " . mysqli_connect_error();
  }

?>