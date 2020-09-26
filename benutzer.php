<?php include('connection.php');?>

<?php
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $query = "SELECT Benutzer_ID, Benutzer_Name, DOB, Benutzer_Role_ID FROM benutzer WHERE Benutzer_ID=$id";
    $record = mysqli_query($db, $query);

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
    <title>Create, Update, Delete PHP MySQL</title>
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
<!--dosyanın en başına bu blok yazıldığı zaman edit, add, delete işlemleri yapıldığında ekrana ilgili
 mesaj basıldığında belli oranda ekran küçülüyor. Sabit kalmasını istediğim için buraya yazdım-->

<?php if (isset($_SESSION['message'])): ?>
    <div class="msg">
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
    </div>
<?php endif ?>

<form method="post" action="connection.php">
    <table class="benutzer">
        <caption>BENUTZER LISTE<br><br></caption>
        <thead>
            <th><label for="select_all_checkbox"></label><input type="checkbox" id="select_all_checkbox" onclick="toggle(this);"></th>
            <th>BenutzerID</th>
            <th>BenutzerName</th>
            <th>RoleName</th>
            <th>Geburtsdatum</th>
            <th>Rechten</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead><br>
        <tbody>
        <?php

        // Attempt select query execution
        $sql = "SELECT b.Benutzer_ID, b.Benutzer_Name, b.DOB,  CONCAT(b.Benutzer_Role_ID, ': ', r.Rollen_Name)
                AS Rollen, quer.RechtName from benutzer b JOIN 
                (select rec.Rollen_ID, GROUP_CONCAT(DISTINCT r2.Recht_Name) AS RechtName 
                from rollen_rechten rec join rechten r2 on r2.Recht_ID = rec.Recht_ID 
                group by rec.Rollen_ID) quer ON quer.Rollen_ID=b.Benutzer_Role_ID 
                JOIN rollen r ON b.Benutzer_Role_ID = r.Rollen_ID order by b.Benutzer_ID";

        if($result = mysqli_query($db, $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    echo "<tr class='rows'>";
                    echo "<td class='user_list'><input class='user_list1' type='checkbox' name='checkbox[]' value='".$row['Benutzer_ID']."'></td>";
                    echo "<td class='user_list'>" . $row['Benutzer_ID'] . "</td>";
                    echo "<td class='user_list'>" . $row['Benutzer_Name'] . "</td>";
                    echo "<td class='user_list'>" . $row['Rollen'] . "</td>";
                    echo "<td class='user_list'>" . $row['DOB'] . "</td>";
                    echo "<td class='user_list'>" . $row['RechtName'] . "</td>";
                    echo "<td class='user_list'><a href='benutzer.php?edit=".$row['Benutzer_ID']."#form_2' class='edit_btn'>Edit</a></td>";
                    echo "<td class='user_list'><a href='connection.php?del=".$row['Benutzer_ID']."' class='del_btn'>Delete</a></td>";
                    echo "</tr>";
                }
                mysqli_free_result($result);
            } else{
                echo "No records matching your query were found.";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
        }

        ?>

        </tbody>
    </table>
    <table class="control">
        <tr class="del_sel_button">
            <td><label for="select_all_checkbox"></label><input type="checkbox" id="select_all_checkbox" onclick="toggle(this);">Check All</td>
            <td class="button"><input type="submit" name="delete" id="delete" value="Delete Selected Records"></td>
        </tr>
    </table>
</form>


<form class="form_2" id=form_2 method="post" action="connection.php" >

    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <div class="input-group">
        <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?php echo $name; ?>">
    </div>
    <div class="input-group">
        <label for="rolle">Rolle Auswählen</label>
        <select name="rolle" id="rolle" form="form_2" required>

            <!--Select listelerinin elemanlarını veritabanından çekmek için bu SQL kodunu oluşturuyoruz. -->
            <?php
            $query2= "SELECT b.Benutzer_Role_ID, CONCAT( b.Benutzer_Role_ID, ': ', r.Rollen_Name) AS Rollen from benutzer b
            JOIN rollen r ON b.Benutzer_Role_ID = r.Rollen_ID group by Benutzer_Role_ID order by Benutzer_Role_ID";

            $res = mysqli_query($db, $query2);
            while($row2 = mysqli_fetch_array($res)){
                echo "<option name='rolle' value='".$row2['Benutzer_Role_ID']."'>".$row2['Rollen']."</option>";
            }
            mysqli_free_result($res);
            ?>
            <!--<option name="rolle" value=1>1: Admin</option>
            <option name="rolle" value=2>2: Editor</option>
            <option name="rolle" value=3>3: Guest</option>

             Bir satır edit edildiğinde aşağıdaki option seçeneğini otomatik olarak seçmesini istiyoruz.
             update==true bundan dolayı koşul olarak eklendi. -->
            <?php if ($update == true): ?>
                <option name="rolle" value="<?php echo $rolle; ?>" selected><?php echo $rolle; ?></option>
            <?php endif ?>
        </select>
    </div>

    <div class="input-group">
        <label for="dob">Geburtsdatum</label>
            <input type="date" name="dob" id="dob" value="<?php echo $dob; ?>">
    </div>
    <div class="input-group">
        <?php if ($update == true): ?>
            <button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
        <?php else: ?>
            <button class="btn" type="submit" name="save" >Add</button>
        <?php endif ?>
    </div>
</form>

</body>
</html>