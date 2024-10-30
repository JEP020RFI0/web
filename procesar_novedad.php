<?php
include ('./conexion/conexion.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $novedad = $_POST['novedad'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];

    $sql = "INSERT INTO novedades (novedad, fecha_publicacion, hora_publicacion) VALUES ('$novedad', '$fecha', '$hora')";

    if ($conexion->query($sql) === TRUE) {
        echo "<script>
                alert('Agregado exitosamente.');
                window.location='../Vista/Novedades.php';
            </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }

    $conexion->close();
}

?>