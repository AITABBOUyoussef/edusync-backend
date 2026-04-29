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
function getAllUsers($conn,$role){
    try {
        $sql = "SELECT id,nom,email FROM users WHERE role = ?";
        $stm=$conn->prepare($sql);
        $stm->execute([$role]);
        $users= $stm->fetchAll();
        return $users;
    } catch(PDOException $e) {
            echo $e->getMessage();
    }
}

function getCours($conn){
    try {
        $sql = "SELECT id,nom,description FROM courses ";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $courses = $stm->fetchAll();
        return $courses ;
    } catch(PDOException $e) {
            echo $e->getMessage();
    }
}
function repartitionStudent($conn,$id_classe){
    try{
        $sql="SELECT classe_id,COUNT(id) from users WHERE role='?' GROUP BY classe_id";
        $stm=$conn->prepare($sql);
        $stm->execute(["student"]);
        $total=$stm->fetchALL();
        return $total;
    }
    catch(PDOEXception $e){
        echo $e->getMessage();

    }
}