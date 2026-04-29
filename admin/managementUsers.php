<?php
require "functions.php";
require "connectDB.php";
$connct = ConnectionDb();
if(isset($_POST["submit"])){
    $password=$_POST['password'];
          $confirmpass= $_POST['confirmpass'];
    if($password == $confirmpass){
        $fullname=htmlentities($_POST['nom']);
      $email=htmlentities($_POST['email']);
        $role = htmlentities($_POST['role']);
        adduser($connct,$fullname,$email,$password,$role);

    }else {
        echo "password n'est pas athauntique";
    }
    
}else{
    echo "WRONG";
}
?>