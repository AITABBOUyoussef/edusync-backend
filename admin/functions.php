<?php 
require "./connectDB.php" ;
function adduser($conn,$fullName,$Email,$password, $role){
    try {
    $sql = "INSERT INTO users (nom,Email,password,role) VALUES (?,?,?,?)  ";
    $stm=$conn->prepare($sql);
    $stm->execute([$fullName,$Email,$password, $role]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
function deletuser($id,$conn){
    try{
$sql="DELETE FROM users WHERE id=?";
$stm=$conn->prepare($sql);
$stm->execute([$id]);
    }
    catch (PDOException $e){
        echo $e->getMessage();

    }
}
function modifyuser($fullName,$email,$password,$role,$conn,$id){
    try{
        $sql="UPDATE users SET nom=$fullName, email=$email,role=$role,password=$password WHERE id=?";
        $stm=$conn->prepare($sql);
        $stm->execute([$fullName,$email,$password,$role,$id]);
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
}