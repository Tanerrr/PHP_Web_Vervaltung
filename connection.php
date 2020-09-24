<?php
    try {
        $PDO = new PDO ("mysql:host=localhost;port=8888;dbname=group_work", "root","root");
    } catch(PDOException $e){
        echo $e ->getMessage();
    }
?>