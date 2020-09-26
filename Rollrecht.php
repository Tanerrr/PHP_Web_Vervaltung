
<?php include('connection.php');?>

<?php
/*if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $roleID_save = $_GET['edit'];
    $update = true;
    $query = "select rr.rolRec_ID, rr.Rollen_ID, r2.Rollen_Name, 
    CONCAT(rr.Rollen_ID, ': ',r2.Rollen_Name ) AS RolenName, r.Recht_Name 
    from rollen_rechten rr JOIN rechten r on r.Recht_ID = rr.Recht_ID 
    JOIN rollen r2 on r2.Rollen_ID= rr.Rollen_ID WHERE rr.rolRec_ID=$id";
    $record = mysqli_query($db, $query);

    //if (count($record) == 1 ) {
    $n = mysqli_fetch_array($record);
    $rolid = $n['RolenName'];
    $recname = $n['Recht_Name'];

    //}
}*/
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
    <caption>Rollen Rechten<br><br></caption>
    <thead>
        <th><label for="select_all_checkbox"></label><input type="checkbox" id="select_all_checkbox" onclick="toggle(this);"></th>
        <th>RollenID</th>
        <th>RollenName</th>
        <th>RechtName</th>
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
                echo "<td class='user_list'><a href='connection.php?del=".$row['rolRec_ID']."' class='del_btn'>Delete</a></td>";
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


<form class="form_2" id=form_2 method="post" action="connection.php" >

    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <div class="input-group">
        <label for="rolid">Rolle Auswählen</label>
        <select name="rolid" id="rolid" form="form_2" required>

            <!--Select listelerinin elemanlarını veritabanından çekmek için bu SQL kodunu oluşturuyoruz. -->
            <?php
            $query2= "select Rollen_ID, Rollen_Name, CONCAT( Rollen_ID, ': ', Rollen_Name) AS Rollen from rollen;";
            $res = mysqli_query($db, $query2);
            while($row2 = mysqli_fetch_array($res)){
                echo "<option name='rolid' value='".$row2['Rollen_ID']."'>".$row2['Rollen']."</option>";
            }
            mysqli_free_result($res);
            ?>



        </select>
    </div>
    <div class="input-group">
        <label for="recname">Rechte Auswählen</label>
        <select name="recname" id="recname" form="form_2" required>

            <!--Select listelerinin elemanlarını veritabanından çekmek için bu SQL kodunu oluşturuyoruz. -->
            <?php
            $query4 = "select Rollen_ID from rollen_rechten where rolRec_ID=$id";
            ob_start(); //Start output buffer
            echo $query4;
            $output = ob_get_contents(); //Grab output
            ob_end_clean(); //Discard output buffer


            $query3= "select Rollen_ID, Recht_ID, Recht_Name from (select rr.Rollen_ID, r.Recht_ID, r.Recht_Name
            from rechten r JOIN rollen_rechten rr ON rr.Recht_ID = r.Recht_ID) que
            where que.Recht_ID NOT IN (select Recht_ID from (select rr.Rollen_ID, r.Recht_ID, r.Recht_Name
            from rechten r JOIN rollen_rechten rr ON rr.Recht_ID = r.Recht_ID) que where que.Rollen_ID = 3 OR NOT 3 IN(select Rollen_ID from rollen))
            group by Recht_ID";
            $res2 = mysqli_query($db, $query3);
            while($row3 = mysqli_fetch_array($res2)){
                echo "<option name='recname' value='".$row3['Recht_ID']."'>".$row3['Recht_Name']."</option>";
            }
            mysqli_free_result($res2);
            ?>

        </select>
    </div>
    <div class="input-group">
            <button class="btn" type="submit" name="save" >Save</button>
    </div>
</form>

</body>
</html>