<?php

class clsSaldosClientes extends conexionPDO
{
    protected $con;
    // CONEXION
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }
    //Obtener el valor total de la remision
    public function get_valor_remision($id_remision)
    {
        $sql = "SELECT `ct26_valor_total` FROM `ct26_remisiones` WHERE `ct26_id_remision` = :id_remision";
        // Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_remision', $id_remision, PDO::PARAM_STR);
        // ejecuta la sentencia SQL
        if ($stmt->execute()) {
            $num_reg = $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $fila['ct26_valor_total'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //Obtener el saldo del cliente
    public function get_saldo_cliente($id_cliente)
    {
        $sql = "SELECT `ct1_saldo_cliente` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id_cliente";
        // Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_STR);
        // ejecuta la sentencia SQL
        if ($stmt->execute()) {
            $num_reg = $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $fila['ct1_saldo_cliente'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //Obtener el saldo del cliente
    public function get_cupo_cliente($id_cliente)
    {
        $sql = "SELECT `ct1_cupo_cliente` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id_cliente";
        // Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_STR);
        // ejecuta la sentencia SQL
        if ($stmt->execute()) {
            $num_reg = $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $fila['ct1_cupo_cliente'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //Actualizar saldos de clientes
    public function actualizar_saldo_cliente($id_cliente, $saldo)
    {
        $sql = "UPDATE `ct1_terceros` SET `ct1_saldo_cliente` = :saldo WHERE `ct1_IdTerceros` = :id_cliente";

        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':saldo', $saldo, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    //Obtener la cantidad de metros en la remision
    public function cantidad_m3_orden_compra($id_orden_compra)
    {
        $sql = "SELECT `saldo_m3` FROM `ct65_pedidos_has_precio_productos` WHERE `id_pedido` = :id_pedido AND `status` = 1";
        // Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_pedido', $id_orden_compra, PDO::PARAM_STR);
        // ejecuta la sentencia SQL
        if ($stmt->execute()) {
            $num_reg = $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $fila['saldo_m3'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //Actualizar saldos de la orden de compra
    public function actualizar_saldo_orden_compra($id_pedido, $saldo)
    {
        $sql = "UPDATE `ct65_pedidos_has_precio_productos` SET `saldo_m3` = :saldo WHERE `id_pedido` = :id_pedido;";

        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_STR);
        $stmt->bindParam(':saldo', $saldo, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    //obtener si el cliente tiene plan maestro
    public function get_plan_maestro($id_cliente)
    {
        $sql = "SELECT `ct1_nombre_tipo_cliente` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id_cliente";
        // Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_STR);
        // ejecuta la sentencia SQL
        if ($stmt->execute()) {
            $num_reg = $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $fila['ct1_nombre_tipo_cliente'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //obtener si el cliente tiene plan maestro
    public function get_plan_maestro_por_id_orden_compra($id_orden_compra)
    {
        $sql = "SELECT `plan_maestro` FROM `ct65_pedidos` WHERE `id` = :id_pedido;";
        // Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_pedido', $id_orden_compra, PDO::PARAM_STR);
        // ejecuta la sentencia SQL
        if ($stmt->execute()) {
            $num_reg = $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $fila['plan_maestro'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // //Obtener el saldo-cupo del cliente
    // public function get_saldo_cupo_cliente($id_cliente)
    // {
    //     $sql = "SELECT `ct1_cupo_cliente`,`ct1_saldo_cliente` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id_cliente";
    //     // Preparar Conexion
    //     $stmt = $this->con->prepare($sql);
    //     $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_STR);
    //     // ejecuta la sentencia SQL
    //     if ($stmt->execute()) {
    //         $num_reg = $stmt->rowCount();
    //         if ($num_reg > 0) {
    //             while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //                 $datos['ct1_cupo_cliente'] = $fila['ct1_cupo_cliente'];
    //                 $datos['ct1_saldo_cliente'] = $fila['ct1_saldo_cliente'];
    //                 $datosf[] = $datos;
    //             }
    //             return $datosf;
    //         } else {
    //             return false;
    //         }
    //     } else {
    //         return false;
    //     }
    // }


    //Obtener el valor del producto
    public function get_valor_producto($id_producto)
    {
        $sql = "SELECT `precio_base` FROM `ct65_pedidos_has_precio_productos` WHERE `id_producto` = :id_producto";
        // Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_STR);
        // ejecuta la sentencia SQL
        if ($stmt->execute()) {
            $num_reg = $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $fila['precio_base'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
