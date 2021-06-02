<?php

require_once('modelo.php');

class PersonaModel extends Modelo
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getPersonas()
    {
        $personas = $this->_db->query("SELECT p.id, p.nombre, r.nombre as rol, c.nombre as comuna FROM personas p INNER JOIN roles r ON p.rol_id = r.id INNER JOIN comunas c ON p.comuna_id = c.id ORDER BY p.nombre");

        return $personas->fetchall();
    }


    public function getPersonaId($id)
    {
        $id = (int) $id;

        $persona = $this->_db->prepare("SELECT p.id, p.nombre, p.rut, p.email, p.direccion, p.fecha_nac, p.telefono, p.rol_id, p.comuna_id, p.created_at, p.updated_at, r.nombre as rol, c.nombre as comuna FROM personas p INNER JOIN roles r ON p.rol_id = r.id INNER JOIN comunas c ON p.comuna_id = c.id WHERE p.id = ?");
        $persona->bindParam(1, $id);
        $persona->execute();

        return $persona->fetch();
    }

    //metodo que consulta por el registro de una persona por su email
    public function getPersonaEmail($email)
    {
        $persona = $this->_db->prepare("SELECT id FROM personas WHERE email = ?");
        $persona->bindParam(1, $email);
        $persona->execute();

        return $persona->fetch();
    }

    public function setPersona($nombre, $rut, $email, $direccion, $fecha_nac, $telefono, $rol, $comuna)
    {
        $telefono = (int) $telefono;
        $rol = (int) $rol;
        $comuna = (int) $comuna;

        $persona = $this->_db->prepare("INSERT INTO personas(nombre, rut, email, direccion, fecha_nac, telefono, rol_id, comuna_id, created_at, updated_at) VALUES(?, ?, ?, ?, ?, ?, ?, ?, now(), now() ) ");
        $persona->bindParam(1, $nombre);
        $persona->bindParam(2, $rut);
        $persona->bindParam(3, $email);
        $persona->bindParam(4, $direccion);
        $persona->bindParam(5, $fecha_nac);
        $persona->bindParam(6, $telefono);
        $persona->bindParam(7, $rol);
        $persona->bindParam(8, $comuna);
        $persona->execute();

        $row = $persona->rowCount();

        return $row;
    }

    public function updatePersona($id, $nombre, $rut, $email, $direccion, $fecha_nac, $telefono, $rol, $comuna)
    {
        $id = (int) $id;
        $telefono = (int) $telefono;
        $rol = (int) $rol;
        $comuna = (int) $comuna;

        $persona = $this->_db->prepare("UPDATE personas SET nombre = ?, rut = ?, email = ?, direccion = ?, fecha_nac = ?, telefono = ?, rol_id = ?, comuna_id = ?, updated_at = now() WHERE id = ?");
        $persona->bindParam(1, $nombre);
        $persona->bindParam(2, $rut);
        $persona->bindParam(3, $email);
        $persona->bindParam(4, $direccion);
        $persona->bindParam(5, $fecha_nac);
        $persona->bindParam(6, $telefono);
        $persona->bindParam(7, $rol);
        $persona->bindParam(8, $comuna);
        $persona->bindParam(9, $id);
        $persona->execute();

        $row = $persona->rowCount();

        return $row;
    }

    public function deletePersona($id)
    {
        $id = (int) $id;

        $persona = $this->_db->prepare("DELETE FROM personas WHERE id = ?");
        $persona->bindParam(1, $id);
        $persona->execute();

        $row = $persona->rowCount();

        return $row;
    }
}
