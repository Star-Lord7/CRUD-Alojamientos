<?php

require_once __DIR__ . '/../models/FavoritosModel.php';

class FavoritosController
{
    // Método para agregar un favorito
    public static function agregarFavorito($id_usuario, $id_alojamiento)
    {
        return FavoritosModel::agregarFavorito($id_usuario, $id_alojamiento);
    }

    // Método para obtener los favoritos de un usuario
    public static function obtenerFavoritos($id_usuario)
    {
        return FavoritosModel::obtenerFavoritosPorUsuario($id_usuario);
    }

    // Método para eliminar un favorito
    public static function eliminarFavorito($id_usuario, $id_alojamiento)
    {
        return FavoritosModel::eliminarFavorito($id_usuario, $id_alojamiento);
    }
}