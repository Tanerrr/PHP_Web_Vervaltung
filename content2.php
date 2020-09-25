<?php
require_once "connection.php";

$stmt = $PDO->query("SELECT Benutzer_ID, Benutzer_Name, SEX FROM benutzer");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<html>
<head>

</head>
<body>
<table border="1">
    <?php
    foreach ( $rows as $row ) {
        echo "<tr><td>";
        echo($row['Benutzer_ID']);
        echo("</td><td>");
        echo($row['Benutzer_Name']);
        echo("</td><td>");
        echo($row['SEX']);
        echo("</td><td>");

    }
    ?>
</table>
</body>
</html>
