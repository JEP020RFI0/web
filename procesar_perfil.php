<?php
// Incluir la conexión
include("../Controlador/conexion/conexion.php");

session_start(); // Asegúrate de que la sesión esté iniciada

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar si se ha enviado el formulario de actualización
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario y asegurarse de escaparlos correctamente
    $id = mysqli_real_escape_string($conexion, $_SESSION['idusuario']);
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $contrasena = mysqli_real_escape_string($conexion, $_POST['contrasena']);
    $avatar = mysqli_real_escape_string($conexion, $_POST['avatar']); // Asegúrate de que este sea el nombre correcto

    // Comprobar si se ha proporcionado una nueva contraseña
    if (!empty($contrasena)) {
        // Si hay una nueva contraseña, actualizar también la contraseña
        $updateQuery = "UPDATE usuario SET nombre='$nombre', correo='$correo', contrasena='$contrasena', avatar='$avatar' WHERE idusuario='$id'";
    } else {
        // Si no se proporciona una nueva contraseña, no se actualiza
        $updateQuery = "UPDATE usuario SET nombre='$nombre', correo='$correo', avatar='$avatar' WHERE idusuario='$id'";
    }

    // Ejecutar la consulta de actualización
    if (mysqli_query($conexion, $updateQuery)) {
        // Actualizar las variables de sesión con los nuevos datos
        $_SESSION['nombre'] = $nombre;
        $_SESSION['correo'] = $correo;
        $_SESSION['avatar'] = $avatar; // Asegúrate de que el avatar se actualice en la sesión

        // Redirigir a la página de perfil con un mensaje de éxito usando SweetAlert
        echo '<!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Perfil Actualizado</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            </head>
            <body>
                <script>
                    Swal.fire({
                        title: "¡Éxito!",
                        text: "Perfil actualizado con éxito.",
                        icon: "success",
                        confirmButtonText: "Aceptar",
                        confirmButtonColor: "#ac3846",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "../Vista/SectionPerfil.php";
                        }
                    });
                </script>
            </body>
            </html>';
        exit();
    } else {
        // Mostrar mensaje de error usando SweetAlert
        $error_message = mysqli_error($conexion);
        echo '<!DOCTYPE html>
            html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Error de Actualización</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            </head>
            <body>
                <script>
                    Swal.fire({
                        title: "Error",
                        text: "Error al actualizar el perfil: ' . addslashes($error_message) . '",
                        icon: "error",
                        confirmButtonText: "Cerrar",
                        confirmButtonColor: "#ac3846"
                    });
                </script>
            </body>
            </html>';
    }
}

// Cerrar la conexión
include("../Controlador/conexion/cerrarconexion.php");
