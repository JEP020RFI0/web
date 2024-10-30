<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

ob_start(); // Start output buffering
include("../Controlador/conexion/conexion.php"); // Include the database connection
include ("../Vista/sidebar.php");

// Check if the session has a user ID
if (!isset($_SESSION['idusuario'])) {
    header("Location: ./Index.php"); // Redirect to index.php if there is no session
    exit(); // Ensure the script stops after redirecting
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Actividades</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@500&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: #c9d6ff;
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
            display: flex;
            flex-direction: column; /* Cambiar a columna */
            height: 100vh;
            overflow-y: auto; /* Permitir desplazamiento vertical */
        }

        .container {
    background-color: #fff;
    border-radius: 20px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
    display: flex; 
    flex-direction: row; /* Mantener disposición en fila */
    margin: 20px auto; /* Centrar el contenedor horizontalmente */
    padding: 20px 6px; 
    padding-top: 60px;
    width: 90%;
    max-width: 700px;
    margin-right: 250px;
    margin-bottom: -50px; /* Espacio extra en la parte inferior */
}


        .barra-lateral{
            margin-left: -5px;
        }
        .title {
            font-size: 20px; 
            color: #333;
            margin-bottom: 20px; 
            margin-top: -30px;
            text-align: center;
            margin-left: 20px;
            margin-right: -70px;

        }

        .input-box {
            margin-bottom: 15px;
            display: flex; 
            flex-wrap: wrap; 
            gap: 5px; 
        }

        .input-box input, .input-box select, .input-box textarea {
            flex: 1 1 calc(50% - 5px); 
            padding: 8px 10px; 
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 13px; 
            outline: none;
            background-color: #eee;
        }

        .button {
            margin-top: 15px; 
            display: flex; 
            justify-content: center; 
        }

        .button input[type="submit"] {
            background-color: #ac3846;
            color: white;
            padding: 8px 20px; 
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 100;
            text-transform: uppercase;
        }

        .question-group {
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px; 
            background-color: #f9f9f9;
        }

        .remove-question {
            color: red;
            cursor: pointer;
            margin-top: 5px;
        }

        button {
            background-color:  #2497c3 ;
            color: white;
            padding: 8px 10px; 
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            margin-bottom: 20px; 
            font-weight: 100;
        }
        .remove-question{
            color:  #ac3846 ;
        }
        .input-box label {
    flex-basis: 100%;
    font-size: 13px; /* Tamaño de fuente acorde al input */
    margin-bottom: 5px; /* Espacio entre la etiqueta y el input */
}


    </style>
</head>
<body>

<div class="container">
    <div class="title">Subir Actividad</div>
    <form role="form" method="post" action="../Controlador/procesar_actividad.php" enctype="multipart/form-data">
        <div class="user-details">
            <div class="input-box">
                <input type="text" placeholder="Ingrese el título de la actividad" name="titulo" required>
            </div>
            <div class="input-box">
                <textarea placeholder="Describa la actividad" name="descripcion" rows="2" required></textarea>
            </div>
            <div class="input-box">
                <label for="inicio">Fecha de inicio:</label>
                <input type="date" id="inicio" name="inicio" required>

                <label for="finalizacion">Fecha de finalización:</label>
                <input type="date" id="finalizacion" name="finalizacion" required>
            </div>
        </div>

        <!-- Sección para preguntas -->
        <div id="questions-container">
            <!-- Aquí cargaremos las preguntas existentes -->
            <?php
            // Si hay preguntas existentes, las cargamos
            if (isset($reto['pregunta']) && is_array($reto['pregunta'])) {
                foreach ($reto['pregunta'] as $index => $pregunta) {
                    echo '<div class="question-group">';
                    echo '<div class="input-box">';
                    echo '<input type="text" placeholder="Pregunta ' . ($index + 1) . '" name="pregunta[]" value="' . htmlspecialchars($pregunta) . '" required>';
                    echo '</div>';
                    echo '<span class="remove-question" onclick="removeQuestion(this)">Eliminar Pregunta</span>';
                    echo '</div>';
                }
            } else {
                // Si no hay preguntas, muestra una pregunta por defecto
                echo '<div class="question-group">';
                echo '<div class="input-box">';
                echo '<input type="text" placeholder="Pregunta 1" name="pregunta[]" required>';
                echo '</div>';
                echo '<span class="remove-question" onclick="removeQuestion(this)">Eliminar Pregunta</span>';
                echo '</div>';
            }
            ?>
        </div>
        <button type="button" onclick="addQuestion()">Agregar Pregunta</button>

        <div class="button">
            <input type="submit" value="Subir Actividad">
        </div>
    </form>
</div>
<script>
    function addQuestion() {
        var questionsContainer = document.getElementById('questions-container');
        var questionCount = questionsContainer.getElementsByClassName('question-group').length + 1;

        var questionGroup = document.createElement('div');
        questionGroup.className = 'question-group';
        questionGroup.innerHTML = `
            <div class="input-box">
                <input type="text" placeholder="Pregunta ${questionCount}" name="pregunta[]" required>
            </div>
            <span class="remove-question" onclick="removeQuestion(this)">Eliminar Pregunta</span>
        `;
        questionsContainer.appendChild(questionGroup);
    }

    function removeQuestion(element) {
        element.parentElement.remove();
    }
</script>

</body>
</html>
