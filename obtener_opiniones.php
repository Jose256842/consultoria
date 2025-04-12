<?php
header('Content-Type: application/json');

$conexion = new mysqli("localhost", "gomacomm_GOMAadmin", "Jose0816@", "gomacomm_GOMA");

if ($conexion->connect_error) {
  echo json_encode(["error" => "Error de conexión"]);
  exit;
}

$sql = "SELECT nombre, foto, opinion, pdf FROM opiniones_clientes ORDER BY id DESC";
$resultado = $conexion->query($sql);

$opiniones = [];

if ($resultado->num_rows > 0) {
  while ($fila = $resultado->fetch_assoc()) {
    $opiniones[] = $fila;
  }
}

echo json_encode($opiniones);

$conexion->close();
?>
