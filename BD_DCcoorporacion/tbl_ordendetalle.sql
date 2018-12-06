# Host: localhost  (Version 5.5.5-10.1.34-MariaDB)
# Date: 2018-12-06 00:19:45
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "tbl_ordendetalle"
#

DROP TABLE IF EXISTS `tbl_ordendetalle`;
CREATE TABLE `tbl_ordendetalle` (
  `ordendetalle_id` int(11) NOT NULL AUTO_INCREMENT,
  `orden_id` int(11) DEFAULT '0',
  `producto_id` int(11) DEFAULT '0',
  `cantidad` int(11) DEFAULT '0',
  `comentario` varchar(255) DEFAULT '',
  `activo` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ordendetalle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
