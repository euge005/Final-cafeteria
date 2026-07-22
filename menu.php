<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>¡Que Cafecito!</title>
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
    <main>
    <div class="blophp">

<?php 

require __DIR__ . '/abrir_base.php';

// 1. Verificamos si viene un ID por la URL. Si viene, lo usamos; si no, queda en null.
$id = isset($_GET['id']) ? $_GET['id'] : null;
        
try { 
    if ($id) {
        // SI HAY ID: Buscamos solo ese producto específico de forma segura con prepare
        $query = "SELECT * FROM producto WHERE id_prod = :id";  
        $stmt = $conne->prepare($query);
        $stmt->execute(['id' => $id]);
    } else {
        // NO HAY ID: Mostramos todos los productos del menú (lo que tenías comentado antes)
        $query = "SELECT * FROM producto ORDER BY id_prod, nombre, descri, precio";
        $stmt = $conne->query($query);
    }

    // 2. Comprobamos si devolvió algún resultado
    if ($stmt->rowCount() > 0) {
        while ($fila = $stmt->fetch(PDO::FETCH_BOTH)) {
            $nombre = $fila['nombre'];
            $descri = $fila['descri'];
            $precio = $fila['precio']; 
            
            echo '<div class="recetas">';
            echo '<img src="' . $fila['foto'] . '" alt="' . $fila['nombre'] . '">';
            echo '<h3>' . $fila['nombre'] . '</h3>';
            echo '<h5>' . $fila['descri'] . '</h5>';
            echo '<h4><i>$' . $fila['precio'] . '</i></h4>';
            echo '</div>'; 
        }
    } else {
        $nombre = "";
        $descri = "";
        $precio = "";
        echo '<script>alert("No existen Comidas para mostrar!!!!");</script>';
    }
      
} catch (PDOException $e) {
    // Si algo sale mal con la base de datos, te lo avisa limpiamente
    echo '<div class="error">Error al cargar los productos: ' . $e->getMessage() . '</div>';
}
?>




<!-- // include 'abrir_base.php';

// $query="SELECT * FROM cafeteria.producto order by id_prod,nombre,descri,precio";
//         $resultado=mysqli_query($conne,$query);
//         if(mysqli_num_rows($resultado)>0){
//             while($fila=mysqli_fetch_array($resultado)){
            
//                 echo '<div class="recetas">';
//                 echo '<img src="' . $fila['foto'] . '" alt="' . $fila['nombre'] . '">';
//                 echo '<h3>' . $fila['nombre'] . '</h3>';
//                 echo '<h5>' . $fila['descri'] . '</h5>';
//                 echo '<h4><i>$' . $fila['precio'] . '</i></h4>';
//                 echo '</div>'; 
//             }    
//         }
//         else{
//             echo'<script>alert("No existen Comidas para mostrar!!!!");</script>';
//         } -->

</div>
</div>
</body>
</html>