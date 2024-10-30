<?php
session_start();
require_once __DIR__ . '/conexion/conexion.php';

// Verifica si la conexión se estableció
if (!isset($conexion)) {
    die('Error en la conexión a la base de datos: ' . mysqli_connect_error());
}

    $titulo = htmlspecialchars($_POST['titulo']);
    $descripcion = htmlspecialchars($_POST['descripcion']);
    $link_quizizz = htmlspecialchars($_POST['link_quizizz']);

    // Insertar en la base de datos sin incluir la imagen
    $stmt = $conexion->prepare("INSERT INTO retos (titulo, descripcion, link_quizizz) VALUES (?, ?, ?)");
    if ($stmt) {
        // No se incluye id porque es autoincremental
        $stmt->bind_param("sss", $titulo, $descripcion, $link_quizizz);
        $stmt->execute();
        $stmt->close();

        $_SESSION['ultimo_reto'] = $conexion->insert_id;
        $_SESSION['nuevo_reto'] = $titulo;

        echo "<script>
                alert('El reto se ha agregado exitosamente.');
                window.location.href = '../Vista/SectionRetosSubidos.php';
            </script>";
        exit();
    } else {
        echo "<script>alert('Error en la preparación de la consulta: " . $conexion->error . "'); window.location.href = '../Vista/SectionAgregarReto.php';</script>";
    }

?>
