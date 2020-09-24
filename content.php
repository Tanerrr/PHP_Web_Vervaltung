<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="style2.css.php" >
    <script>
        function toggle(source) {
            //var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            var checkboxes = document.querySelectorAll(".user_list1");
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
    </script>
</head>
<body>
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
                //echo "<td><button class='btn btn-primary btn-lg' data-toggle='modal' data-target='#myModal' id='".$row['Benutzer_ID']."' onclick='showDetails(this);'>Edit</button></td>";
                //echo "<td><a href='edit.php' id='".$row['Benutzer_ID']."'>Edit</td>";
                echo "</tr>";
            }
            /*function find_client_by_id($client_id) {
                $link = mysqli_connect("localhost", "root", "", "group_work");

                $safe_client_id = mysqli_real_escape_string($link, $client_id);

                $query = "SELECT * FROM benutzer WHERE Benutzer_ID = {$safe_client_id} LIMIT 1";
                $client_set = mysqli_query($link, $query);
                if($client = mysqli_fetch_assoc($client_set)) {
                    return $client;
                } else {
                    return null;
                }
            }*/


            //echo "</table>";
            // Free result set
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
</body>
</html>