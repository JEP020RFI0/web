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
<?php
// Función para determinar el género basado en el nombre
function determinarGenero($nombre) {
    $nombre = strtolower(trim($nombre));
    if (substr($nombre, -1) == 'a') {
        return 'femenino';
    } else {
        return 'masculino';
    }
}

// Array de mensajes
$mensajes = [
    "masculino" => [
        "¡Hola, {nombre}! Estás haciendo un gran trabajo.",
        "¡Saludos, {nombre}! ¿Listo para aprender hoy?",
        "¡Hola, {nombre}! ¡Que tengas un día productivo!",
        "¡Hola, {nombre}! ¡Vamos a conquistar la química!",
        "¡Hola, {nombre}! ¿Listo para nuevos desafíos?",
        "¡Hola, {nombre}! ¿Preparado para brillar en tus estudios?",
        "¡Hola, {nombre}! Aquí para ayudarte a alcanzar tus metas.",
        "¡Hola, {nombre}! Tu esfuerzo está a punto de dar frutos.",
        "¡Hola, {nombre}! ¡Sigamos avanzando juntos en el aprendizaje!"
    ],
    "femenino" => [
        "¡Hola, {nombre}! Estás haciendo un gran trabajo.",
        "¡Saludos, {nombre}! ¿Lista para aprender hoy?",
        "¡Hola, {nombre}! ¡Que tengas un día productivo!",
        "¡Hola, {nombre}! ¡Vamos a conquistar la química!",
        "¡Hola, {nombre}! ¿Lista para nuevos desafíos?",
        "¡Hola, {nombre}! ¿Preparada para brillar en tus estudios?",
        "¡Hola, {nombre}! Aquí para ayudarte a alcanzar tus metas.",
        "¡Hola, {nombre}! Tu esfuerzo está a punto de dar frutos.",
        "¡Hola, {nombre}! ¡Sigamos avanzando juntos en el aprendizaje!"
    ]
];

// Determinar el género del usuario
$genero = "masculino"; // Por defecto
if (isset($_SESSION['nombre']) && !empty($_SESSION['nombre'])) {
    $nombreParts = explode(' ', $_SESSION['nombre']);
    $genero = determinarGenero($nombreParts[0]);
} 

// Elegir un mensaje al azar según el género
$mensajeElegido = $mensajes[$genero][array_rand($mensajes[$genero])];

// Reemplazar el marcador {nombre} con el nombre real del usuario
if (isset($_SESSION['nombre']) && !empty($_SESSION['nombre'])) {
    $mensajeElegido = str_replace("{nombre}", htmlspecialchars($nombreParts[0]), $mensajeElegido);
} else {
    $mensajeElegido = str_replace("{nombre}", "usuario", $mensajeElegido);
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Perfil</title>
    <link rel="stylesheet" href="../Vista/CSS/SectionPerfil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Include Font Awesome -->
    <link rel="shortcut icon" href="../Vista/Publico/Imagenes/FAVICON.ico" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@500&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Macondo&family=Mali:wght@500&family=Pangolin&family=Shantell+Sans:ital,wght@0,300;0,400;0,500;1,400&display=swap');

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
    height: 100vh; /* Mantener altura de vista completa */
    overflow: hidden; /* Evitar scroll */
}

.container {
    background-color: #fff;
    border-radius: 30px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
    position: absolute;
    width: 768px;
    max-width: 90%;
    min-height: auto;
    margin: 20px 0;
    padding: 30px 5px 10px; /* Aumenta el padding superior para bajar el contenido */
    text-align: center;
    margin-left: 100px;
    margin-top: -15px;

}



        .profile-images {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .image-container {
            position: relative;
        }

        .profile-option {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            cursor: pointer;
            transition: transform 0.3s ease, border 0.3s ease;
            border: 5px solid transparent;
        }

        .profile-option:hover {
            transform: scale(1.1);
        }

        /* Style for selected image */
        .profile-option.selected {
            border: 5px solid  #0bc7e8;
        }

        h1, h2 {
            color: #333;
        }

        h2 {
            margin-top: 10px;
        }

        /* Form styles */
        form {
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-group {
            margin-bottom: 15px;
            width: 100%;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 80%;
            padding: 10px 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
            outline: none;
            background-color: #eee;
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

        .container-hero {
            background-color: rgba(214, 208, 208, 0.541);
            padding: 20px 0;
        }

        .nombre-pagina h1 {
            color: black;
        }

        .logo-img {
            width: 70px;
            height: auto;
            margin-left: 156px;
            padding-top: 20px;
        }

        .logout-icon {
    font-size: 34px; /* Ajusta el tamaño del icono según sea necesario */
    color: #333; /* Cambia el color del icono según tu diseño */
    cursor: pointer; /* Cambia el cursor a puntero */
    position: fixed; /* Fija el icono en su posición */
    top: 20px; /* Ajusta la distancia desde la parte superior */
    right: 80px; /* Ajusta la distancia desde el lado derecho */
    z-index: 1000; /* Asegúrate de que el icono esté por encima de otros elementos */
    color: #ac3846;
}


        .logout-icon:hover {
            transform: scale(1.2); 
        }

        .welcome-message  {
            position: absolute;
            right: 200px; /* Adjust the position according to your design */
            top: 20px;
            font-size: 20px;
            font-weight: 400;
        }
        .logo-img{
            margin-top: 20px;
            width: 80px;
        }

        .barra-lateral.mini-barra-lateral img#logo {
            margin-left: -10px;
            margin-right: 25px;
            margin-bottom: -15px;
            width: 80px;
        }

        .mensaje {
            color: black;
            font-size: 18px;
            font-weight: 100;
            position: fixed;
            top: 0; 
            left: 300px;
            width: 100%; 
            text-align:center; 
            padding: 10px; 
            margin-bottom: 200px;
        }

    </style>
</head>
<body>

<form action="../Vista/cierresesion.php" method="POST" style="display: inline;">
    <i class="fas fa-sign-out-alt logout-icon" onclick="this.closest('form').submit();"></i>
</form> 
<div class="container">
<div class="mensaje">
        <?php echo $mensajeElegido; ?>
    </div>
    <h1>Elige tu avatar</h1>
    <div class="profile-images">
        <div class="image-container">
            <img src="./Publico/Imagenes/avatar-1.png" alt="Perfil 1" class="profile-option" onclick="selectProfile(this)">
        </div>
        <div class="image-container">
            <img src="./Publico/Imagenes/avatar-2.png" alt="Perfil 2" class="profile-option" onclick="selectProfile(this)">
        </div>
        <div class="image-container">
            <img src="./Publico/Imagenes/avatar-3.png" alt="Perfil 3" class="profile-option" onclick="selectProfile(this)">
        </div>
        <div class="image-container">
            <img src="./Publico/Imagenes/avatar-4.png" alt="Perfil 4" class="profile-option" onclick="selectProfile(this)">
        </div>
    </div>

    <form action="../Controlador/procesar_perfil.php" method="POST" id="perfilForm">
        <input type="hidden" name="avatar" id="avatar" value="">
        <div class="form-group">
            <input type="text" name="nombre" placeholder="Nombre" value="<?php echo htmlspecialchars($_SESSION['nombre']); ?>" required>
        </div>
        <div class="form-group">
            <input type="email" name="correo" placeholder="Correo electrónico" value="<?php echo htmlspecialchars($_SESSION['correo']); ?>" required>
        </div>
        <div class="form-group">
            <input type="password" name="contrasena" placeholder="Actualiza tu contraseña (Opcional)">
        </div>
        <button type="submit" class="btn-actualizar">Actualizar Perfil</button>
    </form>
</div>

<script>
function selectProfile(image) {
    // Clear the previous selection
    const options = document.querySelectorAll('.profile-option');
    options.forEach(option => option.classList.remove('selected'));

    // Mark the selected image
    image.classList.add('selected');

    // Update the hidden field value
    document.getElementById('avatar').value = image.src;
}

// Validate that an avatar has been selected before submitting the form
document.getElementById('perfilForm').addEventListener('submit', function(event) {
    const avatarValue = document.getElementById('avatar').value;

    if (avatarValue === "") {
        event.preventDefault(); // Prevent form submission
        Swal.fire({
            title: 'Error',
            text: 'Por favor, selecciona un avatar antes de continuar.',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
    }
});
</script>
<footer class="footer">
            <div class="footer-content">
                <p>&copy; 2024 Quimiclick. Todos los derechos reservados.</p>
                <p><a href="#">Términos de Servicio</a> | <a href="#">Política de Privacidad</a></p>
            </div>
        </footer>

        <style>
            .footer {
                margin-top: 10px;
                background-color: #0bc7e8;
                text-align: center;
                width: -98%;
                padding: 10px;
                color: #252237;     
                position: absolute;
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
