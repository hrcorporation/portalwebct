<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';


$php_clases = new php_clases();
$t27_factura = new t27_factura();
$t26_remisiones = new t26_remisiones();
$php_fechatime = "" . date("Y-m-d H:i:s");

$php_estado = false;
$errores[] = "";
$resultado = "";
$php_error = "";

$id_factura = $_POST['id_factura'];



if (isset($_POST['h_datos']) && !empty($_POST['h_datos']) && $_POST['h_datos'] == 1) {
    $id_factura = $_POST['id_factura'];
    $id_cliente = (int) htmlspecialchars($_POST['Txb_IdTercero']);
    $id_obra = (int) htmlspecialchars($_POST['Txb_IdObras']);
    $numero_factura = htmlspecialchars($_POST['numero_factura']);
    $valor = (int) htmlspecialchars($_POST['valor_factura']);
    //$modificacion = htmlspecialchars($_POST['Txb_RazonM']);


    $result = $t27_factura->editar_datos_factura($numero_factura, $valor, $id_cliente, $id_obra, $id_factura);

    if ($result) {
        $php_estado = true;
        $php_error = $result;
    } else {
        $php_estado = false;
        $php_error = "error al guardar en la base de datos";
    }
}

if (isset($_POST['habi_img']) && !empty($_POST['h_datos']) && $_POST['habi_img'] == 1) {
    $php_estado = true;
    $image = htmlspecialchars($_FILES['image']['name']);
    $ruta = htmlspecialchars($_FILES['image']['tmp_name']);

    $php_fileexten = strrchr($_FILES['image']['name'], ".");
    $php_serial = strtoupper(substr(hash('sha1', $_FILES['image']['name'] . $php_fechatime), 0, 40)) . $php_fileexten;

    $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/internal/images/facturas/';
    $php_tempfoto = ('/internal/images/facturas/' . $php_serial);

    $actualizar_factura = $t27_factura->editar_archivo_factura($php_tempfoto, $id_factura);

    if ($actualizar_factura) {
        $php_movefile = move_uploaded_file($ruta, $carpeta_destino . $php_serial);

        $php_error = "Factura actualizada correctamente";
    }
}


$php_remisiones = $_POST["remision"];

///remisiones seleccionadas
$php_contadorremisiones = count($php_remisiones);

if ($php_remisiones) {
    $eliminar_remisiones = $t27_factura->eliminafactura_remi($id_factura);
    if ($eliminar_remisiones) {
        foreach ($php_remisiones as $number => $idremisiones) {
            $estado = 1;
            $t26_remisiones->actualizar_estado_remi_fact($idremisiones, $estado);
            $result2 = $t27_factura->insertar_factura_remi($id_factura, $idremisiones);



            if ($result2) {
                $php_estado = true;
                //$php_movefile = move_uploaded_file($ruta, $carpeta_destino . $php_serial);
            } else {
                $errores = "hubo un error al guardar las remisiones";
            }
        }
    }
}









$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
