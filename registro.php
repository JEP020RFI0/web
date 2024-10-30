<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Iniciar sesión si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'conexion/conexion.php';

function showAlert($title, $text, $icon)
{
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>$title</title>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css'>
    </head>
    <body>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
        <script>
            Swal.fire({
                title: '$title',
                text: '$text',
                icon: '$icon',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#ac3846',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../Vista/registrar.php'; // Cambia esta ruta si es necesario
                }
            });
        </script>
    </body>
    </html>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['nombre']) && !empty($_POST['correo']) && !empty($_POST['perfil']) && !empty($_POST['contrasena']) && !empty($_POST['rol'])) {
        $nombre = trim($_POST['nombre']);
        $correo = trim($_POST['correo']);
        $perfil = trim($_POST['perfil']);
        $contrasena = trim($_POST['contrasena']);
        $rol = trim($_POST['rol']);

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            showAlert('Error', 'Correo electrónico no válido.', 'error');
            exit();
        }

        // Sanear entradas inyeccion paraque los datos sean gaurdados de forma segura
        $nombre = mysqli_real_escape_string($conexion, $nombre);
        $correo = mysqli_real_escape_string($conexion, $correo);
        $perfil = mysqli_real_escape_string($conexion, $perfil);
        $rol = mysqli_real_escape_string($conexion, $rol);

        // Verificar si el correo ya existe
        $sqlCheck = "SELECT * FROM usuario WHERE correo = ?";
        $stmtCheck = mysqli_prepare($conexion, $sqlCheck);
        mysqli_stmt_bind_param($stmtCheck, 's', $correo);
        mysqli_stmt_execute($stmtCheck);
        $resultCheck = mysqli_stmt_get_result($stmtCheck);

        if (mysqli_num_rows($resultCheck) > 0) {
            showAlert('Error', 'El correo ya está en uso.', 'error');
            mysqli_stmt_close($stmtCheck);
            exit();
        }


        // Insertar el nuevo usuario
        // En tu proceso de registro
        $contrasena = $_POST['contrasena']; // Captura la contraseña tal como la ingresó el usuario

        $sql = "INSERT INTO usuario (nombre, correo, perfil, contrasena, rol) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $sql);

        if ($stmt === false) {
            error_log('Error en la preparación de la consulta: ' . mysqli_error($conexion));
            showAlert('Error', 'Ocurrió un error en el sistema. Por favor intenta más tarde.', 'error');
            exit();
        }

        mysqli_stmt_bind_param($stmt, 'sssss', $nombre, $correo, $perfil, $contrasena, $rol);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['usuario'] = $nombre;
            showAlert('¡Bienvenido!', 'Acabas de crear una cuenta, ahora dale aceptar para iniciar sesión :)', 'success');
        } else {
            error_log("Error al crear la cuenta: " . mysqli_stmt_error($stmt));
            showAlert('Error', 'Error al crear la cuenta. Por favor intenta más tarde.', 'error');
        }

        mysqli_stmt_close($stmt);
        mysqli_stmt_close($stmtCheck);
        mysqli_close($conexion);
    } else {
        showAlert('Error', 'Todos los campos del formulario deben ser completados.', 'error');
    }
} else {
    showAlert('Error', 'Método de solicitud no válido.', 'error');
}
