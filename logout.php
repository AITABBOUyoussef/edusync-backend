<?php
  session_start();
if(isset($_SESSION))

{
  
session_destroy(); // unset($_SESSION['user]);
header('Location:login.php');
}
else{
    header('Location:login.php');
}
?>