
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Comida</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="formulario">
        <h1 class="titulo-formulario">Editar Producto del Menú</h1>
        <?php 
        $id = $_GET ['id'];
        include 'abrir_base.php';

        $query = "SELECT * FROM producto WHERE id_prod = $id";
        $resultado = mysqli_query($conne, $query);

        if (mysqli_num_rows($resultado) > 0) {
            $fila = mysqli_fetch_array($resultado);
            $nombre = $fila['nombre'];
            $descri = $fila['descri'];
            $precio = $fila['precio']; 
        } else {
            $nombre = "";
            $descri = "";
            $precio = "";
        }
        mysqli_close($conne);
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
                <input type="submit" value="Guardar" />
                <input type="reset" value="Limpiar" />
            </div>

            <div class="volver-link">
            <a href="menu_cafeteria.php"> Volver al listado</a>
            </div>
        </form>
    </div>
</body>
</html>