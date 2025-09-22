<?php

// require_once __DIR__ . '/../vendor/autoload.php';

// use Dotenv\Dotenv; //libreria para cargar variables de entorno

// $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
// $dotenv->load();

// function conectarDB() : mysqli {
//     $host = $_ENV['MYSQL_ADDON_HOST']; // MYSQL_ADDON_HOST
//     $user = $_ENV['MYSQL_ADDON_USER']; // MYSQL_ADDON_USER
//     $pass = $_ENV['MYSQL_ADDON_PASSWORD']; // MYSQL_ADDON_PASSWORD
//     $db   = $_ENV['MYSQL_ADDON_DB']; // MYSQL_ADDON_DB
//     $port = $_ENV['MYSQL_ADDON_PORT']; // MYSQL_ADDON_PORT

//     $db = mysqli_connect($host, $user, $pass, $db, $port);

//     if(!$db){
//         echo 'Error: No se pudo conectar a la base de datos -> ' . mysqli_connect_error();
//         exit;
//     }
//     return $db;
// }

function conectarDB() : mysqli {
    $db = mysqli_connect('localhost', 'root', 'root', 'crud_kodigo');

    if(!$db){
        echo 'Error no se pudo conectar a la base de datos';
        exit;
    }
    return $db;
}