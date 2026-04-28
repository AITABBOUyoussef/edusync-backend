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