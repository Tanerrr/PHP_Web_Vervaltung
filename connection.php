<?php include('config.php');?>
<?php


$db = mysqli_connect($host, $username, $password, $database);
if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// initialize variables
$name = "";
$dob = "";
$rolle = "";
$id = 0;
$update = false;

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $rolle = $_POST['rolle'];

    mysqli_query($db, "INSERT INTO benutzer (Benutzer_Name, DOB, Benutzer_Role_ID) VALUES ('$name', '$dob', '$rolle')");
    $_SESSION['message'] = "Neue Benutzer wurde hinzugefügt";
    header('location: benutzer.php');
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $rolle = $_POST['rolle'];
    mysqli_query($db, "UPDATE benutzer SET Benutzer_Name='$name', DOB='$dob', Benutzer_Role_ID='$rolle' WHERE Benutzer_ID=$id");
    $_SESSION['message'] = "Benutzer Infomationen wurde bearbeitet";
    header('location: benutzer.php');
}


if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($db, "DELETE FROM benutzer WHERE Benutzer_ID=$id");
    $_SESSION['message'] = "Benutzer wurde entfernt!";
    header('location: benutzer.php');
}

if(isset($_POST['delete'])){
    $itemID = $_POST['checkbox'];
    foreach ($itemID as $id){
        mysqli_query($db, "Delete From benutzer where Benutzer_ID = ".$id);
    }
    $_SESSION['message'] = "Ausgewählte Benutzer wurde entfernt!";
    header("Location: benutzer.php");
}



?>


