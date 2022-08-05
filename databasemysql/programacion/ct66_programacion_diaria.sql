CREATE TABLE `concr_bdportalconcretol`.`ct66_programacion_semanal` ( `id` INT(11) NOT NULL AUTO_INCREMENT , 
`status` INT(11) NULL DEFAULT NULL  , 
`id_cliente` INT(11) NULL DEFAULT NULL  , 
`nombre_cliente` VARCHAR(255) NULL DEFAULT NULL  , 
`id_obra` INT(11) NULL DEFAULT NULL  , 
`nombre_obra` VARCHAR(255) NULL DEFAULT NULL  , 
`id_pedido` INT(11) NULL DEFAULT NULL  , 
`id_producto` INT(11) NULL DEFAULT NULL  , 
`nombre_producto` VARCHAR(255) NULL DEFAULT NULL  , 
`cantidad` DOUBLE NULL DEFAULT NULL  , 
`valor_programacion` DOUBLE NULL DEFAULT NULL  , 
`id_linea_produccion` INT(11) NULL DEFAULT NULL  , 
`nombre_linea_produccion` VARCHAR(255) NULL DEFAULT NULL  , 
`hora_cargue` TIME NULL DEFAULT NULL  , 
`hora_mixer_obra` TIME NULL DEFAULT NULL  , 
`id_mixer` INT(11) NULL DEFAULT NULL  , 
`mixer` VARCHAR(255) NULL DEFAULT NULL  , 
`id_conductor` INT(11) NULL DEFAULT NULL  , 
`nombre_conductor` VARCHAR(255) NULL DEFAULT NULL  , 
`requiere_bomba` BOOLEAN NULL DEFAULT NULL  , 
`id_tipo_descargue` INT(11) NULL DEFAULT NULL  , 
`nombre_tipo_descargue` VARCHAR(255) NULL DEFAULT NULL  , 
`id_tipo_bomba` INT(11) NULL DEFAULT NULL  , 
`tipo_bomba` INT(11) NULL DEFAULT NULL  , 
`metros_tuberia` INT(11) NULL DEFAULT NULL  , 
`elemento_fundir` INT(11) NULL DEFAULT NULL  , 
`observaciones` INT(11) NULL DEFAULT NULL  , 
`fecha_ini` INT(11) NULL DEFAULT NULL  , 
`fecha_fin` INT(11) NULL DEFAULT NULL  , 
`id_usuario` INT(11) NULL DEFAULT NULL  , 
`nombre_usuario` INT(11) NULL DEFAULT NULL  , 
`fecha_creacion` INT(11) NULL DEFAULT NULL  , 
`id_usuario_edit` INT(11) NULL DEFAULT NULL  , 
`nombre_usuario_edit` INT(11) NULL DEFAULT NULL  , 
`fecha_modificacion` INT(11) NULL DEFAULT NULL  , 

PRIMARY KEY (`id`)) ENGINE = InnoDB;