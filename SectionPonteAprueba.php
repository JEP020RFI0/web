<?php
require_once '../Controlador/conexion/conexion.php';
include '../Vista/sidebar.php';

$query = "SELECT * FROM retos";
$result = $conexion->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Ponte Aprueba!</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="../Vista/Publico/Imagenes/FAVICON.ico" type="image/x-icon">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@500&display=swap');

        .barra-lateral{
        margin-left: -1120px;
    }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
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
            width: 900%;
            max-width: 1000px;
            margin: 10px auto;
            padding: 20px 20px;
            text-align: center;
            margin-top: -40px;
            margin-right: 80px;
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
        }

        .cards-container {
            display: flex;
            transition: transform 0.3s ease;
            min-width: 100%;
            padding-left: 35px;
        }

        .card {
            flex: 0 0 auto;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 230px;
            margin: 15px; /* Espacio entre las tarjetas */
            text-align: center;
            transition: transform 0.5s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-content {
            padding: 15px;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .card-description {
            font-size: 14px;
            color: #777;
            margin: 10px 0;
        }

        .btn-acceder {
            background-color: #ac3846;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-transform: uppercase;
            font-size: 14px;
            font-weight: 600;
            display: inline-block;
        }

        .btn-acceder:hover {
            background-color: #84545b;
        }

        .carousel-btn {
            background-color: #ffffff;
            border: none;
            font-size: 30px;
            cursor: pointer;
            z-index: 1000;
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

        .footer {
            margin-top: 50px;
            background-color: #0bc7e8;
            text-align: center;
            position: relative;
            bottom: -63px;
            width: 100%;
            padding: 10px;
            color: #252237;
            margin-bottom: -70px;
        }

        .footer-content {
            max-width: 800px;
            margin-left: 400px;
            font-size: 15px;
        }

        .footer p {
            margin: 0;
        }

        .footer a {
            color: #ac3846;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: #258790;
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .footer-content {
                padding: 0 10px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Retos disponibles</h1>
        <div class="carousel-container">
            <button class="carousel-btn left-btn" onclick="moveCarousel(-1)">❮</button>
            <div class="cards-container">
                <?php while ($row = $result->fetch_assoc()): ?>
                <div class="card">
                    <div class="card-content">
                        <h2 class="card-title"><?php echo $row['titulo']; ?></h2>
                        <p class="card-description"><?php echo $row['descripcion']; ?></p>
                        <a class="link-button" href="<?php echo $row['link_quizizz']; ?>">Acceder al Reto</a>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <button class="carousel-btn right-btn" onclick="moveCarousel(1)">❯</button>
        </div>
    </div>

    <script>
        let currentIndex = 0;

        function moveCarousel(direction) {
            const cardsContainer = document.querySelector('.cards-container');
            const cards = document.querySelectorAll('.card');
            const cardWidth = cards[0].offsetWidth + 30; // Ajustar para considerar el nuevo margen

            currentIndex += direction;

            if (currentIndex < 0) {
                currentIndex = 0;
            } else if (currentIndex > cards.length - 1) {
                currentIndex = cards.length - 1;
            }

            cardsContainer.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
        }
    </script>

    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2024 Quimiclick. Todos los derechos reservados.</p>
            <p><a href="#">Términos de Servicio</a> | <a href="#">Política de Privacidad</a></p>
        </div>
    </footer>
</body>
</html>
