<?php
include('../Controlador/conexion/conexion.php');
include('./sidebar.php');
// Consulta para obtener los usuarios
$sql = "SELECT idusuario, nombre, correo, perfil, rol FROM usuario"; // Asegúrate de incluir 'rol'
$result = $conexion->query($sql);

// Verifica si hay resultados
if ($result === false) {
    die("Error en la consulta: " . $conexion->error);
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Vista/CSS/SectionAdmin.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Panel de Administración</title>
    <link rel="shortcut icon" href="../Vista/Publico/Imagenes/FAVICON.ico" type="image/x-icon">
    
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
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
            position: relative;
            overflow: hidden;
            width: 900%;
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            text-align: center;
            margin-top: -50px;
            margin-right: 110px;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
            font-size: 40px;
        }

        .table-wrapper {
            max-height: 250px;
            overflow-y: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 14px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        input[type="submit"] {
            background-color: #ac3846;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
            margin-right: 5px; /* Espacio entre el botón y el ícono */
            font-weight: 100;
        }

        input[type="submit"]:hover {
            background-color: #84545b;
        }

        select {
            padding: 8px;
            font-size: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        form {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .table-wrapper {
            max-height: 250px;
            overflow-x: auto;
        }

        .table-wrapper::-webkit-scrollbar {
            width: 5px;
            height: 4.5px;
        }

        .table-wrapper::-webkit-scrollbar-thumb {
            background-color: var(--color-scroll, #888);
            border-radius: 5px;
        }

        .table-wrapper::-webkit-scrollbar-thumb:hover {
            background-color: var(--color-scroll-hover, #555);
        }
            .barra-lateral.mini-barra-lateral img#logo {
    margin-left: -10px;
    margin-right: 150px;
    margin-bottom: -15px;
    width: 80px;
        
    }

    </style>

    <script>
        function confirmDeletion() {
            return confirm('¿Estás segura de que deseas eliminar este usuario?');
        }
    </script>
</head>

<body>
    <div class="container">
        <h1>Panel de Administración</h1>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($usuario = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $usuario['idusuario']; ?></td>
                                <td><?php echo $usuario['nombre']; ?></td>
                                <td><?php echo $usuario['correo']; ?></td>
                                <td><?php echo $usuario['rol']; ?></td>
                                <td>
                                    <form action="../Controlador/actualizar_rol.php" method="POST" style="display:inline;">
                                        <select name="rol">
                                            <option value="estudiante" <?php echo ($usuario['rol'] == 'estudiante') ? 'selected' : ''; ?>>Estudiante</option>
                                            <option value="docente" <?php echo ($usuario['rol'] == 'docente') ? 'selected' : ''; ?>>Docente</option>
                                            <option value="administrador" <?php echo ($usuario['rol'] == 'administrador') ? 'selected' : ''; ?>>Administrador</option>
                                        </select>
                                        <input type="hidden" name="idusuario" value="<?php echo $usuario['idusuario']; ?>">
                                        <input type="submit" value="Actualizar">
                                    </form>

                                    <form action="../Controlador/eliminarUser.php" method="POST" style="display:inline;" onsubmit="return confirmDeletion();">
                                        <input type="hidden" name="idusuario" value="<?php echo $usuario['idusuario']; ?>">
                                        <button type="submit" style="border: none; background: none; cursor: pointer;">
                                            <ion-icon name="trash-outline" style="color: #ac3846; font-size: 20px;"></ion-icon>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No hay usuarios registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2024 Quimiclick. Todos los derechos reservados.</p>
            <p><a href="#">Términos de Servicio</a> | <a href="#">Política de Privacidad</a></p>
        </div>
    </footer>

    <style>
        *{
            margin: 0;
            padding: 0;
        }
        .footer {
            margin-top: 50px;
            background-color: #0bc7e8;
            /* Color de fondo */
            text-align: center;
            /* Centrar el texto */
            position: relative;
            /* Posición relativa para el posicionamiento */
            bottom: -149;
            /* Alinear al fondo de la página */
            width: 100%;
            /* Ancho completo */
            padding: 10px;
            color: #252237;
            margin-top: -100px;
            
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
