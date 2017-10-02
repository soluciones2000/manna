-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 29-09-2017 a las 16:07:24
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sgcconsu_manna`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `afiliados`
--

CREATE TABLE `afiliados` (
  `id` bigint(20) NOT NULL COMMENT 'Id del sistema',
  `tit_codigo` varchar(20) NOT NULL COMMENT 'Código del titular',
  `tit_codigo_largo` varchar(20) NOT NULL COMMENT 'Código en el sistema del titular',
  `cot_codigo_largo` varchar(20) NOT NULL COMMENT 'Código en el sistema del cotitular',
  `tit_nombres` varchar(150) NOT NULL COMMENT 'Nombres del titular',
  `tit_apellidos` varchar(150) NOT NULL COMMENT 'Apellidos del titular',
  `tit_cedula` varchar(9) NOT NULL COMMENT 'Cédula del titular',
  `tit_rif` varchar(10) NOT NULL COMMENT 'R.I.F. del titular',
  `tit_fecha_nac` char(10) NOT NULL COMMENT 'Fecha de nacimiento del titular',
  `tit_edo_civil` varchar(10) NOT NULL COMMENT 'Estado civil del titular',
  `tit_sexo` varchar(9) NOT NULL COMMENT 'Sexo del titular',
  `tit_profesion` varchar(150) NOT NULL COMMENT 'Profesión del titular',
  `cot_nombres` varchar(150) NOT NULL COMMENT 'Nombres del cotitular',
  `cot_apellidos` varchar(150) NOT NULL COMMENT 'Apellidos del cotitular',
  `cot_cedula` varchar(9) NOT NULL COMMENT 'Cédula del cotitular',
  `cot_rif` varchar(10) NOT NULL COMMENT 'R.I.F. del cotitular',
  `cot_fecha_nac` char(10) NOT NULL COMMENT 'Fecha de nacimiento del cotitular',
  `cot_edo_civil` varchar(10) NOT NULL COMMENT 'Estado civil del cotitular',
  `cot_sexo` varchar(9) NOT NULL COMMENT 'Sexo del cotitular',
  `calle` varchar(150) NOT NULL COMMENT 'Calle / Avenida / Vereda',
  `cruce` varchar(150) NOT NULL COMMENT 'Cruce con / Sector / Manzana',
  `casa` varchar(50) NOT NULL COMMENT 'Casa / Edificio',
  `sector` varchar(150) NOT NULL COMMENT 'Urbanización / Sector',
  `piso` varchar(50) NOT NULL COMMENT 'Piso No.',
  `apto` varchar(50) NOT NULL COMMENT 'Apto. No.',
  `referencia` varchar(150) NOT NULL COMMENT 'Punto de referencia',
  `ciudad` varchar(150) NOT NULL COMMENT 'Ciudad',
  `municipio` varchar(150) NOT NULL COMMENT 'Municipio',
  `estado` varchar(150) NOT NULL COMMENT 'Estado',
  `parroquia` varchar(150) NOT NULL COMMENT 'Parroquia',
  `cod_postal` varchar(10) NOT NULL COMMENT 'Código Postal',
  `pais` varchar(150) NOT NULL COMMENT 'País',
  `tel_local` varchar(50) NOT NULL COMMENT 'Teléfono Local',
  `tel_celular` varchar(50) NOT NULL COMMENT 'Teléfono Celular',
  `email` varchar(150) NOT NULL COMMENT 'Correo electrónico',
  `enrol_codigo` varchar(20) NOT NULL COMMENT 'Código del enrolador',
  `enrol_nombre_completo` varchar(200) NOT NULL COMMENT 'Nombre completo del enrolador',
  `patroc_codigo` varchar(20) NOT NULL COMMENT 'Código del patrocinador',
  `patroc_nombre_completo` varchar(200) NOT NULL COMMENT 'Nombre completo del patrocinador',
  `banco_nombre_cta` varchar(200) NOT NULL COMMENT 'Titular de la cuenta bancaria',
  `banco_numero_cta` char(20) NOT NULL COMMENT 'Número de cuenta',
  `banco_nombre_bco` varchar(150) NOT NULL COMMENT 'Nombre del banco',
  `banco_sucursal` varchar(150) NOT NULL COMMENT 'Sucursal del banco',
  `banco_estado` varchar(150) NOT NULL COMMENT 'Estado de ubicación de la sucursal bancaria',
  `banco_tipo_cta` varchar(30) NOT NULL COMMENT 'Tipo de cuenta bancaria',
  `tipo_persona` varchar(12) NOT NULL COMMENT 'Tipo de persona jurídica',
  `nacionalidad` varchar(10) NOT NULL COMMENT 'Nacionalidad',
  `tipo_afiliado` varchar(7) NOT NULL COMMENT 'Tipo de afiliado',
  `tipo_kit` varchar(6) NOT NULL COMMENT 'Línea de afliación',
  `fecha_afiliacion` date NOT NULL COMMENT 'Fecha de afiliación',
  `envio` tinyint(1) NOT NULL COMMENT 'Envío (1="SI",0="NO")',
  `direccion_envio` varchar(500) NOT NULL COMMENT 'Direccíón de envío',
  `status_afiliado` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bono_afiliacion`
--

CREATE TABLE `bono_afiliacion` (
  `id` int(11) NOT NULL,
  `nivel` varchar(20) NOT NULL,
  `premium` int(11) NOT NULL,
  `vip` int(11) NOT NULL,
  `oro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id` int(11) NOT NULL,
  `ciudad` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `direccion` varchar(500) NOT NULL,
  `direccion_envio` varchar(500) NOT NULL,
  `patroc_codigo` varchar(20) NOT NULL,
  `cod_clte` varchar(20) NOT NULL,
  `cod_corto_clte` varchar(20) NOT NULL,
  `status_cliente` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_preferencial`
--

CREATE TABLE `cliente_preferencial` (
  `id` bigint(20) NOT NULL,
  `cod_clte` varchar(20) NOT NULL,
  `clte_nombre` varchar(150) NOT NULL,
  `clte_cedula` varchar(10) NOT NULL,
  `clte_telefono` varchar(50) NOT NULL,
  `clte_email` varchar(150) NOT NULL,
  `clte_direccion` varchar(500) NOT NULL,
  `clte_direccion_envio` varchar(500) NOT NULL,
  `patroc_codigo` varchar(20) NOT NULL,
  `cod_corto_clte` varchar(20) NOT NULL,
  `status_cliente` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `club_180`
--

CREATE TABLE `club_180` (
  `id` bigint(20) NOT NULL,
  `cod_miembro` varchar(20) NOT NULL,
  `tipo_miembro` varchar(25) NOT NULL,
  `patroc_codigo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_orden`
--

CREATE TABLE `det_orden` (
  `id` bigint(20) NOT NULL,
  `orden_id` bigint(20) NOT NULL,
  `id_pro` varchar(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `valor_comisionable` decimal(12,2) NOT NULL,
  `puntos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_orden_promocion`
--

CREATE TABLE `det_orden_promocion` (
  `id` bigint(20) NOT NULL,
  `orden_id` bigint(20) NOT NULL,
  `promo_kit` varchar(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `promo_precio` decimal(12,2) NOT NULL,
  `promo_puntos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `emp_nombre` varchar(150) NOT NULL,
  `emp_rif` varchar(10) NOT NULL,
  `emp_web` varchar(150) DEFAULT NULL,
  `emp_email` varchar(150) NOT NULL,
  `emp_direccion` varchar(150) NOT NULL,
  `emp_logo` varchar(150) DEFAULT NULL,
  `emp_hoy` date NOT NULL,
  `prefijo_pais` char(3) NOT NULL,
  `pvp_premium_hogar` decimal(12,2) NOT NULL,
  `premium_hogar` decimal(12,2) NOT NULL,
  `mp_premium_hogar` int(3) NOT NULL,
  `pvp_premium_lq` decimal(12,2) NOT NULL,
  `premium_lq` decimal(12,2) NOT NULL,
  `mp_premium_lq` int(3) NOT NULL,
  `pvp_premium_teatro` decimal(12,2) NOT NULL,
  `premium_teatro` decimal(12,2) NOT NULL,
  `mp_premium_teatro` int(3) NOT NULL,
  `pvp_premium_todas` decimal(12,2) NOT NULL,
  `premium_todas` decimal(12,2) NOT NULL,
  `mp_premium_todas` int(3) NOT NULL,
  `pvp_vip_hogar` decimal(12,2) NOT NULL,
  `vip_hogar` decimal(12,2) NOT NULL,
  `mp_vip_hogar` int(3) NOT NULL,
  `pvp_vip_lq` decimal(12,2) NOT NULL,
  `vip_lq` decimal(12,2) NOT NULL,
  `mp_vip_lq` int(3) NOT NULL,
  `pvp_vip_teatro` decimal(12,2) NOT NULL,
  `vip_teatro` decimal(12,2) NOT NULL,
  `mp_vip_teatro` int(3) NOT NULL,
  `pvp_vip_todas` decimal(12,2) NOT NULL,
  `vip_todas` decimal(12,2) NOT NULL,
  `mp_vip_todas` int(3) NOT NULL,
  `pvp_oro_hogar` decimal(12,2) NOT NULL,
  `oro_hogar` decimal(12,2) NOT NULL,
  `mp_oro_hogar` int(3) NOT NULL,
  `pvp_oro_lq` decimal(12,2) NOT NULL,
  `oro_lq` decimal(12,2) NOT NULL,
  `mp_oro_lq` int(3) NOT NULL,
  `pvp_oro_teatro` decimal(12,2) NOT NULL,
  `oro_teatro` decimal(12,2) NOT NULL,
  `mp_oro_teatro` int(3) NOT NULL,
  `pvp_oro_todas` decimal(12,2) NOT NULL,
  `oro_todas` decimal(12,2) NOT NULL,
  `mp_oro_todas` int(3) NOT NULL,
  `iva1` decimal(12,2) NOT NULL,
  `iva2` decimal(12,2) NOT NULL,
  `iva3` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `estado` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genealogia`
--

CREATE TABLE `genealogia` (
  `id` bigint(20) NOT NULL,
  `padre` varchar(20) NOT NULL,
  `hijo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kits_promocion`
--

CREATE TABLE `kits_promocion` (
  `id` bigint(20) NOT NULL,
  `promo_id` bigint(20) NOT NULL,
  `promo_kit` varchar(20) NOT NULL,
  `promo_nombre` varchar(150) NOT NULL,
  `promo_precio` decimal(12,2) NOT NULL,
  `promo_puntos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE `ordenes` (
  `orden_id` bigint(20) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `tipo_orden` varchar(20) NOT NULL,
  `patroc_codigo` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `monto` decimal(12,2) NOT NULL,
  `valor_comisionable` decimal(12,2) NOT NULL,
  `puntos` bigint(20) NOT NULL,
  `direccion_envio` varchar(500) NOT NULL,
  `id_transaccion` bigint(20) NOT NULL,
  `status_orden` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_promocion`
--

CREATE TABLE `ordenes_promocion` (
  `orden_id` bigint(20) NOT NULL,
  `promo_id` bigint(20) NOT NULL,
  `ticket` varchar(5) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `cedula` varchar(8) NOT NULL,
  `fecha` datetime NOT NULL,
  `monto` decimal(12,2) NOT NULL,
  `promo_puntos` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organizacion`
--

CREATE TABLE `organizacion` (
  `id` bigint(20) NOT NULL,
  `organizacion` varchar(20) NOT NULL,
  `nivel` varchar(20) NOT NULL,
  `afiliado` varchar(20) NOT NULL,
  `lado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id` int(11) NOT NULL,
  `pais` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patrocinio`
--

CREATE TABLE `patrocinio` (
  `id` bigint(20) NOT NULL,
  `patroc_codigo` varchar(20) NOT NULL,
  `tit_codigo` varchar(20) NOT NULL,
  `fecha_afiliacion` date NOT NULL,
  `fecha_fin_bono` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint(20) NOT NULL,
  `id_pro` varchar(20) NOT NULL,
  `desc_pro` varchar(200) NOT NULL,
  `precio_pro` decimal(12,2) NOT NULL,
  `valor_comisionable_pro` decimal(12,2) NOT NULL,
  `puntos_pro` int(11) NOT NULL,
  `pvp_dist` decimal(12,2) NOT NULL,
  `com_dist` decimal(12,2) NOT NULL,
  `pts_dist` int(11) NOT NULL,
  `pvp_clipref` decimal(12,2) NOT NULL,
  `com_clipref` decimal(12,2) NOT NULL,
  `pts_clipref` int(11) NOT NULL,
  `desc_corta` varchar(50) NOT NULL,
  `imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `promo_id` bigint(20) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `fecha_limite` date NOT NULL,
  `ticket1` varchar(5) NOT NULL,
  `ticket2` varchar(5) NOT NULL,
  `status` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repbonoafiliacion`
--

CREATE TABLE `repbonoafiliacion` (
  `patroc_codigo` varchar(20) NOT NULL,
  `tit_codigo` varchar(20) NOT NULL,
  `fecha_afiliacion` date NOT NULL,
  `fecha_fin_bono` date NOT NULL,
  `nivel` varchar(20) NOT NULL,
  `afiliado` varchar(20) NOT NULL,
  `tipo_afiliado` varchar(7) NOT NULL,
  `fectr` date NOT NULL,
  `monto` decimal(12,2) NOT NULL,
  `porcentaje` decimal(12,2) NOT NULL,
  `comision` decimal(12,2) NOT NULL,
  `patroc_nombres` varchar(200) NOT NULL,
  `nombres` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) NOT NULL,
  `promo_id` bigint(20) NOT NULL,
  `ticket` varchar(5) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `cedula` varchar(8) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `telefono` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones`
--

CREATE TABLE `transacciones` (
  `id` bigint(20) NOT NULL,
  `fecha` date NOT NULL,
  `afiliado` varchar(20) NOT NULL,
  `cliente` varchar(20) NOT NULL,
  `cliente_pref` varchar(20) NOT NULL,
  `tipo` char(2) NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `monto` decimal(12,2) NOT NULL,
  `puntos` int(11) NOT NULL,
  `documento` varchar(10) NOT NULL,
  `bancoorigen` varchar(50) NOT NULL,
  `status_comision` varchar(9) NOT NULL,
  `orden_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `upgrade`
--

CREATE TABLE `upgrade` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `tipo_afiliado` varchar(7) NOT NULL,
  `fechapago` date NOT NULL,
  `numcomprobante` varchar(10) NOT NULL,
  `bancoorigen` varchar(50) NOT NULL,
  `monto` decimal(12,2) NOT NULL,
  `status_upgrade` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_user` varchar(150) DEFAULT NULL,
  `user_email` varchar(150) DEFAULT NULL,
  `user_pass` varchar(150) DEFAULT NULL,
  `pista` varchar(150) DEFAULT NULL,
  `respuesta` varchar(150) DEFAULT NULL,
  `codigo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_genealogia`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_genealogia` (
`id` bigint(20)
,`padre` varchar(20)
,`hijo` varchar(20)
,`nombre_padre` varchar(150)
,`apellido_padre` varchar(150)
,`nombre_hijo` varchar(150)
,`apellido_hijo` varchar(150)
,`tipo_afiliado` varchar(7)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_organizacion`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_organizacion` (
`organizacion` varchar(20)
,`nivel` varchar(20)
,`afiliado` varchar(20)
,`cot_nombres` varchar(150)
,`cot_apellidos` varchar(150)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_padres`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_padres` (
`id` bigint(20)
,`padre` varchar(20)
,`hijo` varchar(20)
,`nombre_padre` varchar(150)
,`apellido_padre` varchar(150)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_patr1`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_patr1` (
`id` bigint(20)
,`patroc_codigo` varchar(20)
,`tit_codigo` varchar(20)
,`fecha_afiliacion` date
,`fecha_fin_bono` date
,`nombres_patroc` varchar(150)
,`apellidos_patroc` varchar(150)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_patrocinio`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_patrocinio` (
`id` bigint(20)
,`patroc_codigo` varchar(20)
,`tit_codigo` varchar(20)
,`nombres_patroc` varchar(150)
,`apellidos_patroc` varchar(150)
,`nombres` varchar(150)
,`apellidos` varchar(150)
,`fecha_fin_bono` date
);

-- --------------------------------------------------------

--
-- Estructura para la vista `v_genealogia`
--
DROP TABLE IF EXISTS `v_genealogia`;

CREATE ALGORITHM=UNDEFINED DEFINER=`sgcco_root`@`%` SQL SECURITY DEFINER VIEW `v_genealogia`  AS  select `v_padres`.`id` AS `id`,`v_padres`.`padre` AS `padre`,`v_padres`.`hijo` AS `hijo`,`v_padres`.`nombre_padre` AS `nombre_padre`,`v_padres`.`apellido_padre` AS `apellido_padre`,`afiliados`.`tit_nombres` AS `nombre_hijo`,`afiliados`.`tit_apellidos` AS `apellido_hijo`,`afiliados`.`tipo_afiliado` AS `tipo_afiliado` from (`v_padres` left join `afiliados` on((`v_padres`.`hijo` = `afiliados`.`tit_codigo`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_organizacion`
--
DROP TABLE IF EXISTS `v_organizacion`;

CREATE ALGORITHM=UNDEFINED DEFINER=`sgcco_root`@`%` SQL SECURITY DEFINER VIEW `v_organizacion`  AS  select `organizacion`.`organizacion` AS `organizacion`,`organizacion`.`nivel` AS `nivel`,`organizacion`.`afiliado` AS `afiliado`,`afiliados`.`cot_nombres` AS `cot_nombres`,`afiliados`.`cot_apellidos` AS `cot_apellidos` from (`organizacion` join `afiliados`) where ((`organizacion`.`afiliado` = `afiliados`.`tit_codigo`) and (`organizacion`.`organizacion` = '00000')) order by `organizacion`.`organizacion`,`organizacion`.`nivel`,`organizacion`.`afiliado` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_padres`
--
DROP TABLE IF EXISTS `v_padres`;

CREATE ALGORITHM=UNDEFINED DEFINER=`sgcco_root`@`%` SQL SECURITY DEFINER VIEW `v_padres`  AS  select `genealogia`.`id` AS `id`,`genealogia`.`padre` AS `padre`,`genealogia`.`hijo` AS `hijo`,`afiliados`.`tit_nombres` AS `nombre_padre`,`afiliados`.`tit_apellidos` AS `apellido_padre` from (`genealogia` left join `afiliados` on((`genealogia`.`padre` = `afiliados`.`tit_codigo`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_patr1`
--
DROP TABLE IF EXISTS `v_patr1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`sgcco_root`@`%` SQL SECURITY DEFINER VIEW `v_patr1`  AS  select `patrocinio`.`id` AS `id`,`patrocinio`.`patroc_codigo` AS `patroc_codigo`,`patrocinio`.`tit_codigo` AS `tit_codigo`,`patrocinio`.`fecha_afiliacion` AS `fecha_afiliacion`,`patrocinio`.`fecha_fin_bono` AS `fecha_fin_bono`,`afiliados`.`tit_nombres` AS `nombres_patroc`,`afiliados`.`tit_apellidos` AS `apellidos_patroc` from (`patrocinio` left join `afiliados` on((`patrocinio`.`patroc_codigo` = `afiliados`.`tit_codigo`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_patrocinio`
--
DROP TABLE IF EXISTS `v_patrocinio`;

CREATE ALGORITHM=UNDEFINED DEFINER=`sgcco_root`@`%` SQL SECURITY DEFINER VIEW `v_patrocinio`  AS  select `v_patr1`.`id` AS `id`,`v_patr1`.`patroc_codigo` AS `patroc_codigo`,`v_patr1`.`tit_codigo` AS `tit_codigo`,`v_patr1`.`nombres_patroc` AS `nombres_patroc`,`v_patr1`.`apellidos_patroc` AS `apellidos_patroc`,`afiliados`.`tit_nombres` AS `nombres`,`afiliados`.`tit_apellidos` AS `apellidos`,`v_patr1`.`fecha_fin_bono` AS `fecha_fin_bono` from (`v_patr1` left join `afiliados` on((`v_patr1`.`tit_codigo` = `afiliados`.`tit_codigo`))) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `afiliados`
--
ALTER TABLE `afiliados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tit_codigo` (`tit_codigo`);

--
-- Indices de la tabla `bono_afiliacion`
--
ALTER TABLE `bono_afiliacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente_preferencial`
--
ALTER TABLE `cliente_preferencial`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `club_180`
--
ALTER TABLE `club_180`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `det_orden`
--
ALTER TABLE `det_orden`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `det_orden_promocion`
--
ALTER TABLE `det_orden_promocion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `genealogia`
--
ALTER TABLE `genealogia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `kits_promocion`
--
ALTER TABLE `kits_promocion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`orden_id`);

--
-- Indices de la tabla `ordenes_promocion`
--
ALTER TABLE `ordenes_promocion`
  ADD PRIMARY KEY (`orden_id`);

--
-- Indices de la tabla `organizacion`
--
ALTER TABLE `organizacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `patrocinio`
--
ALTER TABLE `patrocinio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`promo_id`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `upgrade`
--
ALTER TABLE `upgrade`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `afiliados`
--
ALTER TABLE `afiliados`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Id del sistema', AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT de la tabla `bono_afiliacion`
--
ALTER TABLE `bono_afiliacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `cliente_preferencial`
--
ALTER TABLE `cliente_preferencial`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `club_180`
--
ALTER TABLE `club_180`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `det_orden`
--
ALTER TABLE `det_orden`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `det_orden_promocion`
--
ALTER TABLE `det_orden_promocion`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `genealogia`
--
ALTER TABLE `genealogia`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT de la tabla `kits_promocion`
--
ALTER TABLE `kits_promocion`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `orden_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `ordenes_promocion`
--
ALTER TABLE `ordenes_promocion`
  MODIFY `orden_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `organizacion`
--
ALTER TABLE `organizacion`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;
--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;
--
-- AUTO_INCREMENT de la tabla `patrocinio`
--
ALTER TABLE `patrocinio`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `promo_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT de la tabla `upgrade`
--
ALTER TABLE `upgrade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
