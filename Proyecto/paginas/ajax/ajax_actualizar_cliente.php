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

$sql = "UPDATE `clientes` SET `nombre`='$_POST['nombre']',`apellido`='$_POST['apellido']',`email`='$_POST['email']',`telefono`=$_POST['telefono'],`tarjeta`='$_POST['tarjeta']' WHERE `id_cliente`=$_POST['id_cliente']";

if ($conn->query($sql) === TRUE) {
    echo "1";
} else {
    echo "0";
}

$conn->close();
?>
