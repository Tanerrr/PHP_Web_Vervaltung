<?php
include("header.php");

require_once "connection.php";

$stmt = $PDO->query("SELECT CONCAT(r.Rollen_ID, ': ', r.Rollen_Name)
                AS Rollen, GROUP_CONCAT(re.Recht_Name) as Rechten from rollen r 
                join rollen_rechten rr on rr.Rollen_ID = r.Rollen_ID
                join rechten re on rr.Recht_ID = re.Recht_ID GROUP BY Rollen");

/* JOIN
                (select rec.Rollen_ID, GROUP_CONCAT(DISTINCT r2.Recht_Name) AS RechtName  */
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


echo '<table class="table table-striped text-monospace" style="width: 60%; margin: 0 auto;">'."\n";

echo "
    <thead class='bg-secondary text-white'>
        <tr>
            <th>" . "Roll-ID_Name" . "</th>
            <th>" . "Rechten" . "</th>
            <th>" . "Add" . "</th>
            <th>" . "Delete" . "</th>
        </tr>
    </thead>
    
";
/* echo('<form method="post"><input type="hidden" ');
    echo('name="Benutzer_ID" value="'.$row['Benutzer_ID'].'">'."\n");*/
foreach ( $rows as $row ) {
    echo "<tr><td>";
    echo($row['Rollen']);
    echo("</td><td>");
    echo($row['Rechten']);
    echo("</td><td>");
    echo "
        <form method='post'>
            <select class='custom-select mr-sm-2' name='Add_New_Recht'>
                <option> Add Recht</option>
                <option value='Read'>Read</option>
                <option value='Add'>Add</option>
                <option value='Edit'>Edit</option>
                <option value='Delete'>Delete</option>
            </select>
        </form>
    ";
    echo("</td><td>");
    echo "
        <form method='post'>
            <select class='custom-select mr-sm-2' name='Delete_Recht'>
                <option> Delete Recht</option>
                <option value='Read'>Read</option>
                <option value='Add'>Add</option>
                <option value='Edit'>Edit</option>
                <option value='Delete'>Delete</option>
            </select>
        </form>
    ";
    echo("</td></tr>\n");

}
echo "</table>\n";



require_once "footer.php";

?>




