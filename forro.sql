# Creamos la base de datos, con nuestro usuario existente
CREATE DATABASE pr1db;

# Creamos el usuario
CREATE USER 'pr1usuario'@'localhost' IDENTIFIED BY 'pr1password';

# En caso de tener que eliminarlo
# DROP USER 'pr1usuario'@'localhost';

# Le brindamos privilegios en todas las tablas de su BD
GRANT ALL PRIVILEGES ON pr1db.* TO 'pr1usuario'@'localhost';

# Actualizamos los privilegios
FLUSH PRIVILEGES;

# Iniciamos sesión como el nuevo usuario
# $: mysql -u pr1usuario -h localhost --password=pr1password --database pr1db

# El resto de comandos los ejecutamos como ese usuario:

# Creamos nuestra tabla de usuarios
CREATE TABLE usuarios(
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);

# Verificamos la estructura de la tabla
DESC usuarios;

# En caso de ocupar borrar la BD
# DROP TABLE usuarios;

# Insertamos un usuario
INSERT INTO usuarios (email, password) VALUES ('prueba@prueba.com', '123queso');

## Pedimos la lista de usuarios
# Todos los datos de todos los usuarios
SELECT * FROM usuarios;
# Pedimos la lista de usuarios divididos por pagina:
# Pagina uno
SELECT id, email FROM usuarios LIMIT 5;
# Pagina dos
SELECT id, email FROM usuarios LIMIT 5 OFFSET 5;

# Creacion
# Ingresamos un segundo usuario
INSERT INTO usuarios (email, password) VALUES ('prueba@prueba.com', '123queso');

# Edicion
# Modificamos el correo del segundo usuario
UPDATE usuarios SET email = 'prueba@correodeprueba.com' WHERE email = 'prueba@prueba.com';

# Borrado
# Eliminamos ese segundo usuario
DELETE FROM usuarios WHERE email = 'prueba@correodeprueba.com';

## Procedimientos almacenados:
# Se define el inicio y el fin del procedimiento, delimitado por `//`
DELIMITER //
# Revisamos si el procedimiento existe, en caso de que exista lo borramos
DROP PROCEDURE IF EXISTS pr1_procedimiento;
# Definimos el procedimiento
CREATE PROCEDURE `pr1_procedimiento`(IN primer_valor INT, IN segundo_valor INT)
  # Agregamos un comentario al procedimiento
  COMMENT 'Ejemplo de un procedimiento sencillo'
  # Inicia el bloque del procedimiento
  BEGIN
    # Definimos la lista de variables a usar
    DECLARE resultado INT;
    DECLARE operacion VARCHAR(10);

    # Asignamos el valor a esas variables
    SET resultado = primer_valor + segundo_valor;
    SET operacion = 'suma';

    # Iniciamos nuestra logica
    SELECT resultado AS operacion;
  END //

# Mandamos a llamar a nuestro procedimiento, pasandole los parametros
CALL pr1_procedimiento(10, 20);
