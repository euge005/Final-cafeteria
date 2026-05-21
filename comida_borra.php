<?php
$id=$_GET['id'];

include 'abrir_base.php';
$query="DELETE From producto where id_prod=$id";

$resultado=mysqli_query($conne,$query);
if ($resultado){
    //se borro la comida
    echo '<script>alert("Los datos se borraron");window.location="menu_cafeteria.php";</script>';
 }else{
    //Hubo un error al intentar borrar
    echo '<script>alert("ERROR: hubo un error al intentar borrar.");history.go(-1);<script>';
 }   
 mysqli_close($conne);
?>