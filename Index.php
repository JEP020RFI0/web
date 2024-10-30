<?php

include('../Vista/sidebar.php');

// Definición del mensaje y tipo de advertencia
$text = "Por favor, inicia sesión para acceder a todas las funcionalidades de QuimiClick.";
$advertencia = "info"; // Cambia a success, error, warning, info, question según prefieras

// Verificar si el usuario ha iniciado sesión
$usuarioActivo = isset($_SESSION['usuario']); // Cambia 'usuario' según el nombre de tu variable de sesión
?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Conexión a la base de datos (ajusta los parámetros según tu configuración)
$servername = "localhost"; // Cambia si es necesario
$username = "root"; // Cambia si es necesario
$password = ""; // Cambia si es necesario
$dbname = "quimiclick"; // Cambia si es necesario

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Realizar la consulta para obtener novedades
$result = $conn->query("SELECT novedad, fecha_publicacion, hora_publicacion FROM novedades"); // Asegúrate de que la tabla y columnas son correctas

?>
<style>
    .barra-lateral {
        margin-left: -5px;
    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuimiClick</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Incluir SweetAlert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<style>
    /* Estilos del botón de campana */
    .button {
        width: 50px;
        height: 50px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgb(44, 44, 44);
        border-radius: 50%;
        cursor: pointer;
        transition-duration: .3s;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.13);
        border: none;
        margin-left: 900px;
        margin-bottom: -30px;
    }

    .bell {
        width: 18px;
    }

    .bell path {
        fill: white;
    }

    .button:hover {
        background-color: rgb(56, 56, 56);
    }

    /* Panel de novedades */
    .panel-novedades {
        display: none;
        position: absolute;
        top: 65px;
        right: 10px;
        width: 300px;
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        z-index: 100;
        margin-top: 10px;
    }

    .panel-novedades.activo {
        display: block;
    }

    /* Estilo para cada novedad */
    .novedad-item {
        padding: 10px;
        border-bottom: 1px solid #eee;
        display: flex;
        align-items: center;
    }

    .novedad-item:last-child {
        border-bottom: none;
    }

    .novedad-mensaje {
        font-size: 16px;
        flex-grow: 1;
    }

    .novedad-timestamp {
        font-size: 12px;
        color: #888;
    }

    /* Estilos del par de palomitas */
    .double-check-icon {
        display: flex;
        align-items: center;
        cursor: pointer;
        margin-left: 20px;
    }

    .double-check-icon .check-icon {
        width: 25px;
        /* Cambia el tamaño aquí */
        height: 25px;
        fill: #ddd;
        transition: fill 0.3s;
        margin-left: -8px;
        /* Superposición para imitar el estilo de WhatsApp */
    }

    .double-check-icon .check-icon:hover {
        fill: #4CAF50;
        /* Color verde al pasar el cursor */
    }

    /* Estilo del mensaje de novedades leídas */
    .novedades-leidas {
        font-size: 16px;
        color: #4CAF50;
        text-align: center;
        display: none;
    }
</style>

<body>
    <main>
        <?php

        // Verifica si el usuario ha iniciado sesión
        if (isset($_SESSION['nombre'])):
        ?>


            <!-- Botón de notificación -->
            <button class="button" onclick="togglePanel()">
                <svg viewBox="0 0 448 512" class="bell">
                    <path d="M224 0c-17.7 0-32 14.3-32 32V49.9C119.5 61.4 64 124.2 64 200v33.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416H424c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4V200c0-75.8-55.5-138.6-128-150.1V32c0-17.7-14.3-32-32-32zm0 96h8c57.4 0 104 46.6 104 104v33.4c0 47.9 13.9 94.6 39.7 134.6H72.3C98.1 328 112 281.3 112 233.4V200c0-57.4 46.6-104 104-104h8zm64 352H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z"></path>
                </svg>
            </button>

            <!-- Panel de novedades -->
            <div id="panelNovedades" class="panel-novedades">
                <p>¡Hola <?php echo htmlspecialchars($_SESSION['nombre']); ?>! Aquí están tus novedades:</p>

                <?php if ($result && $result->num_rows > 0): ?>
                    <div id="novedadesContainer">
                        <?php while ($novedad = $result->fetch_assoc()): ?>
                            <div class="novedad-item">
                                <div class="novedad-mensaje"><?php echo htmlspecialchars($novedad['novedad']); ?></div>
                                <div class="novedad-timestamp">
                                    <span><?php echo htmlspecialchars($novedad['fecha_publicacion']); ?></span>
                                    <span><?php echo htmlspecialchars($novedad['hora_publicacion']); ?></span>
                                </div>
                                <div class="double-check-icon" onclick="marcarLeido(this)">
                                    <svg viewBox="0 0 24 24" class="check-icon">
                                        <path d="M9 16.17l-3.88-3.88a1 1 0 1 1 1.42-1.42l3.47 3.47 7.47-7.47a1 1 0 1 1 1.42 1.42l-8.17 8.17a1 1 0 0 1-1.42 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <div id="sinNovedades" class="novedad-item" style="display: none; text-align: center; font-size: 16px;">
                        Sin novedades
                    </div>
                <?php else: ?>
                    <div class="novedad-item">No hay novedades registradas.</div>
                <?php endif; ?>
            </div>

            <script>
                function togglePanel() {
                    const panel = document.getElementById("panelNovedades");
                    panel.classList.toggle("activo");
                }

                function marcarLeido(doubleCheckIcon) {
                    doubleCheckIcon.classList.toggle("checked");

                    // Oculta el elemento de novedad cuando está marcado como leído
                    if (doubleCheckIcon.classList.contains("checked")) {
                        doubleCheckIcon.parentElement.style.display = "none";
                    }

                    // Verifica si todas las novedades están ocultas
                    const novedadesContainer = document.getElementById("novedadesContainer");
                    const novedades = novedadesContainer.querySelectorAll(".novedad-item");
                    const allHidden = Array.from(novedades).every(novedad => novedad.style.display === "none");

                    // Muestra "Sin novedades" si todas están ocultas
                    if (allHidden) {
                        document.getElementById("sinNovedades").style.display = "block";
                    }
                }
            </script>

        <?php
        endif; // Fin de la comprobación de sesión iniciada 
        ?>




        <div class="session-nosotros">
            <a href="SobreNosotros.php">SOBRE NOSOTROS</a>
            <h1 class="title-principal"><span>REFORZANDO-</span>NUESTROS CONOCIMIENTOS.</h1>
            <p class="text-inicio">
                <span>QuimiClick-</span>
                Descubre QuimiClick! Aprende química de forma divertida con juegos, videos interactivos y retos emocionantes.
            </p>
            <div class="text-block-6">¡Más de 150 estudiantes activos!</div>
        </div>
    </main>

    <div class="section-infor">
        <h2>¿Qué es la química?</h2>
        <div class="info-item">
            <p>
                La química estudia la composición, estructura, propiedades y cambios de la materia,
                analizando interacciones entre átomos y moléculas en diversas ramas y aplicaciones industriales.
            </p>
        </div>
        <div class="info-item">
            <img src="Publico/Imagenes/IconoAtomo.png" alt="Icono de una molécula">
            <p>
                Un átomo es la unidad fundamental de la materia, compuesto por un núcleo central con protones (carga positiva) y neutrones (sin carga), rodeado por electrones (carga negativa).
            </p>
        </div>
        <div class="info-item">
            <img src="Publico/Imagenes/IconoHidrogeno.png" alt="Icono de un elemento químico">
            <p>
                El hidrógeno es el elemento químico más ligero y abundante en el universo. Tiene el símbolo H y su número atómico es 1. Un átomo de hidrógeno típico consiste en un protón y un electrón.
            </p>
        </div>
        <div class="info-item">
            <img src="./Publico/Imagenes/IconoOxigeno.png" alt="Icono de un elemento químico">
            <p>
                El oxígeno, representado por el símbolo "O" y número atómico 8, es un gas incoloro e inodoro esencial para la vida en la Tierra.
                Constituye aproximadamente el 21% de la atmósfera terrestre y es fundamental para la respiración celular.
            </p>
        </div>
    </div>

    <style>
        .section-infor {
            margin-right: 200px;
            position: relative;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        .container {
            display: flex;
            justify-content: center;
            margin-top: 100px;
            background-color: #d9d9d9;
            padding: 10px 5px;
            border-radius: 10px;
            margin-left: 430px;
            margin-right: 300px;
            margin-top: 50px;

        }


        .periodic-table {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            max-width: 800px;
            margin: 0 auto;
            margin-top: 50px;
            align-items: center;
            margin-left: -60px;
        }

        .element {
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .element:hover {
            background-color: #d9d9d9;
            transform: scale(1.05);
        }

        .element-symbol {
            font-size: 14px;
            color: #555;
        }

        .info-panel {
            position: fixed;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 20px;
            display: none;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 320px;
            max-height: 400px;
            overflow-y: auto;
            border-radius: 10px;
            animation: fadeIn 0.3s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .info-panel h2 {
            margin-top: 0;
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .info-item i {
            margin-right: 10px;
            color: #ac3846;
            font-size: 18px;
            /* Aumentar el tamaño del ícono */
        }

        .fun-close {
            cursor: pointer;
            font-size: 24px;
            display: inline-block;
            transition: transform 0.3s;
            text-align: center;
            margin-bottom: 10px;
            /* Espacio entre el ícono y el título */

        }

        .fun-close:hover {
            transform: rotate(20deg);
        }

        .btn-close {
            background-color: #ac3846;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
            margin-top: 10px;
            /* Espacio superior del botón */
        }

        .btn-close:hover {
            background-color: #9c3039;
            /* Color de fondo al pasar el ratón */
        }

        .container h3{
            text-align: center;
            margin-right: -250px;
            margin-left: 150px;
            margin-top: 20px;
        }
    </style>
        <div class="container">
        <h3>¡Elementos que Cambian Tu Vida!</h3>
            <div class="periodic-table">
                <div class="element" onclick="showInfo('H')">H<br><span class="element-symbol">Hidrógeno</span></div>
                <div class="element" onclick="showInfo('O')">O<br><span class="element-symbol">Oxígeno</span></div>
                <div class="element" onclick="showInfo('C')">C<br><span class="element-symbol">Carbono</span></div>
                <div class="element" onclick="showInfo('N')">N<br><span class="element-symbol">Nitrógeno</span></div>
                <div class="element" onclick="showInfo('Cl')">Cl<br><span class="element-symbol">Cloro</span></div>
                <div class="element" onclick="showInfo('Na')">Na<br><span class="element-symbol">Sodio</span></div>
                <div class="element" onclick="showInfo('F')">F<br><span class="element-symbol">Flúor</span></div>
                <div class="element" onclick="showInfo('He')">He<br><span class="element-symbol">Helio</span></div>
                <div class="element" onclick="showInfo('Ca')">Ca<br><span class="element-symbol">Calcio</span></div>

            </div>
        </div>

        <div id="infoPanel" class="info-panel">
            <span class="fun-close" onclick="closeInfo()">&times;</span>
            <h2 id="elementName"></h2>
            <div class="info-item">
                <i class="fas fa-info-circle"></i>
                <p id="elementInfo"></p>
            </div>
            <div class="info-item">
                <i class="fas fa-briefcase"></i>
                <p id="elementUses"></p>
            </div>
            <div class="info-item">
                <i class="fas fa-flask"></i>
                <p id="elementProperties"></p>
            </div>
        </div>

        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script>
            const elementsInfo = {
                H: {
                    name: 'Hidrógeno',
                    info: 'El hidrógeno es el elemento químico más ligero y el más abundante en el universo.',
                    uses: 'Se utiliza en la producción de amoníaco, en la industria de alimentos y como combustible en cohetes.',
                    properties: 'Gas incoloro, inodoro e insípido. Es altamente inflamable.'
                },
                O: {
                    name: 'Oxígeno',
                    info: 'El oxígeno es esencial para la respiración de los seres vivos y se encuentra en el aire y el agua.',
                    uses: 'Se utiliza en la medicina, en la industria química y en la respiración de los seres vivos.',
                    properties: 'Gas incoloro, inodoro e insípido. Apoya la combustión.'
                },
                C: {
                    name: 'Carbono',
                    info: 'El carbono es la base de la vida en la Tierra y se encuentra en todas las moléculas orgánicas.',
                    uses: 'Se utiliza en la fabricación de plásticos, combustibles y fibras sintéticas.',
                    properties: 'Puede existir en forma de grafito o diamante. Es un elemento no metálico.'
                },
                N: {
                    name: 'Nitrógeno',
                    info: 'El nitrógeno es un componente importante de la atmósfera y se utiliza en fertilizantes.',
                    uses: 'Se utiliza en la industria alimentaria para empaquetar alimentos y en la producción de explosivos.',
                    properties: 'Gas incoloro e inodoro. No es reactivo a temperatura ambiente.'
                },
                Cl: {
                    name: 'Cloro',
                    info: 'El cloro se utiliza en productos de limpieza y desinfección.',
                    uses: 'Se utiliza en el tratamiento de agua, en la fabricación de plásticos y en productos de limpieza.',
                    properties: 'Gas amarillo-verde, irritante, y tóxico en altas concentraciones.'
                },
                Na: {
                    name: 'Sodio',
                    info: 'El sodio es un mineral esencial y se encuentra en la sal de mesa.',
                    uses: 'Se utiliza en la fabricación de productos químicos y en la conservación de alimentos.',
                    properties: 'Metal blando, plateado y altamente reactivo con agua.'
                },
                F: {
                    name: 'Flúor',
                    info: 'El flúor es un elemento muy reactivo y se utiliza en la fabricación de compuestos fluorados.',
                    uses: 'Se utiliza en la producción de pasta de dientes y en la fabricación de teflón.',
                    properties: 'Gas amarillo pálido, muy tóxico y reactivo.'
                },
                He: {
                    name: 'Helio',
                    info: 'El helio es un gas noble y el segundo elemento más ligero.',
                    uses: 'Se utiliza en globos y en refrigeración de ciertos dispositivos.',
                    properties: 'Gas incoloro, inodoro e insípido, no reactivo.'
                },
                Ca: {
                    name: 'Calcio',
                    info: 'El calcio es un mineral esencial para los huesos y los dientes.',
                    uses: 'Se utiliza en suplementos dietéticos y en la fabricación de cemento.',
                    properties: 'Metal blando, plateado y reactivo con agua.'
                },
            };

            function showInfo(element) {
                const info = elementsInfo[element];
                if (info) {
                    document.getElementById('elementName').textContent = info.name;
                    document.getElementById('elementInfo').textContent = info.info;
                    document.getElementById('elementUses').textContent = info.uses;
                    document.getElementById('elementProperties').textContent = info.properties;
                    document.getElementById('infoPanel').style.display = 'block';
                }
            }

            function closeInfo() {
                document.getElementById('infoPanel').style.display = 'none';
            }
        </script>
        <footer class="footer">
            <div class="footer-content">
                <p>&copy; 2024 Quimiclick. Todos los derechos reservados.</p>
                <p><a href="#">Términos de Servicio</a> | <a href="#">Política de Privacidad</a></p>
            </div>
        </footer>

        <!-- Estilos CSS -->
        <style>
            .footer {
                margin-top: 50px;
                background-color: #0bc7e8;
                text-align: center;
                width: 100%;
                padding: 10px;
                color: #252237;
            }

            .footer-content {
                max-width: 800px;
                margin: auto;
                font-size: 15px;
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
        </style>

        <?php
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if the user is logged in by verifying the session variable
        $usuarioActivo = isset($_SESSION['idusuario']);

        // Only display the alert if the user is not logged in
        if (!$usuarioActivo): ?>
            <!-- SweetAlert Script for users who are not logged in -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    title: '¡Bienvenido a QuimiClick!',
                    text: "<?php echo $text; ?>",
                    icon: '<?php echo $advertencia; ?>',
                    showCancelButton: true,
                    confirmButtonText: '¡Atrévete!',
                    cancelButtonText: 'Luego',
                    confirmButtonColor: '#B33A43', // Confirm button color
                    cancelButtonColor: '#6c757d' // Cancel button color
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = './registrar.php'; // URL to registration
                    }
                });
            </script>
        <?php endif; ?>


        <!-- Cierre de la conexión -->
        <?php $conn->close(); ?>

    </body>

</html>