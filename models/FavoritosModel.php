<?php

require_once __DIR__ . '/../config/db.php';

class FavoritosModel
{
    protected static $db;

    //Metodo para agregar un favorito
    public static function agregarFavorito($id_usuario, $id_alojamiento)
    {
        self::$db = conectarDB();
        // Sanitizar entradas
        $id_usuario = mysqli_real_escape_string(self::$db, $id_usuario);
        $id_alojamiento = mysqli_real_escape_string(self::$db, $id_alojamiento);

        // Verificar si el favorito ya existe
        $checkQuery = "SELECT * FROM favoritos WHERE id_usuario = '$id_usuario' AND id_alojamiento = '$id_alojamiento'";
        $checkResult = mysqli_query(self::$db, $checkQuery);
        if (mysqli_num_rows($checkResult) > 0) {
            return false; // Ya existe
        }

        // Agregar favorito
        $query = "INSERT INTO favoritos (id_usuario, id_alojamiento) VALUES ('$id_usuario', '$id_alojamiento')";
        $resultado = mysqli_query(self::$db, $query);
        return $resultado;
    }

    //Metodo para obtener los favoritos de un usuario
    public static function obtenerFavoritosPorUsuario($id_usuario)
    {
        self::$db = conectarDB();
        // Sanitizar entrada
        $id_usuario = mysqli_real_escape_string(self::$db, $id_usuario);

        // Consulta para obtener los alojamientos favoritos del usuario
        $query = "SELECT a.* FROM alojamientos a
                JOIN favoritos f ON a.id_alojamiento = f.id_alojamiento
                WHERE f.id_usuario = '$id_usuario'";
        $resultado = mysqli_query(self::$db, $query);

        $favoritos = []; // Array para almacenar los alojamientos favoritos
        while ($alojamiento = mysqli_fetch_assoc($resultado)) {
            $favoritos[] = $alojamiento;
        }
        return $favoritos;
    }

    //Metodo para eliminar un favorito
    public static function eliminarFavorito($id_usuario, $id_alojamiento)
    {
        self::$db = conectarDB();
        $id_usuario = mysqli_real_escape_string(self::$db, $id_usuario);
        $id_alojamiento = mysqli_real_escape_string(self::$db, $id_alojamiento);

        // Consulta para eliminar el favorito
        $query = "DELETE FROM favoritos WHERE id_usuario = '$id_usuario' AND id_alojamiento = '$id_alojamiento'";
        $resultado = mysqli_query(self::$db, $query);
        return $resultado;
    }
}
