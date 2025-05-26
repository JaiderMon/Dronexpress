<?php
session_start();

$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "dronexpress";

$conn = new mysqli($host, $usuario, $contrasena, $base_datos);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $pass = $_POST['contrasena'] ?? '';

    if (empty($email) || empty($pass)) {
        die("Por favor completa todos los campos.");
    }

    // Buscar usuario por correo
    $sql = "SELECT id, usuario, contrasena FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $usuario, $pass_hash);
        $stmt->fetch();

        if (password_verify($pass, $pass_hash)) {
            // Contraseña correcta, iniciar sesión
            $_SESSION['usuario_id'] = $id;
            $_SESSION['usuario_nombre'] = $usuario;

            // Redirigir a página principal o dashboard
            header("Location: Dronexpress.html");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }

    $stmt->close();
}

$conn->close();
?>
