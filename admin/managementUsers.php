<?php
require "functions.php";
require "connectDB.php";
$connct = ConnectionDb();
if(isset($_POST["submit"])){
    $password=$_POST['password'];
          $confirmpass= $_POST['confirmpass'];
    if($password == $confirmpass){
        $fullname=htmlentities($_POST['role']);
      $email=htmlentities($_POST['email']);
        $role = htmlentities($_POST['nom']);
        adduser($connct,$fullname,$email,$password,$role);

    }else {
        echo "password n'est pas athauntique";
    }
    
}else{
    echo "WRONG";
}
?>