
<?php
// Conectar a la base de datos
include '../Controlador/conexion/conexion.php'; // Cambia esto según tu estructura
include ('../Vista/sidebar.php');

// Verifica si se ha pasado el id
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepara la consulta
    $query = "SELECT * FROM novedades WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica si se encontraron resultados
    if ($result->num_rows > 0) {
        $reto = $result->fetch_assoc(); // Obtener los datos del reto
    } else {
        echo "No se encontró la novedad.";
        exit;
    }
} else {
    echo "ID no especificado.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Novedad</title>
    <link rel="stylesheet" href="../Vista/CSS/SectionAdmin.css">
</head>

<body>
    <div class="container">
        <h1>Editar Novedad</h1>
        <form action="../Controlador/actualizarNovedad.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="novedad">Novedad:</label>
            <input type="text" id="novedad" name="novedad" value="<?php echo htmlspecialchars($novedad['novedad']); ?>" required>
            <label for="fecha">Fecha de Publicación:</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $novedad['fecha_publicacion']; ?>" required>
            <label for="hora">Hora de Publicación:</label>
            <input type="time" id="hora" name="hora" value="<?php echo $novedad['hora_publicacion']; ?>" required>
            <button type="submit">Actualizar Novedad</button>
        </form>
    </div>
</body>

</html>

 <style>
        
        body {
            background-color: #c9d6ff;
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
            font-family: 'Outfit', sans-serif;
        }
        .container {
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
            position: relative;
            width: 60%; /* Cambiado de 80% a 60% */
            max-width: 800px; /* Añadido para limitar el ancho máximo */
            padding: 20px;
            text-align: center;
            margin-right: -120px;
        }
        h2 {
            color: #333;
            margin-top: 20px;
        }
        form {
            margin: 20px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        input[type="date"], input[type="time"], textarea {
            width: 80%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
            margin-bottom: 10px;
            background-color: #eee;
        }
        input[type="submit"] {
            background-color: #ac3846;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            text-transform: uppercase;
        }
        input[type="submit"]:hover {
            background-color: #84545b;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background-color: #f3f3f3;
        }
        .actions a {
            text-decoration: none;
            padding: 5px 10px;
            color: #fff;
            background-color: #0bc7e8;
            border-radius: 5px;
            margin: 0 5px;
        }
        .actions a:hover {
            background-color: #085775;
        }
    </style>