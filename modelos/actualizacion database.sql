UPDATE `ct1_terceros` SET `ct1_RazonSocial` = 'PAULA GOMEZ' WHERE `ct1_terceros`.`ct1_IdTerceros` = 508; 
UPDATE `ct1_terceros` SET `ct1_RazonSocial` = 'SIRLEY ACEVEDO' WHERE `ct1_terceros`.`ct1_IdTerceros` = 510; 
UPDATE `ct1_terceros` SET `ct1_RazonSocial` = 'ANGIE MONDRAGON' WHERE `ct1_terceros`.`ct1_IdTerceros` = 543; 
UPDATE `ct1_terceros` SET `ct1_RazonSocial` = 'ANDRES MAECHA' WHERE `ct1_terceros`.`ct1_IdTerceros` = 629; 
UPDATE `ct1_terceros` SET `ct1_RazonSocial` = 'LEIDY ACERO' WHERE `ct1_terceros`.`ct1_IdTerceros` = 728; 
UPDATE `ct1_terceros` SET `ct1_RazonSocial` = 'CLAUDIA RODRIGUEZ' WHERE `ct1_terceros`.`ct1_IdTerceros` = 1133; 

UPDATE `ct1_terceros` SET `ct1_Estado` = '2' WHERE `ct1_terceros`.`ct1_IdTerceros` = 630; 
UPDATE `ct1_terceros` SET `ct1_Estado` = '2' WHERE `ct1_terceros`.`ct1_IdTerceros` = 779; 

ALTER TABLE `ct5_obras`  ADD `longitud` DOUBLE(11,8) NULL DEFAULT NULL  AFTER `ct5_barrio`,  ADD `latitud` DOUBLE(11,8) NULL DEFAULT NULL  AFTER `longitud`;


ALTER TABLE `ct29_batch` ADD `consolidado_remi` VARCHAR(100) NULL DEFAULT NULL AFTER `ct29_TAguaxM3`;

ALTER TABLE `ct26_remisiones`  ADD `consolidado_remi` VARCHAR(100) NULL DEFAULT NULL  AFTER `ct26_codigo_remi`;