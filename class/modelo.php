<?php
//se hace una llamada obligatoria al archivo conexion.php para disponer de sus instancias de conexion
require('conexion.php');

class Modelo
{
    //se declara un atributo protegido
    protected $_db;

    //se declara el constructor de la clase
    public function __construct()
    {
        //crear una instancia u objeto de la clase Conexion
        $this->_db = new Conexion; //colaboracion de clases
    }
}

//private => en donde el objeto solo es accesible dentro de la clase donde es declarado
//protected => el objeto se puede acceder desde una clase que herede de la clase que declara el objeto
//public => se hacen visibles para cualquier clase que herede de la clase donde se declara el objeto
//static => se pueden usar sin necesidad de heredar de la clase que la crea, con solo mencionar la clase