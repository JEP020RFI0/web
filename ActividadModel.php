<?php
include("../Controlador/conexion/conexion.php");
include("../Modelo/ActividadModel.php");  // Verifica la ruta aquí

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $inicio = $_POST['inicio'];
    $finalizacion = $_POST['finalizacion'];
    $dificultad = $_POST['dificultad'];


    if ($actividadModel->agregarActividad($titulo, $descripcion, $inicio, $finalizacion, $dificultad)) {
        header("Location: ../Vista/mostrarActividades.php");
        exit();
    } else {
        echo "Error al subir la actividad.";
    }
}
?>
