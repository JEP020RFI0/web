<?php
include('../Controlador/conexion/conexion.php');

// Verifica si se ha enviado un ID para eliminar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Consulta para eliminar la novedad
    $sql = "DELETE FROM novedades WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id); // 'i' para integer

    if ($stmt->execute()) {
        // Redirige de vuelta a la lista de novedades después de eliminar
        header("Location: ../Vista/Novedades.php?success=1");
        exit();
    } else {
        echo "Error al eliminar la novedad: " . $stmt->error;
    }

    $stmt->close();
}

$conexion->close();
?>
