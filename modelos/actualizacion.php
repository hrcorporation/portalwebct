<?php 

class actualizacion extends conexionPDO
{
    protected $con;

    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    


}

// UPDATE `ct26_remisiones` SET `ct26_recibido` = ''  WHERE `ct26_codigo_remi` = 

// Amarilo CYMA


