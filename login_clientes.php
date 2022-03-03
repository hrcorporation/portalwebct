<?php
session_start();

header('Content-Type: application/json');
require 'librerias/autoload.php';
require 'modelos/autoload.php';
require 'vendor/autoload.php';

$cls_auth = new auth();



//$HR_librerias = new HR_librerias();
$php_codigo = "nada";
$php_error = "";
$php_estado = false;



if (isset($_POST['usuario']) && !empty($_POST['usuario']) && isset($_POST['contrasenia']) && !empty($_POST['contrasenia'])) {
    $php_estado = false;

    $php_usuario = htmlspecialchars($_POST['usuario']);
    $php_password = htmlspecialchars(md5($_POST['contrasenia']));

    if ($_POST['usuario'] == $_POST['contrasenia']) {
        $cambio_pass = true;
    } else {
        $cambio_pass = false;
    }

    // se busca en la funcion el usuario y la clave
    if (is_array($data_usuario = $cls_auth->autenticacion_usuario($php_usuario, $php_password))) {

        // se Recorre el array de datos del usuario
        foreach ($data_usuario as $fila) {
            // se valida que el usuario este activo
            if (intval($fila['estado']) == 1) {
                // se valida el rol del usuario
                switch (intval($fila['id_rol'])) {
                        // el usuario de Facturacion
                    case 101:
                    case '101':
                        $php_codigo = "portalcliente/modulos/facturacione/index.php"; // enruta al modulo de facturacion
                        $_SESSION['id_cliente1'] = $fila['id_usuario']; // se inicia sesion con el id_cliente
                        break;

                        // El usuario es el que firma las remisiones
                    case 102:
                    case '102':
                        if ($_POST['usuario'] == $_POST['contrasenia']) {
                            $php_codigo = "portalcliente/modulos/profile/passnew.php";
                        } else {
                            $php_codigo = "portalcliente/modulos/remisiones/index.php";
                        }
                        $php_estado = true;
                        $php_msg = 'Exitoso';

                        break;

                    case 103:
                    case '103':
                        if ($_POST['usuario'] == $_POST['contrasenia']) {
                            $php_codigo = "portalcliente/modulos/profile/passnew.php";
                        } else {
                            $php_codigo = "portalcliente/modulos/remisiones_cliente/index.php";
                        }
                        $php_estado = true;
                        $php_msg = 'Exitoso';
                        break;

                    default:
                        $php_codigo = "cerrar.php";
                        $php_estado = false;
                        $php_error = "Usuario no posee permisos";
                        break;
                }

                // La se valida que el estado este activo y se inicia sesion
                if ($php_estado) {
                    $_SESSION['id_usuario'] = $fila['id_usuario'];
                    $_SESSION['nombre_usuario'] = $fila['nombre_cliente'];
                    $_SESSION['rol'] = $fila['id_rol'];
                    $_SESSION['id_cliente1'] = $fila['id_cliente1'];
                    $_SESSION['id_obra1 '] = $fila['id_obra1'];
                    $_SESSION['numero_identificacion'] = $fila['numero_identificacion'];
                } else {
                    $php_estado = false;
                    $php_msg = 'Usuario desabilitado';
                }
            }
        }
    } else {
        $php_estado = false;
        $php_msg = 'Usuario o Contraseña Incorrectos';
        $id_usuario = 0;
    }
}else{
    $php_msg = "Por favor diligencie los campos requeridos";
}


$datos = array(
    'estado' => $php_estado,
    'codigo' => $php_codigo,
    'msg' => $php_msg,
    "errores" => $php_error,

);


echo json_encode($datos, JSON_FORCE_OBJECT);
