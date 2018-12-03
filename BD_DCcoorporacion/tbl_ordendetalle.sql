# Host: localhost  (Version 5.5.5-10.1.34-MariaDB)
# Date: 2018-12-02 22:21:43
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
  PRIMARY KEY (`ordendetalle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
