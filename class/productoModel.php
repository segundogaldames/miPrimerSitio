<?php
    require_once('modelo.php');

    class ProductoModel extends Modelo
    {
        public function __construct()
        {
            parent::__construct();

        }
        //obtener productos
        public function getProductos()
        {
            $productos = $this->_db->query("SELECT p.id, p.nombre, p.activo, m.nombre as marca, pt.nombre as tipo FROM productos p
            INNER JOIN marcas m ON p.marca_id = m.id
            INNER JOIN producto_tipos pt on p.producto_tipo_id = pt.id ORDER BY p.nombre;");

            return $productos->fetchall();

        }

        //Consultar por el nombre
        public function getProductoNombre($nombre)
        {
            $producto = $this->_db->prepare("SELECT id From productos WHERE nombre = ?");
            $producto->bindParam(1,$nombre);
            $producto->execute();

            return $producto->fetch();


        }

        //obtener id del producto
        public function getProductoId($id)
        {
            $id = (int) $id;

            $producto = $this->_db->prepare("SELECT p.id, p.sku, p.nombre, p.precio, p.activo, p.marca_id, p.producto_tipo_id, p.created_at, p.updated_at, m.nombre as marca, pt.nombre as tipo FROM productos p
            INNER JOIN marcas m ON p.marca_id = m.id
            INNER JOIN producto_tipos pt ON p.producto_tipo_id = pt.id WHERE p.id = ?");

            $producto->bindParam(1,$id);
            $producto->execute();

            return $producto->fetch();
        }


        //Guardar productos
        public function setProducto($sku, $nombre, $precio, $marca, $tipo)
        {
            //activo = 1
            //inactivo 2

            $producto = $this->_db->prepare("INSERT INTO productos(sku, nombre, precio, activo, marca_id, producto_tipo_id, created_at, updated_at)
            VALUES(?, ?, ?, 2, ?, ?, now(), now() )");

            $precio = (int) $precio;
            $marca = (int) $marca;
            $tipo = (int) $tipo;

            $producto->bindParam(1,$sku);
            $producto->bindParam(2,$nombre);
            $producto->bindParam(3,$precio);
            $producto->bindParam(4,$marca);
            $producto->bindParam(5,$tipo);
            $producto->execute();

            $row = $producto->rowCount();

            return $row;

        }
        //actualizar un producto
        public function updateProducto($id, $sku, $nombre, $precio, $activo, $marca, $tipo)
        {
            $id = (int) $id;
            $precio = (int) $precio;
            $marca = (int) $marca;
            $tipo = (int) $tipo;

            $producto = $this->_db->prepare("UPDATE productos SET sku = ?, nombre = ?, precio = ?, activo = ?, marca_id = ?, producto_tipo_id = ?, updated_at = now() WHERE id = ? ");
            $producto->bindParam(1,$sku);
            $producto->bindParam(2,$nombre);
            $producto->bindParam(3,$precio);
            $producto->bindParam(4,$activo);
            $producto->bindParam(5,$marca);
            $producto->bindParam(6,$tipo);
            $producto->bindParam(7,$id);
            $producto->execute();

            $row = $producto->rowCount();

            return $row;
        }
        //Eliminar un producto
        public function deleteProducto($id)
        {

            $id = (int) $id;

            $producto = $this->_db->prepare("DELETE FROM productos WHERE id=?");
            $producto->bindParam(1,$id);
            $producto->execute();

            $row = $producto->rowCount();

            return $row;

        }



    }
