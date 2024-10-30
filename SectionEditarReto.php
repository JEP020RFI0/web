<?php
// Conectar a la base de datos
include '../Controlador/conexion/conexion.php'; // Cambia esto según tu estructura
include ('../Vista/sidebar.php');

// Verifica si se ha pasado el id
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepara la consulta
    $query = "SELECT * FROM retos WHERE id = ?";
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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="../Vista/Publico/Imagenes/FAVICON.ico" type="image/x-icon">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@500&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Pangolin&display=swap');

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
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
        }


        .container {
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
            width: 768px;
            max-width: 90%;
            min-height: 500px;
            margin: 20px auto;
            padding: 30px 10px;
            text-align: center;
            margin-top: -120px;
            margin-left: 450px;
            margin-bottom: -120px;


        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            width: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-group {
            margin-bottom: 15px;
            width: 100%;
        }

        input[type="text"],
        textarea {
            width: 90%;
            padding: 10px 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
            outline: none;
            background-color: #eee;
            margin-left: 60px;
        }

        textarea {
            resize: vertical;
            height: 80px;
        }

        .btn-actualizar {
            background-color: #ac3846;
            color: white;
            padding: 10px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            margin-left: 400px;
        }

        .btn-actualizar:hover {
            background-color: #84545b;
        }
        .form-group{
            margin-left: 250px;
        }
        .barra-lateral.mini-barra-lateral img#logo {
        margin-left: -10px;
        margin-right: 25px;
        margin-bottom: -15px;
        width: 80px;
        
    }

    </style>
</head>

<body>

    <div class="container">
        <h1>Editar reto</h1>

        <form action="../Controlador/editarReto.php" method="POST">
            <input type="hidden" name="idquizzes" value="<?php echo htmlspecialchars($reto['id']); ?>">

            <div class="form-group">
                <input type="text" id="titulo" name="titulo" placeholder="Título del reto" value="<?php echo htmlspecialchars($reto['titulo']); ?>" required>
            </div>
            <div class="form-group">
                <textarea id="descripcion" name="descripcion" placeholder="Descripción del reto" required><?php echo htmlspecialchars($reto['descripcion']); ?></textarea>
            </div>
            <div class="form-group">
                <input type="text" id="link_quizizz" name="link_quizizz" placeholder="Link del reto" value="<?php echo htmlspecialchars($reto['link_quizizz']); ?>" required>
            </div>

            <button type="submit" class="btn-actualizar">Actualizar</button>
        </form>
    </div>
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2024 Quimiclick. Todos los derechos reservados.</p>
            <p><a href="#">Términos de Servicio</a> | <a href="#">Política de Privacidad</a></p>
        </div>
    </footer>

    <style>
        body{
            overflow-y: hidden;
        }
        *{
            margin: 0;
            padding: 0;
        }
        .footer {
            margin-top: 50px;
            background-color: #0bc7e8;
            /* Color de fondo */
            text-align: center;
            /* Centrar el texto */
            position: relative;
            /* Posición relativa para el posicionamiento */
            bottom: -154px;
            /* Alinear al fondo de la página */
            width: 100%;
            padding: 10px;
            color: #252237;
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
