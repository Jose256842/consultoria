<?php
$conexion = new mysqli("localhost", "gomacomm_GOMAadmin", "Jose0816@", "gomacomm_GOMA");

if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT nombre, foto, opinion, pdf FROM opiniones_clientes ORDER BY id DESC";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Clientes Registrados</title>
  <style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f6f8;
    margin: 20px;
  }

  h2 {
    color: #333;
    text-align: center;
    margin-bottom: 30px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  th {
    background-color: #4CAF50;
    color: white;
    padding: 12px 15px;
    text-align: left;
    font-size: 16px;
  }

  td {
    padding: 12px 15px;
    border-bottom: 1px solid #e0e0e0;
    font-size: 15px;
    color: #333;
  }

  tr:hover {
    background-color: #f1f1f1;
    transition: background-color 0.3s ease;
  }

  img {
    max-width: 100px;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
  }

  a {
    color: #4CAF50;
    text-decoration: none;
    font-weight: bold;
  }

  a:hover {
    text-decoration: underline;
  }
</style>

</head>
<body>

<h2>Clientes Registrados</h2>

<table>
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Foto</th>
      <th>Opinión</th>
    </tr>
  </thead>
  <tbody>
    <?php if ($resultado->num_rows > 0): ?>
      <?php while ($fila = $resultado->fetch_assoc()): ?>
        <tr>
          <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
          <td>
            <?php if (!empty($fila['foto'])): ?>
              <img src="<?php echo htmlspecialchars($fila['foto']); ?>" alt="Foto de <?php echo htmlspecialchars($fila['nombre']); ?>">
            <?php else: ?>
              Sin foto
            <?php endif; ?>
          </td>
          <td><?php echo nl2br(htmlspecialchars($fila['opinion'])); ?></td>
         
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="4">No hay clientes registrados.</td></tr>
    <?php endif; ?>
  </tbody>
</table>

</body>
</html>

<?php
$conexion->close();
?>
