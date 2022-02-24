<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$php_clases = new php_clases();
$t5_obras = new t5_obras();
$permisos = new permisos();
$usuarios = new usuarios();
$modelo_laboratorio = new modelo_laboratorio();



// Roles
//$id_cliente = intval($_POST['cliente']);
//$id_cliente = 21;

// Roles
//$rol_user = $usuarios->buscar_roles($_SESSION['id_usuario']);
//$modulo_usuarios = array(1);
//$modulo_usuarios =  $permisos->habilitar($modulo_usuarios, $rol_user);

$id_muestra = intval($_POST['id_muestra']);

$modulo_usuarios = true;
if ($modulo_usuarios) {
    $data = $modelo_laboratorio->datatable_dias_muesta($id_muestra);
} else {
    $data = null;
}



print json_encode($data, JSON_UNESCAPED_UNICODE);

