<?php
    include 'config.php';
    try {
        $PDO = new PDO ('mysql:host='.$host.';dbname='.$database, $username, $password);
    } catch(PDOException $e){
        echo $e ->getMessage();
    }
?>