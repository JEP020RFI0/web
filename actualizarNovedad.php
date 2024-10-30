<?php
include('../Controlador/conexion/conexion.php');

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $novedad = $_POST['novedad'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];

    // Consulta para actualizar la novedad
    $sql = "UPDATE novedades SET novedad = ?, fecha_publicacion = ?, hora_publicacion = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssi", $novedad, $fecha, $hora, $id);

    if ($stmt->execute()) {
        // Redirige de vuelta a la lista de novedades después de actualizar
        header("Location: ../Vista/Novedades.php?success=2");
        exit();
    } else {
        echo "Error al actualizar la novedad: " . $stmt->error;
    }

    $stmt->close();
}

$conexion->close();
?>
