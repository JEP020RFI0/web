<?php
// Iniciar sesión y conectar a la base de datos
session_start();
include './conexion/conexion.php'; // Asegúrate de que la ruta sea correcta

// Verificar que se haya enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['idquizzes'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $link_quizizz = $_POST['link_quizizz'];

    // Actualizar la base de datos sin incluir la imagen
    $query = "UPDATE retos SET titulo = ?, descripcion = ?, link_quizizz = ? WHERE id = ?";
    $stmt = $conexion->prepare($query);
    
    if ($stmt) {
        $stmt->bind_param("sssi", $titulo, $descripcion, $link_quizizz, $id);
        
        // Ejecutar la consulta y verificar si se realizó correctamente
        if ($stmt->execute()) {
            $_SESSION['msg'] = 'Reto actualizado con éxito';
        } else {
            $_SESSION['msg'] = 'Error al actualizar el reto: ' . $conexion->error;
        }
    } else {
        $_SESSION['msg'] = 'Error en la preparación de la consulta: ' . $conexion->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $conexion->close();

    // Redirigir a la misma página
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
} else {
    echo "<script>alert('Reto actualizado con exito.'); window.location.href = '../Vista/SectionPonteAPrueba.php';</script>";
    exit();
}

// Si se desea eliminar un reto
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $query = "DELETE FROM retos WHERE id = ?";
    $stmt = $conexion->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $_SESSION['msg'] = 'Reto eliminado con éxito';
        } else {
            $_SESSION['msg'] = 'Error al eliminar el reto: ' . $conexion->error;
        }
    } else {
        $_SESSION['msg'] = 'Error en la preparación de la consulta: ' . $conexion->error;
    }

    $stmt->close();
    $conexion->close();

    // Redirigir a la misma página
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Si se está editando un reto
$editing_id = isset($_GET['edit']) ? $_GET['edit'] : null;
$editing_data = null;

if ($editing_id) {
    $editing_query = "SELECT * FROM retos WHERE id = ?";
    $stmt = $conexion->prepare($editing_query);
    $stmt->bind_param("i", $editing_id);
    $stmt->execute();
    $editing_data = $stmt->get_result()->fetch_assoc();
}
?>

</body>
</html>
