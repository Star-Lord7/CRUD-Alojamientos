<?php

require_once __DIR__ . '/../config/db.php';

class AlojamientoModel{
    protected static $db;

    //Metodo para obtener todos los alojamientos
    public static function obtenerTodos(){
        self::$db = conectarDB();
        $query = "SELECT * FROM alojamientos";
        $resultado = mysqli_query(self::$db, $query);

        $alojamientos = []; // Array para almacenar los alojamientos
        // Recorremos los resultados y los añadimos al array
        while($alojamiento = mysqli_fetch_assoc($resultado)){
            $alojamientos[] = $alojamiento;
        }
        return $alojamientos;
    }

    //Metodo para crear un nuevo alojamiento
    public static function crear($titulo, $descripcion, $ubicacion, $precio, $imagen){
        self::$db = conectarDB();

        // Escapamos los datos para evitar inyecciones SQL
        $titulo = mysqli_real_escape_string(self::$db, $titulo);
        $descripcion = mysqli_real_escape_string(self::$db, $descripcion);
        $ubicacion = mysqli_real_escape_string(self::$db, $ubicacion);
        $precio = mysqli_real_escape_string(self::$db, $precio);
        $imagen = mysqli_real_escape_string(self::$db, $imagen);

        // Insertamos el nuevo alojamiento en la base de datos
        $query = "INSERT INTO alojamientos (titulo, descripcion, ubicacion, precio, imagen_url) VALUES ('$titulo', '$descripcion', '$ubicacion', '$precio', '$imagen')";
        $resultado = mysqli_query(self::$db, $query);
        return $resultado;
    }
}