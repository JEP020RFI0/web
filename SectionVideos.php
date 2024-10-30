<?php
session_start(); // Asegúrate de que session_start() esté al principio
// Inicializa las variables por defecto si no se han establecido en la sesión
$nombre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Invitado';
$correo = isset($_SESSION['correo']) ? $_SESSION['correo'] : 'No registrado';
$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : 'No asignado'; // Ajusta según tu lógica

// Aquí puedes inicializar el avatar
$avatar = isset($_SESSION['avatar']) ? $_SESSION['avatar'] : './Publico/Imagenes/FotoUsuario.png';  // Usa una imagen por defecto si no hay avatar
?>

<!--FAVICON DE LA PAGINA-->
<link rel="shortcut icon" href="../Vista/Publico/Imagenes/FAVICON.ico" type="imge/x-icon">
<link rel="stylesheet" href="../Vista/CSS/Style.css">
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<body>
    <div class="menu">
        <ion-icon name="menu-outline"></ion-icon>
        <ion-icon name="close-outline"></ion-icon>
    </div>

    <div class="barra-lateral">
    <div>
        <div class="nombre-pagina">
            <span>QuimiClick</span>
            <a href="Index.php"></a>
            <img id="logo" class="logo-img" src="../Vista/Publico/Imagenes/Logo_página-removebg-preview.png" alt="Logo">
        </div>
        <button class="boton" onclick="window.location.href='registrar.php'">
            <span>¡Atrévete!</span>
            <ion-icon name="add-outline"></ion-icon>
        </button>
    </div>

    <nav class="navegacion">
        <ul>
            <li>
                <a id="inbox" href="./Index.php">
                    <ion-icon name="home-outline"></ion-icon>
                    <span>INICIO</span>
                </a>
            </li>
            <li>
                <a href="./SectionVideos.php">
                    <ion-icon name="videocam-outline"></ion-icon>
                    <span>VIDEOS</span>
                </a>
            </li>
            <li>
                <a href="./SectionTemas.php">
                    <ion-icon name="list-outline"></ion-icon>
                    <span>TEMAS</span>
                </a>
            </li>
            <li>
                <a href="./SectionQuimiLecturas.php">
                    <div class="fun-book-icon">
                        <ion-icon name="book-outline"></ion-icon>
                        <div class="sparkles">
                            <div class="sparkle"></div>
                            <div class="sparkle"></div>
                            <div class="sparkle"></div>
                        </div>
                    </div>
                    <span>QUIMILECTURAS</span>
                </a>
            </li>
            <?php
            if (isset($_SESSION['rol']) && (strtolower($_SESSION['rol']) === 'estudiante' || strtolower($_SESSION['rol']) === 'docente' || strtolower($_SESSION['rol']) === 'administrador')) {
                echo '<li>
                <a href="./Actividades.php">
                    <ion-icon name="clipboard-outline"></ion-icon>
                    <span>ACTIVIDADES</span>
                </a>
                </li>';
                echo '<li>
                <a href="./SectionPonteAprueba.php">
                    <ion-icon name="medal-outline"></ion-icon>
                    <span>¡PONTE A PRUEBA!</span>
                </a>
                </li>';
            }
            ?>
            <?php
            if (isset($_SESSION['nombre'])) {
                echo '<li>
                <a href="../Vista/SectionPerfil.php">
                    <ion-icon name="person-outline"></ion-icon>
                    <span>PERFIL</span>
                </a>
                </li>';
            }
            if (isset($_SESSION['rol']) && (strtolower($_SESSION['rol']) === 'docente' || strtolower($_SESSION['rol']) === 'administrador')) {
                echo '<li>
                <a href="./SectionAgregarActividad.php">
                    <ion-icon name="document-attach-outline"></ion-icon>
                    <span>CREAR TAREAS</span>
                </a>
                </li>';
                echo '<li>
                <a href="./SectionRetosSubidos.php">
                    <ion-icon name="trophy-outline"></ion-icon>
                    <span>RETOS CREADOS</span>
                </a>
                </li>';
                echo '<li>
                <a href="./SectionAgregarReto.php">
                    <ion-icon name="create-outline"></ion-icon>
                    <span>CREAR RETO</span>
                </a>
                </li>';
            }
            if (isset($_SESSION['rol']) && strtolower($_SESSION['rol']) === 'administrador') {
                echo '<li>
                <a href="./SectionAdmin.php">
                    <ion-icon name="cog-outline"></ion-icon>
                    <span>VISTA ADMIN</span>
                </a>
                </li>';
            }
            ?>
            <li>
                <a href="../Vista/SectionContactanos.php">
                    <ion-icon name="call-outline"></ion-icon>
                    <span>CONTACTANOS</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="linea"></div>

    <div class="switch">
        <div class="base">
            <div class="circulo"></div>
        </div>
    </div>

    <div class="usuario">
        <a href="../Vista/SectionPerfil.php">
            <img src="<?php echo isset($_SESSION['avatar']) && !empty($_SESSION['avatar']) ? $_SESSION['avatar'] : '../Vista/Publico/Imagenes/IMGUSER.png'; ?>" alt="Foto del usuario" class="foto-perfil">
        </a>
        <div class="info-usuario">
            <div class="nombre-email">
                <span class="nombre">
                    <?php
                    $nombreCompleto = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Inicia sesión';
                    $primerNombre = explode(" ", $nombreCompleto)[0];
                    echo !empty($primerNombre) ? $primerNombre : 'Inicia sesión';
                    ?>
                </span>
                <span class="email"><?php echo isset($_SESSION['correo']) && !empty($_SESSION['correo']) ? $_SESSION['correo'] : 'Correo no disponible'; ?></span>
                <span class="rol"><?php echo isset($_SESSION['rol']) && !empty($_SESSION['rol']) ? $_SESSION['rol'] : 'Rol no disponible'; ?></span>
            </div>
        </div>
    </div>
</div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@500&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Macondo&family=Mali:wght@500&family=Pangolin&family=Shantell+Sans:ital,wght@0,300;0,400;0,500;1,400&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;

        }


        .barra-lateral.mini-barra-lateral ion-icon {
            padding-left: 5px;
        }

        .barra-lateral {
            margin-left: -1120px;
        }

        .barra-lateral.mini-barra-lateral {
            margin-right: 180px;

        }

        .barra-lateral {
            position: fixed;
        }

        .barra-lateral .usuario {
            width: 100%;
            display: flex;
        }

        .barra-lateral .usuario img {
            width: 70px;
            min-width: 20px;
            border-radius: 10px;
            margin-top: 10px;
            margin-left: -10px;
        }

        .barra-lateral .usuario .info-usuario {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: var(--color-texto);
            overflow: hidden;
        }

        .barra-lateral .usuario .nombre-email {
            width: 90%;
            display: flex;
            flex-direction: column;
            margin-left: 5px;
        }

        .barra-lateral .usuario .nombre {
            font-size: 15px;
            font-weight: 100;
        }

        .barra-lateral .usuario .email {
            font-size: 13px;
        }

        .barra-lateral .usuario ion-icon {
            font-size: 10px;
        }

        .barra-lateral.mini-barra-lateral img#logo {
            margin-left: -10px;
            margin-right: 25px;
            margin-top: 20px;
            width: 80px;

        }

        img#logo{
            margin-top: 30px;
        }

        .barra-lateral .nombre-pagina {
            width: 100%;
            height: 45px;
            color: var(--color-texto);
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        /* Estilos para cuando la barra lateral está minimizada */
        .barra-lateral.mini-barra-lateral span {
            display: none;
            /* Oculta todos los textos cuando la barra está minimizada */
        }

        .barra-lateral span {
            transition: opacity 0.5s ease, width 0.5s ease;
        }

        .barra-lateral.mini-barra-lateral .boton span {
            display: none;
            /* Oculta el texto del botón "¡Atrévete!" */
        }

        .barra-lateral.mini-barra-lateral .logo-img {
            width: 50px;
            /* Ajusta el tamaño del logo en versión mini */
            margin-left: 10px;
            margin-right: 0;
        }

        .barra-lateral.mini-barra-lateral .boton ion-icon {
            font-size: 24px;
            /* Asegúrate de que el ícono sea visible */
            margin: 0 auto;
            /* Centrar el ícono */
        }
    </style>
    <style>
        .fun-book-icon {
            position: relative;
            display: inline-block;
            animation: book-flip 1.5s infinite ease-in-out;
        }

        @keyframes book-flip {

            0%,
            100% {
                transform: rotateY(0);
            }

            50% {
                transform: rotateY(180deg);
            }
        }

        .sparkles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .sparkle {
            position: absolute;
            background-color: yellow;
            border-radius: 50%;
            width: 4px;
            height: 4px;
            opacity: 0;
            animation: sparkle-animation 1.5s infinite ease-in-out;
        }

        @keyframes sparkle-animation {

            0%,
            100% {
                opacity: 0;
                transform: scale(0);
            }

            50% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .sparkle:nth-child(1) {
            top: 20%;
            left: 20%;
            animation-delay: 0.2s;
        }

        .sparkle:nth-child(2) {
            top: 50%;
            left: 80%;
            animation-delay: 0.5s;
        }

        .sparkle:nth-child(3) {
            top: 80%;
            left: 40%;
            animation-delay: 0.8s;
        }

        /* Cambia el tamaño de todos los ion-icon en la barra lateral */
        .barra-lateral ion-icon {
            font-size: 20px;
            /* Ajusta el valor según el tamaño deseado */
            margin-right: 20px;
            margin-left: 10px;
        }
    </style>

</body>

</html>
<script>
    const logo = document.getElementById("logo");
    const barraLateral = document.querySelector(".barra-lateral");
    const spans = document.querySelectorAll(".barra-lateral span"); // Asegúrate de seleccionar solo los spans dentro de la barra lateral
    const palanca = document.querySelector(".switch");
    const circulo = document.querySelector(".circulo");
    const menu = document.querySelector(".menu");
    const main = document.querySelector("main");

    // Event listener para abrir/cerrar el menú lateral
    menu.addEventListener("click", () => {
        barraLateral.classList.toggle("max-barra-lateral");

        // Verificar si la barra está cerrada
        if (barraLateral.classList.contains("max-barra-lateral")) {
            menu.children[0].style.display = "none"; // Oculta el ícono de estado cerrado
            menu.children[1].style.display = "block"; // Muestra el ícono de estado abierto
        } else {
            menu.children[0].style.display = "block"; // Muestra el ícono de estado abierto
            menu.children[1].style.display = "none"; // Oculta el ícono de estado cerrado
            barraLateral.classList.add("closed-sidebar"); // Añadir clase de barra cerrada
        }

        // Lógica para pantallas móviles
        if (window.innerWidth <= 320) {
            barraLateral.classList.add("mini-barra-lateral");
            main.classList.add("min-main");
            spans.forEach((span) => {
                span.classList.add("oculto"); // Oculta los spans al cerrar
            });
        } else {
            // Oculta los spans si no es vista móvil
            spans.forEach((span) => {
                if (barraLateral.classList.contains("mini-barra-lateral")) {
                    span.classList.add("oculto"); // Ocultar cuando está cerrado
                } else {
                    span.classList.remove("oculto"); // Mostrar cuando está abierto
                }
            });
        }
    });

    // Event listener para el switch de modo oscuro
    palanca.addEventListener("click", () => {
        let body = document.body;
        body.classList.toggle("dark-mode");
        circulo.classList.toggle("prendido");
    });

    // Event listener para el logo que abre/cierra el menú lateral
    logo.addEventListener("click", () => {
        barraLateral.classList.toggle("mini-barra-lateral");
        main.classList.toggle("min-main");

        // Alternar la clase 'oculto' en los spans al abrir/cerrar la barra
        spans.forEach((span) => {
            if (barraLateral.classList.contains("mini-barra-lateral")) {
                span.classList.add("oculto"); // Ocultar si está cerrado
            } else {
                span.classList.remove("oculto"); // Mostrar si está abierto
            }
        });
    });

    // DOM Content Loaded para manejar clics en el botón de registro
    document.addEventListener("DOMContentLoaded", function() {
        const registroBtn = document.getElementById(".boton");

        if (registroBtn) {
            registroBtn.addEventListener("click", function() {
                console.log("Current URL:", window.location.href);
                window.location.href = "../../../Vista/registrar.php";
            });
        } else {
            console.error("Button not found");
        }
    });

    // Event listener para el icono de menú que alterna la lista del menú
    const menuIcon = document.getElementById("menu-icon");
    const menuList = document.getElementById("menu-list");

    menuIcon.addEventListener("click", () => {
        menuList.classList.toggle("hidden");
    });


    // Función para manejar el estado de la barra lateral
    function toggleBarraLateral() {
        barraLateral.classList.toggle("mini-barra-lateral");

        // Alternar la visibilidad de los textos
        spans.forEach(span => {
            if (barraLateral.classList.contains("mini-barra-lateral")) {
                span.style.display = 'none'; // Oculta los textos
            } else {
                span.style.display = 'inline'; // Muestra los textos
            }
        });

        // Manejar el botón "¡Atrévete!"
        botonesSpan.forEach(span => {
            if (barraLateral.classList.contains("mini-barra-lateral")) {
                span.style.display = 'none'; // Oculta el texto del botón
            } else {
                span.style.display = 'inline'; // Muestra el texto del botón
            }
        });
    }

    // Añade el listener para abrir/cerrar la barra lateral
    document.querySelector(".menu").addEventListener("click", toggleBarraLateral);
</script>
<style>
    .barra-lateral{
        margin-left: -5px;
        margin-top: -0px;
    }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuimiClick - Videos</title>
    <link rel="stylesheet" href="./CSS/SectionVideos.css">
    <link rel="shortcut icon" href="./Publico/Imagenes/FAVICON.ico"
    type="imge/x-icon">
</head>

<style>
    body{
        font-family: 'Outfit'sans-serif
    }
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@500&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Macondo&family=Mali:wght@500&family=Pangolin&family=Shantell+Sans:ital,wght@0,300;0,400;0,500;1,400&display=swap');


.nav-bar {
    background-color: rgba(148, 141, 141, 0.541);
    padding: 15px 15px;
    text-align: center; /* Centra el contenido */
    border-radius: 8px; /* Bordes redondeados */
    box-shadow: 0 4px 4px rgba(207, 198, 198, 0.1); /* Sombra sutil */
    margin-bottom: 20px; /* Espacio inferior */
    font-family: Arial, Helvetica, sans-serif;
}

.nav-bar ul {
    list-style-type: none; /* Elimina los puntos de la lista */
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: center; /* Centra los elementos en la barra de navegación */
}

.nav-bar ul li {
    margin: 0 15px; /* Espaciado entre los elementos del menú */
}

.nav-bar ul li a {
    text-decoration: none; /* Elimina el subrayado del enlace */
    color: #fff; /* Color del texto blanco */
    font-size: 18px; /* Tamaño de la fuente */
    font-weight: bold; /* Fuente en negrita */
    padding: 10px 20px; /* Relleno alrededor del texto */
    border-radius: 5px; /* Bordes redondeados */
    transition: background-color 0.3s ease; /* Transición suave para el fondo */
    font-weight: 100;
}

.nav-bar ul li a:hover {
    background-color: #BF2A45; /* Cambia el color de fondo al pasar el ratón */
}

/* Estilos previos y estilos de nav-bar aquí... */

#video-content {
    margin-top: 20px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
}

.video-card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-bottom: 20px;
    width: 30%;
    text-align: center;
}

.video-card iframe {
    width: 100%;
    height: 200px;
    border-radius: 8px;
}

.video-card h3 {
    margin-top: 15px;
    font-size: 18px;
    color: #333;
    font-weight: 100;
}
h2{
    margin-top: 100px;
    margin-bottom: 50px;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 30px;
}
</style>
<body>
    <main>
<nav class="nav-bar">
        <ul>
            <li><a href="#" onclick="loadVideos('periodo1')">Periodo 1</a></li>
            <li><a href="#" onclick="loadVideos('periodo2')">Periodo 2</a></li>
            <li><a href="#" onclick="loadVideos('periodo3')">Periodo 3</a></li>
            <li><a href="#" onclick="loadVideos('extras')">Videos extra</a></li>
        </ul>
    </nav>
    <div id="video-content">
        <!-- Aquí se cargarán los videos dinámicamente -->
    </div>
<script>
    function loadVideos(period) {
    const videoContent = document.getElementById('video-content');
    let videosHTML = '';

    if (period === 'periodo1') {
        videosHTML = `
            <div class="video-card">
                <iframe src="https://www.youtube.com/embed/mbtK9Khf9AU" frameborder="0" allowfullscreen></iframe>
                <h3>Video 1: Introducción a la Química</a></h3>
            </div>
            <div class="video-card">
                <iframe src="https://www.youtube.com/embed/hzw_h87wL2E" frameborder="0" allowfullscreen></iframe>
                <h3>Video 2: La Materia y Sus Propiedades</a></h3>
            </div>
            <div class="video-card">
                <iframe src="https://www.youtube.com/embed/8KM8ysFtEOU" frameborder="0" allowfullscreen></iframe>
                <h3>Video 3: Estructura Atómica</a></h3>
            </div>
            <div class="video-card">
                <iframe src="https://www.youtube.com/embed/zodrbhLMFDY" frameborder="0" allowfullscreen></iframe>
                <h3>Video 4: Enlaces Químicos</a></h3>
            </div>
            <div class="video-card">
                <iframe src="https://www.youtube.com/embed/PKS22hWZfKU" frameborder="0" allowfullscreen></iframe>
                <h3>Video 5: Reacciones Químicas</a></h3>
            </div>
            <div class="video-card">
                <iframe src="https://www.youtube.com/embed/Dq40Vs0aTi8" frameborder="0" allowfullscreen></iframe>
                <h3>Video 6: Leyes de la Química</a></h3>
            </div>
            <div class="video-card">
                <iframe src="https://www.youtube.com/embed/o5n-Ok8vdgE" frameborder="0" allowfullscreen></iframe>
                <h3>Video 7: Estequiometría</a></h3>
            </div>
            <div class="video-card">
                <iframe src="https://www.youtube.com/embed/Bvfn6eUhUAc" frameborder="0" allowfullscreen></iframe>
                <h3>Video 8: Termodinámica Química</a></h3>
            </div>
        `;
    } else if (period === 'periodo2') {
        videosHTML = `
            <div class="video-card">
                <iframe src="https://www.youtube.com/embed/ducBHqyNjNg/ frameborder="0" allowfullscreen></iframe>
                <h3>Video 1: Propiedades de los Gases</a></h3>
            </div>
            <div class="video-card">
                <iframe src="https://www.youtube.com/embed/ReiGO17SH4g" frameborder="0" allowfullscreen></iframe>
                <h3>Video 2: Soluciones y Concentraciones</a></h3>
            </div>
            <div class="video-card">
                <iframe src="https://www.youtube.com/embed/DbJJsf2qsFM" frameborder="0" allowfullscreen></iframe>
                <h3>Video 3: Reacciones de Óxido-Reducción</a></h3>
            </div>
            <div class="video-card">
                <iframe src="https://www.youtube.com/embed/GpcblwWnFWk" frameborder="0" allowfullscreen></iframe>
                <h3>Video 4: Equilibrio Químico</a></h3>
            </div>
            <div class="video-card">
                <iframe src="https://www.youtube.com/embed/SmCVbb__SVE" frameborder="0" allowfullscreen></iframe>
                <h3>Video 5: Ácidos y Bases</a></h3>
            </div>
            <div class="video-card">
                <iframe src="https://www.youtube.com/embed/Bvfn6eUhUAc" frameborder="0" allowfullscreen></iframe>
                <h3>Video 6: Termodinámica Química Avanzada</a></h3>
            </div>
            <div class="video-card">
                <iframe src="https://www.youtube.com/embed/J0j61P_ok5Y" frameborder="0" allowfullscreen></iframe>
                <h3>Video 7: Cinética Química</a></h3>
            </div>
            <div class="video-card">
                <iframe src="https://www.youtube.com/embed/vqGUvocEYAI" frameborder="0" allowfullscreen></iframe>
                <h3>Video 8: Química Orgánica Básica</a></h3>
            </div>
        `;
    } else if (period === 'periodo3') {
        videosHTML = `
            <div class="video-card">
                <iframe src="https://www.youtube.com/embed/F0LC1EdZY6s" frameborder="0" allowfullscreen></iframe>
                <h3>Video 1: Química de Polímeros</a></h3>
            </div>
            <div class="video-card">
                <iframe src="https://www.youtube.com/embed/aHQzxYeCS7E" frameborder="0" allowfullscreen></iframe>
                <h3>Video 2: Compuestos Orgánicos</a></h3>
            </div>
            <div class="video-card">
                <iframe src="https://www.youtube.com/embed/uIDA8HjrSM8" frameborder="0" allowfullscreen></iframe>
                <h3>Video 3: Reacciones Química Ambiental</a></h3>
            </div>
            <div class="video-card">
                <iframe src="https://www.youtube.com/embed/Cw0LcuPgohg" frameborder="0" allowfullscreen></iframe>
                <h3>Video 4: Química en la Vida Cotidiana</a></h3>
            </div>
            <div class="video-card">
                <iframe src="https://www.youtube.com/embed/GGHsuEtZAS0" frameborder="0" allowfullscreen></iframe>
                <h3>Video 5: Futuro de la Química</a></h3>
            </div>
        `;
    } else if (period === 'extras') {
        videosHTML = `
            <div class="video-card">
                <iframe src="https://www.youtube.com/embed/z11_ICGemu8" frameborder="0" allowfullscreen></iframe>
                <h3>Video 1: Experimentos Químicos Divertidos</a></h3>
            </div>
            <div class="video-card">
                <iframe src="https://www.youtube.com/embed/pDh7-uP0iOo" frameborder="0" allowfullscreen></iframe>
                <h3>Video 2: La Historia de la Química</a></h3>
            </div>
            <div class="video-card">
                <iframe src="https://www.youtube.com/embed/knumN1z4uhg" frameborder="0" allowfullscreen></iframe>
                <h3>Video 3: Química en la Industria</a></h3>
        `;
    }

    videoContent.innerHTML = videosHTML;
}

window.onload = function() {
    loadVideos('periodo1');
}
</script>
    </main>
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2024 Quimiclick. Todos los derechos reservados.</p>
            <p><a href="#">Términos de Servicio</a> | <a href="#">Política de Privacidad</a></p>
        </div>
    </footer>

    <style>
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
            max-width: 800px;
            /* Ancho máximo para contenido */
            margin-left: 400px;
            font-size: 15px;
        }

    .footer p {
        margin: 0;
        font-family: 'Outfit'sans-serif;
    }

    .footer a {
        color: #ac3846;
        text-decoration: none;
        transition: color 0.3s ease;
        font-family: 'Outfit'sans-serif;
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
