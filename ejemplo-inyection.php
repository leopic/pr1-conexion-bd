<?php

/**
 * ejemplo-inyection.php
 * Forma antigua e insegura de obtener datos.
 */

/**
 * Información sobre la conexión a la BD.
 * Esto no debería vivir en el repositorio.
 */
$host = "localhost";
$user = "pr1usuario";
$pass = "pr1password";
$dbname = "pr1db";

// Ejemplos
// ejemplo-inyection/?email=' or '1'='1
// ejemplo-inyection/?email=leo'; DELETE FROM usuarios WHERE 1

// Abrimos la conexion con la BD
$conn = mysql_connect($host, $user, $pass);

// Seleccionamos la BD con la que vamos a trabajar
mysql_selectdb($dbname);

// Obtenemos el valor del parametro email
$email = $_GET['email'];

// Creamos un string con el query que vamos a ejecutar
$query = "SELECT * FROM usuarios WHERE email = '$email'";

// Lo imprimimos para verlo en la página, esto es irrelevante a la petición a la BD
echo("<pre>$query</pre>");

// Ejecutamos el query y almacenamos el resultado
$resultado = mysql_query($query, $conn);

// Si existe un error, detenga la ejecucion
if (!$resultado) {
    die("Query invalido " . mysql_error());
} else {
    // Sino, itere sobre los resultados
    while ($tupla = mysql_fetch_assoc($resultado)) {
        echo("Correo: " . $tupla["email"]);
    }
}

// Debemos cerrar la conexión cuando terminamos
mysql_close($conn);
