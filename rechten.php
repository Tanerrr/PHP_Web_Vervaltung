<?php
include("header.php");

require_once "connection.php";

$stmt = $PDO->query("SELECT Recht_ID, Recht_Name FROM rechten");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<div class='container'>";
echo '<table class="table table-striped text-monospace mt-5" style="width: 30%; margin: 0 auto;">'."\n";

echo "
    <thead class='bg-dark text-white'>
        <tr>
            <th>" . "Recht - ID" . "</th>
            <th>" . "Recht - Name" . "</th>
        </tr>
    </thead>
    
";

foreach ( $rows as $row ) {
    echo "<tr><td>";
    echo($row['Recht_ID']);
    echo("</td><td>");
    echo($row['Recht_Name']);
    echo("</td></tr>\n");

}
echo "</table>\n";
echo "</div>";

require_once "footer.php";

?>




