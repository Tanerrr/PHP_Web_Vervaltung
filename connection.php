<?php
include 'config.php';
$PDO = new PDO ('mysql:host='.$host.';dbname='.$database, $username, $password);
$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>

