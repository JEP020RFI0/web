<?php
// Incluir la conexión a la base de datos
include('./conexion/conexion.php'); // Ajusta la ruta según tu proyecto

// Inicializar las variables de estado
$mensaje = '';
$tipoMensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si los campos necesarios están presentes
    if (isset($_POST['idusuario']) && isset($_POST['rol'])) {
        // Obtener los datos del formulario
        $idusuario = intval($_POST['idusuario']);
        $rol = mysqli_real_escape_string($conexion, $_POST['rol']);

        // Preparar la consulta SQL para actualizar el rol
        $sql = "UPDATE usuario SET rol = ? WHERE idusuario = ?";
        $stmt = mysqli_prepare($conexion, $sql);

        // Vincular los parámetros a la consulta
        mysqli_stmt_bind_param($stmt, 'si', $rol, $idusuario);

        // Ejecutar la consulta
        if (mysqli_stmt_execute($stmt)) {
            // Si la actualización fue exitosa
            $mensaje = 'El rol se ha actualizado correctamente.';
            $tipoMensaje = 'success';
        } else {
            // Si hubo un error en la actualización
            $mensaje = 'Hubo un error al actualizar el rol.';
            $tipoMensaje = 'error';
        }

        // Cerrar la declaración y la conexión
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
    } else {
        // Si los campos no están presentes
        $mensaje = 'Faltan datos para actualizar el rol.';
        $tipoMensaje = 'error';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Rol</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Incluir SweetAlert -->
</head>
<body>

<script>
    // Mostrar la alerta de SweetAlert según el resultado de la actualización
    <?php if ($mensaje !== ''): ?>
        Swal.fire({
            icon: '<?php echo $tipoMensaje; ?>',
            title: '<?php echo $tipoMensaje === 'success' ? '¡Éxito!' : 'Error'; ?>',
            text: '<?php echo $mensaje; ?>',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#ac3846',
        }).then((result) => {
            if (result.isConfirmed) {
                // Redireccionar a la página del panel de administración después de hacer clic en Aceptar
                window.location.href = '../Vista/SectionAdmin.php'; 
            }
        });
    <?php endif; ?>
</script>

</body>
</html>
