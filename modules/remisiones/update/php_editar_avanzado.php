<?php

session_start();
header('Content-Type: application/json');

//require '../../../include/conexionPDO.php';
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
//$con = new conexionPDO();
$php_clases = new php_clases();
$t26_remisiones = new t26_remisiones();


$php_estado = false;
$errores[] = "MAl";
$resultado = "";
$php_error;

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id  = $_POST['id'];
    $id_usuario = (int) ($_SESSION['id_usuario']);
    $nombre_usuario = $_SESSION['nombre_usuario'];
    $datos_remision = $t26_remisiones->get_remision_id($id);
    foreach ($datos_remision as $dato) {
        $hora = $dato['ct26_hora_remi'];
        $numero_remision = $dato['ct26_codigo_remi'];
        $id_cliente = $dato['ct26_idcliente'];
        $id_obra = $dato['ct26_idObra'];
        $doc_remi = $dato['ct26_imagen_remi'];
        $id_vehiculo = $dato['ct26_id_vehiculo'];
        $id_conductor = $dato['ct26_conductor'];
        $metros = $dato['ct26_metros'];
        $id_producto = $dato['ct26_id_producto'];
        $asentamiento = htmlspecialchars($dato['ct26_asentamiento']);
        $sello = $dato['ct26_sello'];
        $estado = $dato['ct26_estado'];
        $hora_salida_planta = $dato['ct26_hora_salida_planta'];
        $hora_llegada_obra = $dato['ct26_hora_llegada_obra'];
        $hora_inicio_descargue = $dato['ct26_hora_inicio_descargue'];
        $hora_terminada_descargue = $dato['ct26_hora_terminada_descargue'];
        $hora_llegada_planta = $dato['ct26_hora_llegada_planta'];
    }
    if (isset($datos_remision)) {
        if ($t26_remisiones->agregar_copia($hora, $numero_remision, $id_cliente, $id_obra, $doc_remi, $id_vehiculo, $id_conductor, $metros, $id_producto, $asentamiento, $sello, $estado, $hora_salida_planta, $hora_llegada_obra, $hora_inicio_descargue, $hora_terminada_descargue, $hora_llegada_planta, $id_usuario, $nombre_usuario)) {
            $php_estado = true;
            $php_error[] = "Se guardo exitosamente";
        } else {
            $php_error[] = "Error";
        }
    }
}
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id_remision = (int)htmlspecialchars($_POST['id']);
    // Hora Remision
    if (isset($_POST['check_habilitar_hremision']) || !empty($_POST['check_habilitar_hremision'])) {
        $txt_hremi = htmlspecialchars($_POST['txt_hremi']);
        // Fuuncion Adicionar Hora de la remision
        if ($t26_remisiones->update_hora_remi($id_remision, $txt_hremi)) {
            $php_estado = true;
            $php_error[] = "La hora de la Remision Actualizada Correctamente";
        } else {
            $php_error[] = "Error al Actualizar la remision";
        }
    }

    // metros Cubicos
    if (isset($_POST['check_hab_m3']) || !empty($_POST['check_hab_m3'])) {
        $txt_m3 = htmlspecialchars($_POST['txt_m3']);
        if ($t26_remisiones->metros_cubi_remi($id_remision, $txt_m3)) {
            $php_estado = true;
            $php_error[] = "Los metros cubicos de la Remision Actualizada Correctamente";
        } else {
            $php_error[] = "Error al Actualizar la remision";
        }
    }



    // Numero Remision
    if (isset($_POST['check_habilitar_nremision']) || !empty($_POST['check_habilitar_nremision'])) {
        $txt_nremi = htmlspecialchars($_POST['txt_nremi']);
        if ($t26_remisiones->numero_remi($id_remision, $txt_nremi)) {
            $php_estado = true;
            $php_error[] = "El Numero de la Remision Actualizada Correctamente";
        } else {
            $php_error[] = "Error al Actualizar la remision";
        }
    }


    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    if (isset($_POST['check_hab_std']) || !empty($_POST['check_hab_std'])) {
        $estado = htmlspecialchars($_POST['txt_estado']);
        if ($t26_remisiones->estado_remi($id_remision, $estado)) {
            $php_estado = true;
            $php_error[] = "Estado de la Remision Actualizada Correctamente";
        } else {
            $php_error[] = "Error al Actualizar la remision";
        }
    }

    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

    if (isset($_POST['check_hab_sello']) || !empty($_POST['check_hab_sello'])) {
        $asentamiento = utf8_encode($_POST['txt_asentamiento']);
        $sello = htmlspecialchars($_POST['txt_sello']);
        if ($t26_remisiones->actualizar_asent_sello($id_remision, $asentamiento, $sello)) {
            $php_estado = true;
            $php_error[] = "Asentamiento y sello Actualizado Correctamente";
        } else {
            $php_error[] = "Error al actualizar el sello y el presinto";
        }
    }



    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

    if (isset($_POST['check_hab_producto']) || !empty($_POST['check_hab_producto'])) {
        $id_producto = (int)htmlspecialchars($_POST['txt_producto']);
        if ($t26_remisiones->actualizar_producto($id_remision, $id_producto)) {
            $php_estado = true;
            $php_error[] = "Producto Actualizado Exitosamente";
        } else {
            $php_error[] = "Error al actualizar el producto";
        }
    }
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    if (isset($_POST['check_hab_mix_cond']) || !empty($_POST['check_hab_mix_cond'])) {
        $id_vehiculo = (int)htmlspecialchars($_POST['txt_vehiculo']);
        $id_conductor = (int)htmlspecialchars($_POST['txt_conductor']);

        if ($t26_remisiones->actualizar_conduc_vehi($id_remision, $id_conductor, $id_vehiculo)) {
            $php_estado = true;
            $php_error[] = "Conductor y mixer actualizados Correctamente";
        } else {
            $php_error[] = "Error al sincronizar mixer y conductor";
        }
    }

    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

    if (isset($_POST['check_habilitar_cli_obra']) || !empty($_POST['check_habilitar_cli_obra'])) {

        $id_cliente = (int)htmlspecialchars($_POST['txt_cliente']);
        $id_obra = (int)htmlspecialchars($_POST['txt_obra']);

        if ($t26_remisiones->actualizar_cli_obra($id_remision, $id_cliente, $id_obra)) {
            $php_estado = true;
            $php_error[] = "Cliente y Obra Actualizados Correctamente";
        } else {
            $php_error[] = "Error al Guardar cliente y obra";
        }
    } else {
        $php_error[] = "No ha habilitado el campo del cliente";
    }

    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    // check Horas
    if (isset($_POST['check_habilitar_horas']) || !empty($_POST['check_habilitar_horas'])) {
        $h_salida_mix_planta = $_POST['h_salida_mix_planta'];
        if ($_POST['h_salida_mix_planta'] <= 0) {
            $h_salida_mix_planta = NULL;
        }
        $h_llegada_mix_obra = $_POST['h_llegada_mix_obra'];
        if ($_POST['h_llegada_mix_obra'] <= 0) {
            $h_llegada_mix_obra = NULL;
        }
        $h_inicio_descargue = $_POST['h_inicio_descargue'];
        if ($_POST['h_inicio_descargue'] <= 0) {
            $h_inicio_descargue = NULL;
        }
        $h_terminacion_descargue = $_POST['h_terminacion_descargue'];
        if ($_POST['h_terminacion_descargue'] <= 0) {
            $h_terminacion_descargue = NULL;
        }
        $h_llegada_mix_planta = $_POST['h_llegada_mix_planta'];
        if ($_POST['h_llegada_mix_planta'] <= 0) {
            $h_llegada_mix_planta = NULL;
        }

        if ($result_hora = $t26_remisiones->actualizar_horas_remi($id_remision, $h_salida_mix_planta, $h_llegada_mix_obra, $h_inicio_descargue, $h_terminacion_descargue, $h_llegada_mix_planta)) {
            $php_estado = true;
            $php_error[] = "Guardo Correctamente las Horas";
        } else {
            $php_error[] = "Error al Guardar las Horas";
        }
    } else {
        $php_error[] = "No se ha habilitado ningun cambio horas";
    }
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    // check_remi_fisica

    if (isset($_POST['check_habilitar']) || !empty($_FILES['imgfiles'])) {

        $img_remi = htmlspecialchars($_FILES['imgfiles']['name']);
        $ruta = htmlspecialchars($_FILES['imgfiles']['tmp_name']);

        $result2 =  $t26_remisiones->editar_remision($img_remi, $ruta, $id_remision);

        if ($result2) {
            $php_estado = true;
            $php_error[] = "Guardo Correctamente la remision Fisica";
        } else {
            $php_estado = false;
            $php_error[] = "error al guardar en la base de datos";
        }
    } else {
        $php_error[] = "No se ha habilitado ningun cambio remision ";
    }
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////


} else {
    $php_error[] = "No se ha habilitado ningun cambio";
}




$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'prueba' => $_SESSION['id_usuario']
    //'result' => $result2,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
