<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar si ya hay una sesión activa
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Iniciar sesión si no está activa
}

// Incluir el archivo de conexión a la base de datos
include './conexion/conexion.php'; // Ajusta la ruta si es necesario

// Inicializar la variable para mensajes
$alertMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si todos los campos están presentes
    if (isset($_POST['correo']) && isset($_POST['contrasena'])) {
        // Obtener los datos del formulario
        $correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
        $contrasena = isset($_POST['contrasena']) ? trim($_POST['contrasena']) : '';

        // Validar la estructura del correo electrónico
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $alertMessage = "Correo electrónico no válido.";
        } else {
            // Sanitizar datos para prevenir inyecciones SQL
            $correo = mysqli_real_escape_string($conexion, $correo);
            $contrasena = mysqli_real_escape_string($conexion, $contrasena);

            // Preparar la consulta SQL usando sentencias preparadas para verificar el usuario
            $sql = "SELECT idusuario, nombre, correo, avatar, contrasena, rol FROM usuario WHERE correo = ? AND contrasena = ?";
            $stmt = mysqli_prepare($conexion, $sql);

            // Vincular los parámetros
            mysqli_stmt_bind_param($stmt, 'ss', $correo, $contrasena);

            // Ejecutar la consulta
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);

            // Comprobar si se encontró un usuario
            if (mysqli_num_rows($resultado) > 0) {
                $usuario = mysqli_fetch_assoc($resultado);

                // Almacenar los valores en la sesión
                $_SESSION['idusuario'] = $usuario['idusuario'];
                $_SESSION['nombre'] = $usuario['nombre'];
                $_SESSION['correo'] = $usuario['correo'];
                $_SESSION['avatar'] = $usuario['avatar'];
                $_SESSION['rol'] = $usuario['rol'];

                // Mostrar SweetAlert con confeti (bombas)
                echo "<!DOCTYPE html>
                <html lang='es'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Inicio de Sesión</title>
                    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css'>
                </head>
                <body>
                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
                    <script src='https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js'></script>

                    <script>
                        // Variable global para detener el intervalo de confeti
                        let confettiInterval;

                        // Función para lanzar confeti (bombas) de manera continua
                        function lanzarBombas() {
                            var defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 1000 };

                            function randomInRange(min, max) {
                                return Math.random() * (max - min) + min;
                            }

                            // Lanzar confeti continuamente
                            confettiInterval = setInterval(function() {
                                confetti(Object.assign({}, defaults, {
                                    particleCount: 100,
                                    origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 }
                                }));
                                confetti(Object.assign({}, defaults, {
                                    particleCount: 100,
                                    origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 }
                                }));
                            }, 250);
                        }

                        // Detener el confeti
                        function detenerBombas() {
                            clearInterval(confettiInterval);
                        }

                        // Lanzar las bombas inmediatamente
                        lanzarBombas();

                        // SweetAlert para mostrar el mensaje de bienvenida
                        Swal.fire({
                            title: '¡Has iniciado sesión con éxito!',
                            text: 'Bienvenido {$usuario['nombre']}',
                            icon: 'success',
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor: '#ac3846',
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                detenerBombas();
                                window.location.href = '../Vista/Index.php';
                            }
                        });
                    </script>
                </body>
                </html>";
                exit();
            } else {
                $alertMessage = "Correo o contraseña incorrectos.";
            }
            // Cerrar la declaración y la conexión
            mysqli_stmt_close($stmt);
            mysqli_close($conexion);
        }
    } else {
        $alertMessage = "Todos los campos del formulario deben ser completados.";
    }
} else {
    $alertMessage = "Método de solicitud no válido.";
}

// Si hay un mensaje de alerta, mostrarlo
if ($alertMessage) {
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Error</title>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css'>
    </head>
    <body>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
        <script>
            Swal.fire({
                title: 'Error',
                text: '{$alertMessage}',
                icon: 'error',
                confirmButtonText: 'Aceptar', // Corrigido aquí
                confirmButtonColor: '#ac3846'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../Vista/registrar.php'; 
                }
            });
        </script>
    </body>
    </html>";
}
?>

