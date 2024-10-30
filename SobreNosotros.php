<?php
include('./sidebar.php')
?>
<style>
    .barra-lateral {
        margin-left: -5px;
    }

    .barra-lateral img#logo {
        margin-top: -5px
    }
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quimiclick - Sobre Nosotros</title>
    <link rel="stylesheet" href="../Vista/CSS/SobreNosotros.css">
    <!-- FAVICON DE LA PAGINA -->
    <link rel="shortcut icon" href="./Publico/Imagenes/FAVICON.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <main>
        <div class="info">
            <div class="info-section">
                <h2>Misión</h2>
                <p>Nuestra misión es proporcionar una educación divertida y de alta calidad a través de recursos interactivos y atractivos, ayudando a los estudiantes a alcanzar su máximo potencial académico.</p>
            </div>
            <div class="info-section">
                <h2>Visión</h2>
                <p>Ser la plataforma líder en educación química en línea, reconocida por nuestro enfoque innovador y el impacto positivo en el aprendizaje de nuestros usuarios.</p>
            </div>
            <div class="info-section">
                <h2>Objetivo</h2>
                <p>Nuestro objetivo es facilitar el aprendizaje de la química mediante herramientas y recursos que permitan una comprensión profunda y práctica de los conceptos científicos.</p>
            </div>
        </div>

        <div class="creadores">
            <h2>Nuestro Equipo</h2>
            <div class="tarjetas">
                <div class="tarjeta">
                    <img src="./Publico/Imagenes/Foto-Valentina.jpg" alt="Creador 1">
                    <p>Valentina Arias</p>
                    <p>Diseñando experiencias que inspiran y conectan.</p>
                </div>
                <div class="tarjeta">
                    <img src="./Publico/Imagenes/Foto-Camila.jpg" alt="Creador 2">
                    <p>Camila Rivera</p>
                    <p>Código: la magia que transforma las ideas en realidad.</p>
                </div>
                <div class="tarjeta">
                    <img src="./Publico/Imagenes/Foto-Evelyn.jpg" alt="Creador 3">
                    <p>Evelyn Cardona</p>
                    <p>Con cada código, un paso más cerca de la innovación.</p>
                </div>
                <div class="tarjeta">
                    <img src="./Publico/Imagenes/Foto-Brayan.jpg" alt="Creador 4">
                    <p>Brayan Mora</p>
                    <p>Programando el futuro, línea por línea.</p>
                </div>
            </div>
        </div>

        <div class="container">
            <a href="https://www.facebook.com/profile.php?id=61567349680530" class="icon facebook">
                <div class="tooltip">Facebook</div>
                <span><i class="fab fa-facebook-f"></i></span>
            </a>
            <a href="https://www.instagram.com/quimi_click/" class="icon instagram">
                <div class="tooltip">Instagram</div>
                <span><i class="fab fa-instagram"></i></span>
            </a>
            <a href="https://www.tiktok.com/@quimiclick7" class="icon tiktok">
                <div class="tooltip">Tik Tok</div>
                <span><i class="fab fa-tiktok"></i></span>
            </a>
        </div>
        <style>
            /* Estilo del contenedor general */
            .container {
                display: flex;
                justify-content: center;
                gap: 20px;
                padding: 20px;
            }

            /* Estilo general para los botones */
            .container .icon {
                position: relative;
                text-decoration: none;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                cursor: pointer;
                transition: transform 0.3s ease;
            }

            .container .icon:hover {
                transform: scale(1.1);
            }

            /* Estilo de los iconos circulares */
            .container .icon span {
                display: flex;
                align-items: center;
                justify-content: center;
                height: 60px;
                width: 60px;
                background-color: #ffffff;
                border-radius: 50%;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                transition: background-color 0.3s;
            }

            .container .icon span i {
                font-size: 24px;
                color: #333;
                transition: color 0.3s;
            }

            /* Estilos para el tooltip */
            .container .icon .tooltip {
                position: absolute;
                bottom: -30px;
                background: #333;
                color: #fff;
                padding: 5px 10px;
                border-radius: 5px;
                font-size: 14px;
                opacity: 0;
                transform: translateY(10px);
                transition: opacity 0.3s, transform 0.3s;
                white-space: nowrap;
            }

            .container .icon:hover .tooltip {
                opacity: 1;
                transform: translateY(0);
            }

            /* Colores de fondo y de iconos específicos para cada red social */
            .container .facebook:hover span {
                background-color: #3b5998;
            }

            .container .facebook:hover span i {
                color: #fff;
            }

            .container .instagram:hover span {
                background-color: #e1306c;
            }

            .container .instagram:hover span i {
                color: #fff;
            }

            .container .tiktok:hover span {
                background-color:  #f72c53 ;
            }

            .container .tiktok:hover span i {
                color: #fff;
            }
        </style>
        <script>
            console.log('SweetAlert script está cargando');
            Swal.fire({
                title: 'Hola, ¿Quieres contactarnos?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Claro',
                cancelButtonText: 'Luego',
                customClass: {
                    container: 'custom-swal',
                    title: 'custom-title',
                    confirmButton: 'custom-confirm-button',
                    cancelButton: 'custom-cancel-button'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = './SectionContactanos.php';
                }
            });
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
                margin-top: 10px;
                background-color: #0bc7e8;
                /* Color de fondo */
                text-align: center;
                /* Centrar el texto */
                position: relative;
                /* Posición relativa para el posicionamiento */
                bottom: -20;
                /* Alinear al fondo de la página */
                width: -98%;
                /* Ancho completo */
                padding: 10px;
                color: #252237;                
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

<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@500&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Macondo&family=Mali:wght@500&family=Pangolin&family=Shantell+Sans:ital,wght@0,300;0,400;0,500;1,400&display=swap');


    body {
        font-family: 'Outfit', sans-serif;
        margin: 0;
        padding: 0;

    }

    .texto {
        padding: 20px;
        text-align: center;
    }

    .texto h1 {
        text-align: center;
        font-family: 'Pangolin', sans-serif;
        font-size: 40px;

    }

    .title-principal span {
        color: rgb(0, 0, 0);
        font-family: "Macondo", cursive;
        font-size: 70px;

    }

    .title-principal {
        text-align: center;
        margin-top: 40px;
        font-size: 50px;
        margin-left: 50px;
        font-family: "Pangolin", cursive;
    }

    .info {
        display: flex;
        justify-content: space-around;
        padding: 20px;
        margin: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .info-section {
        flex-basis: 30%;
        margin: 10px;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .info-section h2 {
        margin-bottom: 10px;
        color: #333;
    }

    .info-section p {
        margin: 0;
        color: #666;
    }

    .creadores {
        text-align: center;
        padding: -5px;
    }

    .creadores h2 {
        margin-bottom: 20px;
        text-align: center;
    }

    .tarjetas {
        display: flex;
        justify-content: center;
        /* Cambiado de space-around a center */
        flex-wrap: wrap;
        gap: 25px;
        /* Añadido para controlar el espacio entre las tarjetas */
        margin: 30px;
        margin-bottom: -150px;
    }

    .tarjeta {
        background-color: #f4f4f4;
        padding: 10px;
        margin: 0;
        /* Eliminado el margen */
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        flex-basis: calc(25% - 20px);
        /* Ajustado para cuatro tarjetas por fila con espacio entre ellas */
        box-sizing: border-box;
        /* Añadido para incluir el padding y el border en el tamaño total de la caja */
        transition: transform 0.3s, box-shadow 0.3s;
        /* Transición para suavizar el efecto */
    }

    .tarjeta:hover {
        transform: translateY(-5px);
        /* Eleva la tarjeta un poco hacia arriba */
        box-shadow: 0 15px 20px rgba(0, 0, 0, 0.2);
        /* Aumenta la sombra para un efecto de profundidad */
    }

    .tarjeta img {
        width: 150px;
        /* Establece un ancho fijo */
        height: 150px;
        /* Establece una altura fija */
        border-radius: 50%;
        /* Mantén el borde redondeado */
        object-fit: cover;
        /* Asegúrate de que la imagen cubra el contenedor sin distorsionarse */
    }


    .tarjeta p {
        margin: 10px 0;
    }


    .custom-swal {
        background-color: #f0f0f0;
        color: #333333;
    }

    .custom-swal .swal2-title {
        color: #000000;
        font-family: Arial, Helvetica, sans-serif;
        margin: bottom 20px;
        font-weight: 100;
    }

    .custom-swal .swal2-styled.swal2-confirm {
        background-color: #B33A43;
        border-color: #944146;
    }

    .custom-swal .swal2-styled.swal2-cancel {
        background-color: #599EBB;
        border-color: #507381;
    }
</style>