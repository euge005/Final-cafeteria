<?php

$nombre  = trim($_POST['nom_comida']);
$descr   = trim($_POST['desc_comida']);
$precio  = trim($_POST['precio']);

if (strlen($nombre) < 2 || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $nombre)) {
    echo '<script>alert("El nombre no es correcto!!!");history.go(-1);</script>';
    exit;
}
if (strlen($descr) < 2){
    echo '<script>alert("La descripcion no es valida!!!");history.go(-1);</script>';
    exit;
}
if (strlen($precio) == 0 || !is_numeric($precio) || $precio <= 0){ 
    echo '<script>alert("El precio no es valido!!!");history.go(-1);</script>';
    exit;
}

include 'abrir_base.php';

if ($_POST['dato'] == 'inserta-archivo') {
    
    $target_dir = "uploads/";

    // Verificamos si realmente se subió una imagen
    if (!empty($_FILES['imagen']['tmp_name'])) {
        
        // --- AQUÍ CONTROLAMOS SI ES UN ARRAY O UNA CADENA ---
        if (is_array($_FILES['imagen']['tmp_name'])) {
            // Si es un array, agarramos el primer elemento ([0])
            $archivo_tmp    = $_FILES['imagen']['tmp_name'][0];
            $archivo_nombre = basename($_FILES['imagen']['name'][0]);
        } else {
            // Si es un archivo único normal
            $archivo_tmp    = $_FILES['imagen']['tmp_name'];
            $archivo_nombre = basename($_FILES['imagen']['name']);
        }
        
        $target_file = $target_dir . $archivo_nombre;
        
        // Intentamos mover la imagen a la carpeta "uploads"
        if (move_uploaded_file($archivo_tmp, $target_file)) {
            
            try {
                // Preparamos la consulta SQL
                $query = "INSERT INTO producto (nombre, descri, precio, foto) VALUES (?, ?, ?, ?)";
                $stmt = $conne->prepare($query);
                
                // Ejecutamos pasando los datos
                $ejecucion = $stmt->execute([$nombre, $descr, $precio, $target_file]);

                if ($ejecucion) {
                   echo '<script>alert("La comida se guardó correctamente!!!!");window.location="menu_cafeteria.php";</script>';
                    exit;
                } else {
                    echo '<script>alert("Error al guardar en la base de datos.");history.go(-1);</script>';
                    exit;
                }
                
            } catch (PDOException $e) {
                echo "Error en la base de datos: " . $e->getMessage();
                exit;
            }
        } else {
            echo '<script>alert("Error al mover la imagen a la carpeta uploads.");history.go(-1);</script>';
            exit;
        }
    } else {
        echo '<script>alert("Por favor, selecciona una imagen.");history.go(-1);</script>';
        exit;
    }
}
?>