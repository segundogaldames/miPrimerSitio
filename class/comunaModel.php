<?php
require_once('modelo.php');

class comunaModel extends Modelo
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getComunas()
    {
        $comunas = $this->_db->query("SELECT c.id, c.nombre, r.nombre as region FROM comunas c RIGHT JOIN regiones r ON c.region_id = r.id ORDER BY c.nombre");
        
        return $comunas->fetchall();
    }

    public function getComunaId($id)
    {
        $id = (int) $id;

        $comuna = $this->_db->prepare("SELECT c.id, c.nombre, c.region_id, c.created_at, c.updated_at, r.nombre as region FROM comunas c INNER JOIN regiones r WHERE c.id = ?");
        $comuna->bindParam(1, $id);
        $comuna->execute();

        return $comuna->fetch();
    }

    public function getComunaNombre($nombre)
    {
        $comuna = $this->_db->prepare("SELECT id FROM comunas WHERE nombre = ?");
        $comuna->bindParam(1, $nombre);
        $comuna->execute();

        return $comuna->fetch();
    }

    public function setComunas($nombre, $region)
    {
        $region = (int) $region;

        $comuna = $this->_db->prepare("INSERT INTO comunas VALUES(null, ?, ?, now(), now() )");
        $comuna->bindParam(1, $nombre);
        $comuna->bindParam(2, $region);
        $comuna->execute();

        $row = $comuna->rowCount();

        return $row;
    }

    public function updateComuna($id, $nombre, $region)
    {
        $id = (int) $id;
        $region = (int) $region;

        $comuna = $this->_db->prepare("UPDATE comunas SET nombre = ?, region_id = ?, updated_at = now() WHERE id = ?");
        $comuna->bindParam(1, $nombre);
        $comuna->bindParam(2, $region);
        $comuna->bindParam(3, $id);
        $comuna->execute();

        $row = $comuna->rowCount();

        return $row;
    }

    public function deleteComuna($id)
    {
        $id = (int) $id;

        $comuna = $this->_db->prepare("DELETE FROM comunas WHERE id = ?");
        $comuna->bindParam(1, $id);
        $comuna->execute();

        $row = $comuna->rowCount();

        return $row;
    }
}