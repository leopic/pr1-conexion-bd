<?php
/**
 * ejemplo-inyection.php
 * Forma antigua e insegura de obtener datos.
 */

// ejemplo-inyection/?email=' or '1'='1
// ejemplo-inyection/?email=leo'; DELETE FROM usuarios WHERE 1
$conn = mysql_connect("localhost", "root", "root");
mysql_selectdb("pr1");
$email = $_GET['email'];
$query = "SELECT * FROM usuarios WHERE email = '$email'";
echo("<pre>$query</pre>");

$result = mysql_query($query, $conn);
if (!$result) {
    die("Query invalido " . mysql_error());
} else {
    while ($row = mysql_fetch_assoc($result)) {
        echo("Correo: " . $row["email"]);
    }
}

mysql_close($conn);
