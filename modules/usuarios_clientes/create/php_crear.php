<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$php_clases = new php_clases();
$t1_terceros = new t1_terceros();
$usuarios_clientes = new usuarios_clientes();
//$t_nombretabla = new tabla();

$php_estado = false;
$php_error[] = "";
$resultado = "";
$id = 0;
//Validar que el numero identificacion, nombre y apellido exista
if (isset($_POST['C_NumeroID']) && isset($_POST['C_nombres']) && isset($_POST['C_Apellidos'])) {
    //numero identificacion
    $C_NumeroID = htmlspecialchars($_POST['C_NumeroID']);
    //nombre del usuario cliente
    $C_nombres = htmlspecialchars($_POST['C_nombres']);
    //apellido del usuario cliente
    $C_Apellidos = htmlspecialchars($_POST['C_Apellidos']);
    //usuario cliente (numero identificacion)
    $C_Usuario = $C_NumeroID;
    //contraseña del usuario cliente (numero identificacion encriptado)
    $C_Pass = md5($C_NumeroID);
    //razon social del usuario cliente (concatenacion del nombre y apellido)
    $razonSocial = $C_nombres . " " . $C_Apellidos;
    //estado del usuario cliente (1 activo, 2 inactivo)
    $estado = 1;
    //rol del usuario cliente
    $rol = htmlspecialchars($_POST['txt_rol']);
    //tipo de tercero
    $TipoTercero = 3;
    //Validar que la funcion de crear_usuario_cliente funcione correctamente con los parametros anteriores
    if($id = $t1_terceros->crear_usuario_cliente($C_NumeroID, $C_nombres, $C_Apellidos, $rol)){
        //si hace la validacion se retorna verdadero (true)
        $php_estado = true;
    }else{
        
        $php_estado = false;
        $php_error = "Error al guardar en la base de datos";
    }
} else {
    $php_estado = false;
    $php_error = "faltan campos requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
    'id' => $id,
    
);

echo json_encode($datos, JSON_FORCE_OBJECT);
