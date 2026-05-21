
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="CSS/Estilo-1.css?v=1.0">
  <link rel="stylesheet" href="estilos.css" />
  <title>Listado de Recetas</title>
</head>
<body>
  <h1>Listado de Recetas</h1>

  <table class="tabla-productos">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th colspan="2">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
        include 'abrir_base.php';
        $query = "SELECT * FROM producto ORDER BY id_prod, nombre, descri, precio";
        $resultado = mysqli_query($conne, $query);
        if(mysqli_num_rows($resultado) > 0){
          while($fila = mysqli_fetch_array($resultado)){
            echo '<tr>';
            echo '<td>' . $fila[0] . '</td>';
            echo '<td>' . $fila['nombre'] . '</td>';
            echo '<td>' . $fila['descri'] . '</td>';
            echo '<td>$' . number_format($fila['precio'], 2) . '</td>';
            echo '<td><a class="btn editar" href="comida_editar.php?id=' . $fila[0] . '">Editar</a></td>';
            echo '<td><a class="btn borrar" href="comida_borra.php?id=' . $fila[0] . '" onclick="return confirm(\'¿Estás seguro que deseas eliminar estos datos?\')">Borrar</a></td>';
            echo '</tr>';
          }
        } else {
          echo '<tr><td colspan="6">No hay comidas para mostrar.</td></tr>';
        }
      ?>
    </tbody>
  </table>
  <br />
  <div class="volver-inicio">
  <a class="btn volver" href="cafeteria.html">Volver al Inicio</a>
  <a class="btn volver" href="menu.php">Ver Menu</a>
  <a class="btn volver" href="form.html">Formulario</a>
  </div>
</body>
</html>