<?php
session_start();
require_once './conexion/conexion.php'; // Archivo para la conexión a la base de datos

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener el ID del reto a eliminar
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta para eliminar el reto
    $sql = "DELETE FROM retos WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Reto eliminado exitosamente.";
    } else {
        $_SESSION['error'] = "Error al eliminar el reto: " . $conexion->error;
    }
    $stmt->close();
} else {
    $_SESSION['error'] = "ID de reto no proporcionado.";
}

// Redirigir de vuelta a la página de retos
header("Location: ../Vista/SectionRetosSubidos.php");
exit();
?>
