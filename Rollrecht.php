
<?php include('config.php');?>

<?php
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($db, "select rr.rolRec_ID, rr.Rollen_ID, r2.Rollen_Name, r.Recht_Name from rollen_rechten rr 
    JOIN rechten r on r.Recht_ID = rr.Recht_ID 
    JOIN rollen r2 on r2.Rollen_ID= rr.Rollen_ID WHERE rr.rolRec_ID=$id");

    //if (count($record) == 1 ) {
    $n = mysqli_fetch_array($record);
    $rolid = $n['Rollen_ID'];
    $rolname = $n['Rollen_Name'];
    $recname = $n['Recht_Name'];

    //}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CReate, Update, Delete PHP MySQL</title>
    <link rel="stylesheet" type="text/css" href="edit.css.php">
    <script>
        function toggle(source) {
            //var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            const checkboxes = document.querySelectorAll(".user_list1");
            for (let i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] !== source)
                    checkboxes[i].checked = source.checked;
            }
        }
    </script>
</head>
<body>
<?php if (isset($_SESSION['message'])): ?>
    <div class="msg">
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
    </div>
<?php endif ?>

<?php $results = mysqli_query($db, "SELECT rolRec_ID, Rollen_ID, Recht_ID FROM rollen_rechten"); ?>
<form method="post" action="record_delete.php">
<table class="benutzer">
    <caption>BENUTZER LISTE<br><br></caption>
    <thead>
        <th></th>
        <th>RollenID</th><br>
        <th>RollenName</th><br>
        <th>RechtName</th><br>
        <th>Edit</th>
    </thead><br>
    <tbody>
    <?php
    /* Attempt MySQL server connection. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
    $link = mysqli_connect("localhost", "root", "", "group_work");

    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    // Attempt select query execution
    $sql = "select rr.rolRec_ID, rr.Rollen_ID, r2.Rollen_Name, r.Recht_Name from rollen_rechten rr 
    JOIN rechten r on r.Recht_ID = rr.Recht_ID 
    JOIN rollen r2 on r2.Rollen_ID= rr.Rollen_ID";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td class='user_list'><input class='user_list1' type='checkbox' name='checkbox[]' value='".$row['rolRec_ID']."'></td>";
                echo "<td class='user_list'>" . $row['Rollen_ID'] . "</td>";
                echo "<td class='user_list'>" . $row['Rollen_Name'] . "</td>";
                echo "<td class='user_list'>" . $row['Recht_Name'] . "</td>";
                echo "<td class='user_list'><a href='Rollrecht.php?edit=".$row['rolRec_ID']."#form_2' class='edit_btn'>Edit</a></td>";
                echo "</tr>";
            }
            mysqli_free_result($result);
        } else{
            echo "No records matching your query were found.";
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }

    // Close connection
    mysqli_close($link);
    ?>

    </tbody>
</table>
<table class="control">
    <tr>
        <td><input type="checkbox" id="select_all_checkbox" onclick="toggle(this);">Check All</td>
        <td class="button"><input type="submit" name="delete" id="delete" value="Delete Records"></td>
    </tr>
</table>
</form>


<form class="form_2" id=form_2 method="post" action="config.php" >

    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <div class="input-group">
        <label>RolleID</label>
        <input type="text" name="name" value="<?php echo $rolid; ?>">
    </div>
    <div class="input-group">
        <label>RollName</label>
        <input type="text" name="rolle" value="<?php echo $rolname; ?>">
    </div>
    <div class="input-group">
        <label>RechtName</label>
        <input type="text" name="dob" value="<?php echo $recname; ?>">
    </div>
    <div class="input-group">
        <?php if ($update == true): ?>
            <button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
        <?php else: ?>
            <button class="btn" type="submit" name="save" >Save</button>
        <?php endif ?>
    </div>
</form>

</body>
</html>