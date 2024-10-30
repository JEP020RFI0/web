<?php
include('../Controlador/conexion/conexion.php'); // Asegúrate de incluir la conexión a la base de datos

// Inicializar variables para el mensaje de estado
$mensaje = '';
$tipoMensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idusuario = $_POST['idusuario'];

    // Preparar la consulta para eliminar el usuario
    $sql = "DELETE FROM usuario WHERE idusuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $idusuario); // 'i' indica que el parámetro es un entero

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Si la eliminación fue exitosa
        $mensaje = 'Usuario eliminado con éxito.';
        $tipoMensaje = 'success';
    } else {
        // Si hubo un error en la eliminación
        $mensaje = 'Error al eliminar el usuario.';
        $tipoMensaje = 'error';
    }

    // Cerrar la declaración
    $stmt->close();
}

// Cerrar la conexión
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Incluir SweetAlert -->
</head>
<body>

<script>
    // Mostrar la alerta de SweetAlert según el resultado de la eliminación
    <?php if ($mensaje !== ''): ?>
        Swal.fire({
            icon: '<?php echo $tipoMensaje; ?>',
            title: '<?php echo $tipoMensaje === 'success' ? '¡Éxito!' : 'Error'; ?>',
            text: '<?php echo $mensaje; ?>',
            confirmButtonColor: '#ac3846',
            confirmButtonText: 'Aceptar',
            timer: 2000
        }).then(() => {
            // Redireccionar a la página del panel de administración después de mostrar la alerta
            window.location.href = '../Vista/SectionAdmin.php';
        });
    <?php endif; ?>
</script>

</body>
</html>
