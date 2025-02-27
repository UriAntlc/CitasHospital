<?php
    include '../../admin/conexion.php';

if (isset($_GET['id'])) {
    $medicamento_id = $_GET['id'];
    
    // Consulta para obtener el costo del medicamento con el ID proporcionado
    $consulta = "SELECT * FROM Medicamento WHERE ID_Medicamento = $medicamento_id";
    $resultado = mysqli_query($conn, $consulta);
    
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $row = mysqli_fetch_assoc($resultado);
        $costo = $row['costo'];
        echo $costo; // Devuelve el costo del medicamento como respuesta
    } else {
        echo "No se encontró el costo del medicamento.";
    }
} else {
    echo "ID de medicamento no proporcionado.";
}
?>