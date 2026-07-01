<?php

$nombre  = trim( $_POST['nom_comida']);
$descr = trim( $_POST['desc_comida']);
$precio = trim( $_POST['precio']);


if ( strlen($nombre) < 2 || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $nombre)) {
    echo'<script>alert ("El nombre no es correcto!!!");history.go(-1);</script>';
    exit;
}
if (strlen($descr)<2){
    echo'<script>alert ("La descripcion no es valida!!!");history.go(-1);</script>';
    exit;
}
if(strlen($precio) == 0 || !is_numeric($precio) || $precio <= 0){ 
    echo'<script>alert ("El precio no es valido!!!");history.go(-1);</script>';
    exit;
}

//  include 'abrir_base.php'; 
// //armar la query
// $query = "INSERT INTO producto (nombre, descri, precio, foto) VALUES (?, ?, ?, ?)";
// //ejecutar la query 
// $res = mysqli_query($conne,$query); 
// //control de la ejecución
// if($res){
//     //se ejecuto bien la query, se guardaron los datos
//     echo '<script> alert("La comida se guardó correctamente!");window.location="form.html";</script>';
// }else{  
//     //Error al guardar 
//     echo'<script> alert("Error al guardar la comida!");history.go(-1);</script>';
// }

include 'abrir_base.php';

if ($_POST['dato'] == 'inserta-archivo') {
    
    $target_dir = "uploads/";

    if (!empty($_FILES['imagen']['tmp_name'])) {
        $archivos = $_FILES['imagen'];
        $numArchivo = count($archivos['tmp_name']);
    }

    // Armar la query
    $query = "INSERT INTO cafeteria.producto (nombre, descri, precio, foto) VALUES (?, ?, ?, ?)";
    $stmt = $conne->prepare($query);

    for ($i = 0; $i < $numArchivo; $i++) {
        $archivo_tmp = $archivos['tmp_name'][$i];
        $archivo_nombre = basename($archivos['name'][$i]);
        $target_file = $target_dir . $archivo_nombre;
        if (move_uploaded_file($archivo_tmp, $target_file)) {
            $stmt->bind_param("ssss", $nombre, $descr, $precio, $target_file);

            if ($stmt->execute()) {
                echo '<script>alert("La comida se guardó correctamente!!!!");window.location="form.html";</script>';
                echo "Archivo " . ($i + 1) . " subido correctamente.<br>";
            } else {
                echo "Error al subir archivo " . ($i + 1) . ": " . $stmt->error . "<br>";
            }
        } else {
            echo "Error al mover el archivo " . ($i + 1) . ".<br>";
        }
    }
    $stmt->close();
    $conne->close();
}
// mysqli_close($conne);
?> 