<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../Controlador/conexion/conexion.php");
include("../Vista/sidebar.php");

// Check if the session has a user ID
if (!isset($_SESSION['idusuario'])) {
    header("Location: ./Index.php"); // Redirect to index.php if there is no session
    exit(); // Ensure the script stops after redirecting
}

// Verificar si se ha pasado un ID de actividad
if (isset($_GET['id'])) {
    $id_actividad = intval($_GET['id']);

    // Consulta para obtener el título de la actividad
    $query_title = "SELECT titulo, pregunta FROM actividades WHERE id = ?";
    $stmt_title = $conexion->prepare($query_title);
    $stmt_title->bind_param("i", $id_actividad);
    $stmt_title->execute();
    $stmt_title->bind_result($titulo, $preguntas);
    $stmt_title->fetch();

    // Verifica si hay preguntas
    if (!empty($preguntas)) {
        // Separar las preguntas usando el delimitador ';'
        $preguntas_array = explode(";", $preguntas);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($titulo); ?></title>
    <style>
        body {
            
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
            font-family: 'Outfit', sans-serif;
            margin: 0;
            padding: 20px;
            overflow-x: hidden;
            position: relative;
        }

        @keyframes backgroundAnimation {
            0% {
                opacity: 0.7;
            }
            100% {
                opacity: 1;
            }
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, 0.9); /* Slight transparency */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in;
            position: relative; /* Ensure z-index works */
            z-index: 1; /* Above the background */
            margin-right: 150px;
            
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 2rem;
            animation: bounce 0.8s infinite alternate;
        }
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-5px);
            }
        }
        .pregunta {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer; /* Indicate it's clickable */
        }
        .pregunta:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .pregunta.clicked {
            background-color:  #64a4bc ; /* Light green color to indicate selection */
            border-color: #c3e6cb; /* Darker green border */
        }
        .pregunta h3 {
            font-size: 20px;
            font-weight: 100;
            color: #333;
        }
        .barra-lateral {
            margin-left: -20px;
            margin-top: -20px;
        }
    </style>
</head>
<body>

<div class="background"></div> <!-- Animated background layer -->
<div class="container">
    <h2><?php echo htmlspecialchars($titulo); ?></h2> <!-- Mostrar título de la actividad -->
    <?php
    // Recorrer cada pregunta y mostrarla
    foreach ($preguntas_array as $pregunta) {
        if (!empty(trim($pregunta))) { // Verificar que la pregunta no esté vacía
    ?>
            <div class="pregunta" onclick="markQuestion(this)">
                <h3><?php echo nl2br(htmlspecialchars(trim($pregunta))); ?></h3> <!-- Mostrar preguntas -->
            </div>
    <?php
        }
    }
    ?>

<script>
function markQuestion(element) {
    element.classList.toggle('clicked'); // Toggle the clicked effect
    const audio = new Audio('./Publico/Audios/Audio click.mp3'); // Ensure the path is correct
    audio.play().catch(error => {
        console.error("Error playing audio: ", error);
    });
};
</script>

</body>
</html>
<?php
    } else {
        echo "<p>No se encontraron preguntas para esta actividad.</p>";
    }
} else {
    echo "<p>ID de actividad no proporcionado.</p>";
}
?>
