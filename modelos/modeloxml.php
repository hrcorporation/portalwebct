<?php 
class modeloxml extends conexionPDO

{
    protected $con;
    // Iniciar Conexion
    public function __construct()

    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }
}