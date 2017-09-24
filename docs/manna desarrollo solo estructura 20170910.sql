-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 10-09-2017 a las 16:17:23
-- Versión del servidor: 5.6.17-log
-- Versión de PHP: 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `manna`
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
  `direccion_envio` varchar(500) NOT NULL COMMENT 'Direccíón de envío'
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
  `cod_corto_clte` varchar(20) NOT NULL
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
  `mp_oro_todas` int(3) NOT NULL
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
  `fecha` datetime NOT NULL,
  `monto` decimal(12,2) NOT NULL,
  `valor_comisionable` decimal(12,2) NOT NULL,
  `puntos` bigint(20) NOT NULL,
  `direccion_envio` varchar(500) NOT NULL
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
  `puntos_pro` int(11) NOT NULL
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
  `comision` decimal(12,2) NOT NULL
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
  `tipo` char(2) NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `monto` decimal(12,2) NOT NULL,
  `puntos` int(11) NOT NULL,
  `documento` varchar(10) NOT NULL,
  `bancoorigen` varchar(50) NOT NULL,
  `status_comision` varchar(9) NOT NULL
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
  `respuesta` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Estructura para la vista `v_organizacion`
--
DROP TABLE IF EXISTS `v_organizacion`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_organizacion`  AS  select `organizacion`.`organizacion` AS `organizacion`,`organizacion`.`nivel` AS `nivel`,`organizacion`.`afiliado` AS `afiliado`,`afiliados`.`cot_nombres` AS `cot_nombres`,`afiliados`.`cot_apellidos` AS `cot_apellidos` from (`organizacion` join `afiliados`) where ((`organizacion`.`afiliado` = `afiliados`.`tit_codigo`) and (`organizacion`.`organizacion` = '00000')) order by `organizacion`.`organizacion`,`organizacion`.`nivel`,`organizacion`.`afiliado` ;

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Id del sistema', AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT de la tabla `bono_afiliacion`
--
ALTER TABLE `bono_afiliacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT de la tabla `cliente_preferencial`
--
ALTER TABLE `cliente_preferencial`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT de la tabla `club_180`
--
ALTER TABLE `club_180`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `det_orden`
--
ALTER TABLE `det_orden`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT de la tabla `kits_promocion`
--
ALTER TABLE `kits_promocion`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `orden_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `ordenes_promocion`
--
ALTER TABLE `ordenes_promocion`
  MODIFY `orden_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `organizacion`
--
ALTER TABLE `organizacion`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;
--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;
--
-- AUTO_INCREMENT de la tabla `patrocinio`
--
ALTER TABLE `patrocinio`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
