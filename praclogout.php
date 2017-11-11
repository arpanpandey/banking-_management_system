<?php
session_start();
$name=$_SESSION['name'];
$pwd=$_SESSION['pwd'];

session_unset();
session_destroy();
echo "session out";
header("location:pracmain.php");

?>