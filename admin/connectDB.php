<?php
function ConnectionDb(){
    try {
        $conn=new PDO("mysql:host=localhost;dbname=edu_sync","root","");
        return $conn;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>