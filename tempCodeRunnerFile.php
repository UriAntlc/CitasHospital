<?php
include 'conexion.php';

if(isset($_POST['submit'])){
    $nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$nacimiento = $_POST['nacimiento'];
	$correo = $_POST['correo'];
	$contraseña = $_POST['contraseña'];
	$curp = $_POST['curp'];
	$telefono = $_POST['telefono'];
    
    $insercion = "INSERT INTO Usuario (nombre, apellido, nacimiento, correo, contraseña, curp, telefono) 
    values('$nombre', '$apellido', '$nacimiento', '$correo', '$contraseña', '$curp', '$telefono'";
    $result = mysqli_query($conn, $insercion);
    $result = mysqli_query($conn, $crear);
    if($result){
        echo '<script>alert("Usuario creado correctamente")</script>';
    }else{
        die("Error al ejecutar la consulta: " . mysqli_error($conn));
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Registrarse</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Registrate</h1>
                            </div>
                            <form method ="POST">
                                <div class="mb-3">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" placeholder = "Nombre" name = "nombre">
                                </div>
                                <div class="mb-3">
                                    <label>Apellido</label>
                                    <input type="text" class="form-control" placeholder = "Apellido" name="apellido">
                                </div>
                                <div class="mb-3">
                                    <label>Nacimiento</label>
                                    <input type="date" class="form-control"  placeholder = "Fecha de nacimiento" name="nacimiento">
                                </div>
                                <div class="mb-3">
                                    <label>Correo</label>
                                    <input type="email" class="form-control"  placeholder = "Correo" name="correo">
                                </div>
                                <div class="mb-3">
                                    <label>Contraseña</label>
                                    <input type="password" class="form-control"  placeholder = "Contraseña" name="contraseña">
                                </div>
                                <div class="mb-3">
                                    <label>Curp</label>
                                    <input type="text" class="form-control"  placeholder = "Curp" name="curp">
                                </div>
                                <div class="mb-3">
                                    <label>Telefono</label>
                                    <input type="text" class="form-control"  placeholder = "Numero de telefono" name="telefono">
                                </div>
                                <div class="mb-3">
                                    <label>Nss</label>
                                    <input type="text" class="form-control"  placeholder = "Nss" name="nss">
                                </div>
                                <button type="submit" class="btn btn-primary">Registrarse</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Olvidaste tu contraseña ?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.html">Ya tienes una cuenta ? inicia sesion</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>