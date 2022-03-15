<?php
session_start();
header('Content-Type: application/json');
require 'librerias/autoload.php';
require 'modelos/autoload.php';
require 'vendor/autoload.php';

$t1_terceros = new t1_terceros();
$t11_usuarios = new t11_usuarios();
$php_clases = new php_clases();
$cls_auth = new auth();

$php_estado = false;
$datos_usuario = false;
$php_msg = false;
$php_codigo = false;
$array_roles = false;
$permisos = false;

if (isset($_POST['usuario']) && !empty($_POST['usuario']) && isset($_POST['contrasenia']) && !empty($_POST['contrasenia'])) {
    $php_usuario = htmlspecialchars($_POST['usuario']);
    $php_password = htmlspecialchars($_POST['contrasenia']);

    $datos_usuario = false;
    $datos = false;
    $validacion_autenticacion = false;

    if (is_array($datos_usuario = $cls_auth->autenticacion_usuario($php_usuario, md5($php_password)))) {
        foreach ($datos_usuario as $key) {
            if ($key['estado'] == 1) {
                $id_usuario = $key['id_usuario'];
                $nombre_usuario = $key['nombre_cliente'];
                // traermos los Roles
                if (is_array($array_roles = $cls_auth->get_rol($key['id_usuario']))) {
                    if ($cls_auth->validar_permisos($array_roles, [3,101])) {
                        $php_estado = true;
                        $php_codigo = "portalcliente/index.php";
                        $php_codigo = "#";
                    }elseif ($cls_auth->validar_permisos($array_roles, [3, 102, 103])) {
                        $php_estado = true;
                        $php_codigo = "portalcliente/index.php";
                        $php_codigo = "#";                        
                    }else{
                        

                        $array_roles = false;
                    }

                    $php_msg = "El usuario no cuenta permisos";
                        $array_permisos = array(1);
                        foreach ($array_permisos as $key) {
                            // se valida que los permisos esten en el rol
                            if(in_array($key, (array)$array_roles)){
                                $php_msg = "bien";
                                
                            }else{
                                $php_msg =  "mal";
                            }
                        }

                } else {
                    $array_roles = false;
                    $php_msg = "El usuario no cuenta permisos";
                }
            } else {
                $php_msg = "El Usuario se encuentra deshabilitado";
            }
        }
    } else {
        //$datos_usuario = false;
        $php_msg = "Usuario y/o Contraseña Incorrectas";
    }


    
} else {
    $php_msg = "Faltan datos Requeridos para la autenticacion";
}



$datos = array(
    'estado' => $php_estado,
    'codigo' => $php_codigo,
    'errores' => $php_msg,
    //'datos_usuario' => $array_roles,
    //'array_roles' => $cls_auth->validar_permisos($array_roles, [1,'1']),
);


echo json_encode($datos, JSON_FORCE_OBJECT);
