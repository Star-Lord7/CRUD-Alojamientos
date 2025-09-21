<?php
require_once __DIR__ . '/../config/db.php';

class UsuarioModel {
    protected static $db;

    // Método para autenticar usuario
    public static function autenticar($email, $password) {
        self::$db = conectarDB();
        //$stmt = self::$db->prepare("SELECT * FROM usuarios WHERE email = ?");

        //Preparamos la consulta
        $stmt = self::$db->prepare("SELECT id_usuario, nombre, email, password, rol FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();
        $stmt->close();

        // Verificamos la contraseña
        if ($usuario && $password === $usuario['password']) {
            return $usuario; // Retornamos el usuario si la autenticación es exitosa
        }
        return false; // Retornamos false si la autenticación falla
    }

    // Método para registrar usuario
    public static function registrar($nombre, $email, $password) {
        self::$db = conectarDB();
        //$hash = password_hash($password, PASSWORD_BCRYPT);
        $hash = $password;
        // Preparamos la consulta
        $stmt = self::$db->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$nombre, $email, $hash]);
    }
}
