<?php

$id = $_GET['id'];
        
        require __DIR__ . '/abrir_base.php';

         $query="DELETE From producto WHERE id_prod = $id";  
        try{ 
            $resultado = $conne->query($query);
        

            if ($resultado->rowCount() > 0) {
            // se borro la comida
            echo '<script>alert("Los datos se borraron");window.location="menu_cafeteria.php";</script>';
            }else{
            //Hubo un error al intentar borrar
            echo '<script>alert("ERROR: hubo un error al intentar borrar.");history.go(-1);<script>';
                }
            
      
            }catch (PDOException $e) {
            // Es buena práctica envolver tus consultas en un try-catch por si falla algo en la base de datos
            echo '<tr><td colspan="6">Error al editar los productos: ' . $e->getMessage() . '</td></tr>';
        }
?>


<!-- // include 'abrir_base.php';
// $query="DELETE From producto where id_prod=$id";

// $resultado=mysqli_query($conne,$query);
// if ($resultado){
//     //se borro la comida
//     echo '<script>alert("Los datos se borraron");window.location="menu_cafeteria.php";</script>';
//  }else{
//     //Hubo un error al intentar borrar
//     echo '<script>alert("ERROR: hubo un error al intentar borrar.");history.go(-1);<script>';
//  }   
//  mysqli_close($conne); -->
