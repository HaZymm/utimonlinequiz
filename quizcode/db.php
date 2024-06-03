<?php
/* php& mysqldb connection file */
$user = "root"; //mysqlusername
$pass = ""; //mysqlpassword
$host = "localhost"; //server name or ipaddress
$dbname= "quiz1"; //nama database table at phpmyAdmin

$connect = mysqli_connect($host,$user,$pass,$dbname);

/*if(isset($connect)) 
    echo("connect");  //connection is established
else
  echo("Tak boleh connect");*/

?>