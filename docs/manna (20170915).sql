-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 15-09-2017 a las 08:59:09
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

--
-- Volcado de datos para la tabla `afiliados`
--

INSERT INTO `afiliados` (`id`, `tit_codigo`, `tit_codigo_largo`, `cot_codigo_largo`, `tit_nombres`, `tit_apellidos`, `tit_cedula`, `tit_rif`, `tit_fecha_nac`, `tit_edo_civil`, `tit_sexo`, `tit_profesion`, `cot_nombres`, `cot_apellidos`, `cot_cedula`, `cot_rif`, `cot_fecha_nac`, `cot_edo_civil`, `cot_sexo`, `calle`, `cruce`, `casa`, `sector`, `piso`, `apto`, `referencia`, `ciudad`, `municipio`, `estado`, `parroquia`, `cod_postal`, `pais`, `tel_local`, `tel_celular`, `email`, `enrol_codigo`, `enrol_nombre_completo`, `patroc_codigo`, `patroc_nombre_completo`, `banco_nombre_cta`, `banco_numero_cta`, `banco_nombre_bco`, `banco_sucursal`, `banco_estado`, `banco_tipo_cta`, `tipo_persona`, `nacionalidad`, `tipo_afiliado`, `tipo_kit`, `fecha_afiliacion`, `envio`, `direccion_envio`) VALUES
(1, '00000', 'VEN-00000-TNLP', 'VEN-00000-CNLP', 'José Luis', 'Baudet Guerra', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'x@y.z', '00000', 'José Luis Baudet Guerra', '00000', 'José Luis Baudet Guerra', '', '', '', '', '', '', 'Natural', 'Local', 'Premium', 'Todas', '2017-07-17', 0, ''),
(2, '00001', 'VEN-00001-TELP', 'VEN-00001-CELP', 'Corporativo', '1', '11111111', 'V111111111', '17/07/2017', 'soltero', 'masculino', 'Socio', 'Dr. José Luis', 'Baudet', '111111111', 'V111111111', '17/07/2017', 'soltero', 'femenino', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'Valencia', 'Valencia', 'Carabobo', 'a', '2001', 'Venezuela', '11111111111111111111', '11111111111111111111', 'aaaaa@aaa.aa', '00000', 'José Luis Baudet Guerra', '00000', 'José Luis Baudet Guerra', 'a', '11111111111111111111', 'Mercantil', 'a', 'Carabobo', 'ahorro', 'Especialista', 'Local', 'Premium', 'Todas', '2017-07-17', 0, ''),
(3, '00002', 'VEN-00002-TNLP', 'VEN-00002-CNLP', 'Corporativo', '2', '22222222', 'V222222222', '17/07/2017', 'soltero', 'femenino', 'Socio', 'Marisol', 'Pérez', '222222222', 'V222222222', '17/07/2017', 'soltero', 'masculino', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'Valencia', 'Valencia', 'Carabobo', 'b', '2001', 'Venezuela', '22222222222222222222', '22222222222222222222', 'bbbbb@bbb.bb', '00000', 'José Luis Baudet Guerra', '00000', 'José Luis Baudet Guerra', 'b', '22222222222222222222', 'Mercantil', 'b', 'Carabobo', 'ahorro', 'Natural', 'Local', 'Premium', 'Todas', '2017-07-17', 0, ''),
(4, '00003', 'VEN-00003-TNLP', 'VEN-00003-CNLP', 'Corporativo', '3', '33333333', 'V333333333', '17/07/2017', 'soltero', 'masculino', 'Socio', 'Luis', 'Vera', '333333333', 'V333333333', '17/07/2017', 'soltero', 'femenino', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'Valencia', 'Valencia', 'Carabobo', 'c', '2001', 'Venezuela', '33333333333333333333', '33333333333333333333', 'ccccc@ccc.cc', '00000', 'José Luis Baudet Guerra', '00000', 'José Luis Baudet Guerra', 'c', '33333333333333333333', 'Mercantil', 'c', 'Carabobo', 'ahorro', 'Natural', 'Local', 'Premium', 'Todas', '2017-07-17', 0, ''),
(5, '00004', 'VEN-00004-TNLP', 'VEN-00004-CNLP', 'Corporativo', '4', '44444444', 'V444444444', '17/07/2017', 'soltero', 'masculino', 'Socio', 'Mercedes', 'Guerra', '44444444', 'V444444444', '17/07/2017', 'soltero', 'masculino', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'Valencia', 'Valencia', 'Carabobo', 'd', '2001', 'Venezuela', '44444444444444444444', '44444444444444444444', 'ddddd@ddd.dd', '00000', 'José Luis Baudet Guerra', '00000', 'José Luis Baudet Guerra', 'd', '44444444444444444444', 'Mercantil', 'd', 'Carabobo', 'ahorro', 'Natural', 'Local', 'Premium', 'Todas', '2017-07-17', 0, ''),
(6, '00005', 'VEN-00005-TNLP', 'VEN-00005-CNLP', 'Corporativo', '5', '55555555', 'V555555555', '17/07/2017', 'soltero', 'masculino', 'Socio', 'Luis', 'Rodríguez', '7132358', 'V071323583', '09/07/1971', 'soltero', 'masculino', 'Avenida Uslar', 'Entre Paéz y Colombia', 'casa No. 99-13', 'Sector San Blas', 'PB', 'NA', 'Media cuadra antes de la plaza', 'Valencia', 'Valencia', 'Carabobo', 'San Blas', '2001', 'Venezuela', '02418592208', '04144802725', 'soluciones2000@gmail.com', '00000', 'José Luis Baudet Guerra', '00000', 'José Luis Baudet Guerra', 'Luis Rodríguez', '01080082030100388542', 'BBVA Provincial', 'El recreo', 'Carabobo', 'corriente', 'Natural', 'Local', 'Premium', 'Todas', '2017-07-17', 0, ''),
(7, '00006', 'VEN-00006-TNLP', 'VEN-00006-CNLP', 'Corporativo', '6', '66666666', 'V666666666', '17/07/2017', 'soltero', 'masculino', 'Socio', 'Aristóteles', 'Aranguren', '66666666', 'V666666666', '17/07/2017', 'soltero', 'masculino', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'Valencia', 'Valencia', 'Carabobo', 'f', '2001', 'Venezuela', '66666666666666666666', '66666666666666666666', 'fffff@fff.ff', '00000', 'José Luis Baudet Guerra', '00000', 'José Luis Baudet Guerra', 'f', '66666666666666666666', 'Mercantil', 'f', 'Carabobo', 'ahorro', 'Natural', 'Local', 'Premium', 'Todas', '2017-07-17', 0, ''),
(8, '00007', 'VEN-00007-TNLP', 'VEN-00007-CNLP', 'MILAGROS COROMOTO', 'PEÑA SANCHEZ', '5375757', 'V053757576', '09/09/1960', 'otro', 'femenino', 'COMERCIANTA', 'FRANCISCO', 'GONZALEZ DAFONTE', '4842485', 'V048424852', '28/09/1956', 'soltero', 'masculino', 'AV 110-B', '', 'CASA Nº130-20', 'URB PREBO II', '', '', '', 'Valencia', 'VALENCIA', 'Carabobo', 'SAN JOSE', '2001', 'Venezuela', '02418255172', '04124420362', 'mp3milagros@gmail.com', '00002', 'Corporativo 2', '00002', 'Corporativo 2', 'MILAGROS PEÑA SANCHEZ', '01050137761137023287', 'Mercantil', 'VALENCIA ', 'Carabobo', 'corriente', 'Natural', 'Local', 'Premium', 'Hogar', '2017-08-01', 0, ''),
(9, '00008', 'VEN-00008-TNLV', 'VEN-00008-CNLV', 'Z', 'Linares de salazar', '5893618', 'V058936185', '1960-06-05', 'casado', 'femenino', 'TSU ADMON DE EMPRESAS', 'Juan Jose', 'Salazar Marin', '5480350', 'V054803509', '1958-12-24', 'casado', 'masculino', 'Calle 57.Pararapal', 'manzana 49', 'CASA', 'Quintas 2000', '', '', 'Frente parada de Malabar', 'Los Guayos', 'LOS GUAYOS', 'Carabobo', 'LOS GUAYOS', '2010', 'Venezuela', '02455812151', '04144235420', 'zullider90@hotmail.com', '00002', 'Corporativo 2', '00002', 'Corporativo 2', 'ZULAY LINARES', '01050190331190168286', 'Mercantil', 'MARACAY', 'Aragua', 'corriente', 'Natural', 'Local', 'VIP', 'Hogar', '2017-08-01', 0, ''),
(10, '00009', 'VEN-00009-TNLV', 'VEN-00009-CNLV', 'antonieta', 'troccoli', '8003974', 'V80039740', '1955-09-30', 'soltero', 'femenino', 'vendedora', 'jean carlo', 'izaguirre troccoli', '15494075', 'J154940754', '1981-02-27', 'casado', 'masculino', 'av 112 ', '', '101-100', 'chaguaramal', '', '', 'via la entrada naguanagua', 'Valencia', 'naguanagua', 'Carabobo', 'valencia', '2001', 'Venezuela', '04244274745', '04244274745', 'antonietatroccoli300@hotmail.com', '00002', 'Corporativo 2', '00002', 'Corporativo 2', 'antonieta troccoli', '01341089520003002281', 'Banesco', 'trade word center hesperia', 'Carabobo', 'corriente', 'Natural', 'Local', 'VIP', 'Todas', '2017-08-02', 0, ''),
(11, '0000A', 'VEN-0000A-TNLP', 'VEN-0000A-CNLP', 'BELKIS JANETH', 'NOSSA QUINTERO', '6321057', 'V063210575', '1969-07-24', 'divorciado', 'femenino', 'TSU RRHH', 'BELQUIS AIDA', 'QUINTERO DE NOSSA', '2288112', 'V022881120', '1943-07-18', 'otro', 'femenino', 'CALLE LAS ACACIAS 5A 11', '', 'CASA NUMERO 198', 'CIUDAD ALIANZA', '', '', 'A 2 CUADRAS DEL ESTADIO ALFREDO RODRIGUEZ', 'Guacara', 'GUACARA', 'Carabobo', 'GUACARA', '2016', 'Venezuela', '02455711757', '04144141871', 'bjnq247@hotmail.com', '00008', 'Z Linares de salazar', '00008', 'Z Linares de salazar', 'BELKIS JANETH NOSSA QUINTERO', '01080071460100269624', 'BBVA Provincial', 'VALENCIA', 'Carabobo', 'corriente', 'Natural', 'Local', 'Premium', 'Todas', '2017-08-03', 0, ''),
(12, '0000B', 'VEN-0000B-TNLO', 'VEN-0000B-CNLO', 'JOHANMILET YURIMAR', 'GUILLEN ARIAS', '14915552', 'V149155526', '1980-12-31', 'casado', 'femenino', 'TSU CONTADURIA', 'JOSE LUIS ', 'BAUDET GUERRA', '11941903', 'V119419030', '1973-12-17', 'casado', 'masculino', 'AV 190', '', 'CASA NRO 107-338', 'URBANIZACION TARAPIO', '', '', 'DIAGONAL A PINTURAS LATINA', 'Valencia', 'NAGUANAGUA', 'Carabobo', 'NAGUANAGUA', '2005', 'Venezuela', '02418680506', '04244044588', 'johanmilet@hotmail.com', '00001', 'Corporativo 1', '00001', 'Corporativo 1', 'JOHANMILET YURIMAR GUILLEN ARIAS', '01020692830000125707', 'Banco de Venezuela', 'AV. BOLIVAR', 'Carabobo', 'corriente', 'Natural', 'Local', 'Oro', 'Hogar', '2017-08-03', 0, ''),
(13, '0000C', 'VEN-0000C-TNLV', 'VEN-0000C-CNLV', 'Nelson Antonio', 'Von der Brelje Delli Compagni', '16369269', 'V163692690', '1983-10-23', 'casado', 'masculino', 'Químico', 'Olga Carolina', 'Ochoa Parra', '20270260', 'V202702607', '1990-03-27', 'casado', 'masculino', 'Carretera Nac. San diego de los Altos - San Jose de los Altos', 'Calle 4', 'Casa Mi Viejo', 'San Diego Prado', 'N/A', 'N/A', 'Al lado del agua mineral los Alpes', 'Los Teques', 'Guaicaipuro', 'Miranda', 'Cecilio Acosta', '1204', 'Venezuela', '02124158782', '04123927136', 'nvondelli@hotmail.com', '0000B', 'JOHANMILET YURIMAR GUILLEN ARIAS', '0000B', 'JOHANMILET YURIMAR GUILLEN ARIAS', 'Nelson Von der Brelje', '01140152031521245910', 'Bancaribe', 'San Antonio de los Altos', 'Miranda', 'ahorro', 'Natural', 'Local', 'VIP', 'Hogar', '2017-08-04', 0, ''),
(14, '0000D', 'VEN-0000D-TNLP', 'VEN-0000D-CNLP', 'JOSE GREGORIO', 'RODRIGUEZ ANGULO', '15783109', 'V157831093', '1981-11-24', 'soltero', 'masculino', 'INGENIERO', 'KAREN YUSETT', 'JAUREGUI PEÑUELA', '15231640', 'V152316409', '1982-10-14', 'soltero', 'femenino', 'DON JULIO CENTENO', '', '36', 'VALLES DE SAN DIEGO', 'PB', '36-13', 'DETRAS DE FIN DE SIGLO', 'Valencia', 'SAN DIEGO', 'Carabobo', 'SAN DIEGO', '2006', 'Venezuela', '04144824257', '04144824257', 'josegregoriorodriguez@gmail.com', '0000A', 'BELKIS JANETH NOSSA QUINTERO', '0000A', 'BELKIS JANETH NOSSA QUINTERO', 'JOSE GREGORIO RODRIGUEZ ', '01080992410100030378', 'BBVA Provincial', 'METROPOLIS', 'Carabobo', 'corriente', 'Natural', 'Local', 'Premium', 'Todas', '2017-08-04', 0, ''),
(15, '0000E', 'VEN-0000E-TNLP', 'VEN-0000E-CNLP', 'ALEXANDRA', 'VERGARA MIRANDA', '12962864', 'V129628649', '1960-07-14', 'soltero', 'femenino', 'ASESOR DE VIAJES ', 'CESAR DAVID', 'FLORES OLIVO', '19322511', 'V193225116', '1986-04-17', 'soltero', 'masculino', '126 AV KERDELL', '', 'RESD ROLIZ 1', 'LAS ACACIAS', '13', '13-C', '', 'Valencia', 'VALENCIA', 'Carabobo', 'SAN JOSE', '2001', 'Venezuela', '02418248261', '04144190721', 'avergaraunica@gmail.com', '0000A', 'BELKIS JANETH NOSSA QUINTERO', '0000A', 'BELKIS JANETH NOSSA QUINTERO', 'ALEXANDRA VERGARA', '01050120201120238293', 'Mercantil', 'ELRECREO', 'Carabobo', 'corriente', 'Natural', 'Local', 'Premium', 'Hogar', '2017-08-08', 0, ''),
(16, '0000F', 'VEN-0000F-TELP', 'VEN-0000F-CELP', 'Luis Jesús', 'Sojo', '6681535', 'V066815354', '10/04/1968', 'casado', 'masculino', 'Iridiólogo y Quiroterapeuta', '', '', '', '', '', '', '', 'Urbanización Ciudad Parque La Pradera', 'Abasto de Chema y Escuela La Pradera', 'Apamate 17', 'Urbanización Ciudad Parque La Pradera', 'Piso 4', '4-2', 'Abasto de Chema', 'Valencia', 'San Joaquín', 'Carabobo', 'San Joaquín', '20100', 'Venezuela', '02455620359', '04244088178', 'luisjsojo@gmail.com', '00009', 'antonieta troccoli', '00009', 'antonieta troccoli', 'Luis Jesús Sojo', '01020159460103155544', 'Banco de Venezuela', 'Naguanagua', 'Carabobo', 'ahorro', 'Especialista', 'Local', 'Premium', 'Hogar', '2017-08-10', 0, ''),
(17, '0000G', 'VEN-0000G-TNLP', 'VEN-0000G-CNLP', 'Rosario ', 'Nieves Leal', '7222417', 'V072224171', '1962-12-20', 'soltero', 'femenino', 'dibujante', 'Lincoln Jesus', 'Jairran Mora', '9222462', 'V092224623', '1966-12-25', 'soltero', 'masculino', 'calle 03', 'cruce con calle A', 'casa 18', 'urb. villa esperanza', 'N/A', 'N/A', 'panaderia venezuela', 'Santa Rita', 'Francisco Linares Alcantara', 'Aragua', 'santa rita', '2103', 'Venezuela', '02436118360', '04243350421', 'charosnow@hotmail.com', '00002', 'Corporativo 2', '00002', 'Corporativo 2', 'Rosario Nieves', '01340881588813020519', 'Banesco', 'c.c.las americas ', 'Aragua', 'corriente', 'Natural', 'Local', 'Premium', 'Hogar', '2017-08-13', 0, ''),
(18, '0000H', 'VEN-0000H-TNLP', 'VEN-0000H-CNLP', 'Carlos Eduardo', 'Jairran Nieves', '21272244', 'V212722444', '1992-10-06', 'soltero', 'masculino', 'licenciado en artes', 'Lincoln Jesus', 'Jairran Mora', '9222462', 'V092224623', '1966-12-25', 'soltero', 'masculino', 'calle 03', 'cruce con calle A', 'casa 18', 'urb. villa esperanza', '', '', 'panaderia venezuela', 'Defecto', 'Francisco Linares Alcantara', 'Aragua', 'santa rita', '2103', 'Venezuela', '02436118360', '04127791892', 'jairran@gmail.com', '0000G', 'Rosario Nieves Leal', '0000G', 'Rosario Nieves Leal', 'Carlos Jairran', '01020333300000308896', 'Banco de Venezuela', 'c.c. maracay plaza', 'Aragua', 'corriente', 'Natural', 'Local', 'Premium', 'Todas', '2017-08-13', 0, ''),
(19, '0000I', 'VEN-0000I-TNLV', 'VEN-0000I-CNLV', 'LLOANI ARICELA', 'GUILLERMOS CHIQUITO', '15000125', 'V150001257', '1980-07-04', 'soltero', 'femenino', 'ASISTENTE ADMINISTRATIVO', 'ALEXIS ANTONIO', 'MONTILLA MONTILLA', '14835418', 'V148354185', '1980-06-24', 'soltero', 'masculino', 'Av. Este Oeste', '', 'Casa # 108', 'Urb. Ciudad Plaza', '', '', 'Al frente del abasto Sra. Mary', 'Valencia', 'Valencia', 'Carabobo', 'Rafael Urdaneta', '2003', 'Venezuela', '02418960460', '04144170740', 'lloanig@hotmail.com', '00007', 'MILAGROS COROMOTO PEÑA SANCHEZ', '00007', 'MILAGROS COROMOTO PEÑA SANCHEZ', 'LLOANI ARICELA GUILLERMOS CHIQUITO', '01050094041094432059', 'Mercantil', 'Valencia', 'Carabobo', 'corriente', 'Natural', 'Local', 'VIP', 'Hogar', '2017-08-14', 0, ''),
(20, '0000J', 'VEN-0000J-TNLP', 'VEN-0000J-CNLP', 'MARIA EUGENIA', 'NOSSA QUINTERO', '10784316', 'V107843163', '1972-04-11', 'soltero', 'femenino', 'TSU MERCADOTECNIA', '', '', '', '', '', 'soltero', 'masculino', 'CALLE LAS ACACIAS 5A 11 manzana 14', '', 'casa 197', 'CIUDAD ALIANZA', '', '', 'A 2 CUADRAS DEL ESTADIO ALFREDO RODRIGUEZ', 'Valencia', 'GUACARA', 'Carabobo', 'CIUDAD ALIANZA', '2016', 'Venezuela', '02455713619', '04144285673', 'marianossa2004@yahoo.com', '0000A', 'BELKIS JANETH NOSSA QUINTERO', '0000A', 'BELKIS JANETH NOSSA QUINTERO', 'MARIA EUGENIA NOSSA QUINTERO', '01080071420100746023', 'Venezolano de Crédito', 'VALENCIA', 'Carabobo', 'corriente', 'Natural', 'Local', 'Premium', 'Todas', '2017-08-15', 0, ''),
(21, '0000K', 'VEN-0000K-TNLV', 'VEN-0000K-CNLV', 'NORALIS GREGORIA', 'GUILLERMOS CHIQUITO', '13666685', 'V136666858', '1978-03-14', 'soltero', 'femenino', 'T.S.U.RR.HH', 'ALEXANDER ANTONIO', 'MONTILLA MONTILLA', '14835417', 'V148354177', '1978-11-14', 'soltero', 'masculino', 'Av. Este Oeste', 'Manzana # 08', 'Casa # 229', 'Urb. Ciudad Plaza', '', '', 'Diagonal al Abasto Sra. Mary', 'Valencia', 'Valencia', 'Carabobo', 'Rafael Urdaneta', '2003', 'Venezuela', '02418960316', '04124483847', 'noralis_guillermos@hotmail.com', '00007', 'MILAGROS COROMOTO PEÑA SANCHEZ', '00007', 'MILAGROS COROMOTO PEÑA SANCHEZ', 'Noralis Guillermos', '01020692800000150206', 'Banco de Venezuela', 'Valencia', 'Carabobo', 'corriente', 'Natural', 'Local', 'VIP', 'Hogar', '2017-08-15', 0, ''),
(22, '0000L', 'VEN-0000L-TNLP', 'VEN-0000L-CNLP', 'WILLIAM JOSE', 'TELLES MORA', '19794050', 'V197940502', '1990-05-04', 'soltero', 'masculino', 'ING MECANICO', '', '', '', '', '', 'soltero', 'masculino', 'CALLE 144', '', 'NO 981', 'EL MORRO II', '', '', '', 'Valencia', 'SAN DIEGO', 'Carabobo', 'SAN DIEGO', '2006', 'Venezuela', '02418248261', '04247527927', 'tellezwwilliam@gmail.com', '0000A', 'BELKIS JANETH NOSSA QUINTERO', '0000A', 'BELKIS JANETH NOSSA QUINTERO', 'WILLIAM JOSE TELLES MORA', '01080071470100966864', 'BBVA Provincial', 'VALENCIA', 'Carabobo', 'corriente', 'Natural', 'Local', 'Premium', 'Hogar', '2017-08-16', 0, ''),
(23, '0000M', 'VEN-0000M-TELO', 'VEN-0000M-CELO', 'JHONY GABRIEL', 'HERNANDEZ', '11495717', 'V114957173', '1973-04-18', 'casado', 'masculino', 'NATUROPATA', '', '', '', '', '', '', '', 'CALLE PAEZ', 'CRUCE CON SUCRE', 'EDIFICIO DON TOTO', 'CENTRO', 'MEZZANINA', 'OFIC.1-13', 'CENTRO DE LA CIUDAD', 'Maracay', 'MUNICIPIO GIRARDOT', 'Aragua', 'ANDRES ELOY BLANCO', '2103', 'Venezuela', '02438896175', '04161064334', 'jhonygabrielh@gmail.com', '00002', 'Corporativo 2', '00002', 'Corporativo 2', 'JHONY GABRIEL HERNANDEZ ', '01050664641664068821', 'Mercantil', 'MARACAY', 'Aragua', 'corriente', 'Especialista', 'Local', 'Oro', 'Hogar', '2017-08-16', 0, ''),
(24, '0000N', 'VEN-0000N-TNLP', 'VEN-0000N-CNLP', 'Enriqueta Mercedes', 'Bravo de Abreu', '3862177', 'V038621773', '1953-04-23', 'casado', 'femenino', 'Docente', 'Jorge Pastor', 'Abreu Graterol', '3705080', 'V037050802', '1949-09-08', 'casado', 'masculino', 'Avenida Boyacá', 'Entre calles Aánchez Carrero y Libertad', 'Residencias Mauraco', 'La Democracia', '9', '92', 'Detrás del Colegio "La Consolación"', 'Maracay', 'Girardot', 'Aragua', 'Andrés Eloy Blanco', '2101', 'Venezuela', '02432463186', '04144542695', 'enriquetab53@gmail.com', '00002', 'Corporativo 2', '00002', 'Corporativo 2', 'Enriqueta Mercedes Bravo de Abreu', '01020338450100000503', 'Banco de Venezuela', 'Maracay', 'Aragua', 'ahorro', 'Natural', 'Local', 'Premium', 'Todas', '2017-08-18', 0, ''),
(25, '0000O', 'VEN-0000O-TNLP', 'VEN-0000O-CNLP', 'ANIBAL JOSE ', 'VALERA LATOUCHE', '9535309', 'V09535092', '1964-07-05', 'casado', 'masculino', 'ING EN SISTEMAS', 'MARIELA MARISOL', 'MORALES MONTESINOS', '10985006', 'V109850060', '1971-05-18', 'casado', 'femenino', 'CALLE D MANZAN8 No.5', '', 'CASA 5', 'SOL DE TAGUANES', '', '', 'DETRAS HOSPITAL JOAQUINA', 'Tinaquillo', 'TINAQUILLO', 'Cojedes', 'TINAQUILLO', '2209', 'Venezuela', '02587662934', '04144192109', 'canisca@hotmail.com', '00008', 'Z Linares de salazar', '00008', 'Z Linares de salazar', 'ANIBAL JOSE VALERA L', '01340410164101030779', 'Banesco', 'TINAQUILLO', 'Cojedes', 'corriente', 'Natural', 'Local', 'Premium', 'Todas', '2017-08-18', 0, ''),
(26, '0000P', 'VEN-0000P-TNLP', 'VEN-0000P-CNLP', 'LAURA LIS ', 'MOSQUEDA MARTINEZ', '15275145', 'V152751458', '1979-09-16', 'soltero', 'femenino', 'ADMON RRHH', '', '', '', '', '', 'soltero', 'masculino', 'MICHELENA', '', 'CASA No3', 'NUEVA GUACARA', '', '', 'CERCA DEL CLUB PAVECA', 'Guacara', 'GUACARA', 'Carabobo', 'GUACARA', '2015', 'Venezuela', '02454153474', '04244423949', 'mosqueda1609@hotmail.com', '0000A', 'BELKIS JANETH NOSSA QUINTERO', '0000A', 'BELKIS JANETH NOSSA QUINTERO', 'LAURA LIS MOSQUEDA M', '01082415060100184608', 'BBVA Provincial', 'VALENCIA', 'Carabobo', 'corriente', 'Natural', 'Local', 'Premium', 'Hogar', '2017-08-18', 0, ''),
(27, '0000Q', 'VEN-0000Q-TNLP', 'VEN-0000Q-CNLP', 'MAGALY PASTORA ', 'VERA', '3922718', 'V39227181', '1953-04-04', 'casado', 'femenino', 'COMERCIANTE INDEPENDIENTE', 'BARTOLIS ANTONIO', 'GOMEZ NUÑEZ', '4576423', 'V45764237', '1949-02-02', 'casado', 'masculino', 'AV BOLIVAR NORTE', 'CALLEJON SANTA ANA', 'RESIDENCIAS KARINA', 'CHAGUARAMAL', '9', '94', 'DETRAS DEL TORIGALLO', 'Valencia', 'VALENCIA', 'Carabobo', 'SAN JOSE', '2001', 'Venezuela', '02418226963', '04142330447', 'verapastora@yahoo.com', '00002', 'Corporativo 2', '00002', 'Corporativo 2', 'MAGALY PASTORA VERA', '01050120221120182247', 'Mercantil', 'EL RECREO VALENCIA', 'Carabobo', 'corriente', 'Natural', 'Local', 'Premium', 'Todas', '2017-08-21', 0, ''),
(28, '0000R', 'VEN-0000R-TNLO', 'VEN-0000R-CNLO', 'ALBERTO JOSE', 'MARTINEZ TORTOLERO', '12301842', 'V123018423', '1975-12-28', 'casado', 'masculino', 'COMERCIANTE', 'MARIA ESTHER', 'ESPINOZA FREITES', '12300855', 'V123008550', '1974-03-29', 'casado', 'femenino', 'CALLE NORTE AV. PRIMERA ETAPA', '', 'CASA MA8', 'CIUDAD PARQUE LA PRADERA', '', '', 'CASTILLO. FERRETERIA EL CARMEN ', 'Guacara', 'SAN JOAQUIN', 'Carabobo', 'SAN JOAQUIN', '2018', 'Venezuela', '02455621067', '04244379541', 'alberto_martinezt1975@hotmail.com', '00008', 'Z Linares de salazar', '00008', 'Z Linares de salazar', 'ALBERTO J. MARTINEZ', '01910027801127279516', 'Banco Nacional de Crédito', 'Guacara', 'Carabobo', 'ahorro', 'Natural', 'Local', 'Oro', 'Todas', '2017-09-08', 0, '');

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

--
-- Volcado de datos para la tabla `bono_afiliacion`
--

INSERT INTO `bono_afiliacion` (`id`, `nivel`, `premium`, `vip`, `oro`) VALUES
(1, '1', 20, 15, 10),
(2, '2', 12, 10, 8),
(3, '3', 8, 7, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id` int(11) NOT NULL,
  `ciudad` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`id`, `ciudad`) VALUES
(1, 'Acarigua'),
(2, 'Anaco'),
(3, 'Araure'),
(4, 'Barcelona'),
(5, 'Barinas'),
(6, 'Barquisimeto'),
(7, 'Cabimas'),
(8, 'Cabudare'),
(9, 'Cagua'),
(10, 'Caicara del Orinoco'),
(11, 'Calabozo'),
(12, 'Caracas'),
(13, 'Carora'),
(14, 'Carúpano'),
(15, 'Charallave'),
(16, 'Ciudad Bolívar'),
(17, 'Ciudad Guayana'),
(18, 'Ciudad Ojeda'),
(19, 'Coro'),
(20, 'Cúa'),
(21, 'Cumaná'),
(22, 'Ejido'),
(23, 'El Limón'),
(24, 'El Tigre'),
(25, 'El Tocuyo'),
(26, 'El Vigía'),
(27, 'Guacara'),
(28, 'Guanare'),
(29, 'Guarenas'),
(30, 'Guasdualito'),
(31, 'Guatire'),
(32, 'Güigüe'),
(33, 'La Concepción'),
(34, 'La Victoria'),
(35, 'Los Guayos'),
(36, 'Los Puertos de Altagracia'),
(37, 'Los Teques'),
(38, 'Machiques'),
(39, 'Maracaibo'),
(40, 'Maracay'),
(41, 'Mariara'),
(42, 'Maturín'),
(43, 'Mérida'),
(44, 'Naguanagua'),
(45, 'Ocumare del Tuy'),
(46, 'Porlamar'),
(47, 'Puerto Ayacucho'),
(48, 'Puerto Cabello'),
(49, 'Puerto La Cruz'),
(50, 'Punto Fijo'),
(51, 'Quíbor'),
(52, 'San Carlos'),
(53, 'San Cristóbal'),
(54, 'San Felipe'),
(55, 'San Fernando de Apure'),
(56, 'San Juan de Los Morros'),
(57, 'Santa Bárbara del Zulia'),
(58, 'Santa Lucía'),
(59, 'Santa Rita'),
(60, 'Santa Teresa del Tuy'),
(61, 'Táriba'),
(62, 'Tinaquillo'),
(63, 'Tocuyito'),
(64, 'Tovar'),
(65, 'Tucupita'),
(66, 'Turmero'),
(67, 'Upata'),
(68, 'Valencia'),
(69, 'Valera'),
(70, 'Valle de la Pascua'),
(71, 'Villa de Cura'),
(72, 'Yaritagua'),
(73, 'Zaraza');

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

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `emp_nombre`, `emp_rif`, `emp_web`, `emp_email`, `emp_direccion`, `emp_logo`, `emp_hoy`, `prefijo_pais`, `pvp_premium_hogar`, `premium_hogar`, `mp_premium_hogar`, `pvp_premium_lq`, `premium_lq`, `mp_premium_lq`, `pvp_premium_teatro`, `premium_teatro`, `mp_premium_teatro`, `pvp_premium_todas`, `premium_todas`, `mp_premium_todas`, `pvp_vip_hogar`, `vip_hogar`, `mp_vip_hogar`, `pvp_vip_lq`, `vip_lq`, `mp_vip_lq`, `pvp_vip_teatro`, `vip_teatro`, `mp_vip_teatro`, `pvp_vip_todas`, `vip_todas`, `mp_vip_todas`, `pvp_oro_hogar`, `oro_hogar`, `mp_oro_hogar`, `pvp_oro_lq`, `oro_lq`, `mp_oro_lq`, `pvp_oro_teatro`, `oro_teatro`, `mp_oro_teatro`, `pvp_oro_todas`, `oro_todas`, `mp_oro_todas`) VALUES
(1, 'Corporación Manna C.A.', 'J298355832', 'www.corporacionmanna.com', 'afiliaciones@corporacionmanna.com', 'Av. Miranda, Urb. Kerdell, Centro Profesional Kerdell, Piso 4 Oficina 401, Valencia, Estado Carabobo. 2001 Corporación Manna de Venezuela', 'manna.png', '2017-06-04', 'VEN', '290085.24', '235458.80', 190, '309316.20', '294427.64', 125, '411099.49', '333684.65', 120, '366599.97', '297564.91', 160, '181237.47', '147108.34', 100, '217640.91', '176656.58', 75, '274066.33', '222456.44', 80, '193371.95', '156957.75', 100, '24217.64', '19657.57', 20, '72546.97', '58885.53', 25, '137033.16', '111228.22', 40, '36194.95', '29378.94', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `estado` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `estado`) VALUES
(1, 'Amazonas'),
(2, 'Anzoátegui'),
(3, 'Apure'),
(4, 'Aragua'),
(5, 'Barinas'),
(6, 'Bolívar'),
(7, 'Carabobo'),
(8, 'Cojedes'),
(9, 'Delta Amacuro'),
(10, 'Distrito Capital'),
(11, 'Falcón'),
(12, 'Guárico'),
(13, 'Lara'),
(14, 'Mérida'),
(15, 'Miranda'),
(16, 'Monagas'),
(17, 'Nueva Esparta'),
(18, 'Portuguesa'),
(19, 'Sucre'),
(20, 'Táchira'),
(21, 'Trujillo'),
(22, 'Vargas'),
(23, 'Yaracuy'),
(24, 'Zulia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genealogia`
--

CREATE TABLE `genealogia` (
  `id` bigint(20) NOT NULL,
  `padre` varchar(20) NOT NULL,
  `hijo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `genealogia`
--

INSERT INTO `genealogia` (`id`, `padre`, `hijo`) VALUES
(1, '00000', '00001'),
(2, '00000', '00002'),
(3, '00000', '00003'),
(4, '00000', '00004'),
(5, '00000', '00005'),
(6, '00000', '00006'),
(7, '00002', '00007'),
(8, '00002', '00008'),
(9, '00002', '00009'),
(10, '00008', '0000A'),
(11, '00001', '0000B'),
(12, '0000B', '0000C'),
(13, '0000A', '0000D'),
(14, '0000A', '0000E'),
(15, '00009', '0000F'),
(16, '00002', '0000G'),
(17, '0000G', '0000H'),
(18, '00007', '0000I'),
(19, '0000A', '0000J'),
(20, '00007', '0000K'),
(21, '0000A', '0000L'),
(22, '00002', '0000M'),
(23, '00002', '0000N'),
(24, '00008', '0000O'),
(25, '0000A', '0000P'),
(26, '00002', '0000Q'),
(27, '00008', '0000R');

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

--
-- Volcado de datos para la tabla `kits_promocion`
--

INSERT INTO `kits_promocion` (`id`, `promo_id`, `promo_kit`, `promo_nombre`, `promo_precio`, `promo_puntos`) VALUES
(1, 1, 'PFX3', '3 FRASCOS DE FRUTIBAL', '210700.83', 140),
(2, 1, 'PFX6', '6 FRASCOS DE FRUTIBAL', '359254.20', 280),
(3, 1, 'PFX8', '8 FRASCOS DE FRUTIBAL', '362880.00', 480),
(4, 1, 'PMH1', '2 PLAT + 2 K-ATALIZADOR', '100969.90', 214),
(5, 1, 'PMH2', '4 PLAT + 4 K-ATALIZADOR', '201939.80', 328),
(6, 1, 'PMH4', '8 PLAT + 8 K-ATALIZADOR', '403879.60', 536),
(7, 1, 'PTI1', '2 JUGUETES TI', '229520.00', 160),
(8, 1, 'PTI2', '6 JUGUETES TI', '498960.00', 380),
(9, 1, 'PTI3', '8 JUGUETES TI', '556416.00', 560);

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

--
-- Volcado de datos para la tabla `organizacion`
--

INSERT INTO `organizacion` (`id`, `organizacion`, `nivel`, `afiliado`, `lado`) VALUES
(1, '00001', '0', '00001', '0'),
(2, '00000', '1', '00001', '1'),
(3, '00002', '0', '00002', '0'),
(4, '00000', '1', '00002', '1'),
(5, '00003', '0', '00003', '0'),
(6, '00000', '1', '00003', '1'),
(7, '00004', '0', '00004', '0'),
(8, '00000', '1', '00004', '1'),
(9, '00005', '0', '00005', '0'),
(10, '00000', '1', '00005', '1'),
(11, '00006', '0', '00006', '0'),
(12, '00000', '1', '00006', '1'),
(13, '00007', '0', '00007', '0'),
(14, '00002', '1', '00007', '1'),
(15, '00000', '2', '00007', '1'),
(16, '00008', '0', '00008', '0'),
(17, '00002', '1', '00008', '1'),
(18, '00000', '2', '00008', '1'),
(19, '00009', '0', '00009', '0'),
(20, '00002', '1', '00009', '1'),
(21, '00000', '2', '00009', '1'),
(22, '0000A', '0', '0000A', '0'),
(23, '00008', '1', '0000A', '1'),
(24, '00002', '2', '0000A', '1'),
(25, '00000', '3', '0000A', '1'),
(26, '0000B', '0', '0000B', '0'),
(27, '00001', '1', '0000B', '1'),
(28, '00000', '2', '0000B', '1'),
(29, '0000C', '0', '0000C', '0'),
(30, '0000B', '1', '0000C', '1'),
(31, '00001', '2', '0000C', '1'),
(32, '00000', '3', '0000C', '1'),
(33, '0000D', '0', '0000D', '0'),
(34, '0000A', '1', '0000D', '1'),
(35, '00008', '2', '0000D', '1'),
(36, '00002', '3', '0000D', '1'),
(37, '00000', '4', '0000D', '1'),
(38, '0000E', '0', '0000E', '0'),
(39, '0000A', '1', '0000E', '1'),
(40, '00008', '2', '0000E', '1'),
(41, '00002', '3', '0000E', '1'),
(42, '00000', '4', '0000E', '1'),
(43, '0000F', '0', '0000F', '0'),
(44, '00009', '1', '0000F', '1'),
(45, '00002', '2', '0000F', '1'),
(46, '00000', '3', '0000F', '1'),
(47, '0000G', '0', '0000G', '0'),
(48, '00002', '1', '0000G', '1'),
(49, '00000', '2', '0000G', '1'),
(50, '0000H', '0', '0000H', '0'),
(51, '0000G', '1', '0000H', '1'),
(52, '00002', '2', '0000H', '1'),
(53, '00000', '3', '0000H', '1'),
(54, '0000I', '0', '0000I', '0'),
(55, '00007', '1', '0000I', '1'),
(56, '00002', '2', '0000I', '1'),
(57, '00000', '3', '0000I', '1'),
(58, '0000J', '0', '0000J', '0'),
(59, '0000A', '1', '0000J', '1'),
(60, '00008', '2', '0000J', '1'),
(61, '00002', '3', '0000J', '1'),
(62, '00000', '4', '0000J', '1'),
(63, '0000K', '0', '0000K', '0'),
(64, '00007', '1', '0000K', '1'),
(65, '00002', '2', '0000K', '1'),
(66, '00000', '3', '0000K', '1'),
(67, '0000L', '0', '0000L', '0'),
(68, '0000A', '1', '0000L', '1'),
(69, '00008', '2', '0000L', '1'),
(70, '00002', '3', '0000L', '1'),
(71, '00000', '4', '0000L', '1'),
(72, '0000M', '0', '0000M', '0'),
(73, '00002', '1', '0000M', '1'),
(74, '00000', '2', '0000M', '1'),
(75, '0000N', '0', '0000N', '0'),
(76, '00002', '1', '0000N', '1'),
(77, '00000', '2', '0000N', '1'),
(78, '0000O', '0', '0000O', '0'),
(79, '00008', '1', '0000O', '1'),
(80, '00002', '2', '0000O', '1'),
(81, '00000', '3', '0000O', '1'),
(82, '0000P', '0', '0000P', '0'),
(83, '0000A', '1', '0000P', '1'),
(84, '00008', '2', '0000P', '1'),
(85, '00002', '3', '0000P', '1'),
(86, '00000', '4', '0000P', '1'),
(87, '0000Q', '0', '0000Q', '0'),
(88, '00002', '1', '0000Q', '1'),
(89, '00000', '2', '0000Q', '1'),
(90, '0000R', '0', '0000R', '0'),
(91, '00008', '1', '0000R', '1'),
(92, '00002', '2', '0000R', '1'),
(93, '00000', '3', '0000R', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id` int(11) NOT NULL,
  `pais` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `pais`) VALUES
(1, 'Afganistán'),
(2, 'Albania'),
(3, 'Alemania'),
(4, 'Andorra'),
(5, 'Angola'),
(6, 'Antigua y Barbuda'),
(7, 'Arabia Saudita'),
(8, 'Argelia'),
(9, 'Argentina'),
(10, 'Armenia'),
(11, 'Australia'),
(12, 'Austria'),
(13, 'Azerbaiyán'),
(14, 'Bahamas'),
(15, 'Bangladés'),
(16, 'Barbados'),
(17, 'Baréin'),
(18, 'Bélgica'),
(19, 'Belice'),
(20, 'Benín'),
(21, 'Bielorrusia'),
(22, 'Birmania'),
(23, 'Bolivia'),
(24, 'Bosnia-Herzegovina'),
(25, 'Botsuana'),
(26, 'Brasil'),
(27, 'Brunéi'),
(28, 'Bulgaria'),
(29, 'Burkina Faso'),
(30, 'Burundi'),
(31, 'Bután'),
(32, 'Cabo Verde'),
(33, 'Camboya'),
(34, 'Camerún'),
(35, 'Canadá'),
(36, 'Catar'),
(37, 'Chad'),
(38, 'Chile'),
(39, 'China'),
(40, 'Chipre'),
(41, 'Colombia'),
(42, 'Comoras'),
(43, 'Congo'),
(44, 'Corea del Norte'),
(45, 'Corea del Sur'),
(46, 'Costa de Marfil'),
(47, 'Costa Rica'),
(48, 'Croacia'),
(49, 'Cuba'),
(50, 'Dinamarca'),
(51, 'Dominica'),
(52, 'Ecuador'),
(53, 'Egipto'),
(54, 'El Salvador'),
(55, 'Emiratos Árabes Unidos'),
(56, 'Eritrea'),
(57, 'Eslovaquia'),
(58, 'Eslovenia'),
(59, 'España'),
(60, 'Estados Unidos'),
(61, 'Estonia'),
(62, 'Etiopía'),
(63, 'Filipinas'),
(64, 'Finlandia'),
(65, 'Fiyi'),
(66, 'Francia'),
(67, 'Gabón'),
(68, 'Gambia'),
(69, 'Georgia'),
(70, 'Ghana'),
(71, 'Granada'),
(72, 'Grecia'),
(73, 'Guatemala'),
(74, 'Guinea'),
(75, 'Guinea Ecuatorial'),
(76, 'Guinea-Bisáu'),
(77, 'Guyana'),
(78, 'Haití'),
(79, 'Honduras'),
(80, 'Hungría'),
(81, 'India'),
(82, 'Indonesia'),
(83, 'Irak'),
(84, 'Irán'),
(85, 'Irlanda'),
(86, 'Islandia'),
(87, 'Islas Marshall'),
(88, 'Islas Salomón'),
(89, 'Israel'),
(90, 'Italia'),
(91, 'Jamaica'),
(92, 'Japón'),
(93, 'Jordania'),
(94, 'Kazajistán'),
(95, 'Kenia'),
(96, 'Kirguistán'),
(97, 'Kiribati'),
(98, 'Kosovo'),
(99, 'Kuwait'),
(100, 'Laos'),
(101, 'Lesoto'),
(102, 'Letonia'),
(103, 'Líbano'),
(104, 'Liberia'),
(105, 'Libia'),
(106, 'Liechtenstein'),
(107, 'Lituania'),
(108, 'Luxemburgo'),
(109, 'Macedonia'),
(110, 'Madagascar'),
(111, 'Malasia'),
(112, 'Malaui'),
(113, 'Maldivas'),
(114, 'Malí'),
(115, 'Malta'),
(116, 'Marruecos'),
(117, 'Mauricio'),
(118, 'Mauritania'),
(119, 'México'),
(120, 'Micronesia'),
(121, 'Moldavia'),
(122, 'Mónaco'),
(123, 'Mongolia'),
(124, 'Montenegro'),
(125, 'Mozambique'),
(126, 'Namibia'),
(127, 'Nauru'),
(128, 'Nepal'),
(129, 'Nicaragua'),
(130, 'Níger'),
(131, 'Nigeria'),
(132, 'Noruega'),
(133, 'Nueva Zelanda'),
(134, 'Omán'),
(135, 'Países Bajos'),
(136, 'Pakistán'),
(137, 'Palaos'),
(138, 'Palestina'),
(139, 'Panamá'),
(140, 'Papúa Nueva Guinea'),
(141, 'Paraguay'),
(142, 'Perú'),
(143, 'Polonia'),
(144, 'Portugal'),
(145, 'Reino Unido'),
(146, 'República Centroafricana'),
(147, 'República Checa'),
(148, 'República Democrática del Congo'),
(149, 'República Dominicana'),
(150, 'Ruanda'),
(151, 'Rumania'),
(152, 'Rusia'),
(153, 'Samoa'),
(154, 'San Cristóbal y Nieves'),
(155, 'San Marino'),
(156, 'San Vicente y las Granadinas'),
(157, 'Santa Lucía'),
(158, 'Santo Tomé y Príncipe'),
(159, 'Senegal'),
(160, 'Serbia'),
(161, 'Seychelles'),
(162, 'Sierra Leona'),
(163, 'Singapur'),
(164, 'Siria'),
(165, 'Somalia'),
(166, 'Sri Lanka'),
(167, 'Suazilandia'),
(168, 'Sudáfrica'),
(169, 'Sudán'),
(170, 'Sudán del Sur'),
(171, 'Suecia'),
(172, 'Suiza'),
(173, 'Surinam'),
(174, 'Tailandia'),
(175, 'Taiwán'),
(176, 'Tanzania'),
(177, 'Tayikistán'),
(178, 'Timor Oriental'),
(179, 'Togo'),
(180, 'Tonga'),
(181, 'Trinidad y Tobago'),
(182, 'Túnez'),
(183, 'Turkmenistán'),
(184, 'Turquía'),
(185, 'Tuvalu'),
(186, 'Ucrania'),
(187, 'Uganda'),
(188, 'Uruguay'),
(189, 'Uzbekistán'),
(190, 'Vanuatu'),
(191, 'Vaticano'),
(192, 'Venezuela'),
(193, 'Vietnam'),
(194, 'Yemen'),
(195, 'Yibuti'),
(196, 'Zambia'),
(197, 'Zimbabue');

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

--
-- Volcado de datos para la tabla `patrocinio`
--

INSERT INTO `patrocinio` (`id`, `patroc_codigo`, `tit_codigo`, `fecha_afiliacion`, `fecha_fin_bono`) VALUES
(1, '00000', '00000', '2017-07-17', '2017-09-15'),
(2, '00000', '00001', '2017-07-17', '2017-09-15'),
(3, '00000', '00002', '2017-07-17', '2017-09-15'),
(4, '00000', '00003', '2017-07-17', '2017-09-15'),
(5, '00000', '00004', '2017-07-17', '2017-09-15'),
(6, '00000', '00005', '2017-07-17', '2017-09-15'),
(7, '00000', '00006', '2017-07-17', '2017-09-15'),
(8, '00001', '0000B', '2017-08-03', '2017-10-02'),
(9, '00002', '00007', '2017-08-01', '2017-09-30'),
(10, '00002', '00008', '2017-08-01', '2017-09-30'),
(11, '00002', '00009', '2017-08-02', '2017-10-01'),
(12, '00002', '0000G', '2017-08-13', '2017-10-12'),
(13, '00008', '0000A', '2017-08-03', '2017-10-02'),
(14, '00009', '0000F', '2017-08-10', '2017-10-09'),
(15, '0000A', '0000D', '2017-08-04', '2017-10-03'),
(16, '0000A', '0000E', '2017-08-08', '2017-10-07'),
(17, '0000B', '0000C', '2017-08-04', '2017-10-03'),
(18, '0000G', '0000H', '2017-08-13', '2017-10-12'),
(19, '00007', '0000I', '2017-08-14', '2017-10-13'),
(20, '0000A', '0000J', '2017-08-15', '2017-10-14'),
(21, '00007', '0000K', '2017-08-15', '2017-10-14'),
(22, '0000A', '0000L', '2017-08-16', '2017-10-15'),
(23, '00002', '0000M', '2017-08-16', '2017-10-15'),
(24, '00002', '0000N', '2017-08-18', '2017-10-17'),
(25, '00008', '0000O', '2017-08-18', '2017-10-17'),
(26, '0000A', '0000P', '2017-08-18', '2017-10-17'),
(27, '00002', '0000Q', '2017-08-21', '2017-10-20'),
(28, '00008', '0000R', '2017-09-08', '2017-11-07');

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

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`promo_id`, `nombre`, `fecha_limite`, `ticket1`, `ticket2`, `status`) VALUES
(1, 'Experiencia Manna', '2017-08-22', '00001', '00054', 'Activa');

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

--
-- Volcado de datos para la tabla `repbonoafiliacion`
--

INSERT INTO `repbonoafiliacion` (`patroc_codigo`, `tit_codigo`, `fecha_afiliacion`, `fecha_fin_bono`, `nivel`, `afiliado`, `tipo_afiliado`, `fectr`, `monto`, `porcentaje`, `comision`, `patroc_nombres`, `nombres`) VALUES
('00000', '00000', '2017-07-17', '2017-09-15', '3', '00007', 'Premium', '2017-08-01', '75000.00', '8.00', '6000.00', 'José Luis Baudet Guerra', 'MILAGROS COROMOTO PEÑA SANCHEZ'),
('00000', '00000', '2017-07-17', '2017-09-15', '3', '00008', 'VIP', '2017-08-01', '75000.00', '7.00', '5250.00', 'José Luis Baudet Guerra', 'Z Linares de salazar'),
('00000', '00000', '2017-07-17', '2017-09-15', '3', '00009', 'VIP', '2017-08-02', '160000.00', '7.00', '11200.00', 'José Luis Baudet Guerra', 'antonieta troccoli'),
('00000', '00000', '2017-07-17', '2017-09-15', '3', '0000B', 'Oro', '2017-08-03', '40000.00', '5.00', '2000.00', 'José Luis Baudet Guerra', 'JOHANMILET YURIMAR GUILLEN ARIAS'),
('00000', '00000', '2017-07-17', '2017-09-15', '3', '0000G', 'Premium', '2017-08-13', '140000.00', '8.00', '11200.00', 'José Luis Baudet Guerra', 'Rosario Nieves Leal'),
('00000', '00000', '2017-07-17', '2017-09-15', '3', '0000M', 'Oro', '2017-08-16', '40000.00', '5.00', '2000.00', 'José Luis Baudet Guerra', 'JHONY GABRIEL HERNANDEZ'),
('00000', '00000', '2017-07-17', '2017-09-15', '3', '0000N', 'Premium', '2017-08-17', '180000.00', '8.00', '14400.00', 'José Luis Baudet Guerra', 'Enriqueta Mercedes Bravo de Abreu'),
('00000', '00000', '2017-07-17', '2017-09-15', '3', '0000Q', 'Premium', '2017-08-21', '180000.00', '8.00', '14400.00', 'José Luis Baudet Guerra', 'MAGALY PASTORA VERA'),
('00000', '00001', '2017-07-17', '2017-09-15', '2', '0000B', 'Oro', '2017-08-03', '40000.00', '8.00', '3200.00', 'Corporativo 1', 'JOHANMILET YURIMAR GUILLEN ARIAS'),
('00000', '00001', '2017-07-17', '2017-09-15', '3', '0000C', 'VIP', '2017-08-04', '75000.00', '7.00', '5250.00', 'Corporativo 1', 'Nelson Antonio Von der Brelje Delli Compagni'),
('00000', '00002', '2017-07-17', '2017-09-15', '2', '00007', 'Premium', '2017-08-01', '75000.00', '12.00', '9000.00', 'Corporativo 2', 'MILAGROS COROMOTO PEÑA SANCHEZ'),
('00000', '00002', '2017-07-17', '2017-09-15', '2', '00008', 'VIP', '2017-08-01', '75000.00', '10.00', '7500.00', 'Corporativo 2', 'Z Linares de salazar'),
('00000', '00002', '2017-07-17', '2017-09-15', '2', '00009', 'VIP', '2017-08-02', '160000.00', '10.00', '16000.00', 'Corporativo 2', 'antonieta troccoli'),
('00000', '00002', '2017-07-17', '2017-09-15', '2', '0000G', 'Premium', '2017-08-13', '140000.00', '12.00', '16800.00', 'Corporativo 2', 'Rosario Nieves Leal'),
('00000', '00002', '2017-07-17', '2017-09-15', '2', '0000M', 'Oro', '2017-08-16', '40000.00', '8.00', '3200.00', 'Corporativo 2', 'JHONY GABRIEL HERNANDEZ'),
('00000', '00002', '2017-07-17', '2017-09-15', '2', '0000N', 'Premium', '2017-08-17', '180000.00', '12.00', '21600.00', 'Corporativo 2', 'Enriqueta Mercedes Bravo de Abreu'),
('00000', '00002', '2017-07-17', '2017-09-15', '2', '0000Q', 'Premium', '2017-08-21', '180000.00', '12.00', '21600.00', 'Corporativo 2', 'MAGALY PASTORA VERA'),
('00000', '00002', '2017-07-17', '2017-09-15', '3', '0000A', 'Premium', '2017-08-03', '180000.00', '8.00', '14400.00', 'Corporativo 2', 'BELKIS JANETH NOSSA QUINTERO'),
('00000', '00002', '2017-07-17', '2017-09-15', '3', '0000F', 'Premium', '2017-08-10', '195000.00', '8.00', '15600.00', 'Corporativo 2', 'Luis Jesús Sojo'),
('00000', '00002', '2017-07-17', '2017-09-15', '3', '0000H', 'Premium', '2017-08-13', '180000.00', '8.00', '14400.00', 'Corporativo 2', 'Carlos Eduardo Jairran Nieves'),
('00000', '00002', '2017-07-17', '2017-09-15', '3', '0000I', 'VIP', '2017-08-14', '75000.00', '7.00', '5250.00', 'Corporativo 2', 'LLOANI ARICELA GUILLERMOS CHIQUITO'),
('00000', '00002', '2017-07-17', '2017-09-15', '3', '0000K', 'VIP', '2017-08-14', '75000.00', '7.00', '5250.00', 'Corporativo 2', 'NORALIS GREGORIA GUILLERMOS CHIQUITO'),
('00000', '00002', '2017-07-17', '2017-09-15', '3', '0000O', 'Premium', '2017-08-18', '180000.00', '8.00', '14400.00', 'Corporativo 2', 'ANIBAL JOSE VALERA LATOUCHE'),
('00000', '00002', '2017-07-17', '2017-09-15', '3', '0000R', 'Oro', '2017-09-08', '120500.00', '5.00', '6025.00', 'Corporativo 2', 'ALBERTO JOSE MARTINEZ TORTOLERO'),
('00001', '0000B', '2017-08-03', '2017-10-02', '1', '0000B', 'Oro', '2017-08-03', '40000.00', '10.00', '4000.00', 'JOHANMILET YURIMAR GUILLEN ARIAS', 'JOHANMILET YURIMAR GUILLEN ARIAS'),
('00001', '0000B', '2017-08-03', '2017-10-02', '2', '0000C', 'VIP', '2017-08-04', '75000.00', '10.00', '7500.00', 'JOHANMILET YURIMAR GUILLEN ARIAS', 'Nelson Antonio Von der Brelje Delli Compagni'),
('00002', '00007', '2017-08-01', '2017-09-30', '1', '00007', 'Premium', '2017-08-01', '75000.00', '20.00', '15000.00', 'MILAGROS COROMOTO PEÑA SANCHEZ', 'MILAGROS COROMOTO PEÑA SANCHEZ'),
('00002', '00007', '2017-08-01', '2017-09-30', '2', '0000I', 'VIP', '2017-08-14', '75000.00', '10.00', '7500.00', 'MILAGROS COROMOTO PEÑA SANCHEZ', 'LLOANI ARICELA GUILLERMOS CHIQUITO'),
('00002', '00007', '2017-08-01', '2017-09-30', '2', '0000K', 'VIP', '2017-08-14', '75000.00', '10.00', '7500.00', 'MILAGROS COROMOTO PEÑA SANCHEZ', 'NORALIS GREGORIA GUILLERMOS CHIQUITO'),
('00002', '00008', '2017-08-01', '2017-09-30', '1', '00008', 'VIP', '2017-08-01', '75000.00', '15.00', '11250.00', 'Z Linares de salazar', 'Z Linares de salazar'),
('00002', '00008', '2017-08-01', '2017-09-30', '2', '0000A', 'Premium', '2017-08-03', '180000.00', '12.00', '21600.00', 'Z Linares de salazar', 'BELKIS JANETH NOSSA QUINTERO'),
('00002', '00008', '2017-08-01', '2017-09-30', '2', '0000O', 'Premium', '2017-08-18', '180000.00', '12.00', '21600.00', 'Z Linares de salazar', 'ANIBAL JOSE VALERA LATOUCHE'),
('00002', '00008', '2017-08-01', '2017-09-30', '2', '0000R', 'Oro', '2017-09-08', '120500.00', '8.00', '9640.00', 'Z Linares de salazar', 'ALBERTO JOSE MARTINEZ TORTOLERO'),
('00002', '00008', '2017-08-01', '2017-09-30', '3', '0000D', 'Premium', '2017-08-04', '180000.00', '8.00', '14400.00', 'Z Linares de salazar', 'JOSE GREGORIO RODRIGUEZ ANGULO'),
('00002', '00008', '2017-08-01', '2017-09-30', '3', '0000E', 'Premium', '2017-08-08', '140000.00', '8.00', '11200.00', 'Z Linares de salazar', 'ALEXANDRA VERGARA MIRANDA'),
('00002', '00008', '2017-08-01', '2017-09-30', '3', '0000J', 'Premium', '2017-08-15', '180000.00', '8.00', '14400.00', 'Z Linares de salazar', 'MARIA EUGENIA NOSSA QUINTERO'),
('00002', '00008', '2017-08-01', '2017-09-30', '3', '0000L', 'Premium', '2017-08-16', '140000.00', '8.00', '11200.00', 'Z Linares de salazar', 'WILLIAM JOSE TELLES MORA'),
('00002', '00008', '2017-08-01', '2017-09-30', '3', '0000P', 'Premium', '2017-08-18', '140000.00', '8.00', '11200.00', 'Z Linares de salazar', 'LAURA LIS MOSQUEDA MARTINEZ'),
('00002', '00009', '2017-08-02', '2017-10-01', '1', '00009', 'VIP', '2017-08-02', '160000.00', '15.00', '24000.00', 'antonieta troccoli', 'antonieta troccoli'),
('00002', '00009', '2017-08-02', '2017-10-01', '2', '0000F', 'Premium', '2017-08-10', '195000.00', '12.00', '23400.00', 'antonieta troccoli', 'Luis Jesús Sojo'),
('00002', '0000G', '2017-08-13', '2017-10-12', '1', '0000G', 'Premium', '2017-08-13', '140000.00', '20.00', '28000.00', 'Rosario Nieves Leal', 'Rosario Nieves Leal'),
('00002', '0000G', '2017-08-13', '2017-10-12', '2', '0000H', 'Premium', '2017-08-13', '180000.00', '12.00', '21600.00', 'Rosario Nieves Leal', 'Carlos Eduardo Jairran Nieves'),
('00002', '0000M', '2017-08-16', '2017-10-15', '1', '0000M', 'Oro', '2017-08-16', '40000.00', '10.00', '4000.00', 'JHONY GABRIEL HERNANDEZ', 'JHONY GABRIEL HERNANDEZ'),
('00002', '0000Q', '2017-08-21', '2017-10-20', '1', '0000Q', 'Premium', '2017-08-21', '180000.00', '20.00', '36000.00', 'MAGALY PASTORA VERA', 'MAGALY PASTORA VERA'),
('00007', '0000I', '2017-08-14', '2017-10-13', '1', '0000I', 'VIP', '2017-08-14', '75000.00', '15.00', '11250.00', 'LLOANI ARICELA GUILLERMOS CHIQUITO', 'LLOANI ARICELA GUILLERMOS CHIQUITO'),
('00008', '0000A', '2017-08-03', '2017-10-02', '1', '0000A', 'Premium', '2017-08-03', '180000.00', '20.00', '36000.00', 'BELKIS JANETH NOSSA QUINTERO', 'BELKIS JANETH NOSSA QUINTERO'),
('00008', '0000A', '2017-08-03', '2017-10-02', '2', '0000D', 'Premium', '2017-08-04', '180000.00', '12.00', '21600.00', 'BELKIS JANETH NOSSA QUINTERO', 'JOSE GREGORIO RODRIGUEZ ANGULO'),
('00008', '0000A', '2017-08-03', '2017-10-02', '2', '0000E', 'Premium', '2017-08-08', '140000.00', '12.00', '16800.00', 'BELKIS JANETH NOSSA QUINTERO', 'ALEXANDRA VERGARA MIRANDA'),
('00008', '0000A', '2017-08-03', '2017-10-02', '2', '0000J', 'Premium', '2017-08-15', '180000.00', '12.00', '21600.00', 'BELKIS JANETH NOSSA QUINTERO', 'MARIA EUGENIA NOSSA QUINTERO'),
('00008', '0000A', '2017-08-03', '2017-10-02', '2', '0000L', 'Premium', '2017-08-16', '140000.00', '12.00', '16800.00', 'BELKIS JANETH NOSSA QUINTERO', 'WILLIAM JOSE TELLES MORA'),
('00008', '0000A', '2017-08-03', '2017-10-02', '2', '0000P', 'Premium', '2017-08-18', '140000.00', '12.00', '16800.00', 'BELKIS JANETH NOSSA QUINTERO', 'LAURA LIS MOSQUEDA MARTINEZ'),
('00008', '0000O', '2017-08-18', '2017-10-17', '1', '0000O', 'Premium', '2017-08-18', '180000.00', '20.00', '36000.00', 'ANIBAL JOSE VALERA LATOUCHE', 'ANIBAL JOSE VALERA LATOUCHE'),
('00008', '0000R', '2017-09-08', '2017-11-07', '1', '0000R', 'Oro', '2017-09-08', '120500.00', '10.00', '12050.00', 'ALBERTO JOSE MARTINEZ TORTOLERO', 'ALBERTO JOSE MARTINEZ TORTOLERO'),
('00009', '0000F', '2017-08-10', '2017-10-09', '1', '0000F', 'Premium', '2017-08-10', '195000.00', '20.00', '39000.00', 'Luis Jesús Sojo', 'Luis Jesús Sojo'),
('0000A', '0000D', '2017-08-04', '2017-10-03', '1', '0000D', 'Premium', '2017-08-04', '180000.00', '20.00', '36000.00', 'JOSE GREGORIO RODRIGUEZ ANGULO', 'JOSE GREGORIO RODRIGUEZ ANGULO'),
('0000A', '0000E', '2017-08-08', '2017-10-07', '1', '0000E', 'Premium', '2017-08-08', '140000.00', '20.00', '28000.00', 'ALEXANDRA VERGARA MIRANDA', 'ALEXANDRA VERGARA MIRANDA'),
('0000A', '0000J', '2017-08-15', '2017-10-14', '1', '0000J', 'Premium', '2017-08-15', '180000.00', '20.00', '36000.00', 'MARIA EUGENIA NOSSA QUINTERO', 'MARIA EUGENIA NOSSA QUINTERO'),
('0000A', '0000L', '2017-08-16', '2017-10-15', '1', '0000L', 'Premium', '2017-08-16', '140000.00', '20.00', '28000.00', 'WILLIAM JOSE TELLES MORA', 'WILLIAM JOSE TELLES MORA'),
('0000A', '0000P', '2017-08-18', '2017-10-17', '1', '0000P', 'Premium', '2017-08-18', '140000.00', '20.00', '28000.00', 'LAURA LIS MOSQUEDA MARTINEZ', 'LAURA LIS MOSQUEDA MARTINEZ'),
('0000B', '0000C', '2017-08-04', '2017-10-03', '1', '0000C', 'VIP', '2017-08-04', '75000.00', '15.00', '11250.00', 'Nelson Antonio Von der Brelje Delli Compagni', 'Nelson Antonio Von der Brelje Delli Compagni'),
('0000G', '0000H', '2017-08-13', '2017-10-12', '1', '0000H', 'Premium', '2017-08-13', '180000.00', '20.00', '36000.00', 'Carlos Eduardo Jairran Nieves', 'Carlos Eduardo Jairran Nieves');

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

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id`, `promo_id`, `ticket`, `codigo`, `cedula`, `nombre`, `direccion`, `telefono`, `email`) VALUES
(1, 1, '00001', '', '7132358', 'lakdladlak', 'laskda;ldkl', 'lskd;alsk;l', 'sldka@ssdsd.sss'),
(2, 1, '00002', '', '', '', '', '', ''),
(3, 1, '00003', '', '', '', '', '', ''),
(4, 1, '00004', '', '', '', '', '', ''),
(5, 1, '00005', '', '', '', '', '', ''),
(6, 1, '00006', '', '', '', '', '', ''),
(7, 1, '00007', '', '', '', '', '', ''),
(8, 1, '00008', '', '', '', '', '', ''),
(9, 1, '00009', '', '', '', '', '', ''),
(10, 1, '00010', '', '', '', '', '', ''),
(11, 1, '00011', '', '', '', '', '', ''),
(12, 1, '00012', '', '', '', '', '', ''),
(13, 1, '00013', '', '', '', '', '', ''),
(14, 1, '00014', '', '', '', '', '', ''),
(15, 1, '00015', '', '', '', '', '', ''),
(16, 1, '00016', '', '', '', '', '', ''),
(17, 1, '00017', '', '', '', '', '', ''),
(18, 1, '00018', '', '', '', '', '', ''),
(19, 1, '00019', '', '', '', '', '', ''),
(20, 1, '00020', '', '', '', '', '', ''),
(21, 1, '00021', '', '', '', '', '', ''),
(22, 1, '00022', '', '', '', '', '', ''),
(23, 1, '00023', '', '', '', '', '', ''),
(24, 1, '00024', '', '', '', '', '', ''),
(25, 1, '00025', '', '', '', '', '', ''),
(26, 1, '00026', '', '', '', '', '', ''),
(27, 1, '00027', '', '', '', '', '', ''),
(28, 1, '00028', '', '', '', '', '', ''),
(29, 1, '00029', '', '', '', '', '', ''),
(30, 1, '00030', '', '', '', '', '', ''),
(31, 1, '00031', '', '', '', '', '', ''),
(32, 1, '00032', '', '', '', '', '', ''),
(33, 1, '00033', '', '', '', '', '', ''),
(34, 1, '00034', '', '', '', '', '', ''),
(35, 1, '00035', '', '', '', '', '', ''),
(36, 1, '00036', '', '', '', '', '', ''),
(37, 1, '00037', '', '', '', '', '', ''),
(38, 1, '00038', '', '', '', '', '', ''),
(39, 1, '00039', '', '', '', '', '', ''),
(40, 1, '00040', '', '', '', '', '', ''),
(41, 1, '00041', '', '', '', '', '', ''),
(42, 1, '00042', '', '', '', '', '', ''),
(43, 1, '00043', '', '', '', '', '', ''),
(44, 1, '00044', '', '', '', '', '', ''),
(45, 1, '00045', '', '', '', '', '', ''),
(46, 1, '00046', '', '', '', '', '', ''),
(47, 1, '00047', '', '', '', '', '', ''),
(48, 1, '00048', '', '', '', '', '', ''),
(49, 1, '00049', '', '', '', '', '', ''),
(50, 1, '00050', '', '', '', '', '', ''),
(51, 1, '00051', '', '', '', '', '', ''),
(52, 1, '00052', '', '', '', '', '', ''),
(53, 1, '00053', '', '', '', '', '', ''),
(54, 1, '00054', '', '', '', '', '', '');

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

--
-- Volcado de datos para la tabla `transacciones`
--

INSERT INTO `transacciones` (`id`, `fecha`, `afiliado`, `tipo`, `precio`, `monto`, `puntos`, `documento`, `bancoorigen`, `status_comision`) VALUES
(1, '2017-08-01', '00007', '01', '0.00', '75000.00', 0, '2555824296', 'Mercantil', 'Pendiente'),
(2, '2017-08-01', '00008', '01', '0.00', '75000.00', 0, '2555827299', 'Mercantil', 'Pendiente'),
(3, '2017-08-02', '00009', '01', '0.00', '160000.00', 0, '7686648565', 'Banesco', 'Pendiente'),
(4, '2017-08-03', '0000A', '01', '0.00', '180000.00', 0, '2556080387', 'Mercantil', 'Pendiente'),
(5, '2017-08-03', '0000B', '01', '0.00', '40000.00', 0, '0072569903', 'Banco Activo', 'Pendiente'),
(6, '2017-08-04', '0000C', '01', '0.00', '75000.00', 0, '0025565567', 'Mercantil', 'Pendiente'),
(7, '2017-08-04', '0000D', '01', '0.00', '180000.00', 0, '0091826325', 'BBVA Provincial', 'Pendiente'),
(8, '2017-08-08', '0000E', '01', '0.00', '140000.00', 0, '2556777915', 'Mercantil', 'Pendiente'),
(9, '2017-07-17', '00001', '01', '0.00', '0.00', 0, '', '', 'Pendiente'),
(10, '2017-07-17', '00002', '01', '0.00', '0.00', 0, '', '', 'Pendiente'),
(11, '2017-07-17', '00003', '01', '0.00', '0.00', 0, '', '', 'Pendiente'),
(12, '2017-07-17', '00004', '01', '0.00', '0.00', 0, '', '', 'Pendiente'),
(13, '2017-07-17', '00005', '01', '0.00', '0.00', 0, '', '', 'Pendiente'),
(14, '2017-07-17', '00006', '01', '0.00', '0.00', 0, '', '', 'Pendiente'),
(15, '2017-08-10', '0000F', '01', '0.00', '195000.00', 0, '78768441', 'Banco de Venezuela', 'Pendiente'),
(16, '2017-08-13', '0000G', '01', '0.00', '140000.00', 0, '0088296631', 'Banco de Venezuela', 'Pendiente'),
(17, '2017-08-13', '0000H', '01', '0.00', '180000.00', 0, '0088343749', 'Banco de Venezuela', 'Pendiente'),
(18, '2017-08-14', '0000I', '01', '0.00', '75000.00', 0, '5588969342', 'Mercantil', 'Pendiente'),
(19, '2017-08-15', '0000J', '01', '0.00', '180000.00', 0, '1', 'Banco X', 'Pendiente'),
(20, '2017-08-14', '0000K', '01', '0.00', '75000.00', 0, '0018454426', 'Venezolano de Crédito', 'Pendiente'),
(21, '2017-08-16', '0000L', '01', '0.00', '140000.00', 0, '2553773084', 'Mercantil', 'Pendiente'),
(22, '2017-08-16', '0000M', '01', '0.00', '40000.00', 0, '2559758413', 'Mercantil', 'Pendiente'),
(23, '2017-08-17', '0000N', '01', '0.00', '180000.00', 0, '7755211287', 'Banesco', 'Pendiente'),
(24, '2017-08-18', '0000O', '01', '0.00', '180000.00', 0, '2558852180', 'Mercantil', 'Pendiente'),
(25, '2017-08-18', '0000P', '01', '0.00', '140000.00', 0, '2554174348', 'Mercantil', 'Pendiente'),
(26, '2017-08-21', '0000Q', '01', '0.00', '180000.00', 0, '0014226275', 'Banco de Venezuela', 'Pendiente'),
(27, '2017-09-08', '0000R', '01', '0.00', '120500.00', 0, '1656047970', 'Banco Nacional de Crédito', 'Pendiente');

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

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `name_user`, `user_email`, `user_pass`, `pista`, `respuesta`, `codigo`) VALUES
(1, 'Corporativo 1', 'aaaaa@aaa.aa', 'a', 'a', 'a', '00001'),
(9, 'Luis Rodriguez', 'soluciones2000@gmail.com', 'mannaluis', 'Nombre de tu mascota', 'f90553566d1024d6236f3719ac639ce8adaaa650', '00005'),
(10, 'José Luis Baudet Guerra', 'x@y.z', '1', '1', '1', '00000');

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
);

-- --------------------------------------------------------

--
-- Estructura para la vista `v_genealogia`
--
DROP TABLE IF EXISTS `v_genealogia`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_genealogia`  AS  select `v_padres`.`id` AS `id`,`v_padres`.`padre` AS `padre`,`v_padres`.`hijo` AS `hijo`,`v_padres`.`nombre_padre` AS `nombre_padre`,`v_padres`.`apellido_padre` AS `apellido_padre`,`afiliados`.`tit_nombres` AS `nombre_hijo`,`afiliados`.`tit_apellidos` AS `apellido_hijo`,`afiliados`.`tipo_afiliado` AS `tipo_afiliado` from (`v_padres` left join `afiliados` on((`v_padres`.`hijo` = `afiliados`.`tit_codigo`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_organizacion`
--
DROP TABLE IF EXISTS `v_organizacion`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_organizacion`  AS  select `organizacion`.`organizacion` AS `organizacion`,`organizacion`.`nivel` AS `nivel`,`organizacion`.`afiliado` AS `afiliado`,`afiliados`.`cot_nombres` AS `cot_nombres`,`afiliados`.`cot_apellidos` AS `cot_apellidos` from (`organizacion` join `afiliados`) where ((`organizacion`.`afiliado` = `afiliados`.`tit_codigo`) and (`organizacion`.`organizacion` = '00000')) order by `organizacion`.`organizacion`,`organizacion`.`nivel`,`organizacion`.`afiliado` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_padres`
--
DROP TABLE IF EXISTS `v_padres`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_padres`  AS  select `genealogia`.`id` AS `id`,`genealogia`.`padre` AS `padre`,`genealogia`.`hijo` AS `hijo`,`afiliados`.`tit_nombres` AS `nombre_padre`,`afiliados`.`tit_apellidos` AS `apellido_padre` from (`genealogia` left join `afiliados` on((`genealogia`.`padre` = `afiliados`.`tit_codigo`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_patr1`
--
DROP TABLE IF EXISTS `v_patr1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_patr1`  AS  select `patrocinio`.`id` AS `id`,`patrocinio`.`patroc_codigo` AS `patroc_codigo`,`patrocinio`.`tit_codigo` AS `tit_codigo`,`patrocinio`.`fecha_afiliacion` AS `fecha_afiliacion`,`patrocinio`.`fecha_fin_bono` AS `fecha_fin_bono`,`afiliados`.`tit_nombres` AS `nombres_patroc`,`afiliados`.`tit_apellidos` AS `apellidos_patroc` from (`patrocinio` left join `afiliados` on((`patrocinio`.`patroc_codigo` = `afiliados`.`tit_codigo`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_patrocinio`
--
DROP TABLE IF EXISTS `v_patrocinio`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_patrocinio`  AS  select `v_patr1`.`id` AS `id`,`v_patr1`.`patroc_codigo` AS `patroc_codigo`,`v_patr1`.`tit_codigo` AS `tit_codigo`,`v_patr1`.`nombres_patroc` AS `nombres_patroc`,`v_patr1`.`apellidos_patroc` AS `apellidos_patroc`,`afiliados`.`tit_nombres` AS `nombres`,`afiliados`.`tit_apellidos` AS `apellidos` from (`v_patr1` left join `afiliados` on((`v_patr1`.`tit_codigo` = `afiliados`.`tit_codigo`))) ;

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Id del sistema', AUTO_INCREMENT=29;
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `kits_promocion`
--
ALTER TABLE `kits_promocion`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `orden_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ordenes_promocion`
--
ALTER TABLE `ordenes_promocion`
  MODIFY `orden_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `organizacion`
--
ALTER TABLE `organizacion`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;
--
-- AUTO_INCREMENT de la tabla `patrocinio`
--
ALTER TABLE `patrocinio`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
