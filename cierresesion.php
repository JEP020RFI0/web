<?php
session_start(); // Inicia la sesión para poder acceder a las variables de sesión
session_unset(); // Libera todas las variables de sesión
session_destroy(); // Destruye la sesión
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesión cerrada</title>
    <!--FAVICON DE LA PAGINA-->
    <link rel="shortcut icon" href="../Vista/Publico/Imagenes/FAVICON.ico"
        type="imge/x-icon">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="nombre-pagina">
                <h1>Quimiclick</h1>
            </div>
            <a href="../Vista/Index.php">
                <img class="logo-img" src="./Publico/Imagenes/Logo_página-removebg-preview.png" alt="Logo">
            </a>
        </div>
        <h2>¡SESION CERRADA CON EXITO!</h2>
        <img src="./Publico/Imagenes/IMGCLOSE.png" alt="IMG-CLOSE">
        <div class="iconos-enlace">
            <a href="./registrar.php"><ion-icon name="arrow-forward-outline"></ion-icon>Iniciar sesión</a>
            <a href="./Index.php"><ion-icon name="arrow-forward-outline"></ion-icon>Inicio</a>
        </div>
</body>

</html>
<style>
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

    .container {
        background-color: #fff;
        border-radius: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
        position: relative;
        overflow: hidden;
        width: 90%;
        max-width: 45%;
        min-height: auto;
        margin: 20px auto;
        padding: 40px 20px;
        text-align: center;
        margin-top: -100px;
    }

    .header {
        display: flex;
        align-items: center;
    }

    .nombre-pagina h1 {
        color: black;
        font-family: 'Pangolin', sans-serif;
        margin: 20px;

    }

    .logo-img {
        width: 75px;
        height: auto;
        margin-left: 5px;
        margin-bottom: -11px;
    }

    img {
        margin-left: -390px;
        width: 30%;
        margin-top: -40px;
        margin-bottom: 40px;
    }

    h2 {
        margin-left: 250px;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 15px;
        font-weight: normal;

    }

    .iconos-enlace {
    margin-top: -170px; /* Espacio entre el h2 y los iconos */
    display: flex; /* Usar flexbox para la alineación */
    flex-direction: column; /* Colocar los enlaces en columna */
    align-items: center; /* Centrar los enlaces horizontalmente */
}

.iconos-enlace a {
    display: block; /* Cambiar a bloque para ocupar toda la línea */
    margin: 10px 0; /* Espacio vertical entre los enlaces */
    text-decoration: none; /* Quita el subrayado */
    color: #333; /* Color del texto */
}

.iconos-enlace ion-icon {
    margin-right: 5px; /* Espacio entre el icono y el texto */
    font-size: 20px; /* Tamaño del icono */
}

</style>