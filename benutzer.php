<?php include('config.php');?>

<?php
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($db, "SELECT Benutzer_ID, Benutzer_Name, DOB, Benutzer_Role_ID FROM benutzer WHERE Benutzer_ID=$id");

    //if (count($record) == 1 ) {
    $n = mysqli_fetch_array($record);
    $name = $n['Benutzer_Name'];
    $dob = $n['DOB'];
    $rolle = $n['Benutzer_Role_ID'];
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

<?php $results = mysqli_query($db, "SELECT Benutzer_ID, Benutzer_Name, DOB, Benutzer_Role_ID FROM benutzer"); ?>
<form method="post" action="record_delete.php">
    <table class="benutzer">
        <caption>BENUTZER LISTE<br><br></caption>
        <thead>
        <th></th>
        <!--when edit clicked change all the informations then click on go button
        this will run sql command then informations will be saved and then refresh the page again -->
        <!--when delete is clicked all row should be deleted
         So delete button should connect the database sql delete from and
         tnen update the page again-->
        <th>BenutzerID</th><br>
        <th>BenutzerName</th><br>
        <th>RoleName</th><br>
        <th>DoB</th>
        <th>Rechten</th>
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
        $sql = "SELECT b.Benutzer_ID, b.Benutzer_Name, b.DOB,  CONCAT(b.Benutzer_Role_ID, ': ', r.Rollen_Name)
    AS Rollen, quer.RechtName from benutzer b JOIN 
    (select rec.Rollen_ID, GROUP_CONCAT(DISTINCT r2.Recht_Name) AS RechtName from rollen_rechten rec join rechten r2 on r2.Recht_ID = rec.Recht_ID group by rec.Rollen_ID) quer
    ON quer.Rollen_ID=b.Benutzer_Role_ID JOIN rollen r ON b.Benutzer_Role_ID = r.Rollen_ID
    order by b.Benutzer_ID";
        if($result = mysqli_query($link, $sql)){
            if(mysqli_num_rows($result) > 0){
                /*echo "<table class='benutzer'>";
                echo "<tr>";
                echo "<th>BenutzerID</th>";
                echo "<th>BenutzerName</th>";
                echo "<th>RoleName</th>";
                echo "<th>DoB</th>";
                echo "</tr>";*/
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td class='user_list'><input class='user_list1' type='checkbox' name='checkbox[]' value='".$row['Benutzer_ID']."'></td>";
                    echo "<td class='user_list'>" . $row['Benutzer_ID'] . "</td>";
                    echo "<td class='user_list'>" . $row['Benutzer_Name'] . "</td>";
                    echo "<td class='user_list'>" . $row['Rollen'] . "</td>";
                    echo "<td class='user_list'>" . $row['DOB'] . "</td>";
                    echo "<td class='user_list'>" . $row['RechtName'] . "</td>";
                    echo "<td class='user_list'><a href='benutzer.php?edit=".$row['Benutzer_ID']."#form_2' class='edit_btn'>Edit</a></td>";
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
        <label>Name</label>
        <input type="text" name="name" value="<?php echo $name; ?>">
    </div>
    <div class="input-group">
        <label>Rolle</label>
        <input type="text" name="rolle" value="<?php echo $rolle; ?>">
    </div>
    <div class="input-group">
        <label>Geburtsdatum</label>
        <input type="date" name="dob" value="<?php echo $dob; ?>">
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