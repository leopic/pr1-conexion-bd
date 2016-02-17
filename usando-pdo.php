<?php

// Informacion sobre la conexion a la BD
$host = "localhost";
$user = "root";
$pass = "root";
$dbname = "pr1";

try {
    // Abriendo la conexión
    $conexionDB = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

    // Informenos de todos los errores
    $conexionDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // usando-pdo/?email=prueba@prueba.com
    // usando-pdo/?email=' or '1'='1
    $email = $_GET['email'];
    $statement = $conexionDB->prepare("SELECT * FROM usuarios WHERE email = :email");
    $statement->bindParam(':email', $email);
    $statement->execute();

    while($row = $statement->fetch()) {
        echo($row['email']);
    }

    // Cerrando la conexión
    $conexionDB = null;
} catch (PDOException $e) {
    echo $e->getMessage();
}

// Usuario ejecutando la petición
//echo exec('whoami');
//print posix_getpwuid(posix_geteuid())['name'];
//error_log(print_r($row, true) . "\n", 3, '/Users/leo/Sites/pr1/repos/pr1-conexion-bd/error.log');
