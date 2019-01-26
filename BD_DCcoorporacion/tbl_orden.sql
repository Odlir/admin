# Host: localhost  (Version 5.5.5-10.1.34-MariaDB)
# Date: 2019-01-24 23:11:30
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "tbl_orden"
#

CREATE TABLE `tbl_orden` (
  `orden_id` int(11) NOT NULL AUTO_INCREMENT,
  `nrodocumento` varchar(20) NOT NULL DEFAULT '',
  `proveedor_id` int(11) NOT NULL DEFAULT '0',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activo` int(1) NOT NULL DEFAULT '0',
  `comentario` varchar(255) DEFAULT '',
  `created_by` int(11) DEFAULT '0',
  `estado` int(1) DEFAULT '1',
  PRIMARY KEY (`orden_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
