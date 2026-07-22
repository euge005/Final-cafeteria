<?php
$id =$_POST['txtid'];
$nombre  = $_POST['nom_comida'];
$descr = $_POST['desc_comida'];
$precio = $_POST['precio'];

if (strlen($nombre)<2){
    echo'<script>alert ("El nombre de la comida no se actualizo bien !!!");history.go(-1);</script>';
    exit;
}
if (strlen($descr)<2){
    echo'<script>alert ("La descrip no se actualizo bien ponga bien bld!!");history.go(-1);</script>';
    exit;
}
if(strlen($precio)<2){ 
    echo'<script>alert ("el precio no se pudo actualizar correctamente!!!");history.go(-1);</script>';
    exit;
}

require __DIR__ . '/abrir_base.php'; 

try {
   
    $query = "UPDATE producto SET nombre = ?, descri = ?, precio = ? WHERE id_prod = ?";
    $stmt = $conne->prepare($query);
    
    
    $ejecucion = $stmt->execute([$nombre, $descr, $precio, $id]);

    if ($ejecucion) {
        
        echo '<script>alert("La comida se actualizó correctamente!!!!");window.location="menu_cafeteria.php";</script>';
        exit;
    } else {
        echo '<script>alert("No se pudo actualizar el producto.");history.go(-1);</script>';
        exit;
    }

} catch (PDOException $e) {
    echo "Error en la base de datos al actualizar: " . $e->getMessage();
    exit;
}
?>
// // include 'abrir_base.php';
// //armo la query
// $query="UPDATE producto SET nombre='$nombre',descri='$descr',precio=$precio  where id_prod=$id ";
// //Ejecutar la query
// $res = mysqli_query($conne, $query);
// //verifico si se ejecutó bien la query
// if($res){
//     //se actualizó el libro correctamente
<!-- //     echo '<script> alert("La comida se actualizó correctamente!!!");window.location="menu_cafeteria.php"; </script>'; -->

// }else{
//     //hubo un error al actualizar
<!-- //     echo '<script> alert("Error: La comida no se pudo actualizar!!!");history.go(-1); </script>'; -->
// }
// mysqli_close($conne);
// 

include 'abrir_base.php';
//armar la query
$query = "INSERT INTO producto(nombre,descri,precio) values ('$nombre','$descr',$precio)";
//ejecutar la query 
$res = mysqli_query($conne,$query); 
//control de la ejecución
if($res)
    //se ejecuto bien la query, se guardaron los datos
    <!-- echo '<script> alert("La comida se actualizo correctamente bien ahi!");window.location="Cafeteria.html";</script>';
}else{   -->
    //Error al guardar 
    <!-- echo'<script> alert("Error al actualizar la comida!");history.go(-1);</script>';
} -->
mysqli_close($conne);