<?php

require_once "connection.php";
session_start();

if (isset($_POST['name'])  ){

    // Data validation
    if ( strlen($_POST['name']) < 1) {
        $_SESSION['error'] = 'Missing data';
        header("Location: edit.php?Benutzer_ID=".$_POST['user_id']);
        return;
    }
    $sql = "UPDATE benutzer SET Benutzer_Name = :name,
            Job_Name = :job, DOB = :datum, Benutzer_Role_ID = :rolle
            WHERE Benutzer_ID = :Benutzer_ID";
    $stmt = $PDO->prepare($sql);
    $stmt->execute(array(
        ':name' => $_POST['name'],
        ':job' => $_POST['job'],
        ':datum' => $_POST['datum'],
        ':rolle' => $_POST['rolle'],
        ':Benutzer_ID' => $_POST['user_id']));
    $_SESSION['success'] = 'Record updated';
    header( 'Location: index.php' ) ;
    return;
}

if ( !isset($_GET['Benutzer_ID']) ) {
    $_SESSION['error'] = "Missing ID";
    header('Location: index.php');
    return;
}

$stmt = $PDO->prepare("SELECT * FROM benutzer where Benutzer_ID = :xyz");
$stmt->execute(array(":xyz" => $_GET['Benutzer_ID']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
/* if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for user_id';
    header( 'Location: index.php' ) ;
    return;
} */

// Flash pattern
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}

$n = htmlentities($row['Benutzer_Name']);
$j = htmlentities($row['Job_Name']);
$d = htmlentities($row['DOB']);
$r = htmlentities($row['Benutzer_Role_ID']);
$id = $row['Benutzer_ID'];

?>

<p>Edit User</p>
<form method="post">
    <p>Name:
        <input type="text" name="name" value="<?= $n ?>"></p>
    <p>Job Name:
        <input type="text" name="job" value="<?= $j ?>"></p>
    <p>Geburtsdatum:
        <input type="date" name="datum" value="<?= $d ?>"></p>
    <p>Rolle:
        <input type="text" name="rolle" value="<?= $r ?>"></p>
    <input type="hidden" name="user_id" value="<?= $id ?>">
    <p><input type="submit" value="Update"/>
        <a href="index.php">Cancel</a></p>
</form>


