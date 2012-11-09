-- phpMyAdmin SQL Dump
-- version 3.3.7deb5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-11-2012 a las 20:23:56
-- Versión del servidor: 5.1.49
-- Versión de PHP: 5.3.3-7+squeeze3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `eye2000`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE IF NOT EXISTS `historial` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_cliente` int(10) unsigned NOT NULL,
  `miopia_od` decimal(4,2) unsigned NOT NULL DEFAULT '0.00',
  `hipermetropia_od` decimal(4,2) unsigned NOT NULL DEFAULT '0.00',
  `astigmatismo_od` decimal(4,2) unsigned NOT NULL DEFAULT '0.00',
  `presbicia_od` decimal(4,2) unsigned NOT NULL DEFAULT '0.00',
  `info` text NOT NULL,
  `miopia_oi` decimal(4,2) unsigned NOT NULL DEFAULT '0.00',
  `hipermetropia_oi` decimal(4,2) unsigned NOT NULL DEFAULT '0.00',
  `astigmatismo_oi` decimal(4,2) unsigned NOT NULL DEFAULT '0.00',
  `presbicia_oi` decimal(4,2) unsigned NOT NULL DEFAULT '0.00',
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `id_cliente`, `miopia_od`, `hipermetropia_od`, `astigmatismo_od`, `presbicia_od`, `info`, `miopia_oi`, `hipermetropia_oi`, `astigmatismo_oi`, `presbicia_oi`, `fecha`) VALUES
(1, 20674317, '0.00', '0.00', '0.00', '0.00', '', '0.00', '0.00', '0.00', '0.00', '2012-01-10 16:16:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paginas`
--

CREATE TABLE IF NOT EXISTS `paginas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `url` varchar(37) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `contenido` text NOT NULL,
  `menu` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `titulo` (`titulo`),
  KEY `url` (`url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `paginas`
--

INSERT INTO `paginas` (`id`, `titulo`, `url`, `descripcion`, `contenido`, `menu`, `fecha`) VALUES
(1, 'Servicios', 'Servicios', 'sdasd', 'sdasdasdasd', 0, '2012-01-04 22:53:45'),
(2, 'home', 'index', 'pagina principal', 'Óptica EYE 2000 C.A , se enorgullece de ofrecer un stop de monturas de lentes correctivos, lentes de sol y lentes de contactos de las mejores marcas, gustos y colores para nuestra distinguida clientela.', 0, '2012-01-04 23:33:10'),
(3, 'Mision, Vision y Valores', 'mision_vision_y_valores', 'Mision, Vision y Valores de la Empresa', '<dl>\r\n<dt>Misión</dt>\r\n<dd>Darnos a conocer por el excelente servicios prestado a nuestros clientes, ofreciéndole calidad en marcas de monturas, lentes de sol, lentes correctivos y lentes de contactos, como también cuidando su salud visual. De manera de crear lazos perdurables en el tiempo con nuestros clientes.</dd>\r\n<dt>Visión</dt>\r\n<dd>Posicionarnos en el mercado tanto Nacional como internacional, caracterizándonos por complacer a la clientela más exigente.</dd>\r\n<dt>Valores</dt>\r\n<dd>Nuestro equipo de trabajo se basa en los siguientes principios:\r\n<ul>\r\n<li><b>Honestidad:</b> Proyectarnos tal y como somos.</li>\r\n<li><b>Igualdad:</b> Todos nuestros clientes son importantes.</li>\r\n<li><b>Responsabilidad:</b> Garantizar la salud visual.</li>\r\n<li><b>Trabajo en equipo:</b> Unidos todos en una causa, darle la mejor atención.</li>\r\n<li><b>Creatividad:</b> Buscamos la innovación y la moda para nuestra clientela.</li>\r\n<li><b>Ética:</b> Nuestro personal es altamente calificado, asegurando un buen trabajo.</li>\r\n</ul>\r\n</dd>\r\n</dl>\r\n<style>\r\ndt{ text-decoration: underline;}\r\n</style>', 1, '2012-01-10 14:20:14'),
(4, 'Historia', 'historia', 'Historia de l aoptica EYE-2000', '<p>Fue durante el año 2000, que se tuvo la idea de crear una Óptica que operase en los Altos Mirandinos. En un principio no se contaba con recursos suficientes para llevar a cabo éste proyecto, hasta que en el año 2001 , con la ayuda económica prestada por una entidad Bancaria a los socios, se obtuvo el dinero suficiente para financiar el proyecto, a partir de ese momento nace una Óptica cuyo nombre es “Óptica EYE 2000 C.A”.</p>\r\n<p>La Óptica partió con la idea de cubrir las demandas de servicios de la clientela del Sector Rosalito (San Antonio de Los Altos), en vista de que en éste sector existen muy pocos centros ópticos  dedicados a prestar servicios de oftalmología y optometría, esperando con ello satisfacer la gran demanda existente en el sector.</p>\r\n<p>Durante sus comienzos el personal de la óptica estuvo conformado por un optometrista y un vendedor que realizaba las operaciones de facturación. En ese entonces la optometrista que es uno de las socias propietaria de la óptica, trabajando con ética, profesionalismo y amor por su trabajo se fue ganando día a día el respeto y aprobación del servicio que estaba prestando a la clientela. Ella pudo observar que en la medida que fue creciendo la clientela eran demandados otros servicios que la óptica no tenía, y fue cuando ella y los socios de la óptica toman la iniciativa de contratar a un oftalmólogo otro profesional de la salud visual, con este nuevo miembro se conforma un equipo multidisciplinario mucho más completo capaz de cubrir íntegramente con los servicios extras, demandados, con esto se logra llevar a la óptica EYE 2000 C.A, como uno de los centros ópticos preferidos por el público en general.</p>\r\n<p>Hoy por hoy, se cuenta con un excelente centro óptico capaz de cumplir con las necesidades de la clientela más exigentes.</p>\r\n<style>\r\np {text-indent: 20px;}\r\n</style>', 1, '2012-01-10 14:26:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_cliente` int(10) unsigned NOT NULL,
  `id_status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_status` (`id_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcar la base de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id`, `id_cliente`, `id_status`, `fecha`) VALUES
(4, 20674317, 1, '2012-01-12 22:48:21'),
(6, 20674317, 1, '2012-01-15 22:19:18'),
(7, 20674317, 1, '2012-01-15 22:21:02'),
(8, 20674317, 2, '2012-01-15 22:50:33'),
(9, 20674317, 3, '2012-06-19 19:21:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_producto`
--

CREATE TABLE IF NOT EXISTS `pedido_producto` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_pedido` int(10) unsigned NOT NULL,
  `id_producto` tinyint(3) unsigned NOT NULL,
  `cantidad` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_producto` (`id_producto`),
  KEY `id_pedido` (`id_pedido`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Volcar la base de datos para la tabla `pedido_producto`
--

INSERT INTO `pedido_producto` (`id`, `id_pedido`, `id_producto`, `cantidad`) VALUES
(1, 4, 1, 98),
(2, 6, 1, 20),
(3, 6, 2, 30),
(11, 8, 2, 1),
(12, 8, 1, 1),
(13, 7, 1, 100),
(14, 7, 2, 255),
(15, 7, 5, 255),
(16, 9, 1, 2),
(17, 9, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_status`
--

CREATE TABLE IF NOT EXISTS `pedido_status` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `pedido_status`
--

INSERT INTO `pedido_status` (`id`, `status`) VALUES
(1, 'No Pagado'),
(2, 'Tarjeta de Credito'),
(3, 'Efectivo'),
(4, 'Cheque');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `id` tinyint(7) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` char(9) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_marca` tinyint(3) unsigned NOT NULL,
  `id_modelo` tinyint(3) unsigned NOT NULL,
  `id_tipo` tinyint(3) unsigned NOT NULL,
  `id_genero` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `color` varchar(40) NOT NULL DEFAULT '',
  `manufactura` varchar(50) NOT NULL DEFAULT '',
  `precio` decimal(4,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `id_marca` (`id_marca`),
  KEY `id_modelo` (`id_modelo`),
  KEY `id_tipo` (`id_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `codigo`, `nombre`, `id_marca`, `id_modelo`, `id_tipo`, `id_genero`, `color`, `manufactura`, `precio`) VALUES
(1, 's2134', 'Lentes de Sol Blancos', 9, 1, 1, 1, 'blanco', 'no se', '87.65'),
(2, 'S23123', 'producto de prueba', 10, 2, 2, 2, 'Verde', 'chino', '9.00'),
(5, 's12345', 'cristal de 0,25 mm', 1, 1, 2, 3, 'transparente', 'eeuu', '8.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_genero`
--

CREATE TABLE IF NOT EXISTS `producto_genero` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `genero` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `producto_genero`
--

INSERT INTO `producto_genero` (`id`, `genero`) VALUES
(1, 'Hombre'),
(2, 'Mujer'),
(3, 'Unisex');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_marca`
--

CREATE TABLE IF NOT EXISTS `producto_marca` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `marca` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Volcar la base de datos para la tabla `producto_marca`
--

INSERT INTO `producto_marca` (`id`, `marca`) VALUES
(1, 'Cube'),
(2, 'Celine'),
(3, 'Carolina Herrera'),
(4, 'Azzaro'),
(5, 'BVLGARI'),
(6, 'Caroni - Design'),
(7, 'Caroni - collezine'),
(8, 'Cartier'),
(9, 'CHANEL'),
(10, 'Clavin Klein'),
(11, 'Cour Carré');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_modelo`
--

CREATE TABLE IF NOT EXISTS `producto_modelo` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `modelo` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `producto_modelo`
--

INSERT INTO `producto_modelo` (`id`, `modelo`) VALUES
(1, 'Lentes de Sol'),
(2, 'Lentes Correctivos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_tipo`
--

CREATE TABLE IF NOT EXISTS `producto_tipo` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `producto_tipo`
--

INSERT INTO `producto_tipo` (`id`, `tipo`) VALUES
(1, 'lente'),
(2, 'cristal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `cedula` int(10) unsigned NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `pwd` varchar(40) DEFAULT NULL,
  `id_tipo` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `habilitado` tinyint(1) NOT NULL DEFAULT '1',
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `sexo` tinyint(1) NOT NULL,
  `email` varchar(96) NOT NULL,
  `f_nacimiento` date DEFAULT NULL,
  `tele_local` varchar(12) NOT NULL,
  `tele_celular` varchar(12) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `f_log` datetime NOT NULL,
  `f_reg` datetime NOT NULL,
  PRIMARY KEY (`cedula`),
  UNIQUE KEY `usuario` (`usuario`),
  UNIQUE KEY `email` (`email`),
  KEY `id_tipo` (`id_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`cedula`, `usuario`, `pwd`, `id_tipo`, `habilitado`, `nombres`, `apellidos`, `sexo`, `email`, `f_nacimiento`, `tele_local`, `tele_celular`, `ip`, `f_log`, `f_reg`) VALUES
(19, 'prueba', '711383a59fda05336fd2ccf70c8059d1523eb41a', 2, 1, 'mariano', 'ramirez', 0, 'mariano_ramirez353@hotmail.com', '1990-12-12', '', '', '127.0.0.1', '2012-01-16 13:07:34', '0000-00-00 00:00:00'),
(20674317, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 1, 'mariano', 'ramirez', 0, 'marianoramirez353@gmail.com', '1990-07-19', '123', 'w123', '127.0.0.1', '2012-11-08 19:22:46', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_tipo`
--

CREATE TABLE IF NOT EXISTS `usuario_tipo` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `usuario_tipo`
--

INSERT INTO `usuario_tipo` (`id`, `tipo`) VALUES
(1, 'Administrador'),
(2, 'Cliente');

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `usuario` (`cedula`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `usuario` (`cedula`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`id_status`) REFERENCES `pedido_status` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido_producto`
--
ALTER TABLE `pedido_producto`
  ADD CONSTRAINT `pedido_producto_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_producto_ibfk_3` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `usuario_tipo` (`id`) ON UPDATE CASCADE;
