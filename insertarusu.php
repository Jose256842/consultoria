<?php
// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "gomacomm_GOMAadmin", "Jose0816@", "gomacomm_GOMA");
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Obtener datos del formulario
    $usuario = $_POST['usuario'];
    $contrasena_plana = $_POST['contrasena'];

    // Hashear la contraseña
    $contrasena_hash = password_hash($contrasena_plana, PASSWORD_DEFAULT);

    // Insertar usuario en la base de datos
    $sql = "INSERT INTO usuarios (usuario, contrasena) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $usuario, $contrasena_hash);

    if ($stmt->execute()) {
        $mensaje = "✅ Usuario registrado correctamente.";
    } else {
        $mensaje = "❌ Error al registrar usuario: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Usuario</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #eef2f3;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    form {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 400px;
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }
    input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    button {
      width: 100%;
      padding: 12px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    button:hover {
      background-color: #45a049;
    }
    .mensaje {
      margin-top: 15px;
      text-align: center;
      font-weight: bold;
      color: #2c3e50;
    }
  </style>
</head>
<body>

<form method="POST" action="">
  <h2>Registrar Nuevo Usuario</h2>

  <label for="usuario">Usuario:</label>
  <input type="text" name="usuario" required>

  <label for="contrasena">Contraseña:</label>
  <input type="password" name="contrasena" required>

  <button type="submit">Registrar</button>

  <?php if (isset($mensaje)): ?>
    <div class="mensaje"><?php echo $mensaje; ?></div>
  <?php endif; ?>
</form>

</body>
</html>
