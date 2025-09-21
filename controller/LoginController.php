<?php

require_once __DIR__ . '/../models/UsuarioModel.php';

class LoginController {

    // Método para manejar el login
    public static function login($email, $password) {
        // Llamamos al método de autenticación del modelo
        $usuario = UsuarioModel::autenticar($email, $password);

        if ($usuario) {
            session_start(); // Iniciamos sesión
            $_SESSION['usuario'] = $usuario;
            $_SESSION['rol'] = $usuario['rol']; // Guardamos el rol también

            // Redirigir según rol
            if ($usuario['rol'] === 'admin') {
                header("Location: ../views/indiceAdmin.php");
            } else if ($usuario['rol'] === 'usuario') {
                header("Location: ../views/indice.php");
            } else {
                // Si el Rol es desconocido redirigimos a login
                header("Location: ../auth/login.php");
            }
            exit;
        } else {
            // Retornar false si no se autenticó
            return false;
        }
    }

    // Método para manejar el registro
    public static function registrar($data) {
        return UsuarioModel::registrar($data['nombre'], $data['email'], $data['password']);
    }
}