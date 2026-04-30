<?php
function ConnectionDb(){
    try {
        $conn = new PDO("mysql:host=localhost;dbname=edu","root","");
        return $conn ;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}