<?php
    include '../conexion.php';
    
    if(isset($_GET['deleteid_doc']) && isset($_GET['deleteid_user']) && isset($_GET['deleteid_emp'])){
        $id_doc = $_GET['deleteid_doc'];
        $id_user = $_GET['deleteid_user'];
        $id_emp = $_GET['deleteid_emp'];
        
        //Eliminar doctor
        $del_doc = "DELETE FROM Doctor WHERE ID_Doctor = '$id_doc'";
        $consulta_del_doc = mysqli_query($conn, $del_doc);
        
        if(!$consulta_del_doc){
            echo '<script>alert("Error al eliminar doctor")</script>';
        }
        //Eliminar usuario
        $del_emp = "DELETE FROM Empleado WHERE ID_Empleado = '$id_emp'";
        $consulta_del_emp = mysqli_query($conn, $del_emp);
        
        if(!$consulta_del_emp){
            echo '<script>alert("Error al eliminar empleado")</script>';
        }
        
        $del_user = "DELETE FROM Usuario WHERE ID_Usuario = '$id_user'";
        $consulta_user = mysqli_query($conn, $del_user);
        
        if(!$consulta_user){
            echo '<script>alert("Error al eliminar el usuario")</script>';
        }
        
        if($consulta_del_doc && $consulta_del_emp && $consulta_user){
            echo '<script>alert("Doctor y usuario eliminados")</script>';
            header("Location: ../vistas/doctores.php");
        }
    }
?>