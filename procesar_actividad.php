<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../Controlador/conexion/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $inicio = $_POST['inicio'];
    $finalizacion = $_POST['finalizacion'];
    $pregunta = $_POST['pregunta']; // Esto ahora es un array

    // Validar que el campo preguntas no esté vacío
    if (empty($pregunta)) {
        echo "<script>
                alert('El campo de preguntas no puede estar vacío.');
                window.location.href = '../Vista/Actividades.php'; // Redirige a donde desees
              </script>";
        exit();
    }

    // Convertir el array de preguntas a una cadena
    $preguntas_string = implode(";", $pregunta); // Usa un delimitador como punto y coma

    // Consulta para insertar la actividad
    $query = "INSERT INTO actividades (titulo, descripcion, inicio, finalizacion, pregunta) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("sssss", $titulo, $descripcion, $inicio, $finalizacion, $preguntas_string); // Cambiado a preguntas_string

    if ($stmt->execute()) {
        // Si se inserta correctamente, muestra una alerta y redirige
        echo "<script>
                alert('Actividad insertada correctamente.');
                window.location.href = '../Vista/Actividades.php';
              </script>";
    } else {
        // Si ocurre un error, muestra una alerta con el mensaje de error
        echo "<script>
                alert('Error al insertar actividad: " . $stmt->error . "');
                window.location.href = 'preguntas.php'; // Redirigir a preguntas.php en caso de error también
              </script>";
    }
}
?>
