<?php
include ('../Vista/sidebar.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Reto</title>
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

        body {
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
            overflow-y:hidden ;
        }

        .container {
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
            width: 768px;
            max-width: 90%;
            padding: 40px 20px;
            text-align: center;
            margin-top: 10px;
            margin-left: 200px;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .form-image-container {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        form {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-group {
            margin-bottom: 15px;
            width: 90%;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
            outline: none;
            background-color: #eee;
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
            font-weight: 100;
        }

        .btn-actualizar:hover {
            background-color: #84545b;
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
        <h1>Agregar nuevo reto</h1>

        <div class="form-image-container">
            <form action="../Controlador/procesar_reto.php" method="POST">
                <input type="hidden" name="idquizzes" value="<?php echo isset($_SESSION['idquizzes']) ? htmlspecialchars($_SESSION['idquizzes']) : ''; ?>">

                <div class="form-group">
                    <input type="text" id="titulo" name="titulo" placeholder="Título del reto" required>
                </div>
                <div class="form-group">
                    <textarea id="descripcion" name="descripcion" placeholder="Descripción breve del reto" required></textarea>
                </div>
                <div class="form-group">
                    <input type="text" id="link_quizizz" name="link_quizizz" placeholder="Link del quiz" required>
                </div>

                <button type="submit" class="btn-actualizar">Agregar</button>
            </form>
        </div>
    </div>

    <script>
        function validateForm() {
            return true;
        }
    </script>
    
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2024 Quimiclick. Todos los derechos reservados.</p>
            <p><a href="#">Términos de Servicio</a> | <a href="#">Política de Privacidad</a></p>
        </div>
    </footer>

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .footer {
            margin-top: 50px;
            background-color: #0bc7e8;
            text-align: center;
            position: relative;
            bottom: -66px;
            width: 100%;
            padding: 10px;
            color: #252237;
            margin-bottom: 10px;
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

        footer a {
            background-color: #0bc7e8;
        }

        footer p {
            background-color: #0bc7e8;
        }

        @media (max-width: 600px) {
            .footer-content {
                padding: 0 10px;
            }
        }
    </style>
</body>

</html>
