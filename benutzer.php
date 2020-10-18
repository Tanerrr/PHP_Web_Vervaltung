<?php

session_start();

include("header.php");

require_once "connection.php";

if ( isset($_POST['delete']) && isset($_POST['Benutzer_ID']) ) {
$sql = "DELETE FROM benutzer WHERE Benutzer_ID = :zip";
$stmt = $PDO->prepare($sql);
$stmt->execute(array(':zip' => $_POST['Benutzer_ID']));
}

$stmt = $PDO->query("SELECT b.Benutzer_ID, b.Benutzer_Name, b.DOB,  CONCAT(b.Benutzer_Role_ID, ': ', r.Rollen_Name)
                AS Rollen, quer.RechtName from benutzer b JOIN
                (select rec.Rollen_ID, GROUP_CONCAT(DISTINCT r2.Recht_Name) AS RechtName
                from rollen_rechten rec join rechten r2 on r2.Recht_ID = rec.Recht_ID
                group by rec.Rollen_ID) quer ON quer.Rollen_ID=b.Benutzer_Role_ID
                JOIN rollen r ON b.Benutzer_Role_ID = r.Rollen_ID order by b.Benutzer_ID");

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<h2 style="width: 80%; margin: 0 auto;">Benutzern</h2><br>'."\n";
echo '<table class="table table-striped text-monospace" style="width: 80%; margin: 0 auto;">'."\n";

echo "
    
    <thead class='bg-secondary text-white'>
        <tr>
            <th>" . "ID" . "</th>
            <th>" . "Name" . "</th>
            <th>". "Rolle" . "</th>
            <th>". "Rechten" . "</th>
            <th>". "Geburtsdatum" . "</th>
            <th>". "Edit" . "</th>
            <th>". "Delete" . "</th>
        </tr>
    </thead>
    
";

foreach ( $rows as $row ) {
    echo "<tr><td>";
    echo($row['Benutzer_ID']);
    echo("</td><td>");
    echo($row['Benutzer_Name']);
    echo("</td><td>");
    echo($row['Rollen']);
    echo("</td><td style='font-size: small;'>");
    echo ($row['RechtName']);
    echo("</td><td>\n");
    echo($row['DOB']);
    echo("</td><td>\n");
    echo('<form action="edit.php" method="post"><input type="hidden" ');
    echo('name="Benutzer_ID" value="'.$row['Benutzer_ID'].'">'."\n");
    echo('<a href="edit.php?Benutzer_ID='.$row['Benutzer_ID'].'" class="btn btn-outline-info btn-sm">Edit</a>');
    # echo('<input class="btn btn-outline-info btn-sm" type="submit" value="Edit" name="edit">');
    echo("\n</form>\n");
    echo("</td><td>\n");
    echo('<form method="post"><input type="hidden" ');
    echo('name="Benutzer_ID" value="'.$row['Benutzer_ID'].'">'."\n");
    echo('<input class="btn btn-outline-danger btn-sm" type="submit" value="Del" name="delete">');
    echo("\n</form>\n");
    echo("</td></tr>\n");

}
echo "</table>\n";

require_once "footer.php";

?>

