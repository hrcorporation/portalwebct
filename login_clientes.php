<?php
session_start();

header('Content-Type: application/json');

require 'include/conexion.php';
//require 'include/LibreriasHR.php';

$conexion_bd = new conexion();
$conexion_bd->connect();


//$HR_librerias = new HR_librerias();
$php_codigo = "nada";
$php_error = "";


if (isset($_POST['usuario']) && !empty($_POST['usuario']) && isset($_POST['contrasenia']) && !empty($_POST['contrasenia'])) {

    $php_usuario = htmlspecialchars($_POST['usuario']);
    $php_password = htmlspecialchars(md5($_POST['contrasenia']));
    
    
    
    if($_POST['usuario'] == $_POST['contrasenia']){
        $cambio_pass = true;
    }else{
        $cambio_pass = false;
    }

    $id_usuario = 0;
    $estado = 0;
    $rol_user = 0;
    $nombre_usuario = 0;
    $tipo = 0;
    $id_cliente1 = null;


    $sql = "SELECT `ct1_IdTerceros`,`ct1_Estado`, `ct1_NumeroIdentificacion`,ct1_obra_id, `ct1_RazonSocial`, `ct1_rol`,  `ct1_CorreoElectronico` FROM `ct1_terceros` WHERE ct1_terceros.ct1_TipoTercero = 1 AND ct1_terceros.ct1_NumeroIdentificacion = ?  AND ct1_terceros.ct1_pass = ?";
    $stmt = mysqli_prepare($conexion_bd->myconn, $sql);
    $stmt->bind_param("ss", $php_usuario, $php_password);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $n_rows = $result->num_rows;

        if ($n_rows > 0) {
            while ($fila = $result->fetch_assoc()) {
                $id_usuario = $fila['ct1_IdTerceros'];
                $estado = $fila['ct1_Estado'];
                $rol_user = $fila['ct1_rol'];
                 $id_obra = $fila['ct1_obra_id'];
                $nombre_usuario = $fila['ct1_RazonSocial'];
                $numero_identificacion = $fila['ct1_NumeroIdentificacion'];
            }
            $id_cliente1 = $id_usuario;
            $tipo = 3;
            $stmt->close();
            //$ = $fila[''];
        } else {
            $stmt->close();
            $sql2 = "SELECT `ct1_IdTerceros`,`ct1_Estado`,ct1_id_cliente1, ct1_obra_id,`ct1_NumeroIdentificacion`, `ct1_RazonSocial`, `ct1_rol`,  `ct1_CorreoElectronico` FROM `ct1_terceros` WHERE ct1_terceros.ct1_TipoTercero = 3 AND ct1_terceros.ct1_usuario = ?  AND ct1_terceros.ct1_pass = ?";
            $stmt = mysqli_prepare($conexion_bd->myconn, $sql2);
            $stmt->bind_param("ss", $php_usuario, $php_password);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $n_rows = $result->num_rows;
                if ($n_rows > 0) {
                    while ($fila = $result->fetch_assoc()) {
                        
                        $id_usuario = $fila['ct1_IdTerceros'];
                        $estado = $fila['ct1_Estado'];
                        $id_cliente1 = $fila['ct1_id_cliente1'];
                        $id_obra = $fila['ct1_obra_id'];
                        $rol_user = $fila['ct1_rol'];
                        $nombre_usuario = $fila['ct1_RazonSocial'];
                       $numero_identificacion = $fila['ct1_NumeroIdentificacion'];

                        
                    }
                    if($id_cliente1>0){
                        $tipo = 4;
                    }
                    
                }
            } else {
                $php_estado = 4;
            }
        }


        //validar el estado
        //$estado = 1;
        if ($estado == 1) {
            // Definir variables de session
            $_SESSION['id_usuario'] = $id_usuario;
            $_SESSION['nombre_usuario'] = $nombre_usuario;
            $_SESSION['rol'] = $rol_user;
            $_SESSION['tipo'] = $tipo;
            $_SESSION['id_cliente1'] = $id_cliente1;
            $_SESSION['id_obra'] = $id_obra;
            $_SESSION['N_identificacion']= $numero_identificacion; 

            $php_estado = 1;
        } else {
            $php_estado = 4; //el usuario esta bloqueado
        }

        //$fila = $result->fetch_assoc();
    } else {
        $php_estado = 3;
    }

    
   
    
    switch ($rol_user) {
        case 101:
        case '101':
            $php_codigo = "portalcliente/modulos/facturacione/index.php";
            break;
        case 102:
        case '102':
            
            if($cambio_pass){
                $php_codigo = "portalcliente/modulos/profile/passnew.php";
            }else{
                $php_codigo = "portalcliente/modulos/remisiones/index.php";
            }
          
            break;
            case 103:
                case '103':
                    
                    if($cambio_pass){
                        $php_codigo = "portalcliente/modulos/profile/passnew.php";
                    }else{
                        $php_codigo = "portalcliente/modulos/remisiones_cliente/index.php";
                    }
                  
                    break;

        default:
            $php_codigo = "cerrar.php";
            $php_estado = false;
            $php_error ="Usuario o Contraseña Incorrectos";
            break;
    }
    
   
    
} else {
    $php_estado = false;
    $php_error = "faltan Campos Requeridos";
}








$datos = array(
    'estado' => $php_estado,
    'codigo' => $php_codigo,
    "errores" => $php_error
);


echo json_encode($datos, JSON_FORCE_OBJECT);
?>