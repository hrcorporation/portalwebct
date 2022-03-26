<?php
require 'librerias/autoload.php';
require 'modelos/autoload.php';
require 'vendor/autoload.php';

$cls_auth = new auth();

$roles_usuario = array(1,2,3);

var_dump($cls_auth->validar_permisos($roles_usuario, [9,6]));