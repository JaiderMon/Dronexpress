<?php
$host = "localhost";
$usuario = "root";
$contrasena = ""; // Cambia si tienes una clave
$base_datos = "dronexpress";

// Crear conexión
$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
$tipo = $_POST['tipo'] ?? '';
$origen = $_POST['origen'] ?? '';
$destino = $_POST['destino'] ?? '';
$hora = $_POST['hora'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';

// Preparar y ejecutar consulta
$sql = "INSERT INTO solicitudes (tipo_solicitud, direccion_origen, direccion_destino, hora_estimada, descripcion)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $tipo, $origen, $destino, $hora, $descripcion);

if ($stmt->execute()) {
    echo "Solicitud registrada correctamente.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
