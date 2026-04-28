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

function createClass($conn,$name,$salle){
    try {
        $sql = "INSERT INTO classes(nom,salle) VALUES (?,?) ";
        $stm=$conn->prepare($sql);
        $stm->execute([$name,$salle]);  
    } catch(PDOException $e) {
            echo $e->getMessage();
    }
}
function createCours($conn,$name,$description,$profid){
    try {
        $sql = "INSERT INTO courses(nom,description,volume_horaire,professeur_id) VALUES (?,?,?,?)";
        $stm=$conn->prepare($sql);
        $stm->execute([$name,$description,10,$profid]);
    } catch(PDOException $e) {
            echo $e->getMessage();
    }
}
function getAllStudents(){
    try {
        $sql = "";
    }
}