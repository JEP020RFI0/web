<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

ob_start();
include("../Controlador/conexion/conexion.php");
include ("../Vista/sidebar.php");

if (!isset($_SESSION['idusuario'])) {
    header("Location: ./Index.php");
    exit();
}

// Consulta para obtener todas las actividades desde la base de datos
$query = "SELECT titulo, descripcion, inicio, finalizacion, id FROM actividades"; 
$result = $conexion->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividades</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@500&display=swap');

        body {
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
            font-family: 'Outfit', sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 30px;
            max-width: 1200px;
            margin-left: 200px;
        }

        .card {
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            text-align: center;
            width: 300px; /* Ancho fijo para cada card */
            transition: transform 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #333;
        }

        .card p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 15px;
        }

        .dates {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 15px;
        }

        .card button {
            background-color: #ac3846;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            text-transform: uppercase;
        }

        .card button:hover {
            background-color: #84545b;
        }

        .barra-lateral {
            margin-left: -5px;
            margin-top: -1px;
        }

        @media (max-width: 600px) {
            .container {
                flex-direction: column;
                align-items: center;
            }

            .card {
                width: 90%; /* Ancho responsive para dispositivos pequeños */
            }
        }
    </style>
</head>
<body>

<div class="container">
    <?php 
    // Verifica si hay resultados antes de mostrar las cartas
    if ($result->num_rows > 0) {
        // Usar while para iterar sobre todos los registros
        while ($row = $result->fetch_assoc()) {
    ?>
        <div class="card">
            <h3><?php echo $row['titulo']; ?></h3>
            <p><?php echo $row['descripcion']; ?></p>
            <div class="dates">
                <p>Inicio: <?php echo $row['inicio']; ?></p>
                <p>Finaliza: <?php echo $row['finalizacion']; ?></p>
            </div>
            <button onclick="window.location.href='preguntas.php?id=<?php echo $row['id']; ?>'">Ver Preguntas</button>
        </div>
    <?php 
        }
    } else {
        echo "<p>No hay actividades disponibles.</p>"; // Mensaje si no hay actividades
    }
    ?>
</div>
<footer class="footer">
            <div class="footer-content">
                <p>&copy; 2024 Quimiclick. Todos los derechos reservados.</p>
                <p><a href="#">Términos de Servicio</a> | <a href="#">Política de Privacidad</a></p>
            </div>
        </footer>

        <style>
            .footer {
                margin-top: 50px;
                background-color: #0bc7e8;
                /* Color de fondo */
                text-align: center;
                /* Centrar el texto */
                position: relative;
                /* Posición relativa para el posicionamiento */
                bottom: -24;
                /* Alinear al fondo de la página */
                width: -98%;
                /* Ancho completo */
                padding: 10px;
                color: #252237;                
                /* Color del texto */
            }

            .footer-content {
            max-width: 800px;
            /* Ancho máximo para contenido */
            margin-left: 400px;
            font-size: 15px;
        }

            .footer p {
                margin: 0;
                /* Margen para los párrafos */
            }

            .footer a {
                color: #ac3846;
                /* Color de los enlaces */
                text-decoration: none;
                /* Sin subrayado */
                transition: color 0.3s ease;
                /* Transición suave al pasar el ratón */
            }

            .footer a:hover {
                color: #258790;
                /* Color de los enlaces al pasar el ratón */
                text-decoration: underline;
                /* Subrayar al pasar el ratón */
            }

            footer a {
                background-color: #0bc7e8;
            }

            footer p {
                background-color: #0bc7e8;
            }

            @media (max-width: 600px) {
                .footer-content {
                    padding: 0 10px;
                    /* Espaciado lateral para pantallas pequeñas */
                }
            }
        </style>

</body>
</html>
