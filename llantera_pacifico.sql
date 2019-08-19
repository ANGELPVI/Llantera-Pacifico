-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-08-2017 a las 04:48:34
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `llantera_pacifico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apartado`
--

CREATE TABLE `apartado` (
  `Id_apartado` int(11) NOT NULL,
  `Id_sucu_ap` int(11) NOT NULL,
  `Id_perso_ap` int(11) NOT NULL,
  `Id_pro_ap` int(11) NOT NULL,
  `Nombre_cli_A` varchar(50) NOT NULL,
  `Tel_cli_a` varchar(10) NOT NULL,
  `Celular_cli_ap` varchar(10) NOT NULL,
  `Direccion_cli_ap` varchar(80) NOT NULL,
  `fecha_apartado` date NOT NULL,
  `Fecha_termi` date NOT NULL,
  `Abono_ap` double NOT NULL,
  `Estado_ap` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_p`
--

CREATE TABLE `clientes_p` (
  `Id_cliente` varchar(20) NOT NULL,
  `Nom_cliete_p` varchar(50) NOT NULL,
  `Telefono_cli_p` varchar(10) NOT NULL,
  `Celular_cli_p` varchar(10) NOT NULL,
  `Correo_cli_p` varchar(80) NOT NULL,
  `Dereccion_cli_p` varchar(100) NOT NULL,
  `RFC_cli` varchar(15) NOT NULL,
  `Id_sucursal_p` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes_p`
--

INSERT INTO `clientes_p` (`Id_cliente`, `Nom_cliete_p`, `Telefono_cli_p`, `Celular_cli_p`, `Correo_cli_p`, `Dereccion_cli_p`, `RFC_cli`, `Id_sucursal_p`) VALUES
('MRCRMR95102512M200', 'MERLE ADYERIN MORENOS CARDENAS', '7585382174', '7581085251', 'merle_adyerin@gmail.com', 'ew3cxerc4rcr', 'N/P', 3),
('PIVA94HGR08H', 'SEFERINO LAGUNA MONTEZ', '7871098212', '7581082195', 'seferino@gmail.com', 'ewcxwedcecercervcerfvrefvreverf rfcer', 'N/P', 1),
('PIVVAN94090812H700', 'ANGEL PIÃ‘A VIVEROS', '7585382174', '7581009564', 'anggel_viveros08@outlook.com', 'Petatla\r\nLuis donado colosio\r\nRecursos hidaulicos', 'N/P', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `Id_compra` int(11) NOT NULL,
  `Id_produc_c` int(11) NOT NULL,
  `Id_provedor_c` int(11) NOT NULL,
  `Id_perso_c` int(11) NOT NULL,
  `Id_sucu_c` int(11) NOT NULL,
  `Cantidad_c` int(11) NOT NULL,
  `Nombre_pro_em` varchar(20) NOT NULL,
  `Codigo_fatura_c` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `total_c` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credito`
--

CREATE TABLE `credito` (
  `Id_credito` int(11) NOT NULL,
  `Id_produc_cre` int(11) NOT NULL,
  `Abonos` int(11) NOT NULL,
  `Deuda` int(11) NOT NULL,
  `Des_cre` double NOT NULL,
  `Fecha_abono` date NOT NULL,
  `Fecha_compra` date NOT NULL,
  `Total_cuenta` int(11) NOT NULL,
  `Id_sucursal_cre` int(11) NOT NULL,
  `Id_perso_cre` int(11) NOT NULL,
  `Id_cliente_cre_p` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `credito`
--

INSERT INTO `credito` (`Id_credito`, `Id_produc_cre`, `Abonos`, `Deuda`, `Des_cre`, `Fecha_abono`, `Fecha_compra`, `Total_cuenta`, `Id_sucursal_cre`, `Id_perso_cre`, `Id_cliente_cre_p`) VALUES
(1, 424622, 20, 2506, 10, '2017-08-14', '2017-08-09', 162, 3, 180907084, 'PIVVAN94090812H700'),
(2, 504242, 50, 4176, 10, '2017-08-14', '2017-08-09', 3089, 3, 180907084, 'PIVVAN94090812H700');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `folio`
--

CREATE TABLE `folio` (
  `Id_folio` int(11) NOT NULL,
  `Id_venta_fo` int(11) NOT NULL,
  `Total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `Id_movimiento` int(11) NOT NULL,
  `Id_personal` int(11) NOT NULL,
  `desde` varchar(40) NOT NULL,
  `destino` varchar(40) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Nota` text NOT NULL,
  `Estado_mo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`Id_movimiento`, `Id_personal`, `desde`, `destino`, `Cantidad`, `Fecha`, `Nota`, `Estado_mo`) VALUES
(819, 180907084, 'Morelia', 'Zihuatanejo', 8, '2017-08-13', 'Envio de llantas', 'En Camino'),
(1528, 140907085, 'Zihuatanejo', 'Morelia', 10, '2017-08-13', 'EnvÃ­o de llantas', 'Concretado'),
(1998, 140907085, 'Zihuatanejo', 'Morelia', 20, '2017-08-13', 'EnvÃ­o de llantas asimÃ©tricas', 'Concretado'),
(2194, 140907084, 'Morelia', 'Zihuatanejo', 1, '2017-07-13', 'sdsdsd', 'Concretado'),
(5346, 140907085, 'Zihuatanejo', 'Morelia', 500, '0000-00-00', 'Envio desde zihutanejo', 'Concretado'),
(6213, 180907084, 'Morelia', 'Zihuatanejo', 4, '2017-08-14', 'Prueba', 'En Camino'),
(14885, 180907084, 'Morelia', 'Zihuatanejo', 2, '2017-08-11', 'Envio', 'En Camino'),
(19971, 140907085, 'Zihuatanejo', 'Morelia', 60, '0000-00-00', 'Envio hacia morelia', 'Concretado'),
(22457, 140907084, 'Morelia', 'Zihuatanejo', 50, '2017-07-10', 'dvdaveadvadv', 'Concretado'),
(23407, 140907084, 'Morelia', 'Zihuatanejo', 100, '2017-07-10', 'ewfververfvrev', 'Concretado'),
(26015, 180907084, 'Morelia', 'Zihuatanejo', 20, '2017-08-14', 'EnvÃ­o de llantas', 'En Camino'),
(29266, 180907084, 'Morelia', 'Zihuatanejo', 10, '2017-08-03', 'rrgdgdg', 'Concretado'),
(29468, 140907084, 'Morelia', 'Zihuatanejo', 100, '2017-07-11', '3r2f4r2f43fd43f', 'Concretado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movi_pro`
--

CREATE TABLE `movi_pro` (
  `Id_movi_1` int(11) NOT NULL,
  `Id_prod_2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `movi_pro`
--

INSERT INTO `movi_pro` (`Id_movi_1`, `Id_prod_2`) VALUES
(14885, 42237),
(1998, 301026),
(1528, 301026),
(819, 42237),
(26015, 424622),
(6213, 504242);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `Id_persona` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Pass` varchar(300) NOT NULL,
  `Tipo` varchar(50) NOT NULL,
  `Tel` varchar(10) NOT NULL,
  `Celular` varchar(10) NOT NULL,
  `Ciudad_pe` varchar(50) NOT NULL,
  `Colonia_pe` varchar(50) NOT NULL,
  `Calle_pe` varchar(50) NOT NULL,
  `RFC` varchar(13) NOT NULL,
  `Id_sucu_1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`Id_persona`, `Nombre`, `Pass`, `Tipo`, `Tel`, `Celular`, `Ciudad_pe`, `Colonia_pe`, `Calle_pe`, `RFC`, `Id_sucu_1`) VALUES
(140907084, 'GERMAN SALGADO RAMOS', '$2y$10$a3XVyZ9Zthzl4qpwe4K9ce/v6RYJ543JwoB.mDRYYfTF5PtnlDMbq', 'Almacenista', '7585382421', '7581009564', 'Petatlan', 'Luis Donado Colocio', 'Recursos Hidraulicos', 'AHGDGDV76VSHB', 3),
(140907085, 'Merle Adyerin Moreno cardenas', '$2y$10$Fx2BLYGf3wUq7vj3jbYcHui5UI2j9thkL.EDQaxaNWe375isnuGF6', 'Almacenista', '7585382124', '7581085152', 'Petatlan', 'Luis donado colosio', 'Recursos hidraulicos', 'ASDDWWE223DET', 1),
(150907084, 'JOSE LOPEZ JUAREZ', '$2y$10$eJqREt17v3mtcUlJWjFZAOidXbaRGrvHHpkEi1ds4QbmuI5TEgR/i', 'Vendedor', '7585382174', '7581009564', 'Lazaro', 'Luis donado colocio', 'Recursos Hidraulicos', 'VEFRVE543544F', 3),
(150907085, 'juan peres osuna', '$2y$10$zPwhKFKXyMq.MXdYLFbFFOQ07xlwXX2Y0Qe.SZVIUC1TDGKnlt13e', 'Vendedor', '2424234234', '2353252233', 'sdvdsvd', 'svdsvsdvdsfwefwe', 'vdsvsddwdqdwq', 'dsvsdvert4t4t', 1),
(180907084, 'ANGEL PIÃ‘A VIVEROS', '$2y$10$ZN2bZJA8.xxCTW5fB3uMYuAxoUSoSYbWndUhGu0Hd7/nsflz4MwIe', 'Administrativo', '7581009564', '76109234ss', 'petatlan', 'Recurso Hidraulicos', 'Luis donado colocio', 'WCEVCERRVCECE', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `Id_pro` int(11) NOT NULL,
  `Codigo_pro` varchar(20) NOT NULL,
  `Nombre` varchar(70) NOT NULL,
  `Tama` varchar(40) NOT NULL,
  `Modelo` varchar(50) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `Stock` int(11) NOT NULL,
  `Precio_com` double NOT NULL,
  `Precio_ven` double NOT NULL,
  `fecha_entrada` date NOT NULL,
  `Fecha_caducidad` date NOT NULL,
  `Estado` varchar(30) NOT NULL,
  `id_prove_p` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`Id_pro`, `Codigo_pro`, `Nombre`, `Tama`, `Modelo`, `Descripcion`, `Stock`, `Precio_com`, `Precio_ven`, `fecha_entrada`, `Fecha_caducidad`, `Estado`, `id_prove_p`) VALUES
(1231, '2323', 'ewxe', 'ewxxw', 'ewx', 'ewxew', 12, 0, 0, '2017-08-14', '2017-08-30', 'aw', 15),
(9095, '9897AB301', 'Rin Sentra', '255/75R15', '2015', 'Rin para sentra', 20, 1000, 1500, '2017-08-12', '2017-08-31', 'Activo', 16),
(11233, 'cdsc', 'csdc', 'dsc', 'sdcsc', 'dcdsc', 12, 12, 12, '2017-08-14', '2017-08-28', 'wde', 15),
(42237, '989704444', 'FILTRO DE GASOLINA', '255/75R15', '2016', 'Filtro de gazolina', 275, 0, 1100, '2017-08-06', '2017-08-31', 'ACTIVO', 14),
(105347, '9701SDCWA', 'LLANTA PARA JETTA', '255/R751', '2015', 'Llanta para jetta 2016', 230, 1500, 2000, '2017-08-06', '2017-08-30', 'ACTIVO', 15),
(301026, '989708888', 'Llanta asimÃ©trica', '255/75R14', '2018', 'Llanta asimÃ©trica', 90, 2300, 2900, '2017-08-13', '2017-08-31', 'Activo', 13),
(422028, 'SD12S3423', 'RIN DE SENTRA ', '255/R752', '2017', 'Rin para carro sentra', 100, 1200, 2500, '2017-08-06', '2017-09-27', 'ACTIVO', 16),
(424622, '989701111', 'RINES DOBLE RODADO', '255/R255', '2016', 'Rin para dobles rodados', 166, 1000, 1200, '2017-08-06', '2017-09-30', 'ACTIVO', 16),
(462494, '98970ASB', 'Llanta derrapante', '255/75R15', '2016', 'Llanta anti derrapante', 130, 2300, 2800, '2017-08-14', '2017-08-30', 'Activo', 13),
(504242, '989702222', 'LLANTAS DE DOS HILOS', '255/R752', '2017', 'Llanta de hilos ', 108, 3400, 1500, '2017-08-06', '2017-08-13', 'Caducado', 15),
(597138, '9897B1230', 'LLANTA DE DOBLE TARCCION', '255/R233', '2017', 'Llanta para carro 4x4', 100, 0, 3500, '2017-08-06', '2017-09-27', 'ACTIVO', 15),
(867157, '989708888', 'Llanta asimÃ©trica', '255/75R14', '2018', 'Llanta asimÃ©trica', 3, 2300, 2900, '2017-08-13', '2017-08-28', 'Suspedido', 13),
(915741, '98970A2123', 'LLANTA DOBLE RODADO', '255/R752', '2018', 'Llanta para doble rodado2', 2, 2300, 2900, '2017-08-06', '2017-08-31', 'ACTIVO', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provedores`
--

CREATE TABLE `provedores` (
  `Id_provedor` int(11) NOT NULL,
  `Telefono` varchar(10) NOT NULL,
  `Correo` varchar(20) NOT NULL,
  `Ciudad_prove` varchar(30) NOT NULL,
  `Estado_pro` varchar(40) NOT NULL,
  `Colonia_prove` varchar(30) NOT NULL,
  `Calle_prove` varchar(30) NOT NULL,
  `Nombre_empresa` varchar(50) NOT NULL,
  `RFC` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `provedores`
--

INSERT INTO `provedores` (`Id_provedor`, `Telefono`, `Correo`, `Ciudad_prove`, `Estado_pro`, `Colonia_prove`, `Calle_prove`, `Nombre_empresa`, `RFC`) VALUES
(13, '7592132134', 'michelin@gmail.com', 'Lazaro', 'Morelia', 'Tamarindo', 'Lagunas', 'Michelin S.A De B.C', 'OP120932SA123'),
(14, '7342423459', 'bridges@gamail.com', 'Guadalajara', 'Guadalajara', 'Reforma', 'Las tunas', 'Bridgestone', 'AP12SA12CVD43'),
(15, '7213409219', 'rago@gmail.com', 'Mexico', 'Mexico', 'Los pinos', 'Llanitos', 'Agroindustria Rango', 'APSB391S3MKAS'),
(16, '7590129087', 'neumaticos@gmail.com', 'Morelia', 'Morelia', 'Recursos', 'Emiliano zapata', 'Neumaticos y Rines Industriales', 'SAQ19DHC12SWF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `Id_sucu` int(11) NOT NULL,
  `Administrador` varchar(50) NOT NULL,
  `Ciudad` varchar(50) NOT NULL,
  `Colonia` varchar(50) NOT NULL,
  `Calle` varchar(50) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Tel` varchar(10) NOT NULL,
  `RfC` varchar(13) NOT NULL,
  `CP` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`Id_sucu`, `Administrador`, `Ciudad`, `Colonia`, `Calle`, `Correo`, `Tel`, `RfC`, `CP`) VALUES
(1, 'Angel piña Viveros', 'Zihuatanejo', 'El ujal', 'Centro', 'tallerZihua@gmail.com', '6543673', 'ADWECWEC32', '12098'),
(2, 'Marcos Pino Mora', 'Huruapan', 'Niños Herues', 'Independecia', 'tallerpacifico_hurupan@gmail.com', '7441235782', 'AGSHSH675SHS8', '24879'),
(3, 'Maria Leyva Montez', 'Morelia', 'Los pinos', 'niño perdido', 'tallerpacifico_morelia@gmail.com', '7212345690', 'HBJHB8723VH', '23418'),
(4, 'Aldo Juarez Radilla', 'Lazaro', 'Tamarindo', 'Hidalgo', 'tallerpacifico_lazaro@gmail.com', '7591092345', 'ASOI37DJ092M4', '34210');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucu_pro`
--

CREATE TABLE `sucu_pro` (
  `Id_sucu_3` int(11) NOT NULL,
  `Id_pro_1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sucu_pro`
--

INSERT INTO `sucu_pro` (`Id_sucu_3`, `Id_pro_1`) VALUES
(3, 915741),
(3, 597138),
(3, 105347),
(3, 422028),
(3, 424622),
(3, 504242),
(3, 42237),
(3, 9095),
(1, 301026),
(3, 867157),
(3, 462494);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucu_prove`
--

CREATE TABLE `sucu_prove` (
  `Id_sucu_2` int(11) NOT NULL,
  `Id_prove_1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `Id_venta` int(11) NOT NULL,
  `Numero_ven` int(11) NOT NULL,
  `Id_cliete_v` varchar(20) NOT NULL,
  `Id_produc_v` int(11) NOT NULL,
  `Descuento` int(11) NOT NULL,
  `Cantidad_v` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Total` double NOT NULL,
  `Id_persona_v` int(11) NOT NULL,
  `Id_sucu_v` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`Id_venta`, `Numero_ven`, `Id_cliete_v`, `Id_produc_v`, `Descuento`, `Cantidad_v`, `Fecha`, `Total`, `Id_persona_v`, `Id_sucu_v`) VALUES
(1, 188630, 'PIVVAN94090812H700', 424622, 5, 2, '2017-08-08', 2400, 180907084, 3),
(2, 188630, 'PIVVAN94090812H700', 504242, 5, 1, '2017-08-08', 4000, 180907084, 3),
(3, 188630, 'PIVVAN94090812H700', 42237, 5, 3, '2017-08-08', 3300, 180907084, 3),
(4, 210206, 'PIVVAN94090812H700', 42237, 2, 2, '2017-08-08', 2200, 180907084, 3),
(5, 626343, 'PIVVAN94090812H700', 424622, 5, 2, '2017-08-08', 2400, 180907084, 3),
(6, 626343, 'PIVVAN94090812H700', 504242, 5, 2, '2017-08-08', 8000, 180907084, 3),
(7, 626343, 'PIVVAN94090812H700', 42237, 5, 1, '2017-08-08', 1100, 180907084, 3),
(9, 12415, 'PIVVAN94090812H700', 422028, 10, 2, '2017-08-09', 2341, 150907084, 3),
(10, 512726, 'PIVVAN94090812H700', 504242, 20, 1, '2017-08-14', 1500, 180907084, 3),
(11, 512726, 'PIVVAN94090812H700', 42237, 20, 1, '2017-08-14', 1100, 180907084, 3),
(12, 512726, 'PIVVAN94090812H700', 867157, 20, 2, '2017-08-14', 5800, 180907084, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_normal`
--

CREATE TABLE `ventas_normal` (
  `Id_venta_no` int(11) NOT NULL,
  `Numero_venta_no` int(11) NOT NULL,
  `Id_pro_nor` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Total` double NOT NULL,
  `Id_sucu_no` int(11) NOT NULL,
  `Id_perso_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ventas_normal`
--

INSERT INTO `ventas_normal` (`Id_venta_no`, `Numero_venta_no`, `Id_pro_nor`, `Cantidad`, `Fecha`, `Total`, `Id_sucu_no`, `Id_perso_no`) VALUES
(1, 289582, 42237, 2, '2017-08-12', 2200, 3, 180907084),
(2, 250763, 424622, 1, '2017-08-14', 1200, 3, 180907084),
(3, 672120, 42237, 2, '2017-08-14', 2200, 3, 180907084),
(4, 672120, 424622, 1, '2017-08-14', 1200, 3, 180907084),
(5, 485871, 42237, 2, '2017-08-14', 2200, 3, 180907084),
(6, 485871, 424622, 1, '2017-08-14', 1200, 3, 180907084);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_morelia`
--

CREATE TABLE `venta_morelia` (
  `Id_pro_vet` int(11) NOT NULL,
  `Codi_pro_ve` varchar(80) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Nombre_ve_pro` varchar(80) NOT NULL,
  `Costo` double NOT NULL,
  `Id_sucu_veta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `apartado`
--
ALTER TABLE `apartado`
  ADD PRIMARY KEY (`Id_apartado`),
  ADD KEY `Id_sucu_ap` (`Id_sucu_ap`,`Id_perso_ap`,`Id_pro_ap`),
  ADD KEY `Id_perso_ap` (`Id_perso_ap`),
  ADD KEY `Id_pro_ap` (`Id_pro_ap`);

--
-- Indices de la tabla `clientes_p`
--
ALTER TABLE `clientes_p`
  ADD PRIMARY KEY (`Id_cliente`),
  ADD KEY `Id_sucursal_p` (`Id_sucursal_p`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`Id_compra`),
  ADD KEY `Id_produc_c` (`Id_produc_c`),
  ADD KEY `Id_perso_c` (`Id_perso_c`),
  ADD KEY `Id_sucu_c` (`Id_sucu_c`),
  ADD KEY `Id_provedor_c` (`Id_provedor_c`);

--
-- Indices de la tabla `credito`
--
ALTER TABLE `credito`
  ADD PRIMARY KEY (`Id_credito`),
  ADD KEY `Id_produc_cre` (`Id_produc_cre`,`Id_sucursal_cre`,`Id_perso_cre`),
  ADD KEY `Id_cliente_cre_p` (`Id_cliente_cre_p`),
  ADD KEY `Id_sucursal_cre` (`Id_sucursal_cre`),
  ADD KEY `Id_perso_cre` (`Id_perso_cre`);

--
-- Indices de la tabla `folio`
--
ALTER TABLE `folio`
  ADD PRIMARY KEY (`Id_folio`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`Id_movimiento`),
  ADD KEY `Id_personal` (`Id_personal`);

--
-- Indices de la tabla `movi_pro`
--
ALTER TABLE `movi_pro`
  ADD KEY `Id_movi_1` (`Id_movi_1`),
  ADD KEY `Id_prod_2` (`Id_prod_2`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`Id_persona`),
  ADD KEY `Id_sucu_1` (`Id_sucu_1`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`Id_pro`),
  ADD KEY `id_prove_p` (`id_prove_p`);

--
-- Indices de la tabla `provedores`
--
ALTER TABLE `provedores`
  ADD PRIMARY KEY (`Id_provedor`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`Id_sucu`);

--
-- Indices de la tabla `sucu_pro`
--
ALTER TABLE `sucu_pro`
  ADD KEY `Id_sucu_3` (`Id_sucu_3`),
  ADD KEY `Id_pro_1` (`Id_pro_1`);

--
-- Indices de la tabla `sucu_prove`
--
ALTER TABLE `sucu_prove`
  ADD KEY `Id_sucu_2` (`Id_sucu_2`),
  ADD KEY `Id_prove_1` (`Id_prove_1`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`Id_venta`),
  ADD KEY `Id_cliete_v` (`Id_cliete_v`,`Id_produc_v`,`Id_persona_v`,`Id_sucu_v`),
  ADD KEY `Id_produc_v` (`Id_produc_v`),
  ADD KEY `Id_persona_v` (`Id_persona_v`),
  ADD KEY `Id_sucu_v` (`Id_sucu_v`);

--
-- Indices de la tabla `ventas_normal`
--
ALTER TABLE `ventas_normal`
  ADD PRIMARY KEY (`Id_venta_no`),
  ADD KEY `Id_pro_no` (`Id_sucu_no`,`Id_perso_no`),
  ADD KEY `Id_perso_no` (`Id_perso_no`),
  ADD KEY `Id_pro_nor` (`Id_pro_nor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `apartado`
--
ALTER TABLE `apartado`
  MODIFY `Id_apartado` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `Id_compra` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `credito`
--
ALTER TABLE `credito`
  MODIFY `Id_credito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `provedores`
--
ALTER TABLE `provedores`
  MODIFY `Id_provedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `Id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `ventas_normal`
--
ALTER TABLE `ventas_normal`
  MODIFY `Id_venta_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `apartado`
--
ALTER TABLE `apartado`
  ADD CONSTRAINT `apartado_ibfk_1` FOREIGN KEY (`Id_sucu_ap`) REFERENCES `sucursal` (`Id_sucu`) ON DELETE CASCADE,
  ADD CONSTRAINT `apartado_ibfk_2` FOREIGN KEY (`Id_perso_ap`) REFERENCES `personal` (`Id_persona`) ON DELETE CASCADE,
  ADD CONSTRAINT `apartado_ibfk_3` FOREIGN KEY (`Id_pro_ap`) REFERENCES `productos` (`Id_pro`) ON DELETE CASCADE;

--
-- Filtros para la tabla `clientes_p`
--
ALTER TABLE `clientes_p`
  ADD CONSTRAINT `clientes_p_ibfk_1` FOREIGN KEY (`Id_sucursal_p`) REFERENCES `sucursal` (`Id_sucu`) ON DELETE CASCADE;

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`Id_produc_c`) REFERENCES `productos` (`Id_pro`),
  ADD CONSTRAINT `compra_ibfk_3` FOREIGN KEY (`Id_sucu_c`) REFERENCES `sucursal` (`Id_sucu`) ON DELETE CASCADE,
  ADD CONSTRAINT `compra_ibfk_5` FOREIGN KEY (`Id_perso_c`) REFERENCES `personal` (`Id_persona`) ON DELETE CASCADE,
  ADD CONSTRAINT `compra_ibfk_6` FOREIGN KEY (`Id_provedor_c`) REFERENCES `provedores` (`Id_provedor`) ON DELETE CASCADE;

--
-- Filtros para la tabla `credito`
--
ALTER TABLE `credito`
  ADD CONSTRAINT `credito_ibfk_1` FOREIGN KEY (`Id_produc_cre`) REFERENCES `productos` (`Id_pro`) ON DELETE CASCADE,
  ADD CONSTRAINT `credito_ibfk_2` FOREIGN KEY (`Id_sucursal_cre`) REFERENCES `sucursal` (`Id_sucu`) ON DELETE CASCADE,
  ADD CONSTRAINT `credito_ibfk_3` FOREIGN KEY (`Id_perso_cre`) REFERENCES `personal` (`Id_persona`) ON DELETE CASCADE,
  ADD CONSTRAINT `credito_ibfk_4` FOREIGN KEY (`Id_cliente_cre_p`) REFERENCES `clientes_p` (`Id_cliente`) ON DELETE CASCADE;

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_ibfk_1` FOREIGN KEY (`Id_personal`) REFERENCES `personal` (`Id_persona`) ON DELETE CASCADE;

--
-- Filtros para la tabla `movi_pro`
--
ALTER TABLE `movi_pro`
  ADD CONSTRAINT `movi_pro_ibfk_1` FOREIGN KEY (`Id_prod_2`) REFERENCES `productos` (`Id_pro`) ON DELETE CASCADE,
  ADD CONSTRAINT `movi_pro_ibfk_2` FOREIGN KEY (`Id_movi_1`) REFERENCES `movimientos` (`Id_movimiento`) ON DELETE CASCADE;

--
-- Filtros para la tabla `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`Id_sucu_1`) REFERENCES `sucursal` (`Id_sucu`) ON DELETE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_prove_p`) REFERENCES `provedores` (`Id_provedor`);

--
-- Filtros para la tabla `sucu_pro`
--
ALTER TABLE `sucu_pro`
  ADD CONSTRAINT `sucu_pro_ibfk_1` FOREIGN KEY (`Id_pro_1`) REFERENCES `productos` (`Id_pro`) ON DELETE CASCADE,
  ADD CONSTRAINT `sucu_pro_ibfk_2` FOREIGN KEY (`Id_sucu_3`) REFERENCES `sucursal` (`Id_sucu`) ON DELETE CASCADE;

--
-- Filtros para la tabla `sucu_prove`
--
ALTER TABLE `sucu_prove`
  ADD CONSTRAINT `sucu_prove_ibfk_2` FOREIGN KEY (`Id_sucu_2`) REFERENCES `sucursal` (`Id_sucu`) ON DELETE CASCADE,
  ADD CONSTRAINT `sucu_prove_ibfk_3` FOREIGN KEY (`Id_prove_1`) REFERENCES `provedores` (`Id_provedor`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`Id_produc_v`) REFERENCES `productos` (`Id_pro`) ON DELETE CASCADE,
  ADD CONSTRAINT `ventas_ibfk_3` FOREIGN KEY (`Id_persona_v`) REFERENCES `personal` (`Id_persona`) ON DELETE CASCADE,
  ADD CONSTRAINT `ventas_ibfk_4` FOREIGN KEY (`Id_sucu_v`) REFERENCES `sucursal` (`Id_sucu`) ON DELETE CASCADE,
  ADD CONSTRAINT `ventas_ibfk_5` FOREIGN KEY (`Id_cliete_v`) REFERENCES `clientes_p` (`Id_cliente`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ventas_normal`
--
ALTER TABLE `ventas_normal`
  ADD CONSTRAINT `ventas_normal_ibfk_2` FOREIGN KEY (`Id_sucu_no`) REFERENCES `sucursal` (`Id_sucu`) ON DELETE CASCADE,
  ADD CONSTRAINT `ventas_normal_ibfk_3` FOREIGN KEY (`Id_perso_no`) REFERENCES `personal` (`Id_persona`) ON DELETE CASCADE,
  ADD CONSTRAINT `ventas_normal_ibfk_4` FOREIGN KEY (`Id_pro_nor`) REFERENCES `productos` (`Id_pro`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
