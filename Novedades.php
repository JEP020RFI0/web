<?php
include('../Controlador/conexion/conexion.php');
include('./sidebar.php');

// Consulta para obtener las novedades
$sql = "SELECT id, novedad, fecha_publicacion, hora_publicacion FROM novedades"; // Asegúrate de que la tabla se llame 'novedades'
$result = $conexion->query($sql);

// Verifica si hay resultados
if ($result === false) {
    die("Error en la consulta: " . $conexion->error);
}
?>

<?php
if (isset($_GET['success'])) {
    echo "<script>alert('Novedad eliminada exitosamente.');</script>";
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

    <title>Lista de Novedades</title>
    <link rel="shortcut icon" href="../Vista/Publico/Imagenes/FAVICON.ico" type="image/x-icon">
    
    <style>
        /* Estilos como los de tu código anterior */
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
            margin-top: -250px;
            margin-right: 110px;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
            font-size: 40px;
        }

        .table-wrapper {
            max-height: 350px; /* Aumentar la altura máxima aquí */
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

        .footer {
            margin-top: 50px;
            background-color: #0bc7e8;
            text-align: center;
            position: relative;
            bottom: -317px;
            width: 100%;
            padding: 10px;
            color: #252237;
            margin-top: -100px;
        }

        .footer-content {
            max-width: 800px;
            margin-left: 400px;
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

    <script>
        function confirmDeletion() {
            return confirm('¿Estás segura de que deseas eliminar esta novedad?');
        }
    </script>
</head>

<body>
    <div class="container">
        <h1>Lista de Novedades</h1>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Novedad</th>
                        <th>Fecha de Publicación</th>
                        <th>Hora de Publicación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($novedad = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $novedad['id']; ?></td>
                                <td><?php echo $novedad['novedad']; ?></td>
                                <td><?php echo $novedad['fecha_publicacion']; ?></td>
                                <td><?php echo $novedad['hora_publicacion']; ?></td>
                                <td>
                                    <form action="/Controlador/actualizarNovedad.php" method="GET" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $novedad['id']; ?>">
                                        <button type="submit" style="border: none; background: none; cursor: pointer;">
                                            <ion-icon name="create-outline" style="color: #4caf50; font-size: 20px;"></ion-icon>
                                        </button>
                                    </form>
                                    <form action="../Controlador/eliminarNovedad.php" method="POST" style="display:inline;" onsubmit="return confirmDeletion();">
                                        <input type="hidden" name="id" value="<?php echo $novedad['id']; ?>">
                                        <button type="submit" style="border: none; background: none; cursor: pointer;">
                                            <ion-icon name="trash-outline" style="color: #ac3846; font-size: 20px;"></ion-icon>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No hay novedades registradas.</td>
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
</body>

</html>
