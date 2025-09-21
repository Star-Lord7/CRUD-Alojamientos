<?php

require_once __DIR__ . '/../models/AlojamientoModel.php';

class AlojamientoController {
    
    public function index() {
        $alojamientos = AlojamientoModel::obtenerTodos();
        return $alojamientos;
    }

    public function crear($titulo, $descripcion, $ubicacion, $precio, $imagen) {
        return AlojamientoModel::crear($titulo, $descripcion, $ubicacion, $precio, $imagen);
    }
}
