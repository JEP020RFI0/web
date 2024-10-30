<?php
// Incluir la conexión a la base de datos
include('../Controlador/conexion/conexion.php');
include('../Vista/sidebar.php');
// Consulta para obtener los usuarios
$sql = "SELECT idusuario, nombre, correo, contrasena FROM usuario";
$result = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Inicio Sesión|Registro</title>
    <link rel="stylesheet" href="../Vista/CSS/registrar.css">
    <link rel="shortcut icon" href="../Vista/Publico/Imagenes/FAVICON.ico" type="imge/x-icon">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@500&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Macondo&family=Mali:wght@500&family=Pangolin&family=Shantell+Sans:ital,wght@0,300;0,400;0,500;1,400&display=swap');

        .container {
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 90%;
            min-height: 450px;
            margin: 0 auto;
            padding: 20px;
            margin-right: 200px;
        }

        .password-container {
            position: relative; /* Posición relativa para el icono */
        }

        .toggle-password {
            position: absolute;
            right: 10px; /* Ajusta el espacio desde el borde derecho */
            top: 50%; /* Centra verticalmente */
            transform: translateY(-50%); /* Ajusta la posición del icono */
            cursor: pointer; /* Cambia el cursor al pasar sobre el icono */
            color: #aaa; /* Color del icono */
        }

        input[type="password"] {
            width: 100%; /* Ajusta el ancho del input */
            padding-right: 40px; /* Espacio para el icono */
        }

        /* Puedes agregar más estilos aquí */
    </style>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form id="signup-form" action="../Controlador/registro.php" method="POST">
                <h1>Crea tu cuenta</h1>
                <span>Crea una cuenta para disfrutar del contenido</span>
                <input type="text" placeholder="Nombre" required name="nombre">
                <input type="email" placeholder="Correo" required name="correo">
                <div class="password-container">
                    <input type="password" placeholder="Contraseña" required name="contrasena" id="signup-password">
                    <i class="fas fa-eye toggle-password" id="toggle-signup-password"></i>
                </div>
                <input type="hidden" value="usuario" name="perfil">
                <input type="hidden" value="estudiante" name="rol">
                <button type="submit">Regístrate</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form id="signin-form" action="../Controlador/iniciarsesion.php" method="POST">
                <h1>Inicia sesión</h1>
                <span>Inicia sesión con tu correo antes registrado</span>
                <input type="text" placeholder="Nombre" required name="nombre">
                <input type="email" placeholder="Correo" required name="correo">
                <div class="password-container">
                    <input type="password" placeholder="Contraseña" required name="contrasena" id="signin-password">
                    <i class="fas fa-eye toggle-password" id="toggle-signin-password"></i>
                </div>
                <input type="hidden" value="usuario" name="perfil">
                <input type="hidden" value="estudiante" name="rol">
                <button type="submit">Iniciar sesión</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>¡Bienvenido de nuevo!</h1>
                    <p>Inicia sesión con tus datos personales para utilizar todas las funciones del sitio</p>
                    <button class="ghost" id="login">Inicia sesión</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>¡Hola amigo!</h1>
                    <p>Regístrate con tus datos personales para utilizar todas las funciones del sitio correctamente.</p>
                    <button class="ghost" id="register">Regístrate</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../Vista/Publico//Js/ScriptLogin.js"></script>
    <script>
    // Funcionalidad para mostrar/ocultar contraseña
    document.getElementById('toggle-signup-password').addEventListener('click', function() {
        const passwordInput = document.getElementById('signup-password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye'); // Cambia a ojo abierto
        this.classList.toggle('fa-eye-slash'); // Cambia a ojo cerrado
    });

    document.getElementById('toggle-signin-password').addEventListener('click', function() {
        const passwordInput = document.getElementById('signin-password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye'); // Cambia a ojo abierto
        this.classList.toggle('fa-eye-slash'); // Cambia a ojo cerrado
    });
</script>


    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2024 Quimiclick. Todos los derechos reservados.</p>
            <p><a href="#">Términos de Servicio</a> | <a href="#">Política de Privacidad</a></p>
        </div>
    </footer>
    <style>
        .barra-lateral {
            margin-left: -1120px;
        }

        body {
            margin: 0;
            padding: 0;
            overflow-y: hidden;
        }

        .footer {
            margin-top: -18px; /* Mantén este margen si lo deseas */
            background-color: #0bc7e8; /* Color de fondo */
            text-align: center; /* Centrar el texto */
            position: relative; /* Posición relativa para el posicionamiento */
            bottom: -58; /* Alinear al fondo de la página */
            width: 100%; /* Ancho completo */
            padding: 10px;
            color: #252237; /* Color del texto */
            box-sizing: border-box; /* Asegúrate de que el padding no cause desbordamiento */
        }

        .footer-content {
            max-width: 800px; /* Ancho máximo para contenido */
            margin: 0 auto; /* Centrar el contenido sin causar scroll */
            font-size: 15px;
        }

        .footer p {
            margin: 0; /* Margen para los párrafos */
        }

        .footer a {
            color: #ac3846; /* Color de los enlaces */
            text-decoration: none; /* Sin subrayado */
            transition: color 0.3s ease; /* Transición suave al pasar el ratón */
        }

        .footer a:hover {
            color: #258790; /* Color de los enlaces al pasar el ratón */
            text-decoration: underline; /* Subrayar al pasar el ratón */
        }

        footer a {
            background-color: #0bc7e8;
        }

        footer p {
            background-color: #0bc7e8;
        }

        .password-container {
        position: relative; /* Posición relativa para el icono */
    }

    .toggle-password {
        position: absolute;
        right: 10px; /* Ajusta el espacio desde el borde derecho */
        top: 50%; /* Centra verticalmente */
        transform: translateY(-50%); /* Ajusta la posición del icono */
        cursor: pointer; /* Cambia el cursor al pasar sobre el icono */
        color: #aaa; /* Color del icono */
    }

    input[type="password"] {
        border: none;
        margin: 8px 0;
        padding: 10px 40px; /* Espacio para el icono, 40px a la derecha */
        font-size: 13px;
        border-radius: 8px;
        width: 100%; /* Asegura que el campo tenga un ancho completo */
        outline: none;
    }

    .toggle-password {
        color: #aaa; /* Color del icono por defecto */
        transition: color 0.3s; /* Suaviza el cambio de color */
    }

    .toggle-password:hover {
        color: #000; /* Color del icono al pasar el mouse */
    }

    /* Asegúrate de que el placeholder esté alineado a la izquierda */
    input::placeholder {
        text-align: left; /* Alinear el placeholder a la izquierda */
    }

    </style>
</body>

</html>
