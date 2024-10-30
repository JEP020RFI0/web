<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Ponte Aprueba!</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="../Vista/Publico/Imagenes/FAVICON.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.css">
    <style>
        /* Aquí va el estilo que ya tienes */
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@500&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Macondo&family=Mali:wght@500&family=Pangolin&family=Shantell+Sans:ital,wght@0,300;0,400;0,500;1,400&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
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

        .container-hero {
            background-color: rgba(214, 208, 208, 0.541);
            padding: 5px 0;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .nombre-pagina {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-left: -600px;
        }

        .nombre-pagina h1 {
            color: black;
            margin: 0;
            font-size: 24px;
            font-family: 'Pangolin', sans-serif;
        }

        .logo-img {
            width: 70px;
            height: auto;
        }

        .container {
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
            width: 768px;
            max-width: 90%;
            margin: 100px auto;
            padding: 40px 20px;
            text-align: center;
            margin-top: 200px;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .cards-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .card {
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: calc(33.333% - 20px); /* Ajustar para tres tarjetas por fila */
            text-align: center;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-img {
            width: 100%;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            height: 150px;
            object-fit: cover;
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

        .icon {
            margin-top: 10px;
            font-size: 20px;
            color: #ac3846;
            cursor: pointer;
            transition: color 0.2s;
        }

        .icon:hover {
            color: #84545b;
        }

        .link-button {
            text-decoration: none;
            display: inline-block; /* Asegura que se comporte como un botón */
            padding: 10px 20px; /* Espaciado interno */
            background-color: #ac3846; /* Color de fondo */
            color: white; /* Color del texto */
            border: none; /* Sin borde */
            border-radius: 5px; /* Bordes redondeados */
            font-size: 16px; /* Tamaño de fuente */
            cursor: pointer; /* Cambiar el cursor al pasar el mouse */
            transition: background-color 0.3s, transform 0.2s; /* Transiciones suaves */
        }

        .link-button:hover {
            background-color: #84545b; /* Color al pasar el mouse */
            transform: translateY(-2px); /* Efecto de elevación */
        }

        .link-button:active {
            transform: translateY(0); /* Efecto al hacer clic */
        }
        .card {
            position: relative; /* Para posicionar el icono dentro de la tarjeta */
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: calc(33.333% - 20px);
            text-align: center;
            transition: transform 0.2s;
        }

        .icon {
            position: absolute; /* Posiciona el icono en la esquina superior derecha */
            top: 10px;
            right: 10px;
            font-size: 20px;
            color: #ac3846;
            cursor: pointer;
            display: none; /* Ocultamos el ícono por defecto */
        }

    </style>
</head>
<body>
    <div class="container-hero">
        <div class="title-container">
            <div class="nombre-pagina">
                <h1>QuimiClick</h1>
                <a href="./Index.php">
                    <img id="logo" class="logo-img" src="./Publico/Imagenes/Logo_página-removebg-preview.png" alt="Logo">
                </a>
            </div>
        </div>
    </div>

    <div class="container">
        <h1>Retos disponibles</h1>
        <div class="cards-container">
            <?php while ($row = $result->fetch_assoc()) : ?>
                <div class="card">
                    <div class="card-content">
                        <h2 class="card-title"><?= $row['titulo'] ?></h2>
                        <p class="card-description"><?= $row['descripcion'] ?></p>
                        <a href="editarReto.php?id=<?= $row['id'] ?>" class="link-button">Editar Reto</a>
                    </div>
                    <a href="eliminarReto.php?id=<?= $row['id'] ?>" class="icon"><i class="fas fa-trash"></i></a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
