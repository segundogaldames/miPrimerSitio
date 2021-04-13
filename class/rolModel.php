<?php
require('modelo.php');

class rolModel extends Modelo
{
    public function __construct()
    {
        //utilizar el constructor de la clase Modelo
        parent::__construct();
    }

    //crear un metodo que inserte roles en la tabla roles
    public function setRoles($nombre)
    {
        //consulta para insertar datos
        //el metodo prepare sirve para crear una sala de espera de sanitizacion de datos antes de ingresar DB
        $rol = $this->_db->prepare("INSERT INTO roles VALUES(null, ?, now(), now() )");
        //se realiza operacion de sanitizacion
        $rol->bindParam(1, $nombre);
        //ejecutamos la consulta y se envian los datos a la tabla roles
        $rol->execute();

        //consultamos si los datos fueron ingresados, consultando el numero de filas que se ha ingresado
        $row = $rol->rowCount(); //nos devolvera el numero de filas insertadas

        return $row; //disponiblizamos la informacion solicitada para quien la consulte
    }
}