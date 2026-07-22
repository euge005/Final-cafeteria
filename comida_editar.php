
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Comida</title>
    <link rel="stylesheet" href="estilos.css">
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
    <div class="formulario">
        <h1 class="titulo-formulario">Editar Producto del Menú</h1>

        <?php 

        $id = $_GET['id'];
        
        require __DIR__ . '/abrir_base.php';

        $query = "SELECT * FROM producto WHERE id_prod = $id";  
        
        try{ 
            $resultado = $conne->query($query);
        

            if ($resultado->rowCount() > 0) {
                while ($fila = $resultado->fetch(PDO::FETCH_BOTH)){
                    $nombre = $fila['nombre'];
                    $descri = $fila['descri'];
                    $precio = $fila['precio']; 
                }
            } else {
                $nombre = "";
                $descri = "";
                $precio = "";
            }
      
    }catch (PDOException $e) {
            // Es buena práctica envolver tus consultas en un try-catch por si falla algo en la base de datos
            echo '<tr><td colspan="6">Error al editar los productos: ' . $e->getMessage() . '</td></tr>';
        }
       
        ?>
        
        <form action="menu_actualizar.php" method="POST">
            <label for="txtid">ID de la comida</label>
            <input type="number" name="txtid" id="txtid" value="<?php echo $id; ?>" readonly />

            <label for="nom_comida">Nombre de la comida</label>
            <input type="text" name="nom_comida" id="nom_comida" value="<?php echo $nombre; ?>" required />

            <label for="desc_comida">Descripción</label>
            <input type="text" name="desc_comida" id="desc_comida" value="<?php echo $descri; ?>" required />

            <label for="precio">Precio</label>
            <input type="number" name="precio" id="precio" step="0.01" value="<?php echo $precio; ?>" required />

            <div class="botones-form">
                <input type="reset" value="Cancelar" />
                <input type="submit" value="Actualizar" />
                
            </div>
        </form>
    </div>
</body>
</html>