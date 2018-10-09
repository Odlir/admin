DROP TABLE IF EXISTS tb_solicitud_compra;
CREATE TABLE `tbl_productos` (
  `producto_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `codigo` varchar(128),
  `marca` varchar(128),
  `imagen` varchar(200),
  `documento` varchar(200),
  `unidad` int NOT NULL,
  `comentario` varchar(250),
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activo` int DEFAULT 1,
  PRIMARY KEY (`producto_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8

