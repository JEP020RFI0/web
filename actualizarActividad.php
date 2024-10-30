<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"], $_POST["titulo"], $_POST["descripcion"], $_POST["tema"], $_POST["inicio"], $_POST["finalizacion"])) {
        
        // Validar que los campos requeridos no estén vacíos
        if (!empty($_POST["titulo"]) && !empty($_POST["descripcion"]) && !empty($_POST["tema"]) && !empty($_POST["inicio"]) 
            && !empty($_POST["finalizacion"])) {

            // Conectar a la base de datos
            include "./conexion/conexion.php";
            
            // Preparar la consulta
            $sql = "UPDATE actividades SET 
                        titulo='{$_POST['titulo']}', 
                        descripcion='{$_POST['descripcion']}', 
                        tema='{$_POST['tema']}', 
                        inicio='{$_POST['inicio']}', 
                        finalizacion='{$_POST['finalizacion']}', 
                    WHERE Id={$_POST['id']}";

            // Ejecutar la consulta
            if ($con->query($sql) === TRUE) {
                echo "<script>alert('Actualizado exitosamente.');window.location='../vista/ver.php';</script>";
            } else {
                echo "<script>alert('Error: No se pudo actualizar el registro.');window.location='../vista/ver.php';</script>";
            }

        } else {
            echo "<script>alert('Por favor, complete todos los campos.');window.location='../vista/editar.php?id={$_POST['id']}';</script>";
        }
    }
}
?>
