<?php

//herencia
class Conexion extends PDO
{
        //atributos de la clase conexion
	private $host = 'localhost';
	private $base = 'miprimersitio';
	private $user = 'root';
	private $pass = '1234'; //el password para usuarios de Windows es vacio ''
	private $charset = 'utf8';

        //constructor de la clase conexion
        //los constructores de clase permiten inicializar por defecto atributos y/o metodos de una clase
	public function __construct(){
                //constructor de clase padre llamada PDO
                parent::__construct(
                        'mysql:host=' . $this->host . ';dbname=' . $this->base,
                        $this->user,
                        $this->pass,
                        array(
                                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . $this->charset
                        ));
        }
}
