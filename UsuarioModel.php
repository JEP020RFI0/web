<?php
class UsuarioModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerUsuarios() {
        $sql = "SELECT idusuario, nombre, correo, rol FROM usuario"; // Asegúrate de que estás seleccionando la columna correcta
        $resultado = $this->conexion->query($sql);
        
        if ($resultado) {
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
}

?>
