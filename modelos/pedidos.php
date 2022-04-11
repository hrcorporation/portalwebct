<?php

class pedidos extends conexionPDO
{
    protected $con;

    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    public function select_cliente($id = null)
    {
        $option = "<option  selected='true' value='NULL' disabled='true'> Seleccione cliente</option>";

        $sql = "SELECT * FROM `ct3_clientes`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        if ($result = $stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == $fila['ct3_id_cliente']) {
                    $selection = "selected='true'";
                } else {
                    $selection = " ";
                }
                $option .= '<option value="' . $fila['ct3_id_cliente'] . '" ' . $selection . ' >' . $fila['ct3_nombre_cliente'] . ' </option>';
            }
        }
        return $option;
    }
}