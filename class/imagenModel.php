<?php

require_once('modelo.php');

class ImagenModel extends Modelo
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getImagenId($id){
        $id = (int) $id;

        $imagen = $this->_db->prepare("SELECT i.id, i.titulo, i.descripcion, i.imagen, i.activo, i.portada, i.created_at, i.updated_at, p.nombre as producto FROM imagenes i INNER JOIN productos p ON i.producto_id = p.id WHERE i.id = ?");
        $imagen->bindParam(1, $id);
        $imagen->execute();

        return $imagen->fetch();
    }

    public function getImagenNombre($imagen){
        $imagen = $this->_db->prepare("SELECT id FROM imagenes WHERE imagen = ?");
        $imagen->bindParam(1, $imagen);
        $imagen->execute();

        return $imagen->fetch();
    }

    //lista de imagenes por producto
    public function getImagenesProducto($producto){
        $producto = (int) $producto;

        $imagen = $this->_db->prepare("SELECT id, titulo, imagen, activo, portada FROM imagenes WHERE producto_id = ?");
        $imagen->bindParam(1, $producto);
        $imagen->execute();

        return $imagen->fetchall();
    }

    public function getImagenPortada($producto){
        $producto = (int) $producto;

        $imagen = $this->_db->prepare("SELECT id FROM imagenes WHERE portada = 1 AND producto_id = ?");
        $imagen->bindParam(1, $producto);
        $imagen->execute();

        return $imagen->fetch();
    }

    public function setImagen($titulo, $descripcion, $imagen, $portada, $producto){
        $portada = (int) $portada;
        $producto = (int) $producto;

        $imagen = $this->_db->prepare("INSERT INTO imagenes(titulo, descripcion, imagen, activo, portada, producto_id, created_at, updated_at) VALUES(?, ?, ?, 1, ?, ?, now(), now() )");
        $imagen->bindParam(1, $titulo);
        $imagen->bindParam(2, $descripcion);
        $imagen->bindParam(3, $imagen);
        $imagen->bindParam(4, $portada);
        $imagen->bindParam(5, $producto);
        $imagen->execute();

        $row = $imagen->rowCount();

        return $row;
    }

    //edicion general de la imagen
    public function editImagen($id, $titulo, $descripcion, $activo){
        $id = (int) $id;
        $activo = (int) $activo;

        $imagen = $this->_db->prepare("UPDATE imagenes SET titulo = ?, descripcion = ?, activo = ?, updated_at = now() WHERE id = ?");
        $imagen->bindParam(1, $titulo);
        $imagen->bindParam(2, $descripcion);
        $imagen->bindParam(3, $activo);
        $imagen->execute();

        $row = $imagen->rowCount();

        return $row;
    }

    //edicion de portada de la imagen
    public function editImagenPortada($id, $portada){
        $id = (int) $id;
        $portada = $portada;

        $imagen = $this->_db->prepare("UPDATE imagenes SET portada = ?, updated_at = now() WHERE id = ?");
        $imagen->bindParam(1, $portada);
        $imagen->bindParam(2, $id);
        $imagen->execute();

        $row = $imagen->rowCount();

        return $row;
    }

    //eliminacion de imagenes
    public function deleteImagen($id){
        $id = (int) $id;

        $imagen = $this->_db->prepare("DELETE FROM imagenes WHERE id = ?");
        $imagen->bindParam(1, $id);
        $imagen->execute();

        $row = $imagen->rowCount();

        return $row;
    }
}
