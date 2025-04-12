<?php
$conexion = new mysqli("localhost", "gomacomm_GOMAadmin", "Jose0816@", "gomacomm_GOMA");
if ($conexion->connect_error) {
  die("Conexión fallida: " . $conexion->connect_error);
}

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$opinion = $_POST['opinion'];

// Subir la imagen
$fotoNombre = $_FILES['foto']['name'];
$fotoTmp = $_FILES['foto']['tmp_name'];
move_uploaded_file($fotoTmp, "img/" . $fotoNombre);

// Subir el PDF
$pdfNombre = $_FILES['pdf']['name'];
$pdfTmp = $_FILES['pdf']['tmp_name'];
move_uploaded_file($pdfTmp, "img/" . $pdfNombre);

// Insertar en la base de datos
$stmt = $conexion->prepare("INSERT INTO opiniones_clientes (nombre, foto, opinion, pdf) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nombre, $fotoNombre, $opinion, $pdfNombre);

if ($stmt->execute()) {
  echo "Cliente guardado correctamente. <a href='insertar_cliente.html'>Agregar otro</a>";
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
