<?php
session_start(); // Asegúrate de que la sesión esté iniciada

// Conectar a la base de datos
include '../Controlador/conexion/conexion.php'; // Cambia esto según tu estructura

// Verifica si se ha pasado el id
var_dump($_GET); // Para depuración
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepara la consulta
    $query = "SELECT * FROM actividades WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica si se encontraron resultados
    if ($result->num_rows > 0) {
        $reto = $result->fetch_assoc(); // Obtener los datos del reto
    } else {
        echo "No se encontró el reto.";
        exit;
    }
} else {
    echo "ID no especificado.";
    exit;
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
            border-radius: 20px; /* Reducir el radio de borde */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
            display: flex; 
            flex-direction: column; 
            margin: 20px auto; /* Centrar el contenedor */
            padding: 20px 10px; 
            width: 80%; /* Mantener ancho relativo */
            max-width: 700px; /* Establecer un ancho máximo más pequeño */
        }

        .title {
            font-size: 20px; 
            color: #333;
            margin-bottom: 15px; 
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
            font-weight: 600;
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
        }

        .remove-question {
            color:  #ac3846 ;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="title">Subir Actividad</div>
        <form role="form" method="post" action="../Controlador/procesar_actividad.php" enctype="multipart/form-data">
            <div class="user-details">

                <div class="input-box">
                    <input type="text" placeholder="Ingrese el título de la actividad" name="titulo" value="<?php echo htmlspecialchars($reto['titulo']); ?>" required>
                    <input type="text" placeholder="Ejemplo de otra entrada" name="otro_campo" required>
                </div>
                <div class="input-box">
                    <textarea placeholder="Describa la actividad" name="descripcion" rows="2" required><?php echo htmlspecialchars($reto['descripcion']); ?></textarea>
                </div>
                <div class="input-box">
                    <input type="date" name="inicio" value="<?php echo htmlspecialchars($reto['inicio']); ?>" required>
                    <input type="date" name="finalizacion" value="<?php echo htmlspecialchars($reto['finalizacion']); ?>" required>
                </div>
                <div class="input-box">
                    <select name="dificultad" required>
                        <option value="Fácil" <?php echo ($reto['dificultad'] == 'Fácil') ? 'selected' : ''; ?>>Fácil</option>
                        <option value="Intermedio" <?php echo ($reto['dificultad'] == 'Intermedio') ? 'selected' : ''; ?>>Intermedio</option>
                        <option value="Difícil" <?php echo ($reto['dificultad'] == 'Difícil') ? 'selected' : ''; ?>>Difícil</option>
                    </select>
                </div>
            </div>

            <!-- Sección para preguntas -->
            <div id="questions-container">
                <h3>Preguntas (Mínimo 5)</h3>
                <div class="question-group">
                    <div class="input-box">
                        <input type="text" placeholder="Pregunta 1" name="pregunta[]" value="<?php echo htmlspecialchars($reto['pregunta1']); ?>" required>
                    </div>
                    <span class="remove-question" onclick="removeQuestion(this)">Eliminar Pregunta</span>
                </div>
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

        function eliminarReto(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este reto?')) {
                window.location.href = `../Controlador/eliminarActividad.php?id=${id}`;
            }
        }

        function editarReto(id) {
            window.location.href = `./SectionEditarActividad.php?id=${id}`;
        }
    </script>
</body>
</html>
