<?php
session_start();

// Conexión a base de datos
$conexion = new mysqli("localhost", "gomacomm_GOMAadmin", "Jose0816@", "gomacomm_GOMA");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener datos del formulario
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

// Buscar usuario
$sql = "SELECT * FROM usuarios WHERE usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $row = $resultado->fetch_assoc();

    // Verificar contraseña
    if (password_verify($contrasena, $row['contrasena'])) {
        $_SESSION['usuario'] = $usuario;
        header("Location: insertar.html");
    } else {
        echo "Contraseña incorrecta";
    }
} else {
    echo "Usuario no encontrado";
}

$stmt->close();
$conexion->close();
?>
