<?php
include('../Controlador/conexion/conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $novedad = $_POST['novedad'];

    // Actualiza la novedad en la base de datos
    $sql = "UPDATE novedades SET novedad = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("si", $novedad, $id);

    if ($stmt->execute()) {
        echo "<script>
            Swal.fire('¡Actualización Exitosa!', 'La novedad ha sido actualizada.', 'success').then(() => {
                window.location.href = '../Vista/listaNovedades.php'; // Cambia a la ruta de tu lista de novedades
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire('Error', 'No se pudo actualizar la novedad.', 'error');
        </script>";
    }
}
?>
