<?php
    include '../../admin/conexion.php';
session_start();
error_reporting(0);
$actualsesion = $_SESSION['usuario'];
$tipo = "SELECT tipo_usuario FROM Usuario WHERE correo = '$actualsesion'";
$consul_tipo = mysqli_query($conn, $tipo);
$row = mysqli_fetch_assoc($consul_tipo);
$type_usuario = $row['tipo_usuario'];

if ($actualsesion == null || $actualsesion == '' || $type_usuario != 0) {
    header("Location: ../../sesion/login.php");
    die();
}else{
    $inf_user = "SELECT ID_Usuario ,nombre, apellido FROM Usuario WHERE correo = '$actualsesion'";
    $consul_user = mysqli_query($conn, $inf_user);
    $row = mysqli_fetch_assoc($consul_user);
    $user = $row['nombre'] . ' ' . $row['apellido'];
    $id_user = $row['ID_Usuario'];
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
    <title>Consultas</title>
    <!-- Custom fonts for this template -->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Citas</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Sistema</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Adicionales
            </div>
            <!-- Nav Item - Tables -->
            <li class="nav-item active">
                <a class="nav-link" href="recetas.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Recetas</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar"
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo $user; ?>
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="../../img/undraw_profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../../sesion/perfil.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../../sesion/cerrar-php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Salir
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Citas</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Citas</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th scope = "col">No. Consultorio</th>
                                            <th scope = "col">Fecha</th>
                                            <th scope = "col">Doctor</th>
                                            <th scope = "col">Servicio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $vista = "SELECT c.ID_Cita as cita, u.ID_Usuario as id_pac, c.fecha as fecha, 
                                            c.Consultorio_ID as consultorio, ue.nombre as doctor_n, ue.apellido as doctor_ap, 
                                            s.nombre as servicio, c.costo as costo, cu.disponibilidad as disponibilidad
                                            FROM Cita AS c 
                                            INNER JOIN Consultorio as cu ON c.Consultorio_ID = cu.ID_Consultorio
                                            INNER JOIN Doctor as d ON cu.Doctor_ID = d.ID_Doctor
                                            INNER JOIN Empleado as e ON e.ID_Empleado = d.Empleado_ID
                                            INNER JOIN Paciente as p ON c.Paciente_ID = p.ID_Paciente
                                            INNER JOIN Usuario as u ON p.Usuario_ID = u.ID_Usuario
                                            INNER JOIN Usuario as ue ON e.Usuario_ID = ue.ID_Usuario
                                            INNER JOIN Servicio as s ON s.ID_Servicio = c.Servicio_ID
                                            WHERE u.ID_Usuario = $id_user";
                                            $result = mysqli_query($conn, $vista);
                                            if($result){
                                                while($row = mysqli_fetch_assoc($result)){
                                                    $n_doc = $row['doctor_n'] . ' ' . $row['doctor_ap'];
                                                    $id_user = $row['id_usuario'];
                                                    $id_cita = $row['id_cita'];
                                                    $paciente = $row['paciente'];
                                                    $fecha = $row['fecha'];
                                                    $consultorio = $row['consultorio'];
                                                    $servicio = $row['servicio'];
                                                    $costo = $row['costo'];
                                                    echo '<tr>
                                                    <th scope = "row">'.$consultorio.'</th>
                                                    <td>'.$fecha.'</th>
                                                    <td>'.$n_doc.'</td>
                                                    <td>'.$servicio.'</td>
                                                    </tr>';
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; la mmalona KCU 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="../../js/demo/datatables-demo.js"></script>
</body>
</html>
