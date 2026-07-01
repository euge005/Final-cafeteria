
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="CSS/Estilo-1.css?v=1.0">
  <link rel="stylesheet" href="estilos.css" />
  <title>Listado de Recetas</title>
</head>
<body class="body">
  <header>
        <div class="container">
            <div class="img1">
                <img src="img/logo2.png" alt="Logo de la cafetería">
            </div>
            <div class="nombre1">
                <h1>¡Que Cafecito!</h1>
            </div>

            <nav class="enlaces">
                    
                    <p><a href="Cafeteria.html">Inicio</a></p>
                    <p><a href="menu.php">Menú</a></p>
                    <p><a href="menu_cafeteria.php">Listado</a></p>
                    <p><a href="form.html">Ver comida</a></p>      
                    
            </nav>
    </header>
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

      require __DIR__ . '/abrir_base.php';

        // include 'abrir_base.php';

        $query = "SELECT * FROM producto ORDER BY id_prod, nombre, descri, precio";

        try {
            // 1. Ejecutamos la consulta usando el método de PDO
            $resultado = $conne->query($query);

            // 2. En PDO, para saber si trajo filas, podemos usar rowCount()
            if ($resultado->rowCount() > 0) {
                
                // 3. El ciclo while usa ->fetch() para traer fila por fila.
                // Como configuramos PDO::FETCH_ASSOC, por defecto las trae como array asociativo.
                // TIP: Para usar índices numéricos como $fila[0], usamos fetch(PDO::FETCH_BOTH) o usamos directamente el nombre de la columna. 
                // Es MUCHO mejor y más limpio usar los nombres de las columnas (ej: 'id_prod').
                
                while ($fila = $resultado->fetch(PDO::FETCH_BOTH)) {
                    echo '<tr>';
                    echo '<td>' . $fila['id_prod'] . '</td>'; // Cambiado $fila[0] por el nombre de la columna para mayor claridad
                    echo '<td>' . $fila['nombre'] . '</td>';
                    echo '<td>' . $fila['descri'] . '</td>';
                    echo '<td>$' . number_format($fila['precio'], 2) . '</td>';
                    echo '<td><a class="btn editar" href="comida_editar.php?id=' . $fila['id_prod'] . '">Editar</a></td>';
                    echo '<td><a class="btn borrar" href="comida_borra.php?id=' . $fila['id_prod'] . '" onclick="return confirm(\'¿Estás seguro que deseas eliminar estos datos?\')">Borrar</a></td>';
                    echo '</tr>';
                }
                
            } else {
                echo '<tr><td colspan="6">No hay comidas para mostrar.</td></tr>';
            }

        } catch (PDOException $e) {
            // Es buena práctica envolver tus consultas en un try-catch por si falla algo en la base de datos
            echo '<tr><td colspan="6">Error al cargar los productos: ' . $e->getMessage() . '</td></tr>';
        }

        // $resultado = mysqli_query($conne, $query);
        // if(mysqli_num_rows($resultado) > 0){
        //   while($fila = mysqli_fetch_array($resultado)){
        //     echo '<tr>';
        //     echo '<td>' . $fila[0] . '</td>';
        //     echo '<td>' . $fila['nombre'] . '</td>';
        //     echo '<td>' . $fila['descri'] . '</td>';
        //     echo '<td>$' . number_format($fila['precio'], 2) . '</td>';
        //     echo '<td><a class="btn editar" href="comida_editar.php?id=' . $fila[0] . '">Editar</a></td>';
        //     echo '<td><a class="btn borrar" href="comida_borra.php?id=' . $fila[0] . '" onclick="return confirm(\'¿Estás seguro que deseas eliminar estos datos?\')">Borrar</a></td>';
        //     echo '</tr>';
        //   }
        // } else {
        //   echo '<tr><td colspan="6">No hay comidas para mostrar.</td></tr>';
        // }
      ?>
    </tbody>
  </table>
  <br />
</body>
</html>