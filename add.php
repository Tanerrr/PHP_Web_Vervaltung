<?php
include("header.php");
require_once "connection.php";

/*
if (session_status() == PHP_SESSION_NONE) {
    session_start();

}
*/

if ( isset($_POST['Benutzer_Name']) && isset($_POST['SEX'])
    && isset($_POST['DOB'])) {

    // Data validation
    if ( strlen($_POST['Benutzer_Name']) < 1 || strlen($_POST['SEX']) < 1) {
        $_SESSION['error'] = 'Missing data';
        header("Location: add.php");
        return;
    }

    $sql = "INSERT INTO benutzer (Benutzer_Name, SEX, DOB, Job_Name, EMail)
              VALUES (:Benutzer_Name, :SEX, :DOB, :job, :email)";
    $stmt = $PDO->prepare($sql);
    $stmt->execute(array(
        ':Benutzer_Name' => $_POST['Benutzer_Name'],
        ':SEX' => $_POST['SEX'],
        ':DOB' => $_POST['DOB'],
        ':job' => $_POST['job'],
        ':email' => $_POST['email']));
    $_SESSION['success'] = 'Record Added';
    header( 'Location: index.php' ) ;
    return;
}

// Flash pattern
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
?>

<div class="center mt-5">
    <form action="add.php" method="post" style="max-width: 420px; margin: auto">
        <h1 class="h3 mb-3 font-weight-normal">
            Add A New User
        </h1>
        <div class="form-group mb-3">
            <label for="formGroupExampleInput">Name</label>
            <input type="text" class="form-control mb-3" id="formGroupExampleInput" name="Benutzer_Name">
        </div>
        <div class="form-group mb-3">
            <label for="formGroupExampleInput">Job</label>
            <input type="text" class="form-control mb-3" id="formGroupExampleInput" name="job">
        </div>
        <div class="form-group mb-3">
            <label for="formGroupExampleInput">E-Mail</label>
            <input type="text" class="form-control mb-3" id="formGroupExampleInput" name="email">
        </div>
        <div class="form-group mb-3">
            <label for="formGroupExampleInput">Geschlecht</label>
            <input type="text" class="form-control" id="formGroupExampleInput" name="SEX"></p>
        </div>
        <div class="form-group mb-5">
            <label for="formGroupExampleInput">Geburtsdatum</label>
            <input type="date" class="form-control" name="DOB" id="formGroupExampleInput">
        </div>
        <div class="text-center form-group">
            <input type="submit" class="btn btn-primary mr-5" value="Add New"/><a class="btn btn-secondary" href="index.php">Cancel</a>
        </div>
    </form>

</div>




