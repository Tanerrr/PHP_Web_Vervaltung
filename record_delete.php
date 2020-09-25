<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
 server with default setting (user 'root' with no password) */
$conn = mysqli_connect("localhost", "root", "", "group_work");

// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
if(isset($_POST['delete'])){
    $itemID = $_POST['checkbox'];
    foreach ($itemID as $id){
        mysqli_query($conn, "Delete From benutzer where Benutzer_ID = ".$id);
    }
    header("Location: benutzer.php");
}
mysqli_close($conn);

?>
