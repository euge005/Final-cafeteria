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

include 'abrir_base.php';

$query="SELECT * FROM cafeteria.producto order by id_prod,nombre,descri,precio";
        $resultado=mysqli_query($conne,$query);
        if(mysqli_num_rows($resultado)>0){
            while($fila=mysqli_fetch_array($resultado)){
            
                echo '<div class="recetas">';
                echo '<img src="' . $fila['foto'] . '" alt="' . $fila['nombre'] . '">';
                echo '<h3>' . $fila['nombre'] . '</h3>';
                echo '<h5>' . $fila['descri'] . '</h5>';
                echo '<h4><i>$' . $fila['precio'] . '</i></h4>';
                echo '</div>'; 
            }    
        }
        else{
            echo'<script>alert("No existen Comidas para mostrar!!!!");</script>';
        }
?>
</div>
</div>
</body>
</html>