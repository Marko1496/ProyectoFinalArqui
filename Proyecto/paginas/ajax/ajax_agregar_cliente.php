<?php
/******************************************************/
/*******************  CABECERA  ***********************/
/******************************************************/
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyecto_arqui";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO clientes (nombre, apellido, email, telefono, tarjeta)
VALUES ('".$_POST['nombre']."', '".$_POST['apellido']."', '".$_POST['email']."', '".$_POST['telefono']."', '".$_POST['tarjeta']."')";

if ($conn->query($sql) === TRUE) {
    echo "1";
} else {
    echo "0";
}

$conn->close();
?>
