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

    *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Outfit', sans-serif;

}
.barra-lateral.mini-barra-lateral ion-icon{
    padding-left: 5px;
}
    .barra-lateral{
        margin-left: -5px;
    }
    .barra-lateral.mini-barra-lateral {
    margin-right: 170px;

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
        margin-right: 20px;
        margin-bottom: -15px;
        width: 80px;
        
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
    display: none;  /* Oculta todos los textos cuando la barra está minimizada */
}

.barra-lateral span{
    transition: opacity 0.5s ease, width 0.5s ease;
}
.barra-lateral.mini-barra-lateral .boton span {
    display: none;  /* Oculta el texto del botón "¡Atrévete!" */
}

.barra-lateral.mini-barra-lateral .logo-img {
    width: 50px;  /* Ajusta el tamaño del logo en versión mini */
    margin-left: 10px;
    margin-right: 0;
}

.barra-lateral.mini-barra-lateral .boton ion-icon {
    font-size: 24px; /* Asegúrate de que el ícono sea visible */
    margin: 0 auto;  /* Centrar el ícono */
}

</style>

<style>  
    .fun-book-icon {
        position: relative;
        display: inline-block;
        animation: book-flip 1.5s infinite ease-in-out;
    }

    @keyframes book-flip {
        0%, 100% { transform: rotateY(0); }
        50% { transform: rotateY(180deg); }
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
        0%, 100% { opacity: 0; transform: scale(0); }
        50% { opacity: 1; transform: scale(1); }
    }

    .sparkle:nth-child(1) { top: 20%; left: 20%; animation-delay: 0.2s; }
    .sparkle:nth-child(2) { top: 50%; left: 80%; animation-delay: 0.5s; }
    .sparkle:nth-child(3) { top: 80%; left: 40%; animation-delay: 0.8s; }

/* Cambia el tamaño de todos los ion-icon en la barra lateral */
.barra-lateral ion-icon {
    font-size: 20px; /* Ajusta el valor según el tamaño deseado */
    margin-right: 20px;
    margin-left: 10px;
}


</style>

</body>
</html>
<script>
const logo = document.getElementById("logo");
const barraLateral = document.querySelector(".barra-lateral");
const spans = document.querySelectorAll(".barra-lateral span");  // Asegúrate de seleccionar solo los spans dentro de la barra lateral
const palanca = document.querySelector(".switch");
const circulo = document.querySelector(".circulo");
const menu = document.querySelector(".menu");
const main = document.querySelector("main");

// Event listener para abrir/cerrar el menú lateral
menu.addEventListener("click", () => {
    barraLateral.classList.toggle("max-barra-lateral");

    // Verificar si la barra está cerrada
    if (barraLateral.classList.contains("max-barra-lateral")) {
        menu.children[0].style.display = "none";  // Oculta el ícono de estado cerrado
        menu.children[1].style.display = "block";  // Muestra el ícono de estado abierto
    } else {
        menu.children[0].style.display = "block";  // Muestra el ícono de estado abierto
        menu.children[1].style.display = "none";   // Oculta el ícono de estado cerrado
        barraLateral.classList.add("closed-sidebar");  // Añadir clase de barra cerrada
    }

    // Lógica para pantallas móviles
    if (window.innerWidth <= 320) {
        barraLateral.classList.add("mini-barra-lateral");
        main.classList.add("min-main");
        spans.forEach((span) => {
            span.classList.add("oculto");  // Oculta los spans al cerrar
        });
    } else {
        // Oculta los spans si no es vista móvil
        spans.forEach((span) => {
            if (barraLateral.classList.contains("mini-barra-lateral")) {
                span.classList.add("oculto");  // Ocultar cuando está cerrado
            } else {
                span.classList.remove("oculto");  // Mostrar cuando está abierto
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
            span.classList.add("oculto");  // Ocultar si está cerrado
        } else {
            span.classList.remove("oculto");  // Mostrar si está abierto
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
            span.style.display = 'none';  // Oculta los textos
        } else {
            span.style.display = 'inline';  // Muestra los textos
        }
    });

    // Manejar el botón "¡Atrévete!"
    botonesSpan.forEach(span => {
        if (barraLateral.classList.contains("mini-barra-lateral")) {
            span.style.display = 'none';  // Oculta el texto del botón
        } else {
            span.style.display = 'inline';  // Muestra el texto del botón
        }
    });
}

// Añade el listener para abrir/cerrar la barra lateral
document.querySelector(".menu").addEventListener("click", toggleBarraLateral);

</script>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuimiLecturas</title>
    <!-- FAVICON DE LA PAGINA -->
    <link rel="shortcut icon" href="./Publico/Imagenes/FAVICON.ico" type="image/x-icon">
</head>
<body>
    <main>
    <div class="lecturas-container">
            <!-- Primera carta -->
            <a href="https://academia.utp.edu.co/quimica2/files/2018/09/quc3admica-la-ciencia-central-brown.pdf" target="_blank" class="no-underline">
                <div class="card-lectura">
                    <img src="./Publico/Imagenes/Lectura1.webp" alt="Química: La Ciencia Central">
                    <h2>Química: La Ciencia Central</h2>
                    <h3>Autor: Brown, LeMay y Bursten</h3>
                    <h4>Capítulos recomendados</h4>
                    <ul>
                        <li>Estructura atómica</li>
                        <li>Configuración electrónica</li>
                        <li>Tabla periódica y propiedades periódicas</li>
                    </ul>
                </div>
            </a>
                        <!-- Segunda carta (actualizada) -->
                        <a href="https://sacaba.gob.bo/images/wsacaba/pdf/libros/quimica/Chang-QuimicaGeneral7thedicion.pdf" target="_blank" class="no-underline">
                <div class="card-lectura">
                    <img src="./Publico/Imagenes/Lectura2.webp" alt="Química - Raymond Chang">
                    <h2>Química</h2>
                    <h3>Autor: Raymond Chang</h3>
                    <h4>Capítulos recomendados</h4>
                    <ul>
                        <li>Fundamentos de la química</li>
                        <li>Reacciones químicas</li>
                        <li>Estequiometría</li>
                    </ul>
                </div>
            </a>
                <!-- Tercera carta -->
                <a href="https://webooks.co/images/team/academicos/quimica/8.Paulayurkanis-quimicaorganica.pdf" target="_blank" class="no-underline">
                <div class="card-lectura">
                    <img src="./Publico/Imagenes/Lectura.jpeg" alt="Química Orgánica de Bruice">
                    <h2>Química Orgánica</h2>
                    <h3>Autor: Paula Yurkanis Bruice</h3>
                    <h4>Capítulos recomendados</h4>
                    <ul>
                        <li>Estructura y enlace</li>
                        <li>Reacciones de compuestos orgánicos</li>
                        <li>Espectroscopía</li>
                    </ul>
                </div>
            </a>
            <!--Tercera carta -->
            <a href="https://tuylaquimica.wordpress.com/wp-content/uploads/2018/04/quimica-inorganica-4ta-edicic3b3n-atkins.pdf" target="_blank" class="no-underline">
                <div class="card-lectura">
                    <img src="./Publico/Imagenes/Lectura 5.jpg" alt="Química Inorgánica">
                    <h2>Química Inorgánica</h2>
                    <h3>Autor: Shriver y Atkins</h3>
                    <h4>Capítulos recomendados</h4>
                    <ul>
                        <li>Enlaces metálicos</li>
                        <li>Compuestos de coordinación</li>
                        <li>Química de los metales de transición</li>
                    </ul>
                </div>
            </a>
            <style>
                @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@500&display=swap');
                @import url('https://fonts.googleapis.com/css2?family=Macondo&family=Mali:wght@500&family=Pangolin&family=Shantell+Sans:ital,wght@0,300;0,400;0,500;1,400&display=swap');

                .no-underline {
                    text-decoration: none;
                    /* Elimina la línea debajo del enlace */
                }

                .card-lectura {
                    display: inline-block;
                    /* Asegúrate de que la carta sea un bloque en línea para que el enlace funcione */
                }

                li {
                    font-family: Arial, Helvetica, sans-serif;
                    color: #000000;
                }

                /* Título con logo */
                h1 {
                    margin: 0;
                    /* Eliminar todos los márgenes */
                    font-family: 'Pangolin', sans-serif;
                    color: #000000;
                    /* Color más oscuro */
                    font-size: 32px;
                    /* Tamaño mayor para el título */
                    text-decoration: none;
                    /* Sin subrayado */
                }

                .title-container {
                    display: flex;
                    align-items: center;
                    /* Alinear verticalmente */
                    justify-content: flex-start;
                    /* Alinear hacia la izquierda */
                    max-width: 1100px;
                    margin: auto;
                    padding: 20px 0;
                    /* Solo un padding vertical */
                }

                .title-text {
                    font-size: 24px;
                    /* Título de la sección */
                    font-weight: 600;
                    line-height: 1.16667;
                    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
                    color: #000000;
                }

                .logo-img {
                    width: 90px;
                    /* Cambia el valor según tus necesidades */
                    height: auto;
                    /* Esto mantiene la proporción original */
                    margin-left: 10px;
                    /* Espaciado entre el logo y el h1, ajusta según sea necesario */
                    margin-bottom: 0;
                    /* Eliminar margen inferior */
                    cursor: pointer;
                    transition: margin-left 0.5s ease;
                    /* Agrega una transición suave para el margen izquierdo */
                    margin-top: 0;
                    /* Eliminar margen superior */
                }

                p {
                    margin-top: -20px;
                    margin-bottom: -50px;
                    font-size: 20px;
                    font-family: Arial, Helvetica, sans-serif;
                    text-align: center;
                    margin: auto 10px;
                }

                /* Estilos para el contenedor de las lecturas */
                .lecturas-container {
                    display: flex;
                    flex-wrap: wrap;
                    /* Permitir que las cartas se muevan a la siguiente línea */
                    justify-content: center;
                    /* Centrar horizontalmente */
                    margin: 0 auto;
                    /* Centrar el contenedor */
                    padding: 20px;
                    /* Agregar espacio interno al contenedor */
                    max-width: 1200px;
                    /* Ancho máximo */
                }

                /* Estilos para las cartas */
                .card-lectura {
                    background-color: #f9f9f9;
                    /* Color de fondo de las cartas */
                    border: 1px solid #ddd;
                    /* Borde de las cartas */
                    border-radius: 10px;
                    /* Bordes redondeados */
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                    /* Sombra de las cartas */
                    margin: 10px;
                    /* Espaciado entre cartas */
                    padding: 15px;
                    /* Espaciado interno de las cartas */
                    width: 220px;
                    /* Ancho fijo de las cartas */
                    transition: transform 0.2s;
                    /* Efecto de transformación al pasar el ratón */
                }

                .card-lectura:hover {
                    transform: translateY(-5px);
                    /* Levanta la carta al pasar el ratón */
                }

                /* Estilos para las imágenes de las cartas */
                .card-lectura img {
                    width: 100%;
                    /* Imagen ocupa todo el ancho de la carta */
                    border-radius: 5px;
                    /* Bordes redondeados en las imágenes */
                }

                /* Estilos para los enlaces */
                .card-lectura ul {
                    list-style-type: none;
                    /* Eliminar viñetas */
                    padding: 0;
                    /* Eliminar padding */
                    margin: 0;
                    /* Eliminar margin */
                }

                .card-lectura li {
                    margin: 10px 0;
                    /* Espacio entre los elementos de la lista */
                }

                .card-lectura a {
                    text-decoration: none;
                    /* Sin subrayado */
                    color: #007BFF;
                    /* Color del enlace */
                    transition: color 0.3s;
                    /* Efecto de transición para el color */
                }

                .card-lectura a:hover {
                    color: #0056b3;
                    /* Color al pasar el ratón sobre el enlace */
                }

                /* Cambios en los tamaños y colores de los textos */
                h2 {
                    font-size: 20px;
                    /* Tamaño para subtítulo */
                    color: #333;
                    /* Color más oscuro */
                    font-family: Arial, Helvetica, sans-serif;
                }

                h3 {
                    font-size: 15px;
                    /* Tamaño para el autor */
                    color: #666;
                    /* Color intermedio */
                    font-family: Arial, Helvetica, sans-serif;
                }

                h4 {
                    font-size: 15px;
                    /* Tamaño para capítulos recomendados */
                    color: #999;
                    /* Color más claro */
                    font-family: Arial, Helvetica, sans-serif;
                }
            </style>
        </div>
</div>
    </main>
    </main>
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2024 Quimiclick. Todos los derechos reservados.</p>
            <p><a href="#">Términos de Servicio</a> | <a href="#">Política de Privacidad</a></p>
            </div>
            <style>
        .footer {
            margin-top: 10px;
            background-color: #0bc7e8;
            /* Color de fondo */
            text-align: center;
            /* Centrar el texto */
            position: relative;
            /* Posición relativa para el posicionamiento */
            bottom: -13px;
            /* Alinear al fondo de la página */
            width: 100%;
            /* Ancho completo */
            padding: 10px;
            color: #252237;
            
            /* Color del texto */
        }

        .footer-content {
            max-width: 800px;
            /* Ancho máximo para contenido */
            margin-left: 400px;
            font-size: 10px;
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