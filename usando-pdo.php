<?php

/**
 * usando-pdo.php
 * Forma recomendada de interactuar con la BD.
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
// usando-pdo/?email=prueba@prueba.com
// usando-pdo/?email=' or '1'='1

try {
    // Abriendo la conexión
    $conexionDB = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

    // Informenos de todos los errores
    $conexionDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtenemos el valor del parametro email
    $email = $_GET['email'];

    // Query a ejecutar
    $sentencia = $conexionDB->prepare("SELECT * FROM usuarios WHERE email = :email");

    // Creamos un diccionario con todos los parámetros
    $parametros = [':email' => $email];

    // Ejecute el query usando los parámetros enviados
    $sentencia->execute($parametros);

    // Iteramos sobre cada uno de los resultados de la siguiente manera
    while ($tupla = $sentencia->fetch()) {
        echo("Correo: " . $tupla['email']);
    }

    // Debemos cerrar la conexión cuando terminamos
    $conexionDB = null;
} catch (PDOException $e) {
    // En caso de que algo saliera mal con nuestro intento de conexión, el mensaje se imprime
    echo($e->getMessage());
}
