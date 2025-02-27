<?php
    include '../admin/conexion.php';
    session_start();
error_reporting(0); // Mostrar todos los errores para depuración (puedes cambiar a 0 en producción)
$actualsesion = $_SESSION['usuario'];

if ($actualsesion == null || $actualsesion == '') {
    header("Location: login.php");
    exit(); // Añade exit() después de redirigir para detener la ejecución
}

$sql = "SELECT ID_Usuario, nombre, correo, nacimiento FROM Usuario WHERE correo ='$actualsesion'";
$usuarios = mysqli_query($conn, $sql);

// Verificar si la consulta fue exitosa y obtener los datos del usuario
if ($usuarios && $usuarios->num_rows > 0) {
    // Obtener el primer resultado (asumiendo que solo esperas un resultado)
    $fila = $usuarios->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sb-admin-2.min.css" />
    <link rel="stylesheet" href="../css/sb-admin-2.css" />
    <title>Perfil</title> <!-- Agrega un título -->
</head>

<body>

    <section class="perfil-usuario">
        <!-- Tu contenido HTML -->
        <div class="contenedor-perfil">
            <!-- ... -->
            <div class="datos-perfil">
                <h4 class="titulo-usuario"><?php echo isset($fila['nombre']) ? $fila['nombre'] : ''; ?></h4>
                <p class="bio-usuario">Medical PC - Sistema Administrativo de Citas Medicas</p>
                <ul class="lista-perfil">
                    <!-- Puedes agregar más elementos aquí -->
                </ul>
            </div>
        </div>
        <div class="menu-perfil">
            <ul>
                <li><a href="#" title=""><i class="icono-perfil fas fa-grin"></i><?php echo isset($fila['correo']) ? $fila['correo'] : ''; ?></a></li>
                <li><a href="#" title=""><i class="icono-perfil fas fa-camera"></i><?php echo isset($fila['nacimiento']) ? $fila['nacimiento'] : ''; ?></a></li>
            </ul>
        </div>
    </section>

</body>

</html>
