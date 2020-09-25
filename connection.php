<?php
include 'config.php';
try {
    $db = mysqli_connect($host, $username, $password, $database);
} catch(PDOException $e){
    echo $e ->getMessage();
}
?>