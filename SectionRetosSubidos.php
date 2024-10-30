<?php
require_once '../Controlador/conexion/conexion.php'; // Archivo para la conexión a la base de datos

include '../Vista/sidebar.php';

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener los retos de la base de datos
$query = "SELECT * FROM retos";
$result = $conexion->query($query);

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error al ejecutar la consulta: " . $conexion->error);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retos disponibles</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="../Vista/Publico/Imagenes/FAVICON.ico" type="image/x-icon">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@500&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        .barra-lateral.mini-barra-lateral img#logo {
        margin-left: -15px;
        margin-right: 25px;
        margin-bottom: -15px;
        width: 80px;
        
        
    }


        body {
            background-color: #c9d6ff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
            overflow-y: hidden;
        }

        .container {
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
            width: 100%;
            max-width: 1000px;
            margin: 50px auto;
            text-align: center;
            margin-right: 200px;
            padding: 30px;
            padding-left: 60px;
            margin-right:80px;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .carousel-container {
            display: flex;
            align-items: center;
            overflow: hidden;
            position: relative;
            margin-bottom: 20px;
        }

        .cards-container {
            display: flex;
            transition: transform 0.3s ease;
            min-width: 100%;
        }

        .card {
            flex: 0 0 auto;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 230px;
            margin: 5px;
            text-align: center;
            transition: transform 0.5s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-content {
            padding: 15px;
        }

        .link-button {
            text-decoration: none;
            display: inline-block;
            padding: 10px 20px;
            background-color: #ac3846;
            color: white;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .link-button:hover {
            background-color: #84545b;
            transform: translateY(-2px);
        }

        .carousel-btn {
            background-color: #ffffff;
            border: none;
            font-size: 30px;
            cursor: pointer;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            border-radius: 50%;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s, transform 0.3s;
        }

        .carousel-btn:hover {
            background-color: #eaeaea;
            transform: scale(1.1);
        }

        .left-btn {
            left: 5px;
        }

        .right-btn {
            right: 5px;
        }

        .icon-container {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-bottom: -5px;
        }

        .icon {
            cursor: pointer;
            font-size: 20px;
            transition: color 0.3s, transform 0.3s;
            margin-top: 10px;
            margin-right: 20px;
        }

        .icon:hover {
            color: #ac3846;
            transform: scale(1.1);
        }

        .carousel-container {
        display: flex;
        align-items: center;
        overflow: hidden;
        position: relative;
        margin-bottom: 20px;
    }

    /* Ajustar estilos de los botones para que siempre sean visibles */
    .carousel-btn {
        background-color: #ffffff;
        border: none;
        font-size: 30px;
        cursor: pointer;
        position: fixed; /* Cambiar a fixed */
        top: 50%;
        transform: translateY(-50%);
        border-radius: 50%;
        padding: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        transition: background-color 0.3s, transform 0.3s;
        z-index: 1000; /* Asegurarse de que esté por encima de otros elementos */
    }

    .left-btn {
        left: 300px; /* Ajustar la posición */
    }

    .right-btn {
        right: 100px; /* Ajustar la posición */
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Retos disponibles</h1>

        <div class="carousel-container">
            <button class="carousel-btn left-btn" onclick="moveCarousel(-1)">❮</button>
            <div class="cards-container">
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="card" data-id="<?php echo $row['id']; ?>">
                            <div class="icon-container">
                                <div class="icon icon-delete" onclick="eliminarReto(<?php echo $row['id']; ?>)">
                                    <i class="fas fa-trash-alt"></i>
                                </div>
                                <div class="icon icon-edit" onclick="editarReto(<?php echo $row['id']; ?>)">
                                    <i class="fas fa-edit"></i>
                                </div>
                            </div>
                            <div class="card-content">
                                <h2 class="card-title"><?php echo $row['titulo']; ?></h2>
                                <p class="card-description"><?php echo $row['descripcion']; ?></p>
                                <a class="link-button" href="<?php echo $row['link_quizizz']; ?>">Acceder al Reto</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No hay retos disponibles.</p>
                <?php endif; ?>
            </div>
            <button class="carousel-btn right-btn" onclick="moveCarousel(1)">❯</button>
        </div>
    </div>

    <script>
        let currentIndex = 0;

        function moveCarousel(direction) {
            const cardsContainer = document.querySelector('.cards-container');
            const cards = document.querySelectorAll('.card');
            const totalCards = cards.length;

            currentIndex = (currentIndex + direction + totalCards) % totalCards;

            const cardWidth = cards[0].offsetWidth + 10; // 20 is the margin
            cardsContainer.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
        }

        function eliminarReto(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este reto?')) {
                window.location.href = `../Controlador/eliminarReto.php?id=${id}`;
            }
        }

        function editarReto(id) {
            window.location.href = `./SectionEditarReto.php?id=${id}`;
        }
    </script>
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2024 Quimiclick. Todos los derechos reservados.</p>
            <p><a href="#">Términos de Servicio</a> | <a href="#">Política de Privacidad</a></p>
        </div>
    </footer>

    <style>
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
            /* Alinear al fondo de la página */
            width: 100%;
            /* Ancho completo */
            padding: 10px;
            color: #252237;
            margin-bottom: 20px;
            
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
