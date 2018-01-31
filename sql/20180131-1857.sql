CREATE TABLE `tbl_asegurador` (
  `id_asegurador` int(11) NOT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=2048 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_asegurador`
--

INSERT INTO `tbl_asegurador` (`id_asegurador`, `codigo`, `descripcion`) VALUES
(1, 'EPS020', 'Caprecom  EPS'),
(2, 'EPS022', 'EPS CONVIDA'),
(3, 'EPS025', 'CAPRESOCA  EPS'),
(4, 'EPS028', 'CALISALUD E.P.S'),
(5, 'EPS030', 'E.P.S. CONDOR S.A.'),
(6, 'EPS031', 'SELVASALUD S.A. E.P.S'),
(7, 'EPSI01', 'Asociación Indígena del Cesar y la Guajira DUSAKAWI'),
(8, 'EPSI02', 'MANEXKA  EPS'),
(9, 'EPSI03', 'Asociación Indígena del Cauca'),
(10, 'EPSI04', 'ANASWAYUU'),
(11, 'EPSI05', 'MALLAMAS'),
(12, 'EPSI06', 'PIJAOS SALUD  EPSI'),
(13, 'EPSS02', 'Salud Total S.A. E.P.S.'),
(14, 'EPSS03', 'Cafesalud E.P.S. S.A.'),
(15, 'EPSS09', 'EPS Programa Comfenalco Antioquia'),
(16, 'EPSS14', 'Humana Vivir S.A. E.P.S.'),
(17, 'EPSS26', 'SOLSALUD E.P.S. S.A'),
(18, 'EPSS33', 'SALUDVIDA S.A .E.P.S'),
(19, 'ESS002', 'Empresa Mutual para el Desarrollo Integral DE LA SALUD E.S.S. EMDISALUD  ESS'),
(20, 'ESS024', 'Cooperativa de Salud y Desarrollo Integral Zona Sur Oriental de Cartagena Ltda.'),
(21, 'ESS062', 'Asociación Mutual La Esperanza ASMET SALUD'),
(22, 'ESS076', 'Asociación Mutual Barrios Unidos de Quibdó E.S.S.'),
(23, 'ESS091', 'Entidad Cooperativa Sol.de Salud del Norte de Soacha ECOOPSOS'),
(24, 'ESS118', 'Asociación Mutual Empresa Solidaria de Salud de Nariño E.S.S. EMSSANAR E.S.S.'),
(25, 'ESS133', 'Cooperativa de Salud Comunitaria-COMPARTA'),
(26, 'ESS207', 'Asociación Mutual SER Empresa Solidaria de Salud  ESS'),
(27, NULL, 'coomeva'),
(28, NULL, 'papu');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_car_categoria`
--

CREATE TABLE `tbl_car_categoria` (
  `id_car_categoria` int(11) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `tipo` enum('persona','ficha') NOT NULL DEFAULT 'persona'
) ENGINE=InnoDB AVG_ROW_LENGTH=1820 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_car_categoria`
--

INSERT INTO `tbl_car_categoria` (`id_car_categoria`, `descripcion`, `orden`, `tipo`) VALUES
(1, 'Salud infantil', 2, 'persona'),
(2, 'Enfermedades no transmisibles', 3, 'persona'),
(3, 'Salud mental', 4, 'persona'),
(4, 'Salud sexual y reproductiva', 5, 'persona'),
(5, 'Nutrición', 6, 'persona'),
(6, 'Salud oral', 7, 'persona'),
(8, 'Riesgos de medio ambiente', 9, 'ficha'),
(9, 'Signos vitales', 1, 'persona'),
(10, 'Riesgos del ambiente', 1, 'ficha'),
(11, 'Otros', 10, 'persona');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_car_programas`
--

CREATE TABLE `tbl_car_programas` (
  `id_car_programas` int(11) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=1092 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_car_programas`
--

INSERT INTO `tbl_car_programas` (`id_car_programas`, `descripcion`) VALUES
(1, 'VACUNACIÓN'),
(2, 'CRECIMIENTO Y DESARROLLO'),
(3, 'ALTERACIONES DEL DESARROLLO DEL JOVEN'),
(4, 'PLANIFICACIÓN FAMILIAR A HOMBRES Y MUJERES'),
(5, 'ALTERACIONES AL EMBARAZO'),
(6, 'ATENCION DEL PARTO'),
(7, 'RECIEN NACIDO'),
(8, 'ALTERACIONES DEL ADULTO'),
(9, 'CÁNCER DE CUELLO UTERINO (CITOLOGIAS)'),
(10, 'AGUDEZA  VISUAL'),
(11, 'SALUD ORAL'),
(12, 'CONTROL DE PLACA'),
(13, 'FLUOR'),
(14, 'SELLANTES'),
(15, 'DETRARTAJE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_car_programas_actividades`
--

CREATE TABLE `tbl_car_programas_actividades` (
  `id_car_programas_actividades` int(11) NOT NULL,
  `id_car_programa` int(11) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=244 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_car_programas_actividades`
--

INSERT INTO `tbl_car_programas_actividades` (`id_car_programas_actividades`, `id_car_programa`, `descripcion`) VALUES
(1, 1, 'Vacunación con BCG, HB, VOP'),
(2, 1, 'Vacunación con VOP'),
(3, 1, 'Vacunación con Pentavalente (DPT, HIB, HB)'),
(4, 1, 'Vacunación con DPT'),
(5, 1, 'Vacunación con Toxoide diftérico (Td)'),
(6, 1, 'Embarazada'),
(7, 1, 'Triple viral y fiebre amarilla'),
(8, 1, 'Triple viral'),
(9, 2, 'Identificación temprana e inscripción'),
(10, 2, 'Consulta por Médico General'),
(11, 2, 'Consulta de control o seguimiento Menor de 1 año'),
(12, 2, 'Consulta de control o seguimiento 1 año'),
(13, 2, 'Consulta de control o seguimiento 2 años'),
(14, 2, 'Consulta de control o seguimiento De 3 años en adelante'),
(15, 3, 'Consulta médico Gnal 1ra vez (inicial, media, tardía, adulto joven)'),
(16, 3, 'Hemoglobina'),
(17, 3, 'Colesterol HDL'),
(18, 3, 'VDRL'),
(19, 3, 'VIH/SIDA'),
(20, 3, 'Citología'),
(21, 4, 'Consulta 1ra vez'),
(22, 4, 'Consulta de control o seguimiento según método'),
(23, 4, 'Naturales'),
(24, 4, 'Amenorrea por lactancia'),
(25, 4, 'Hormonales'),
(26, 4, 'DIU intervalo'),
(27, 4, 'DIU post-parto'),
(28, 4, 'DIU post-aborto'),
(29, 4, 'E.Q.M Vasectomía (**)'),
(30, 4, 'E.Q.M Oclusión tubaria bilateral'),
(31, 5, 'Consulta 1vez x médico'),
(32, 5, 'Consulta x Odontólogia'),
(33, 5, 'Hemograma compl..'),
(34, 5, 'Hemoclasificación'),
(35, 5, 'VDRL'),
(36, 5, 'Uroanálisis compl..'),
(37, 5, 'Glicemia pre'),
(38, 5, 'Curva Tolerancia Glucosa'),
(39, 5, 'Frotis vaginal'),
(40, 5, 'Ecografía Obstétrica'),
(41, 5, 'Vacunación Td'),
(42, 5, 'Suministro de Sulf. Ferroso Acido fólico'),
(43, 5, 'Consulta control o seguimiento'),
(44, 6, 'Serología VDRL'),
(45, 6, 'Hemoclasificación'),
(46, 6, 'Atención de parto espontáneo'),
(47, 6, 'Consulta del puerperio'),
(48, 8, 'Consulta médico Gnal 1ra vez (inicial, media, tardía, adulto joven)'),
(49, 8, 'Glicemia pre'),
(50, 8, 'Colesterol HDL'),
(51, 8, 'Colesterol LDL'),
(52, 8, 'Colesterol total'),
(53, 8, 'Uruanálisis'),
(54, 8, 'Creatinina (*)'),
(55, 8, 'Triglicéridos (*)'),
(56, 9, 'Citología Cervico-uterina'),
(57, 9, 'Normal/satisfactoria'),
(58, 9, 'Cambios benignos'),
(59, 9, 'Anormal'),
(60, 10, 'Toma de agudeza visual'),
(61, 10, 'Examen oftalmológico'),
(62, 11, 'Control y remoción de placa bacteriana'),
(63, 11, 'Aplicación de flúor gel tópico'),
(64, 11, 'Aplicado de sellantes en autocurado'),
(65, 11, 'Aplicado de sellantes en fotocurado'),
(66, 11, 'Detartraje supragingival'),
(67, 12, 'control'),
(68, 13, 'Aplicacion'),
(69, 14, 'Aplicacion'),
(70, 15, 'Aplicacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_car_programas_actividades_valores`
--

CREATE TABLE `tbl_car_programas_actividades_valores` (
  `id_car_programas_actividades` int(11) NOT NULL,
  `id_car_actividades` int(11) DEFAULT NULL,
  `rango_inicio` int(11) DEFAULT NULL,
  `rango_fin` int(11) DEFAULT NULL,
  `rango_tipo` enum('dias','mes','años') DEFAULT NULL,
  `dosis` int(11) DEFAULT NULL,
  `intervalo` int(11) DEFAULT NULL,
  `intervalo_tipo` enum('dias','semanas','meses','años') DEFAULT NULL,
  `sexo` enum('Masculino','Femenino','ambos') DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=1820 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_car_programas_actividades_valores`
--

INSERT INTO `tbl_car_programas_actividades_valores` (`id_car_programas_actividades`, `id_car_actividades`, `rango_inicio`, `rango_fin`, `rango_tipo`, `dosis`, `intervalo`, `intervalo_tipo`, `sexo`) VALUES
(34, 1, 0, 1, 'dias', 1, 1, 'dias', 'Masculino'),
(35, 1, 0, 1, 'dias', 1, 1, 'dias', 'Femenino'),
(1, 2, 2, 2, 'mes', 5, 4, 'semanas', 'Masculino'),
(2, 2, 2, 2, 'mes', 5, 4, 'semanas', 'Femenino'),
(4, 2, 4, 4, 'mes', 5, 4, 'semanas', 'Masculino'),
(3, 2, 4, 4, 'mes', 5, 4, 'semanas', 'Femenino'),
(9, 2, 5, 5, 'años', 5, 4, 'semanas', 'Masculino'),
(10, 2, 5, 5, 'años', 5, 4, 'semanas', 'Femenino'),
(5, 2, 6, 6, 'mes', 5, 4, 'semanas', 'Masculino'),
(6, 2, 6, 6, 'mes', 5, 4, 'semanas', 'Femenino'),
(8, 2, 18, 18, 'mes', 5, 4, 'semanas', 'Masculino'),
(7, 2, 18, 18, 'mes', 5, 4, 'semanas', 'Femenino'),
(12, 3, 2, 2, 'mes', 6, 4, 'semanas', 'Masculino'),
(11, 3, 2, 2, 'mes', 6, 4, 'semanas', 'Femenino'),
(23, 3, 4, 4, 'mes', 6, 4, 'semanas', 'Masculino'),
(24, 3, 4, 4, 'mes', 6, 4, 'semanas', 'Femenino'),
(33, 3, 6, 6, 'mes', 6, 4, 'semanas', 'Masculino'),
(32, 3, 6, 6, 'mes', 6, 4, 'semanas', 'Femenino'),
(39, 4, 5, 5, 'años', 5, 4, 'semanas', 'Masculino'),
(38, 4, 5, 5, 'años', 5, 4, 'semanas', 'Femenino'),
(36, 4, 18, 18, 'mes', 5, 4, 'semanas', 'Masculino'),
(37, 4, 18, 18, 'mes', 5, 4, 'semanas', 'Femenino'),
(40, 7, 12, 12, 'mes', 1, 1, 'dias', 'Masculino'),
(41, 7, 12, 12, 'mes', 1, 1, 'dias', 'Femenino'),
(43, 8, 5, 5, 'años', 1, 1, 'dias', 'Masculino'),
(42, 8, 5, 5, 'años', 1, 1, 'dias', 'Femenino'),
(44, 9, 1, 1, 'mes', 1, 1, 'dias', 'Masculino'),
(45, 9, 1, 1, 'mes', 1, 1, 'dias', 'Femenino'),
(47, 10, 1, 1, 'mes', 1, 1, 'dias', 'Masculino'),
(46, 10, 1, 1, 'mes', 1, 1, 'dias', 'Femenino'),
(48, 11, 1, 3, 'mes', 1, 1, 'meses', 'Masculino'),
(49, 11, 1, 3, 'mes', 1, 1, 'meses', 'Femenino'),
(51, 11, 4, 6, 'mes', 1, 1, 'meses', 'Masculino'),
(50, 11, 4, 6, 'mes', 1, 1, 'meses', 'Femenino'),
(52, 11, 7, 9, 'mes', 1, 1, 'meses', 'Masculino'),
(53, 11, 7, 9, 'mes', 1, 1, 'meses', 'Femenino'),
(55, 11, 10, 12, 'mes', 1, 1, 'meses', 'Masculino'),
(54, 11, 10, 12, 'mes', 1, 1, 'meses', 'Femenino'),
(56, 12, 13, 16, 'mes', 1, 1, 'meses', 'Masculino'),
(57, 12, 13, 16, 'mes', 1, 1, 'meses', 'Femenino'),
(59, 12, 17, 20, 'mes', 1, 1, 'meses', 'Masculino'),
(58, 12, 17, 20, 'mes', 1, 1, 'meses', 'Femenino'),
(60, 12, 21, 24, 'mes', 1, 1, 'meses', 'Masculino'),
(61, 12, 21, 24, 'mes', 1, 1, 'meses', 'Femenino'),
(63, 13, 25, 30, 'mes', 1, 1, 'meses', 'Masculino'),
(62, 13, 25, 30, 'mes', 1, 1, 'meses', 'Femenino'),
(64, 13, 31, 36, 'mes', 1, 1, 'meses', 'Masculino'),
(65, 13, 31, 36, 'mes', 1, 1, 'meses', 'Femenino'),
(67, 14, 3, 12, 'años', 1, 1, 'años', 'Masculino'),
(66, 14, 3, 12, 'años', 1, 1, 'años', 'Femenino'),
(68, 15, 10, 13, 'años', 1, 1, 'años', 'Masculino'),
(69, 15, 10, 13, 'años', 1, 1, 'años', 'Femenino'),
(71, 15, 14, 16, 'años', 1, 1, 'años', 'Masculino'),
(70, 15, 14, 16, 'años', 1, 1, 'años', 'Femenino'),
(72, 15, 17, 21, 'años', 1, 1, 'años', 'Masculino'),
(73, 15, 17, 21, 'años', 1, 1, 'años', 'Femenino'),
(74, 15, 22, 24, 'años', 1, 1, 'años', 'Femenino'),
(75, 16, 10, 13, 'años', 1, 1, 'años', 'Femenino'),
(77, 17, 17, 24, 'años', 1, 1, 'años', 'Masculino'),
(76, 17, 17, 24, 'años', 1, 1, 'años', 'Femenino'),
(78, 18, 10, 24, 'años', 1, 1, 'años', 'Masculino'),
(79, 18, 10, 24, 'años', 1, 1, 'años', 'Femenino'),
(81, 19, 10, 24, 'años', 1, 1, 'años', 'Masculino'),
(80, 19, 10, 24, 'años', 1, 1, 'años', 'Femenino'),
(82, 20, 10, 24, 'años', 1, 1, 'años', 'Femenino'),
(84, 21, 10, 70, 'años', 1, 1, 'años', 'Femenino'),
(83, 21, 16, 40, 'años', 1, 1, 'años', 'Femenino'),
(85, 22, 10, 70, 'años', 1, 1, 'años', 'Femenino'),
(86, 22, 16, 40, 'años', 1, 1, 'años', 'Masculino'),
(88, 23, 10, 70, 'años', 1, 1, 'años', 'Masculino'),
(87, 23, 16, 40, 'años', 1, 1, 'años', 'Masculino'),
(89, 25, 10, 65, 'años', 1, 1, 'años', 'Femenino'),
(90, 26, 10, 65, 'años', 1, 1, 'años', 'Femenino'),
(92, 27, 10, 65, 'años', 1, 1, 'años', 'Femenino'),
(91, 28, 10, 65, 'años', 1, 1, 'años', 'Femenino'),
(94, 29, 10, 70, 'años', 1, 1, 'años', 'Masculino'),
(93, 30, 10, 70, 'años', 1, 1, 'semanas', 'Masculino'),
(95, 48, 45, 45, 'años', 1, 1, 'años', 'Masculino'),
(96, 48, 45, 45, 'años', 1, 1, 'años', 'Femenino'),
(154, 48, 50, 50, 'años', 1, 1, 'años', 'Masculino'),
(224, 48, 50, 50, 'años', 1, 1, 'años', 'Femenino'),
(155, 48, 55, 55, 'años', 1, 1, 'años', 'Masculino'),
(225, 48, 55, 55, 'años', 1, 1, 'años', 'Femenino'),
(156, 48, 60, 60, 'años', 1, 1, 'años', 'Masculino'),
(226, 48, 60, 60, 'años', 1, 1, 'años', 'Femenino'),
(157, 48, 65, 65, 'años', 1, 1, 'años', 'Masculino'),
(227, 48, 65, 65, 'años', 1, 1, 'años', 'Femenino'),
(158, 48, 70, 70, 'años', 1, 1, 'años', 'Masculino'),
(228, 48, 70, 70, 'años', 1, 1, 'años', 'Femenino'),
(159, 48, 75, 75, 'años', 1, 1, 'años', 'Masculino'),
(229, 48, 75, 75, 'años', 1, 1, 'años', 'Femenino'),
(160, 48, 80, 80, 'años', 1, 1, 'años', 'Masculino'),
(230, 48, 80, 80, 'años', 1, 1, 'años', 'Femenino'),
(98, 49, 45, 45, 'años', 1, 1, 'años', 'Masculino'),
(97, 49, 45, 45, 'años', 1, 1, 'años', 'Femenino'),
(182, 49, 50, 50, 'años', 1, 1, 'años', 'Masculino'),
(238, 49, 50, 50, 'años', 1, 1, 'años', 'Femenino'),
(183, 49, 55, 55, 'años', 1, 1, 'años', 'Masculino'),
(239, 49, 55, 55, 'años', 1, 1, 'años', 'Femenino'),
(184, 49, 60, 60, 'años', 1, 1, 'años', 'Masculino'),
(240, 49, 60, 60, 'años', 1, 1, 'años', 'Femenino'),
(185, 49, 65, 65, 'años', 1, 1, 'años', 'Masculino'),
(241, 49, 65, 65, 'años', 1, 1, 'años', 'Femenino'),
(186, 49, 70, 70, 'años', 1, 1, 'años', 'Masculino'),
(242, 49, 70, 70, 'años', 1, 1, 'años', 'Femenino'),
(187, 49, 75, 75, 'años', 1, 1, 'años', 'Masculino'),
(243, 49, 75, 75, 'años', 1, 1, 'años', 'Femenino'),
(188, 49, 80, 80, 'años', 1, 1, 'años', 'Masculino'),
(244, 49, 80, 80, 'años', 1, 1, 'años', 'Femenino'),
(99, 50, 45, 45, 'años', 1, 1, 'años', 'Masculino'),
(100, 50, 45, 45, 'años', 1, 1, 'años', 'Femenino'),
(147, 50, 50, 50, 'años', 1, 1, 'años', 'Masculino'),
(203, 50, 50, 50, 'años', 1, 1, 'años', 'Femenino'),
(148, 50, 55, 55, 'años', 1, 1, 'años', 'Masculino'),
(204, 50, 55, 55, 'años', 1, 1, 'años', 'Femenino'),
(149, 50, 60, 60, 'años', 1, 1, 'años', 'Masculino'),
(205, 50, 60, 60, 'años', 1, 1, 'años', 'Femenino'),
(150, 50, 65, 65, 'años', 1, 1, 'años', 'Masculino'),
(206, 50, 65, 65, 'años', 1, 1, 'años', 'Femenino'),
(151, 50, 70, 70, 'años', 1, 1, 'años', 'Masculino'),
(207, 50, 70, 70, 'años', 1, 1, 'años', 'Femenino'),
(152, 50, 75, 75, 'años', 1, 1, 'años', 'Masculino'),
(208, 50, 75, 75, 'años', 1, 1, 'años', 'Femenino'),
(153, 50, 80, 80, 'años', 1, 1, 'años', 'Masculino'),
(209, 50, 80, 80, 'años', 1, 1, 'años', 'Femenino'),
(102, 51, 45, 45, 'años', 1, 1, 'años', 'Masculino'),
(101, 51, 45, 45, 'años', 1, 1, 'años', 'Femenino'),
(161, 51, 50, 50, 'años', 1, 1, 'años', 'Masculino'),
(210, 51, 50, 50, 'años', 1, 1, 'años', 'Femenino'),
(162, 51, 55, 55, 'años', 1, 1, 'años', 'Masculino'),
(211, 51, 55, 55, 'años', 1, 1, 'años', 'Femenino'),
(163, 51, 60, 60, 'años', 1, 1, 'años', 'Masculino'),
(212, 51, 60, 60, 'años', 1, 1, 'años', 'Femenino'),
(164, 51, 65, 65, 'años', 1, 1, 'años', 'Masculino'),
(213, 51, 65, 65, 'años', 1, 1, 'años', 'Femenino'),
(165, 51, 70, 70, 'años', 1, 1, 'años', 'Masculino'),
(214, 51, 70, 70, 'años', 1, 1, 'años', 'Femenino'),
(166, 51, 75, 75, 'años', 1, 1, 'años', 'Masculino'),
(215, 51, 75, 75, 'años', 1, 1, 'años', 'Femenino'),
(167, 51, 80, 80, 'años', 1, 1, 'años', 'Masculino'),
(216, 51, 80, 80, 'años', 1, 1, 'años', 'Femenino'),
(103, 52, 45, 45, 'años', 1, 1, 'años', 'Masculino'),
(104, 52, 45, 45, 'años', 1, 1, 'años', 'Femenino'),
(168, 52, 50, 50, 'años', 1, 1, 'años', 'Masculino'),
(217, 52, 50, 50, 'años', 1, 1, 'años', 'Femenino'),
(169, 52, 55, 55, 'años', 1, 1, 'años', 'Masculino'),
(218, 52, 55, 55, 'años', 1, 1, 'años', 'Femenino'),
(170, 52, 60, 60, 'años', 1, 1, 'años', 'Masculino'),
(219, 52, 60, 60, 'años', 1, 1, 'años', 'Femenino'),
(171, 52, 65, 65, 'años', 1, 1, 'años', 'Masculino'),
(220, 52, 65, 65, 'años', 1, 1, 'años', 'Femenino'),
(172, 52, 70, 70, 'años', 1, 1, 'años', 'Masculino'),
(221, 52, 70, 70, 'años', 1, 1, 'años', 'Femenino'),
(173, 52, 75, 75, 'años', 1, 1, 'años', 'Masculino'),
(222, 52, 75, 75, 'años', 1, 1, 'años', 'Femenino'),
(174, 52, 80, 80, 'años', 1, 1, 'años', 'Masculino'),
(223, 52, 80, 80, 'años', 1, 1, 'años', 'Femenino'),
(106, 53, 45, 45, 'años', 1, 1, 'años', 'Masculino'),
(105, 53, 45, 45, 'años', 1, 1, 'años', 'Femenino'),
(196, 53, 50, 50, 'años', 1, 1, 'años', 'Masculino'),
(252, 53, 50, 50, 'años', 1, 1, 'años', 'Femenino'),
(197, 53, 55, 55, 'años', 1, 1, 'años', 'Masculino'),
(253, 53, 55, 55, 'años', 1, 1, 'años', 'Femenino'),
(198, 53, 60, 60, 'años', 1, 1, 'años', 'Masculino'),
(254, 53, 60, 60, 'años', 1, 1, 'años', 'Femenino'),
(199, 53, 65, 65, 'años', 1, 1, 'años', 'Masculino'),
(255, 53, 65, 65, 'años', 1, 1, 'años', 'Femenino'),
(200, 53, 70, 70, 'años', 1, 1, 'años', 'Masculino'),
(256, 53, 70, 70, 'años', 1, 1, 'años', 'Femenino'),
(201, 53, 75, 75, 'años', 1, 1, 'años', 'Masculino'),
(257, 53, 75, 75, 'años', 1, 1, 'años', 'Femenino'),
(202, 53, 80, 80, 'años', 1, 1, 'años', 'Masculino'),
(258, 53, 80, 80, 'años', 1, 1, 'años', 'Femenino'),
(107, 54, 45, 45, 'años', 1, 1, 'años', 'Masculino'),
(108, 54, 45, 45, 'años', 1, 1, 'años', 'Femenino'),
(175, 54, 50, 50, 'años', 1, 1, 'años', 'Masculino'),
(231, 54, 50, 50, 'años', 1, 1, 'años', 'Femenino'),
(176, 54, 55, 55, 'años', 1, 1, 'años', 'Masculino'),
(232, 54, 55, 55, 'años', 1, 1, 'años', 'Femenino'),
(177, 54, 60, 60, 'años', 1, 1, 'años', 'Masculino'),
(233, 54, 60, 60, 'años', 1, 1, 'años', 'Femenino'),
(178, 54, 65, 65, 'años', 1, 1, 'años', 'Masculino'),
(234, 54, 65, 65, 'años', 1, 1, 'años', 'Femenino'),
(179, 54, 70, 70, 'años', 1, 1, 'años', 'Masculino'),
(235, 54, 70, 70, 'años', 1, 1, 'años', 'Femenino'),
(180, 54, 75, 75, 'años', 1, 1, 'años', 'Masculino'),
(236, 54, 75, 75, 'años', 1, 1, 'años', 'Femenino'),
(181, 54, 80, 80, 'años', 1, 1, 'años', 'Masculino'),
(237, 54, 80, 80, 'años', 1, 1, 'años', 'Femenino'),
(110, 55, 45, 45, 'años', 1, 1, 'años', 'Masculino'),
(109, 55, 45, 45, 'años', 1, 1, 'años', 'Femenino'),
(189, 55, 50, 50, 'años', 1, 1, 'años', 'Masculino'),
(245, 55, 50, 50, 'años', 1, 1, 'años', 'Femenino'),
(190, 55, 55, 55, 'años', 1, 1, 'años', 'Masculino'),
(246, 55, 55, 55, 'años', 1, 1, 'años', 'Femenino'),
(191, 55, 60, 60, 'años', 1, 1, 'años', 'Masculino'),
(247, 55, 60, 60, 'años', 1, 1, 'años', 'Femenino'),
(192, 55, 65, 65, 'años', 1, 1, 'años', 'Masculino'),
(248, 55, 65, 65, 'años', 1, 1, 'años', 'Femenino'),
(193, 55, 70, 70, 'años', 1, 1, 'años', 'Masculino'),
(249, 55, 70, 70, 'años', 1, 1, 'años', 'Femenino'),
(194, 55, 75, 75, 'años', 1, 1, 'años', 'Masculino'),
(250, 55, 75, 75, 'años', 1, 1, 'años', 'Femenino'),
(195, 55, 80, 80, 'años', 1, 1, 'años', 'Masculino'),
(251, 55, 80, 80, 'años', 1, 1, 'años', 'Femenino'),
(113, 56, 25, 69, 'años', 1, 1, 'años', 'Femenino'),
(114, 57, 25, 69, 'años', 1, 1, 'años', 'Femenino'),
(112, 58, 25, 69, 'años', 1, 1, 'años', 'Femenino'),
(111, 59, 25, 69, 'años', 1, 1, 'años', 'Femenino'),
(119, 60, 4, 4, 'años', 1, 1, 'años', 'Masculino'),
(120, 60, 4, 4, 'años', 1, 1, 'años', 'Femenino'),
(122, 60, 11, 16, 'años', 1, 1, 'años', 'Masculino'),
(121, 60, 11, 16, 'años', 1, 1, 'años', 'Femenino'),
(123, 60, 45, 45, 'años', 1, 5, 'años', 'Masculino'),
(117, 61, 55, 55, 'años', 1, 1, 'años', 'Masculino'),
(118, 61, 55, 55, 'años', 1, 1, 'años', 'Femenino'),
(124, 62, 2, 19, 'años', 2, 1, 'años', 'Masculino'),
(125, 62, 2, 19, 'años', 2, 1, 'años', 'Femenino'),
(128, 62, 20, 100, 'años', 1, 1, 'años', 'Masculino'),
(129, 62, 20, 100, 'años', 1, 1, 'años', 'Femenino'),
(130, 63, 5, 19, 'años', 1, 1, 'años', 'Masculino'),
(131, 63, 5, 19, 'años', 1, 1, 'años', 'Femenino'),
(133, 64, 3, 15, 'años', 1, 1, 'años', 'Masculino'),
(132, 64, 3, 15, 'años', 1, 1, 'años', 'Femenino'),
(134, 65, 3, 5, 'años', 1, 1, 'años', 'Masculino'),
(135, 66, 12, 100, 'años', 1, 1, 'años', 'Masculino'),
(136, 67, 2, 19, 'años', 1, 2, 'años', 'Masculino'),
(137, 67, 2, 19, 'años', 1, 2, 'años', 'Femenino'),
(139, 67, 20, 100, 'años', 1, 2, 'años', 'Masculino'),
(138, 67, 20, 100, 'años', 1, 2, 'años', 'Femenino'),
(142, 68, 5, 19, 'años', 2, 1, 'años', 'Masculino'),
(141, 68, 5, 19, 'años', 2, 1, 'años', 'Femenino'),
(143, 69, 3, 15, 'años', 1, 1, 'años', 'Masculino'),
(144, 69, 3, 15, 'años', 1, 1, 'años', 'Femenino'),
(146, 70, 12, 100, 'años', 1, 1, 'años', 'Masculino'),
(145, 70, 12, 100, 'años', 1, 1, 'años', 'Femenino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_car_registro`
--

CREATE TABLE `tbl_car_registro` (
  `id_car_registro` int(11) NOT NULL,
  `value` text,
  `id_persona` int(11) DEFAULT NULL,
  `id_tarjeta_familiar` int(11) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=4096 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_car_tipo_dato`
--

CREATE TABLE `tbl_car_tipo_dato` (
  `id_car_tipo_dato` int(11) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=1638 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_car_tipo_dato`
--

INSERT INTO `tbl_car_tipo_dato` (`id_car_tipo_dato`, `descripcion`) VALUES
(1, 'Si/No'),
(2, 'Texto corto'),
(3, 'Texto Largo (Enriquecido)'),
(4, 'Lista de valores'),
(5, 'Entero'),
(6, 'Double'),
(7, 'Fecha'),
(8, 'Hora'),
(9, 'Si multiple'),
(10, 'Si/No otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_car_variables`
--

CREATE TABLE `tbl_car_variables` (
  `id_car_variables` int(11) NOT NULL,
  `descripcion` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `id_car_tipo_dato` int(11) DEFAULT NULL,
  `list_values` text CHARACTER SET latin1
) ENGINE=InnoDB AVG_ROW_LENGTH=186 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_car_variables`
--

INSERT INTO `tbl_car_variables` (`id_car_variables`, `descripcion`, `id_car_tipo_dato`, `list_values`) VALUES
(1, 'Con letrina pero alguien no la usa', 1, NULL),
(2, 'Mala higiene en preparación de alimentos', 1, NULL),
(3, 'Áreas endémicas de enfermedades de salud publica', 1, NULL),
(5, 'No siempre hierve el agua', 1, NULL),
(6, 'Usan plaguicidas', 1, NULL),
(8, 'Accidentes ofídico', 1, NULL),
(9, 'Contaminación del agua', 1, NULL),
(10, 'Mala disposición de plaguicidas', 1, NULL),
(11, 'Convivencia inadecuada con animales', 1, NULL),
(12, 'Plagas (Garra patilla)', 1, NULL),
(13, 'Tiene perros', 1, NULL),
(14, 'Tensión arterial sistólica', 5, NULL),
(15, 'Tensión arterial diastólica', 5, NULL),
(16, 'Frecuencia cardias', 5, NULL),
(17, 'Frecuencia respiratoria', 5, NULL),
(18, 'Muertes en menores de 1 año', 1, NULL),
(19, 'Desnutrición', 1, NULL),
(20, 'Animalia congénita', 1, NULL),
(21, 'Discapacidad', 1, NULL),
(22, 'Embarazo producto de abuso', 1, NULL),
(23, 'Recién nacido menor de 28 días', 1, NULL),
(24, 'Recién nacido parto domiciliario', 1, NULL),
(25, 'Vacunas incompletas', 1, NULL),
(26, 'Niños sin C y D', 1, NULL),
(27, 'Niño sin evaluación odontológica', 1, NULL),
(28, 'Niño menor a 5 años sin estructura AIEPI', 1, NULL),
(29, 'Problemas visuales y auditivos', 1, NULL),
(30, 'Caries', 1, NULL),
(31, 'Deserción escolar', 1, NULL),
(32, 'Violación', 1, NULL),
(33, 'Violencia sexual', 1, NULL),
(34, 'Maltrato infantil', 1, NULL),
(35, 'Abandono', 1, NULL),
(36, 'HTA', 1, NULL),
(37, 'Diabetes', 1, NULL),
(38, 'Escasa adherencia tratamiento medico', 1, NULL),
(39, 'Compilación de órganos blancos', 1, NULL),
(40, 'TBE', 1, NULL),
(41, 'Sin marca BCG en el hombro', 1, NULL),
(42, 'Enfermedades de la piel', 1, NULL),
(43, 'Síntomas respiratorios', 1, NULL),
(44, 'Hombre mayor de 50 años con evaluación de próstata', 1, NULL),
(45, 'Sin evaluación nutricional', 1, NULL),
(46, 'Mujer mayor de 45 años sin perfil epódica', 1, NULL),
(47, 'No adscrito al programa adulto mayor', 1, NULL),
(48, 'Discapacidad psicomotora', 1, NULL),
(49, 'Abandono', 1, NULL),
(50, 'Enfermedad mental y trastorno represivo y retardo', 1, NULL),
(51, 'Retardo psicosocial', 1, NULL),
(52, 'Síntomas de suicidio', 1, NULL),
(53, 'Problemas de conducta', 1, NULL),
(54, 'Víctima de violencia', 1, NULL),
(55, 'Embarazo', 1, NULL),
(56, 'Gestante sin CPN', 1, NULL),
(57, 'Gestante sin suplemento acido folio y hierro', 1, NULL),
(58, 'Gestante sin Psicoprofilaxis', 1, NULL),
(59, 'Embarazo producto de abuso sexual', 1, NULL),
(60, 'Enfermedad de transmisión sexual', 1, NULL),
(61, 'Conducta sexual de riesgo', 1, NULL),
(62, 'Sin citología', 1, NULL),
(63, 'Desnutrición', 1, NULL),
(64, 'Discapacidad psicomotora', 1, NULL),
(65, 'Enfermedades gastrointestinales', 1, NULL),
(66, 'Enfermedades de la cavidad oral', 1, NULL),
(67, 'Tratamientos odontológicos sin terminar', 1, NULL),
(68, 'Pacientes desdentados', 1, NULL),
(69, 'Sin evaluación odontológica', 1, NULL),
(70, 'No higiene oral', 1, NULL),
(71, 'Mala higiene o señales de mal cuidado', 1, NULL),
(72, 'Rechazo a intercambio educacional', 1, NULL),
(73, 'Familia desintegrada o sin red de apoyo', 1, NULL),
(74, 'Rechazo a la vacunación', 1, NULL),
(75, 'Alcoholismo y otra adicción', 1, NULL),
(76, 'Sospecha de violencia o abuso', 1, NULL),
(77, 'Violencia o abuso pedofilia no quiere ayuda', 1, NULL),
(78, 'Violencia o abuso que la familia quiera', 1, NULL),
(79, 'Antecedentes familiares de patologías crónicas', 1, NULL),
(80, 'Familia desinteresada por la salud', 1, NULL),
(81, 'Escasa adherencia a las actividades de la promoción y prevención', 1, NULL),
(82, 'Incesto', 1, NULL),
(83, 'Familia en situación de desplazamiento', 1, NULL),
(84, 'Conflicto armado', 1, NULL),
(85, 'Analfabetismo', 1, NULL),
(86, 'No reconocimiento de síntomas de peligro (Diarrea, ira, embarazo)', 1, NULL),
(87, 'Cepillos dentales inadecuados', 1, NULL),
(88, 'Tienen cepillos dentales pero no los usan', 1, NULL),
(89, 'De donde se toma el agua', 4, '[{\"id\":\"1\",\"value\":\"ACUEDUCTO\"},{\"id\":\"2\",\"value\":\"POZO\"},{\"id\":\"3\",\"value\":\"LLUVIA\"},{\"id\":\"4\",\"value\":\"RIO\"},{\"id\":\"5\",\"value\":\"PILA\"},{\"id\":\"6\",\"value\":\"LAGUNA\"},{\"id\":\"7\",\"value\":\"MANANTIAL\"},{\"id\":\"8\",\"value\":\"TANQUES\"},{\"id\":\"9\",\"value\":\"OTRA\"}]'),
(90, 'La basura es', 4, '[{\"id\":\"1\",\"value\":\"RECOGIDA\"},{\"id\":\"2\",\"value\":\"CONTENEDOR\"},{\"id\":\"3\",\"value\":\"QUEMADA\"},{\"id\":\"4\",\"value\":\"TIRADA\"},{\"id\":\"5\",\"value\":\"ENTERRADA\"},{\"id\":\"6\",\"value\":\"OTROS\"}]'),
(91, 'Tiene animales', 9, '{\"option\":\r\n[{\"id\":\"1\",\"name\":\"¿Cuantos?\"},{\"id\":\"2\",\"name\":\"¿vacunados?\"},{\"id\":\"3\",\"name\":\"¿vacunas?\"}],\r\n\"data\":[{\"id\":\"1\",\"name\":\"Gatos\",\"list\":[\"TRIVALLENTE\",\"REFUERZO TRIVALENTE\",\"RABIA\",\"Presenta Carnet\"]},\r\n{\"id\":\"2\",\"name\":\"Perros\",\"list\":[\"PARVO Y MOQUILLO\",\"POLIVALENTE\",\"RABIA\",\"Presenta Carnet\"]},\r\n{\"id\":\"3\",\"name\":\"Equinos\",\"list\":[\"encefalomielitis equina\",\"influenza equina\",\"Presenta Carnet\"]},\r\n{\"id\":\"4\",\"name\":\"Otros\",\"list\":null}]}'),
(92, 'Iluminación adecuada', 1, NULL),
(93, 'Ventilación adecuada', 1, NULL),
(94, 'Roedores', 1, NULL),
(95, 'Reservorios de agua', 1, NULL),
(96, 'Anjeos puertas y ventanas', 1, NULL),
(97, 'Uso de toldillos', 1, NULL),
(98, 'Material predominante en piso, techo, paredes', 1, NULL),
(99, 'Notas', 3, NULL),
(100, 'PIOJOS', 1, NULL),
(101, 'PARASITOS', 1, NULL),
(102, 'ACAROS', 1, NULL),
(103, 'ZANCUDOS', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_car_variablexcategoria`
--

CREATE TABLE `tbl_car_variablexcategoria` (
  `id_car_variablexcategoria` int(11) NOT NULL,
  `id_car_variables` int(11) DEFAULT NULL,
  `id_car_categoria` int(11) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=188 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_car_variablexcategoria`
--

INSERT INTO `tbl_car_variablexcategoria` (`id_car_variablexcategoria`, `id_car_variables`, `id_car_categoria`, `orden`) VALUES
(1, 1, 8, 1),
(2, 2, 8, 12),
(3, 3, 8, 11),
(5, 5, 8, 9),
(6, 6, 8, 8),
(8, 8, 8, 6),
(9, 9, 8, 5),
(10, 10, 8, 4),
(11, 11, 8, 3),
(12, 12, 8, 2),
(13, 14, 9, 1),
(14, 15, 9, 2),
(15, 16, 9, 3),
(16, 17, 9, 4),
(17, 18, 1, 1),
(18, 19, 1, 2),
(19, 20, 1, 3),
(20, 21, 1, 4),
(21, 22, 1, 5),
(22, 23, 1, 6),
(23, 24, 1, 7),
(24, 25, 1, 8),
(25, 26, 1, 9),
(26, 27, 1, 10),
(27, 28, 1, 11),
(28, 29, 1, 12),
(29, 30, 1, 13),
(30, 31, 1, 14),
(31, 32, 1, 15),
(32, 33, 1, 16),
(33, 34, 1, 17),
(34, 35, 1, 18),
(35, 36, 2, 1),
(36, 37, 2, 2),
(37, 38, 2, 3),
(38, 39, 2, 4),
(39, 40, 2, 5),
(40, 41, 2, 6),
(41, 42, 2, 7),
(42, 43, 2, 8),
(43, 44, 2, 9),
(44, 45, 2, 10),
(45, 46, 2, 11),
(46, 47, 2, 12),
(47, 48, 2, 13),
(48, 49, 2, 14),
(49, 50, 3, 1),
(50, 51, 3, 2),
(51, 52, 3, 3),
(52, 53, 3, 4),
(53, 54, 3, 5),
(54, 55, 4, 1),
(55, 56, 4, 2),
(56, 57, 4, 3),
(57, 58, 4, 4),
(58, 59, 4, 5),
(59, 60, 4, 6),
(60, 61, 4, 7),
(61, 62, 4, 8),
(62, 63, 5, 1),
(63, 64, 5, 2),
(64, 65, 5, 3),
(65, 66, 6, 1),
(66, 67, 6, 2),
(67, 68, 6, 3),
(68, 69, 6, 4),
(69, 70, 6, 5),
(70, 71, 7, 1),
(71, 72, 7, 2),
(72, 73, 7, 3),
(73, 74, 7, 4),
(74, 75, 7, 5),
(75, 76, 7, 6),
(76, 77, 7, 7),
(77, 78, 7, 8),
(78, 79, 7, 9),
(79, 80, 7, 10),
(80, 81, 7, 18),
(81, 82, 7, 12),
(82, 83, 7, 13),
(83, 84, 7, 14),
(84, 85, 7, 15),
(85, 86, 7, 16),
(86, 87, 7, 17),
(87, 88, 7, 11),
(88, 89, 10, 1),
(89, 90, 10, 1),
(90, 91, 10, 3),
(91, 92, 10, 4),
(92, 93, 10, 5),
(93, 94, 10, 6),
(94, 95, 10, 7),
(95, 96, 10, 8),
(96, 97, 10, 9),
(97, 98, 10, 10),
(98, 99, 11, 1),
(99, 100, 8, 100),
(100, 101, 8, 101),
(101, 102, 8, 102),
(102, 103, 8, 103);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_codigos`
--

CREATE TABLE `tbl_codigos` (
  `id_codigos` int(11) NOT NULL,
  `codigo_inicio` int(11) NOT NULL,
  `codigo_fin` int(11) NOT NULL,
  `codigo_next_value` int(11) DEFAULT '1',
  `id_usuario` int(11) NOT NULL,
  `activo` varchar(20) DEFAULT 'si'
) ENGINE=InnoDB AVG_ROW_LENGTH=16384 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_codigos`
--

INSERT INTO `tbl_codigos` (`id_codigos`, `codigo_inicio`, `codigo_fin`, `codigo_next_value`, `id_usuario`, `activo`) VALUES
(2, 1, 100, 6, 1, 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_config`
--

CREATE TABLE `tbl_config` (
  `id_config` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_corregimientos`
--

CREATE TABLE `tbl_corregimientos` (
  `id_corregimiento` int(11) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `id_municipio` int(11) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=780 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_corregimientos`
--

INSERT INTO `tbl_corregimientos` (`id_corregimiento`, `descripcion`, `id_municipio`) VALUES
(1, 'JUANIGNACIO', 430),
(2, 'ALTO DEL REY', 398),
(3, 'ANAYES', 398),
(4, 'CABECERA', 398),
(5, 'CABUYAL', 398),
(6, 'CUATRO ESQUINAS', 398),
(7, 'FONDAS', 398),
(8, 'GRANADA', 398),
(9, 'HUISITO', 398),
(10, 'LA GALLERA', 398),
(11, 'LA PAZ', 398),
(12, 'LOS ANDES', 398),
(13, 'PANDIGUANDO', 398),
(14, 'PERIFERIA URBANA', 398),
(15, 'PIAGUA', 398),
(16, 'PLAYA RICA', 398),
(17, 'QUILCACE', 398),
(18, 'SAN JOAQUIN', 398),
(19, 'SAN JUAN', 398),
(20, 'URIBE', 398),
(21, 'ZARZAL', 398);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_departamentos`
--

CREATE TABLE `tbl_departamentos` (
  `id_departamentos` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=512 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_departamentos`
--

INSERT INTO `tbl_departamentos` (`id_departamentos`, `descripcion`) VALUES
(1, 'Amazonas'),
(2, 'Antioquia'),
(3, 'Arauca'),
(4, 'Atlántico'),
(5, 'Bolívar'),
(6, 'Boyacá'),
(7, 'Caldas'),
(8, 'Caquetá'),
(9, 'Casanare'),
(10, 'Cauca'),
(11, 'Cesar'),
(12, 'Chocó'),
(13, 'Córdoba'),
(14, 'Cundinamarca'),
(15, 'Guainía'),
(16, 'Guaviare'),
(17, 'Huila'),
(18, 'Guajira'),
(19, 'Madgalena'),
(20, 'Meta'),
(21, 'Nariño'),
(22, 'Norte de Santander'),
(23, 'Putumayo'),
(24, 'Quindío'),
(25, 'Risaralda'),
(26, 'San Andrés'),
(27, 'Santander'),
(28, 'Sucre'),
(29, 'Tolima'),
(30, 'Valle del Cauca'),
(31, 'Vaupés'),
(32, 'Vichada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_documento_tipo`
--

CREATE TABLE `tbl_documento_tipo` (
  `id_documento_tipo` int(11) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=3276 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_documento_tipo`
--

INSERT INTO `tbl_documento_tipo` (`id_documento_tipo`, `descripcion`, `codigo`) VALUES
(1, 'CEDULA DE CIUDADANIA', 'CC'),
(2, 'TARJETA DE IDENTIDAD', 'TI'),
(3, 'REGISTRO CIVIL', 'RC'),
(4, 'MENOR SIN IDENTIFICAR', 'MS'),
(5, 'ADULTO SIN IDENTIFICAR', 'AS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado_civil`
--

CREATE TABLE `tbl_estado_civil` (
  `id_estado_civil` int(11) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_estado_civil`
--

INSERT INTO `tbl_estado_civil` (`id_estado_civil`, `descripcion`) VALUES
(1, 'Soltero'),
(2, 'Casado'),
(3, 'Union libre'),
(4, 'Divorciado'),
(5, 'Separado'),
(6, 'Viudo'),
(7, 'No aplica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_morbilidad`
--

CREATE TABLE `tbl_morbilidad` (
  `id_morbilidad` int(11) NOT NULL,
  `nombres` varchar(200) NOT NULL,
  `apellidos` varchar(200) NOT NULL,
  `fecha_nacimientod` date NOT NULL,
  `causa` text NOT NULL,
  `fecha_fallecimiento` date NOT NULL,
  `id_tarjeta_familiar` int(11) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_morbilidad`
--

INSERT INTO `tbl_morbilidad` (`id_morbilidad`, `nombres`, `apellidos`, `fecha_nacimientod`, `causa`, `fecha_fallecimiento`, `id_tarjeta_familiar`) VALUES
(1, '', '', '0000-00-00', '', '0000-00-00', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_municipios`
--

CREATE TABLE `tbl_municipios` (
  `id_municipio` int(11) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=74 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_municipios`
--

INSERT INTO `tbl_municipios` (`id_municipio`, `id_departamento`, `descripcion`) VALUES
(1, 1, 'Leticia'),
(2, 1, 'Puerto Nariño'),
(3, 2, 'Abejorral'),
(4, 2, 'Abriaquí'),
(5, 2, 'Alejandria'),
(6, 2, 'Amagá'),
(7, 2, 'Amalfi'),
(8, 2, 'Andes'),
(9, 2, 'Angelópolis'),
(10, 2, 'Angostura'),
(11, 2, 'Anorí'),
(12, 2, 'Anzá'),
(13, 2, 'Apartadó'),
(14, 2, 'Arboletes'),
(15, 2, 'Argelia'),
(16, 2, 'Armenia'),
(17, 2, 'Barbosa'),
(18, 2, 'Bello'),
(19, 2, 'Belmira'),
(20, 2, 'Betania'),
(21, 2, 'Betulia'),
(22, 2, 'Bolívar'),
(23, 2, 'Briceño'),
(24, 2, 'Burítica'),
(25, 2, 'Caicedo'),
(26, 2, 'Caldas'),
(27, 2, 'Campamento'),
(28, 2, 'Caracolí'),
(29, 2, 'Caramanta'),
(30, 2, 'Carepa'),
(31, 2, 'Carmen de Viboral'),
(32, 2, 'Carolina'),
(33, 2, 'Caucasia'),
(34, 2, 'Cañasgordas'),
(35, 2, 'Chigorodó'),
(36, 2, 'Cisneros'),
(37, 2, 'Cocorná'),
(38, 2, 'Concepción'),
(39, 2, 'Concordia'),
(40, 2, 'Copacabana'),
(41, 2, 'Cáceres'),
(42, 2, 'Dabeiba'),
(43, 2, 'Don Matías'),
(44, 2, 'Ebéjico'),
(45, 2, 'El Bagre'),
(46, 2, 'Entrerríos'),
(47, 2, 'Envigado'),
(48, 2, 'Fredonia'),
(49, 2, 'Frontino'),
(50, 2, 'Giraldo'),
(51, 2, 'Girardota'),
(52, 2, 'Granada'),
(53, 2, 'Guadalupe'),
(54, 2, 'Guarne'),
(55, 2, 'Guatapé'),
(56, 2, 'Gómez Plata'),
(57, 2, 'Heliconia'),
(58, 2, 'Hispania'),
(59, 2, 'Itagüí'),
(60, 2, 'Ituango'),
(61, 2, 'Jardín'),
(62, 2, 'Jericó'),
(63, 2, 'La Ceja'),
(64, 2, 'La Estrella'),
(65, 2, 'La Pintada'),
(66, 2, 'La Unión'),
(67, 2, 'Liborina'),
(68, 2, 'Maceo'),
(69, 2, 'Marinilla'),
(70, 2, 'Medellín'),
(71, 2, 'Montebello'),
(72, 2, 'Murindó'),
(73, 2, 'Mutatá'),
(74, 2, 'Nariño'),
(75, 2, 'Nechí'),
(76, 2, 'Necoclí'),
(77, 2, 'Olaya'),
(78, 2, 'Peque'),
(79, 2, 'Peñol'),
(80, 2, 'Pueblorrico'),
(81, 2, 'Puerto Berrío'),
(82, 2, 'Puerto Nare'),
(83, 2, 'Puerto Triunfo'),
(84, 2, 'Remedios'),
(85, 2, 'Retiro'),
(86, 2, 'Ríonegro'),
(87, 2, 'Sabanalarga'),
(88, 2, 'Sabaneta'),
(89, 2, 'Salgar'),
(90, 2, 'San Andrés de Cuerquía'),
(91, 2, 'San Carlos'),
(92, 2, 'San Francisco'),
(93, 2, 'San Jerónimo'),
(94, 2, 'San José de Montaña'),
(95, 2, 'San Juan de Urabá'),
(96, 2, 'San Luís'),
(97, 2, 'San Pedro'),
(98, 2, 'San Pedro de Urabá'),
(99, 2, 'San Rafael'),
(100, 2, 'San Roque'),
(101, 2, 'San Vicente'),
(102, 2, 'Santa Bárbara'),
(103, 2, 'Santa Fé de Antioquia'),
(104, 2, 'Santa Rosa de Osos'),
(105, 2, 'Santo Domingo'),
(106, 2, 'Santuario'),
(107, 2, 'Segovia'),
(108, 2, 'Sonsón'),
(109, 2, 'Sopetrán'),
(110, 2, 'Tarazá'),
(111, 2, 'Tarso'),
(112, 2, 'Titiribí'),
(113, 2, 'Toledo'),
(114, 2, 'Turbo'),
(115, 2, 'Támesis'),
(116, 2, 'Uramita'),
(117, 2, 'Urrao'),
(118, 2, 'Valdivia'),
(119, 2, 'Valparaiso'),
(120, 2, 'Vegachí'),
(121, 2, 'Venecia'),
(122, 2, 'Vigía del Fuerte'),
(123, 2, 'Yalí'),
(124, 2, 'Yarumal'),
(125, 2, 'Yolombó'),
(126, 2, 'Yondó (Casabe)'),
(127, 2, 'Zaragoza'),
(128, 3, 'Arauca'),
(129, 3, 'Arauquita'),
(130, 3, 'Cravo Norte'),
(131, 3, 'Fortúl'),
(132, 3, 'Puerto Rondón'),
(133, 3, 'Saravena'),
(134, 3, 'Tame'),
(135, 4, 'Baranoa'),
(136, 4, 'Barranquilla'),
(137, 4, 'Campo de la Cruz'),
(138, 4, 'Candelaria'),
(139, 4, 'Galapa'),
(140, 4, 'Juan de Acosta'),
(141, 4, 'Luruaco'),
(142, 4, 'Malambo'),
(143, 4, 'Manatí'),
(144, 4, 'Palmar de Varela'),
(145, 4, 'Piojo'),
(146, 4, 'Polonuevo'),
(147, 4, 'Ponedera'),
(148, 4, 'Puerto Colombia'),
(149, 4, 'Repelón'),
(150, 4, 'Sabanagrande'),
(151, 4, 'Sabanalarga'),
(152, 4, 'Santa Lucía'),
(153, 4, 'Santo Tomás'),
(154, 4, 'Soledad'),
(155, 4, 'Suan'),
(156, 4, 'Tubará'),
(157, 4, 'Usiacuri'),
(158, 5, 'Achí'),
(159, 5, 'Altos del Rosario'),
(160, 5, 'Arenal'),
(161, 5, 'Arjona'),
(162, 5, 'Arroyohondo'),
(163, 5, 'Barranco de Loba'),
(164, 5, 'Calamar'),
(165, 5, 'Cantagallo'),
(166, 5, 'Cartagena'),
(167, 5, 'Cicuco'),
(168, 5, 'Clemencia'),
(169, 5, 'Córdoba'),
(170, 5, 'El Carmen de Bolívar'),
(171, 5, 'El Guamo'),
(172, 5, 'El Peñon'),
(173, 5, 'Hatillo de Loba'),
(174, 5, 'Magangué'),
(175, 5, 'Mahates'),
(176, 5, 'Margarita'),
(177, 5, 'María la Baja'),
(178, 5, 'Mompós'),
(179, 5, 'Montecristo'),
(180, 5, 'Morales'),
(181, 5, 'Norosí'),
(182, 5, 'Pinillos'),
(183, 5, 'Regidor'),
(184, 5, 'Río Viejo'),
(185, 5, 'San Cristobal'),
(186, 5, 'San Estanislao'),
(187, 5, 'San Fernando'),
(188, 5, 'San Jacinto'),
(189, 5, 'San Jacinto del Cauca'),
(190, 5, 'San Juan de Nepomuceno'),
(191, 5, 'San Martín de Loba'),
(192, 5, 'San Pablo'),
(193, 5, 'Santa Catalina'),
(194, 5, 'Santa Rosa '),
(195, 5, 'Santa Rosa del Sur'),
(196, 5, 'Simití'),
(197, 5, 'Soplaviento'),
(198, 5, 'Talaigua Nuevo'),
(199, 5, 'Tiquisio (Puerto Rico)'),
(200, 5, 'Turbaco'),
(201, 5, 'Turbaná'),
(202, 5, 'Villanueva'),
(203, 5, 'Zambrano'),
(204, 6, 'Almeida'),
(205, 6, 'Aquitania'),
(206, 6, 'Arcabuco'),
(207, 6, 'Belén'),
(208, 6, 'Berbeo'),
(209, 6, 'Beteitiva'),
(210, 6, 'Boavita'),
(211, 6, 'Boyacá'),
(212, 6, 'Briceño'),
(213, 6, 'Buenavista'),
(214, 6, 'Busbanza'),
(215, 6, 'Caldas'),
(216, 6, 'Campohermoso'),
(217, 6, 'Cerinza'),
(218, 6, 'Chinavita'),
(219, 6, 'Chiquinquirá'),
(220, 6, 'Chiscas'),
(221, 6, 'Chita'),
(222, 6, 'Chitaraque'),
(223, 6, 'Chivatá'),
(224, 6, 'Chíquiza'),
(225, 6, 'Chívor'),
(226, 6, 'Ciénaga'),
(227, 6, 'Coper'),
(228, 6, 'Corrales'),
(229, 6, 'Covarachía'),
(230, 6, 'Cubará'),
(231, 6, 'Cucaita'),
(232, 6, 'Cuitiva'),
(233, 6, 'Cómbita'),
(234, 6, 'Duitama'),
(235, 6, 'El Cocuy'),
(236, 6, 'El Espino'),
(237, 6, 'Firavitoba'),
(238, 6, 'Floresta'),
(239, 6, 'Gachantivá'),
(240, 6, 'Garagoa'),
(241, 6, 'Guacamayas'),
(242, 6, 'Guateque'),
(243, 6, 'Guayatá'),
(244, 6, 'Guicán'),
(245, 6, 'Gámeza'),
(246, 6, 'Izá'),
(247, 6, 'Jenesano'),
(248, 6, 'Jericó'),
(249, 6, 'La Capilla'),
(250, 6, 'La Uvita'),
(251, 6, 'La Victoria'),
(252, 6, 'Labranzagrande'),
(253, 6, 'Macanal'),
(254, 6, 'Maripí'),
(255, 6, 'Miraflores'),
(256, 6, 'Mongua'),
(257, 6, 'Monguí'),
(258, 6, 'Moniquirá'),
(259, 6, 'Motavita'),
(260, 6, 'Muzo'),
(261, 6, 'Nobsa'),
(262, 6, 'Nuevo Colón'),
(263, 6, 'Oicatá'),
(264, 6, 'Otanche'),
(265, 6, 'Pachavita'),
(266, 6, 'Paipa'),
(267, 6, 'Pajarito'),
(268, 6, 'Panqueba'),
(269, 6, 'Pauna'),
(270, 6, 'Paya'),
(271, 6, 'Paz de Río'),
(272, 6, 'Pesca'),
(273, 6, 'Pisva'),
(274, 6, 'Puerto Boyacá'),
(275, 6, 'Páez'),
(276, 6, 'Quipama'),
(277, 6, 'Ramiriquí'),
(278, 6, 'Rondón'),
(279, 6, 'Ráquira'),
(280, 6, 'Saboyá'),
(281, 6, 'Samacá'),
(282, 6, 'San Eduardo'),
(283, 6, 'San José de Pare'),
(284, 6, 'San Luís de Gaceno'),
(285, 6, 'San Mateo'),
(286, 6, 'San Miguel de Sema'),
(287, 6, 'San Pablo de Borbur'),
(288, 6, 'Santa María'),
(289, 6, 'Santa Rosa de Viterbo'),
(290, 6, 'Santa Sofía'),
(291, 6, 'Santana'),
(292, 6, 'Sativanorte'),
(293, 6, 'Sativasur'),
(294, 6, 'Siachoque'),
(295, 6, 'Soatá'),
(296, 6, 'Socha'),
(297, 6, 'Socotá'),
(298, 6, 'Sogamoso'),
(299, 6, 'Somondoco'),
(300, 6, 'Sora'),
(301, 6, 'Soracá'),
(302, 6, 'Sotaquirá'),
(303, 6, 'Susacón'),
(304, 6, 'Sutamarchán'),
(305, 6, 'Sutatenza'),
(306, 6, 'Sáchica'),
(307, 6, 'Tasco'),
(308, 6, 'Tenza'),
(309, 6, 'Tibaná'),
(310, 6, 'Tibasosa'),
(311, 6, 'Tinjacá'),
(312, 6, 'Tipacoque'),
(313, 6, 'Toca'),
(314, 6, 'Toguí'),
(315, 6, 'Topagá'),
(316, 6, 'Tota'),
(317, 6, 'Tunja'),
(318, 6, 'Tunungua'),
(319, 6, 'Turmequé'),
(320, 6, 'Tuta'),
(321, 6, 'Tutasá'),
(322, 6, 'Ventaquemada'),
(323, 6, 'Villa de Leiva'),
(324, 6, 'Viracachá'),
(325, 6, 'Zetaquirá'),
(326, 6, 'Úmbita'),
(327, 7, 'Aguadas'),
(328, 7, 'Anserma'),
(329, 7, 'Aranzazu'),
(330, 7, 'Belalcázar'),
(331, 7, 'Chinchiná'),
(332, 7, 'Filadelfia'),
(333, 7, 'La Dorada'),
(334, 7, 'La Merced'),
(335, 7, 'La Victoria'),
(336, 7, 'Manizales'),
(337, 7, 'Manzanares'),
(338, 7, 'Marmato'),
(339, 7, 'Marquetalia'),
(340, 7, 'Marulanda'),
(341, 7, 'Neira'),
(342, 7, 'Norcasia'),
(343, 7, 'Palestina'),
(344, 7, 'Pensilvania'),
(345, 7, 'Pácora'),
(346, 7, 'Risaralda'),
(347, 7, 'Río Sucio'),
(348, 7, 'Salamina'),
(349, 7, 'Samaná'),
(350, 7, 'San José'),
(351, 7, 'Supía'),
(352, 7, 'Villamaría'),
(353, 7, 'Viterbo'),
(354, 8, 'Albania'),
(355, 8, 'Belén de los Andaquíes'),
(356, 8, 'Cartagena del Chairá'),
(357, 8, 'Curillo'),
(358, 8, 'El Doncello'),
(359, 8, 'El Paujil'),
(360, 8, 'Florencia'),
(361, 8, 'La Montañita'),
(362, 8, 'Milán'),
(363, 8, 'Morelia'),
(364, 8, 'Puerto Rico'),
(365, 8, 'San José del Fragua'),
(366, 8, 'San Vicente del Caguán'),
(367, 8, 'Solano'),
(368, 8, 'Solita'),
(369, 8, 'Valparaiso'),
(370, 9, 'Aguazul'),
(371, 9, 'Chámeza'),
(372, 9, 'Hato Corozal'),
(373, 9, 'La Salina'),
(374, 9, 'Maní'),
(375, 9, 'Monterrey'),
(376, 9, 'Nunchía'),
(377, 9, 'Orocué'),
(378, 9, 'Paz de Ariporo'),
(379, 9, 'Pore'),
(380, 9, 'Recetor'),
(381, 9, 'Sabanalarga'),
(382, 9, 'San Luís de Palenque'),
(383, 9, 'Sácama'),
(384, 9, 'Tauramena'),
(385, 9, 'Trinidad'),
(386, 9, 'Támara'),
(387, 9, 'Villanueva'),
(388, 9, 'Yopal'),
(389, 10, 'Almaguer'),
(390, 10, 'Argelia'),
(391, 10, 'Balboa'),
(392, 10, 'Bolívar'),
(393, 10, 'Buenos Aires'),
(394, 10, 'Cajibío'),
(395, 10, 'Caldono'),
(396, 10, 'Caloto'),
(397, 10, 'Corinto'),
(398, 10, 'El Tambo'),
(399, 10, 'Florencia'),
(400, 10, 'Guachené'),
(401, 10, 'Guapí'),
(402, 10, 'Inzá'),
(403, 10, 'Jambaló'),
(404, 10, 'La Sierra'),
(405, 10, 'La Vega'),
(406, 10, 'López (Micay)'),
(407, 10, 'Mercaderes'),
(408, 10, 'Miranda'),
(409, 10, 'Morales'),
(410, 10, 'Padilla'),
(411, 10, 'Patía (El Bordo)'),
(412, 10, 'Piamonte'),
(413, 10, 'Piendamó'),
(414, 10, 'Popayán'),
(415, 10, 'Puerto Tejada'),
(416, 10, 'Puracé (Coconuco)'),
(417, 10, 'Páez (Belalcazar)'),
(418, 10, 'Rosas'),
(419, 10, 'San Sebastián'),
(420, 10, 'Santa Rosa'),
(421, 10, 'Santander de Quilichao'),
(422, 10, 'Silvia'),
(423, 10, 'Sotara (Paispamba)'),
(424, 10, 'Sucre'),
(425, 10, 'Suárez'),
(426, 10, 'Timbiquí'),
(427, 10, 'Timbío'),
(428, 10, 'Toribío'),
(429, 10, 'Totoró'),
(430, 10, 'Villa Rica'),
(431, 11, 'Aguachica'),
(432, 11, 'Agustín Codazzi'),
(433, 11, 'Astrea'),
(434, 11, 'Becerríl'),
(435, 11, 'Bosconia'),
(436, 11, 'Chimichagua'),
(437, 11, 'Chiriguaná'),
(438, 11, 'Curumaní'),
(439, 11, 'El Copey'),
(440, 11, 'El Paso'),
(441, 11, 'Gamarra'),
(442, 11, 'Gonzalez'),
(443, 11, 'La Gloria'),
(444, 11, 'La Jagua de Ibirico'),
(445, 11, 'La Paz (Robles)'),
(446, 11, 'Manaure Balcón del Cesar'),
(447, 11, 'Pailitas'),
(448, 11, 'Pelaya'),
(449, 11, 'Pueblo Bello'),
(450, 11, 'Río de oro'),
(451, 11, 'San Alberto'),
(452, 11, 'San Diego'),
(453, 11, 'San Martín'),
(454, 11, 'Tamalameque'),
(455, 11, 'Valledupar'),
(456, 12, 'Acandí'),
(457, 12, 'Alto Baudó (Pie de Pato)'),
(458, 12, 'Atrato (Yuto)'),
(459, 12, 'Bagadó'),
(460, 12, 'Bahía Solano (Mútis)'),
(461, 12, 'Bajo Baudó (Pizarro)'),
(462, 12, 'Belén de Bajirá'),
(463, 12, 'Bojayá (Bellavista)'),
(464, 12, 'Cantón de San Pablo'),
(465, 12, 'Carmen del Darién (CURBARADÓ)'),
(466, 12, 'Condoto'),
(467, 12, 'Cértegui'),
(468, 12, 'El Carmen de Atrato'),
(469, 12, 'Istmina'),
(470, 12, 'Juradó'),
(471, 12, 'Lloró'),
(472, 12, 'Medio Atrato'),
(473, 12, 'Medio Baudó'),
(474, 12, 'Medio San Juan (ANDAGOYA)'),
(475, 12, 'Novita'),
(476, 12, 'Nuquí'),
(477, 12, 'Quibdó'),
(478, 12, 'Río Iró'),
(479, 12, 'Río Quito'),
(480, 12, 'Ríosucio'),
(481, 12, 'San José del Palmar'),
(482, 12, 'Santa Genoveva de Docorodó'),
(483, 12, 'Sipí'),
(484, 12, 'Tadó'),
(485, 12, 'Unguía'),
(486, 12, 'Unión Panamericana (ÁNIMAS)'),
(487, 13, 'Ayapel'),
(488, 13, 'Buenavista'),
(489, 13, 'Canalete'),
(490, 13, 'Cereté'),
(491, 13, 'Chimá'),
(492, 13, 'Chinú'),
(493, 13, 'Ciénaga de Oro'),
(494, 13, 'Cotorra'),
(495, 13, 'La Apartada y La Frontera'),
(496, 13, 'Lorica'),
(497, 13, 'Los Córdobas'),
(498, 13, 'Momil'),
(499, 13, 'Montelíbano'),
(500, 13, 'Monteria'),
(501, 13, 'Moñitos'),
(502, 13, 'Planeta Rica'),
(503, 13, 'Pueblo Nuevo'),
(504, 13, 'Puerto Escondido'),
(505, 13, 'Puerto Libertador'),
(506, 13, 'Purísima'),
(507, 13, 'Sahagún'),
(508, 13, 'San Andrés Sotavento'),
(509, 13, 'San Antero'),
(510, 13, 'San Bernardo del Viento'),
(511, 13, 'San Carlos'),
(512, 13, 'San José de Uré'),
(513, 13, 'San Pelayo'),
(514, 13, 'Tierralta'),
(515, 13, 'Tuchín'),
(516, 13, 'Valencia'),
(517, 14, 'Agua de Dios'),
(518, 14, 'Albán'),
(519, 14, 'Anapoima'),
(520, 14, 'Anolaima'),
(521, 14, 'Apulo'),
(522, 14, 'Arbeláez'),
(523, 14, 'Beltrán'),
(524, 14, 'Bituima'),
(525, 14, 'Bogotá D.C.'),
(526, 14, 'Bojacá'),
(527, 14, 'Cabrera'),
(528, 14, 'Cachipay'),
(529, 14, 'Cajicá'),
(530, 14, 'Caparrapí'),
(531, 14, 'Carmen de Carupa'),
(532, 14, 'Chaguaní'),
(533, 14, 'Chipaque'),
(534, 14, 'Choachí'),
(535, 14, 'Chocontá'),
(536, 14, 'Chía'),
(537, 14, 'Cogua'),
(538, 14, 'Cota'),
(539, 14, 'Cucunubá'),
(540, 14, 'Cáqueza'),
(541, 14, 'El Colegio'),
(542, 14, 'El Peñón'),
(543, 14, 'El Rosal'),
(544, 14, 'Facatativá'),
(545, 14, 'Fosca'),
(546, 14, 'Funza'),
(547, 14, 'Fusagasugá'),
(548, 14, 'Fómeque'),
(549, 14, 'Fúquene'),
(550, 14, 'Gachalá'),
(551, 14, 'Gachancipá'),
(552, 14, 'Gachetá'),
(553, 14, 'Gama'),
(554, 14, 'Girardot'),
(555, 14, 'Granada'),
(556, 14, 'Guachetá'),
(557, 14, 'Guaduas'),
(558, 14, 'Guasca'),
(559, 14, 'Guataquí'),
(560, 14, 'Guatavita'),
(561, 14, 'Guayabal de Siquima'),
(562, 14, 'Guayabetal'),
(563, 14, 'Gutiérrez'),
(564, 14, 'Jerusalén'),
(565, 14, 'Junín'),
(566, 14, 'La Calera'),
(567, 14, 'La Mesa'),
(568, 14, 'La Palma'),
(569, 14, 'La Peña'),
(570, 14, 'La Vega'),
(571, 14, 'Lenguazaque'),
(572, 14, 'Machetá'),
(573, 14, 'Madrid'),
(574, 14, 'Manta'),
(575, 14, 'Medina'),
(576, 14, 'Mosquera'),
(577, 14, 'Nariño'),
(578, 14, 'Nemocón'),
(579, 14, 'Nilo'),
(580, 14, 'Nimaima'),
(581, 14, 'Nocaima'),
(582, 14, 'Pacho'),
(583, 14, 'Paime'),
(584, 14, 'Pandi'),
(585, 14, 'Paratebueno'),
(586, 14, 'Pasca'),
(587, 14, 'Puerto Salgar'),
(588, 14, 'Pulí'),
(589, 14, 'Quebradanegra'),
(590, 14, 'Quetame'),
(591, 14, 'Quipile'),
(592, 14, 'Ricaurte'),
(593, 14, 'San Antonio de Tequendama'),
(594, 14, 'San Bernardo'),
(595, 14, 'San Cayetano'),
(596, 14, 'San Francisco'),
(597, 14, 'San Juan de Río Seco'),
(598, 14, 'Sasaima'),
(599, 14, 'Sesquilé'),
(600, 14, 'Sibaté'),
(601, 14, 'Silvania'),
(602, 14, 'Simijaca'),
(603, 14, 'Soacha'),
(604, 14, 'Sopó'),
(605, 14, 'Subachoque'),
(606, 14, 'Suesca'),
(607, 14, 'Supatá'),
(608, 14, 'Susa'),
(609, 14, 'Sutatausa'),
(610, 14, 'Tabio'),
(611, 14, 'Tausa'),
(612, 14, 'Tena'),
(613, 14, 'Tenjo'),
(614, 14, 'Tibacuy'),
(615, 14, 'Tibirita'),
(616, 14, 'Tocaima'),
(617, 14, 'Tocancipá'),
(618, 14, 'Topaipí'),
(619, 14, 'Ubalá'),
(620, 14, 'Ubaque'),
(621, 14, 'Ubaté'),
(622, 14, 'Une'),
(623, 14, 'Venecia (Ospina Pérez)'),
(624, 14, 'Vergara'),
(625, 14, 'Viani'),
(626, 14, 'Villagómez'),
(627, 14, 'Villapinzón'),
(628, 14, 'Villeta'),
(629, 14, 'Viotá'),
(630, 14, 'Yacopí'),
(631, 14, 'Zipacón'),
(632, 14, 'Zipaquirá'),
(633, 14, 'Útica'),
(634, 15, 'Inírida'),
(635, 16, 'Calamar'),
(636, 16, 'El Retorno'),
(637, 16, 'Miraflores'),
(638, 16, 'San José del Guaviare'),
(639, 17, 'Acevedo'),
(640, 17, 'Agrado'),
(641, 17, 'Aipe'),
(642, 17, 'Algeciras'),
(643, 17, 'Altamira'),
(644, 17, 'Baraya'),
(645, 17, 'Campoalegre'),
(646, 17, 'Colombia'),
(647, 17, 'Elías'),
(648, 17, 'Garzón'),
(649, 17, 'Gigante'),
(650, 17, 'Guadalupe'),
(651, 17, 'Hobo'),
(652, 17, 'Isnos'),
(653, 17, 'La Argentina'),
(654, 17, 'La Plata'),
(655, 17, 'Neiva'),
(656, 17, 'Nátaga'),
(657, 17, 'Oporapa'),
(658, 17, 'Paicol'),
(659, 17, 'Palermo'),
(660, 17, 'Palestina'),
(661, 17, 'Pital'),
(662, 17, 'Pitalito'),
(663, 17, 'Rivera'),
(664, 17, 'Saladoblanco'),
(665, 17, 'San Agustín'),
(666, 17, 'Santa María'),
(667, 17, 'Suaza'),
(668, 17, 'Tarqui'),
(669, 17, 'Tello'),
(670, 17, 'Teruel'),
(671, 17, 'Tesalia'),
(672, 17, 'Timaná'),
(673, 17, 'Villavieja'),
(674, 17, 'Yaguará'),
(675, 17, 'Íquira'),
(676, 18, 'Albania'),
(677, 18, 'Barrancas'),
(678, 18, 'Dibulla'),
(679, 18, 'Distracción'),
(680, 18, 'El Molino'),
(681, 18, 'Fonseca'),
(682, 18, 'Hatonuevo'),
(683, 18, 'La Jagua del Pilar'),
(684, 18, 'Maicao'),
(685, 18, 'Manaure'),
(686, 18, 'Riohacha'),
(687, 18, 'San Juan del Cesar'),
(688, 18, 'Uribia'),
(689, 18, 'Urumita'),
(690, 18, 'Villanueva'),
(691, 19, 'Algarrobo'),
(692, 19, 'Aracataca'),
(693, 19, 'Ariguaní (El Difícil)'),
(694, 19, 'Cerro San Antonio'),
(695, 19, 'Chivolo'),
(696, 19, 'Ciénaga'),
(697, 19, 'Concordia'),
(698, 19, 'El Banco'),
(699, 19, 'El Piñon'),
(700, 19, 'El Retén'),
(701, 19, 'Fundación'),
(702, 19, 'Guamal'),
(703, 19, 'Nueva Granada'),
(704, 19, 'Pedraza'),
(705, 19, 'Pijiño'),
(706, 19, 'Pivijay'),
(707, 19, 'Plato'),
(708, 19, 'Puebloviejo'),
(709, 19, 'Remolino'),
(710, 19, 'Sabanas de San Angel (SAN ANGEL)'),
(711, 19, 'Salamina'),
(712, 19, 'San Sebastián de Buenavista'),
(713, 19, 'San Zenón'),
(714, 19, 'Santa Ana'),
(715, 19, 'Santa Bárbara de Pinto'),
(716, 19, 'Santa Marta'),
(717, 19, 'Sitionuevo'),
(718, 19, 'Tenerife'),
(719, 19, 'Zapayán (PUNTA DE PIEDRAS)'),
(720, 19, 'Zona Bananera (PRADO - SEVILLA)'),
(721, 20, 'Acacías'),
(722, 20, 'Barranca de Upía'),
(723, 20, 'Cabuyaro'),
(724, 20, 'Castilla la Nueva'),
(725, 20, 'Cubarral'),
(726, 20, 'Cumaral'),
(727, 20, 'El Calvario'),
(728, 20, 'El Castillo'),
(729, 20, 'El Dorado'),
(730, 20, 'Fuente de Oro'),
(731, 20, 'Granada'),
(732, 20, 'Guamal'),
(733, 20, 'La Macarena'),
(734, 20, 'Lejanías'),
(735, 20, 'Mapiripan'),
(736, 20, 'Mesetas'),
(737, 20, 'Puerto Concordia'),
(738, 20, 'Puerto Gaitán'),
(739, 20, 'Puerto Lleras'),
(740, 20, 'Puerto López'),
(741, 20, 'Puerto Rico'),
(742, 20, 'Restrepo'),
(743, 20, 'San Carlos de Guaroa'),
(744, 20, 'San Juan de Arama'),
(745, 20, 'San Juanito'),
(746, 20, 'San Martín'),
(747, 20, 'Uribe'),
(748, 20, 'Villavicencio'),
(749, 20, 'Vista Hermosa'),
(750, 21, 'Albán (San José)'),
(751, 21, 'Aldana'),
(752, 21, 'Ancuya'),
(753, 21, 'Arboleda (Berruecos)'),
(754, 21, 'Barbacoas'),
(755, 21, 'Belén'),
(756, 21, 'Buesaco'),
(757, 21, 'Chachaguí'),
(758, 21, 'Colón (Génova)'),
(759, 21, 'Consaca'),
(760, 21, 'Contadero'),
(761, 21, 'Cuaspud (Carlosama)'),
(762, 21, 'Cumbal'),
(763, 21, 'Cumbitara'),
(764, 21, 'Córdoba'),
(765, 21, 'El Charco'),
(766, 21, 'El Peñol'),
(767, 21, 'El Rosario'),
(768, 21, 'El Tablón de Gómez'),
(769, 21, 'El Tambo'),
(770, 21, 'Francisco Pizarro'),
(771, 21, 'Funes'),
(772, 21, 'Guachavés'),
(773, 21, 'Guachucal'),
(774, 21, 'Guaitarilla'),
(775, 21, 'Gualmatán'),
(776, 21, 'Iles'),
(777, 21, 'Imúes'),
(778, 21, 'Ipiales'),
(779, 21, 'La Cruz'),
(780, 21, 'La Florida'),
(781, 21, 'La Llanada'),
(782, 21, 'La Tola'),
(783, 21, 'La Unión'),
(784, 21, 'Leiva'),
(785, 21, 'Linares'),
(786, 21, 'Magüi (Payán)'),
(787, 21, 'Mallama (Piedrancha)'),
(788, 21, 'Mosquera'),
(789, 21, 'Nariño'),
(790, 21, 'Olaya Herrera'),
(791, 21, 'Ospina'),
(792, 21, 'Policarpa'),
(793, 21, 'Potosí'),
(794, 21, 'Providencia'),
(795, 21, 'Puerres'),
(796, 21, 'Pupiales'),
(797, 21, 'Ricaurte'),
(798, 21, 'Roberto Payán (San José)'),
(799, 21, 'Samaniego'),
(800, 21, 'San Bernardo'),
(801, 21, 'San Juan de Pasto'),
(802, 21, 'San Lorenzo'),
(803, 21, 'San Pablo'),
(804, 21, 'San Pedro de Cartago'),
(805, 21, 'Sandoná'),
(806, 21, 'Santa Bárbara (Iscuandé)'),
(807, 21, 'Sapuyes'),
(808, 21, 'Sotomayor (Los Andes)'),
(809, 21, 'Taminango'),
(810, 21, 'Tangua'),
(811, 21, 'Tumaco'),
(812, 21, 'Túquerres'),
(813, 21, 'Yacuanquer'),
(814, 22, 'Arboledas'),
(815, 22, 'Bochalema'),
(816, 22, 'Bucarasica'),
(817, 22, 'Chinácota'),
(818, 22, 'Chitagá'),
(819, 22, 'Convención'),
(820, 22, 'Cucutilla'),
(821, 22, 'Cáchira'),
(822, 22, 'Cácota'),
(823, 22, 'Cúcuta'),
(824, 22, 'Durania'),
(825, 22, 'El Carmen'),
(826, 22, 'El Tarra'),
(827, 22, 'El Zulia'),
(828, 22, 'Gramalote'),
(829, 22, 'Hacarí'),
(830, 22, 'Herrán'),
(831, 22, 'La Esperanza'),
(832, 22, 'La Playa'),
(833, 22, 'Labateca'),
(834, 22, 'Los Patios'),
(835, 22, 'Lourdes'),
(836, 22, 'Mutiscua'),
(837, 22, 'Ocaña'),
(838, 22, 'Pamplona'),
(839, 22, 'Pamplonita'),
(840, 22, 'Puerto Santander'),
(841, 22, 'Ragonvalia'),
(842, 22, 'Salazar'),
(843, 22, 'San Calixto'),
(844, 22, 'San Cayetano'),
(845, 22, 'Santiago'),
(846, 22, 'Sardinata'),
(847, 22, 'Silos'),
(848, 22, 'Teorama'),
(849, 22, 'Tibú'),
(850, 22, 'Toledo'),
(851, 22, 'Villa Caro'),
(852, 22, 'Villa del Rosario'),
(853, 22, 'Ábrego'),
(854, 23, 'Colón'),
(855, 23, 'Mocoa'),
(856, 23, 'Orito'),
(857, 23, 'Puerto Asís'),
(858, 23, 'Puerto Caicedo'),
(859, 23, 'Puerto Guzmán'),
(860, 23, 'Puerto Leguízamo'),
(861, 23, 'San Francisco'),
(862, 23, 'San Miguel'),
(863, 23, 'Santiago'),
(864, 23, 'Sibundoy'),
(865, 23, 'Valle del Guamuez'),
(866, 23, 'Villagarzón'),
(867, 24, 'Armenia'),
(868, 24, 'Buenavista'),
(869, 24, 'Calarcá'),
(870, 24, 'Circasia'),
(871, 24, 'Cordobá'),
(872, 24, 'Filandia'),
(873, 24, 'Génova'),
(874, 24, 'La Tebaida'),
(875, 24, 'Montenegro'),
(876, 24, 'Pijao'),
(877, 24, 'Quimbaya'),
(878, 24, 'Salento'),
(879, 25, 'Apía'),
(880, 25, 'Balboa'),
(881, 25, 'Belén de Umbría'),
(882, 25, 'Dos Quebradas'),
(883, 25, 'Guática'),
(884, 25, 'La Celia'),
(885, 25, 'La Virginia'),
(886, 25, 'Marsella'),
(887, 25, 'Mistrató'),
(888, 25, 'Pereira'),
(889, 25, 'Pueblo Rico'),
(890, 25, 'Quinchía'),
(891, 25, 'Santa Rosa de Cabal'),
(892, 25, 'Santuario'),
(893, 26, 'Providencia'),
(894, 27, 'Aguada'),
(895, 27, 'Albania'),
(896, 27, 'Aratoca'),
(897, 27, 'Barbosa'),
(898, 27, 'Barichara'),
(899, 27, 'Barrancabermeja'),
(900, 27, 'Betulia'),
(901, 27, 'Bolívar'),
(902, 27, 'Bucaramanga'),
(903, 27, 'Cabrera'),
(904, 27, 'California'),
(905, 27, 'Capitanejo'),
(906, 27, 'Carcasí'),
(907, 27, 'Cepita'),
(908, 27, 'Cerrito'),
(909, 27, 'Charalá'),
(910, 27, 'Charta'),
(911, 27, 'Chima'),
(912, 27, 'Chipatá'),
(913, 27, 'Cimitarra'),
(914, 27, 'Concepción'),
(915, 27, 'Confines'),
(916, 27, 'Contratación'),
(917, 27, 'Coromoro'),
(918, 27, 'Curití'),
(919, 27, 'El Carmen'),
(920, 27, 'El Guacamayo'),
(921, 27, 'El Peñon'),
(922, 27, 'El Playón'),
(923, 27, 'Encino'),
(924, 27, 'Enciso'),
(925, 27, 'Floridablanca'),
(926, 27, 'Florián'),
(927, 27, 'Galán'),
(928, 27, 'Girón'),
(929, 27, 'Guaca'),
(930, 27, 'Guadalupe'),
(931, 27, 'Guapota'),
(932, 27, 'Guavatá'),
(933, 27, 'Guepsa'),
(934, 27, 'Gámbita'),
(935, 27, 'Hato'),
(936, 27, 'Jesús María'),
(937, 27, 'Jordán'),
(938, 27, 'La Belleza'),
(939, 27, 'La Paz'),
(940, 27, 'Landázuri'),
(941, 27, 'Lebrija'),
(942, 27, 'Los Santos'),
(943, 27, 'Macaravita'),
(944, 27, 'Matanza'),
(945, 27, 'Mogotes'),
(946, 27, 'Molagavita'),
(947, 27, 'Málaga'),
(948, 27, 'Ocamonte'),
(949, 27, 'Oiba'),
(950, 27, 'Onzaga'),
(951, 27, 'Palmar'),
(952, 27, 'Palmas del Socorro'),
(953, 27, 'Pie de Cuesta'),
(954, 27, 'Pinchote'),
(955, 27, 'Puente Nacional'),
(956, 27, 'Puerto Parra'),
(957, 27, 'Puerto Wilches'),
(958, 27, 'Páramo'),
(959, 27, 'Rio Negro'),
(960, 27, 'Sabana de Torres'),
(961, 27, 'San Andrés'),
(962, 27, 'San Benito'),
(963, 27, 'San Gíl'),
(964, 27, 'San Joaquín'),
(965, 27, 'San José de Miranda'),
(966, 27, 'San Miguel'),
(967, 27, 'San Vicente del Chucurí'),
(968, 27, 'Santa Bárbara'),
(969, 27, 'Santa Helena del Opón'),
(970, 27, 'Simacota'),
(971, 27, 'Socorro'),
(972, 27, 'Suaita'),
(973, 27, 'Sucre'),
(974, 27, 'Suratá'),
(975, 27, 'Tona'),
(976, 27, 'Valle de San José'),
(977, 27, 'Vetas'),
(978, 27, 'Villanueva'),
(979, 27, 'Vélez'),
(980, 27, 'Zapatoca'),
(981, 28, 'Buenavista'),
(982, 28, 'Caimito'),
(983, 28, 'Chalán'),
(984, 28, 'Colosó (Ricaurte)'),
(985, 28, 'Corozal'),
(986, 28, 'Coveñas'),
(987, 28, 'El Roble'),
(988, 28, 'Galeras (Nueva Granada)'),
(989, 28, 'Guaranda'),
(990, 28, 'La Unión'),
(991, 28, 'Los Palmitos'),
(992, 28, 'Majagual'),
(993, 28, 'Morroa'),
(994, 28, 'Ovejas'),
(995, 28, 'Palmito'),
(996, 28, 'Sampués'),
(997, 28, 'San Benito Abad'),
(998, 28, 'San Juan de Betulia'),
(999, 28, 'San Marcos'),
(1000, 28, 'San Onofre'),
(1001, 28, 'San Pedro'),
(1002, 28, 'Sincelejo'),
(1003, 28, 'Sincé'),
(1004, 28, 'Sucre'),
(1005, 28, 'Tolú'),
(1006, 28, 'Tolú Viejo'),
(1007, 29, 'Alpujarra'),
(1008, 29, 'Alvarado'),
(1009, 29, 'Ambalema'),
(1010, 29, 'Anzoátegui'),
(1011, 29, 'Armero (Guayabal)'),
(1012, 29, 'Ataco'),
(1013, 29, 'Cajamarca'),
(1014, 29, 'Carmen de Apicalá'),
(1015, 29, 'Casabianca'),
(1016, 29, 'Chaparral'),
(1017, 29, 'Coello'),
(1018, 29, 'Coyaima'),
(1019, 29, 'Cunday'),
(1020, 29, 'Dolores'),
(1021, 29, 'Espinal'),
(1022, 29, 'Falan'),
(1023, 29, 'Flandes'),
(1024, 29, 'Fresno'),
(1025, 29, 'Guamo'),
(1026, 29, 'Herveo'),
(1027, 29, 'Honda'),
(1028, 29, 'Ibagué'),
(1029, 29, 'Icononzo'),
(1030, 29, 'Lérida'),
(1031, 29, 'Líbano'),
(1032, 29, 'Mariquita'),
(1033, 29, 'Melgar'),
(1034, 29, 'Murillo'),
(1035, 29, 'Natagaima'),
(1036, 29, 'Ortega'),
(1037, 29, 'Palocabildo'),
(1038, 29, 'Piedras'),
(1039, 29, 'Planadas'),
(1040, 29, 'Prado'),
(1041, 29, 'Purificación'),
(1042, 29, 'Rioblanco'),
(1043, 29, 'Roncesvalles'),
(1044, 29, 'Rovira'),
(1045, 29, 'Saldaña'),
(1046, 29, 'San Antonio'),
(1047, 29, 'San Luis'),
(1048, 29, 'Santa Isabel'),
(1049, 29, 'Suárez'),
(1050, 29, 'Valle de San Juan'),
(1051, 29, 'Venadillo'),
(1052, 29, 'Villahermosa'),
(1053, 29, 'Villarrica'),
(1054, 30, 'Alcalá'),
(1055, 30, 'Andalucía'),
(1056, 30, 'Ansermanuevo'),
(1057, 30, 'Argelia'),
(1058, 30, 'Bolívar'),
(1059, 30, 'Buenaventura'),
(1060, 30, 'Buga'),
(1061, 30, 'Bugalagrande'),
(1062, 30, 'Caicedonia'),
(1063, 30, 'Calima (Darién)'),
(1064, 30, 'Calí'),
(1065, 30, 'Candelaria'),
(1066, 30, 'Cartago'),
(1067, 30, 'Dagua'),
(1068, 30, 'El Cairo'),
(1069, 30, 'El Cerrito'),
(1070, 30, 'El Dovio'),
(1071, 30, 'El Águila'),
(1072, 30, 'Florida'),
(1073, 30, 'Ginebra'),
(1074, 30, 'Guacarí'),
(1075, 30, 'Jamundí'),
(1076, 30, 'La Cumbre'),
(1077, 30, 'La Unión'),
(1078, 30, 'La Victoria'),
(1079, 30, 'Obando'),
(1080, 30, 'Palmira'),
(1081, 30, 'Pradera'),
(1082, 30, 'Restrepo'),
(1083, 30, 'Riofrío'),
(1084, 30, 'Roldanillo'),
(1085, 30, 'San Pedro'),
(1086, 30, 'Sevilla'),
(1087, 30, 'Toro'),
(1088, 30, 'Trujillo'),
(1089, 30, 'Tulúa'),
(1090, 30, 'Ulloa'),
(1091, 30, 'Versalles'),
(1092, 30, 'Vijes'),
(1093, 30, 'Yotoco'),
(1094, 30, 'Yumbo'),
(1095, 30, 'Zarzal'),
(1096, 31, 'Carurú'),
(1097, 31, 'Mitú'),
(1098, 31, 'Taraira'),
(1099, 32, 'Cumaribo'),
(1100, 32, 'La Primavera'),
(1101, 32, 'Puerto Carreño'),
(1102, 32, 'Santa Rosalía');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_nivel_educativo`
--

CREATE TABLE `tbl_nivel_educativo` (
  `id_nivel_educativo` int(11) NOT NULL,
  `descripcion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_nivel_educativo`
--

INSERT INTO `tbl_nivel_educativo` (`id_nivel_educativo`, `descripcion`) VALUES
(1, 'Primaria'),
(2, 'Secundaia'),
(3, 'Sin nivel'),
(4, 'Nivel superior'),
(5, 'No aplica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_perfil_tipo`
--

CREATE TABLE `tbl_perfil_tipo` (
  `id_perfil_tipo` int(11) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_perfil_tipo`
--

INSERT INTO `tbl_perfil_tipo` (`id_perfil_tipo`, `descripcion`) VALUES
(1, 'Encuestador'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_persona`
--

CREATE TABLE `tbl_persona` (
  `id_persona` int(11) NOT NULL,
  `id_documento_tipo` int(11) DEFAULT NULL,
  `documento` varchar(100) DEFAULT NULL,
  `nombre1` varchar(200) DEFAULT NULL,
  `nombre2` varchar(200) DEFAULT NULL,
  `apellido1` varchar(200) DEFAULT NULL,
  `apellido2` varchar(200) DEFAULT NULL,
  `id_tarjeta_familiar` int(11) NOT NULL,
  `id_estado_civil` int(11) DEFAULT NULL,
  `id_nivel_educativo` int(11) DEFAULT NULL,
  `sexo` enum('Masculino','Femenino') NOT NULL DEFAULT 'Masculino',
  `fecha_nacimiento` date DEFAULT NULL,
  `id_persona_familiaridad` int(11) NOT NULL,
  `tipo_afiliado` enum('COTIZANTE','BENEFIACIARIO') DEFAULT NULL,
  `id_asegurador` int(11) DEFAULT NULL COMMENT 'subsidiado, contributivo, desplazado, etc',
  `id_rango` int(11) DEFAULT NULL,
  `id_regimen` int(11) DEFAULT NULL,
  `es_cabeza_familia` char(2) NOT NULL DEFAULT 'no',
  `ocupacion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=2340 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_persona`
--

INSERT INTO `tbl_persona` (`id_persona`, `id_documento_tipo`, `documento`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `id_tarjeta_familiar`, `id_estado_civil`, `id_nivel_educativo`, `sexo`, `fecha_nacimiento`, `id_persona_familiaridad`, `tipo_afiliado`, `id_asegurador`, `id_rango`, `id_regimen`, `es_cabeza_familia`, `ocupacion`) VALUES
(8, 1, '76296950', 'WILSON', '', 'ROJAS', 'FLOR', 6, 5, 4, 'Masculino', '1976-06-24', 2, 'COTIZANTE', 27, 1, NULL, 'no', 'ING'),
(9, 1, '1234567', 'N', 'N', 'U', 'Y', 7, 4, 1, 'Masculino', '1977-06-24', 2, 'COTIZANTE', 27, 1, NULL, 'no', 'agricultor'),
(10, 1, '123456789', 'AUDENCIO', '', 'MAGIM', 'JIMENES', 8, 2, 5, 'Masculino', '1972-06-24', 2, 'COTIZANTE', 14, 1, NULL, 'no', 'YUU'),
(11, 1, '1234567891', 'ELIAS', '', 'MAGIM', 'JIMENS', 8, 2, 5, 'Masculino', '1971-06-24', 4, 'COTIZANTE', 14, 1, NULL, 'no', 'UIUI'),
(12, 1, '123456789100', 'FF', 'GGG', 'HH', '', 8, 2, 5, 'Femenino', '1967-04-20', 3, 'COTIZANTE', 27, 1, NULL, 'no', ''),
(13, 1, '12345678910012', 'IIIIII', 'PPPPPPPPP', 'OOOOO', '', 8, 2, 5, 'Masculino', '1966-01-30', 7, 'COTIZANTE', 27, 1, NULL, 'no', ''),
(14, 1, '788999', 'WW', '', 'JJ', 'PP', 9, 2, 4, 'Masculino', '1971-06-24', 2, 'COTIZANTE', 27, 1, NULL, 'no', 'HHH'),
(15, 1, '1061688508', 'CARO', '', 'HER', 'PEÑA', 10, 2, 4, 'Femenino', '1971-01-30', 3, 'COTIZANTE', 14, 1, NULL, 'no', 'agricultor'),
(16, 5, '1', '121', '1212', '12121', '1212', 6, 2, 4, 'Masculino', '2018-01-30', 9, 'COTIZANTE', 10, 1, NULL, 'si', '212');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_persona_familiaridad`
--

CREATE TABLE `tbl_persona_familiaridad` (
  `id_persona_familiaridad` int(11) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `sexo` char(20) DEFAULT NULL COMMENT 'm=masculino\r\nf=femenino\r\n0=neutro'
) ENGINE=InnoDB AVG_ROW_LENGTH=1365 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_persona_familiaridad`
--

INSERT INTO `tbl_persona_familiaridad` (`id_persona_familiaridad`, `descripcion`, `sexo`) VALUES
(2, 'Padre', 'm'),
(3, 'Madre', 'f'),
(4, 'Hijo', 'm'),
(5, 'Hermano', 'm'),
(6, 'Hermana', 'f'),
(7, 'Tio', 'm'),
(8, 'Tia', 'f'),
(9, 'Abuelo', 'm'),
(10, 'Abuela', 'f'),
(11, 'Sobrino', 'm'),
(12, 'Sobrina', 'f'),
(13, 'Hija', 'f'),
(14, 'Esposa', 'f'),
(15, 'Esposo', 'm'),
(16, 'Nieto', 'm'),
(17, 'Nieta', 'f'),
(18, 'Bisnieto', 'm'),
(19, 'Bisnieta', 'f');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_regimen`
--

CREATE TABLE `tbl_regimen` (
  `id_regimen` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=2340 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_regimen`
--

INSERT INTO `tbl_regimen` (`id_regimen`, `descripcion`) VALUES
(1, 'SUBSIDIADO'),
(2, 'CONTRIBUTIVO'),
(3, 'RE ESPECIAL'),
(4, 'VINCULADO'),
(5, 'DESP VINCU'),
(6, 'DESP SUB'),
(7, 'DESP CONT');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tarjeta_familiar`
--

CREATE TABLE `tbl_tarjeta_familiar` (
  `id_tarjeta_familiar` int(11) NOT NULL,
  `fecha_apertura` datetime DEFAULT NULL,
  `codigo` varchar(20) NOT NULL,
  `sisben_ficha` int(11) DEFAULT NULL,
  `sisben_puntaje` double(15,3) DEFAULT NULL,
  `sisben_nivel` int(11) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `id_zona` int(11) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `id_municipio` int(11) NOT NULL,
  `id_corregimiento` int(11) DEFAULT NULL,
  `id_vereda` int(11) DEFAULT NULL,
  `portabilidad` varchar(2) NOT NULL DEFAULT 'no' COMMENT 'si\r\nno',
  `cambio_domicilio` char(2) NOT NULL DEFAULT 'no' COMMENT 'si\r\nno',
  `proxima_visita` date DEFAULT NULL,
  `responsable` varchar(200) DEFAULT NULL,
  `documento_responsable` varchar(200) DEFAULT NULL,
  `posicion_latitud` varchar(200) DEFAULT NULL,
  `posicion_longitud` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=16384 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `id_usuario` int(11) NOT NULL,
  `login` varchar(200) NOT NULL,
  `pass` varchar(200) NOT NULL,
  `id_perfil_tercero` int(11) NOT NULL,
  `id_perfil_tipo` int(11) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `apellido` varchar(200) DEFAULT NULL,
  `documento` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id_usuario`, `login`, `pass`, `id_perfil_tercero`, `id_perfil_tipo`, `nombre`, `apellido`, `documento`) VALUES
(1, '1', 'c4ca4238a0b923820dcc509a6f75849b', 1, 1, 'usuario', 'prueba', '1'),
(2, '2', 'c81e728d9d4c2f636f067f89cc14862c', 2, 2, '2', '2', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_veredas`
--

CREATE TABLE `tbl_veredas` (
  `id_vereda` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `id_municipio` int(11) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=71 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_veredas`
--

INSERT INTO `tbl_veredas` (`id_vereda`, `descripcion`, `id_municipio`) VALUES
(2, 'PRIMAVERA', 430),
(3, 'AGUA AZUL', 430),
(4, 'CANTARITO', 430),
(5, 'EL CHALO', 430),
(26, 'AGUA CLARA', 398),
(27, 'AIRES DE OCCIDENTE', 398),
(28, 'ALBANIA', 398),
(29, 'ALTA MIRA', 398),
(30, 'ALTO DEL CREDO', 398),
(31, 'ALTO DEL REY', 398),
(32, 'ALTO MIRAFLORES', 398),
(33, 'ANTIOQUEÑITA', 398),
(34, 'BARAYA', 398),
(35, 'BARRANQUILLA', 398),
(36, 'BELEN LA CALERA', 398),
(37, 'BELLAVISTA', 398),
(38, 'BELLO HORIZONTE', 398),
(39, 'BETANIA REMOLINO', 398),
(40, 'BETANIA TAMBO', 398),
(41, 'BOJOLEO', 398),
(42, 'BRISAS', 398),
(43, 'BUENA VISTA', 398),
(44, 'CABUYAL', 398),
(45, 'CABUYAL SANJUAQUIN', 398),
(46, 'CACHIMBO', 398),
(47, 'CALICHARES', 398),
(48, 'CAMPO BELLO', 398),
(49, 'CAÑA AGRIA', 398),
(50, 'CASAS VIEJAS', 398),
(51, 'CASCAJAL', 398),
(52, 'CAUCA', 398),
(53, 'CENTRO', 398),
(54, 'CERRITO URIBE', 398),
(55, 'CHAPA', 398),
(56, 'CHISQUIO', 398),
(57, 'COLONIZACIÓN LA PLAYA', 398),
(58, 'COSTA NUEVA', 398),
(59, 'CUATRO ESQUINAS', 398),
(60, 'DIEZ DE ABRIL', 398),
(61, 'EL AGRADO', 398),
(62, 'EL CERRO LA CALERA', 398),
(63, 'EL CIPRES PUEBLO NUEVO', 398),
(64, 'EL CONDOR', 398),
(65, 'EL CRUCERO', 398),
(66, 'EL DELEITE', 398),
(67, 'EL GUAYABO', 398),
(68, 'EL HIGUERON ZARZAL', 398),
(69, 'EL HOYO', 398),
(70, 'EL JAGUAL', 398),
(71, 'EL LIMÓN', 398),
(72, 'EL MARQUEZ', 398),
(73, 'EL MIRADOR', 398),
(74, 'EL MOJON', 398),
(75, 'EL MOLINO', 398),
(76, 'EL MORAL', 398),
(77, 'EL MORCON', 398),
(78, 'EL OBELISCO', 398),
(79, 'EL PLACER', 398),
(80, 'EL PORVENIR', 398),
(81, 'EL PROGRESO', 398),
(82, 'EL PUENTE RIO TIMBIO', 398),
(83, 'EL RAMAL U.', 398),
(84, 'EL RECUERDO URIBE', 398),
(85, 'EL RETIRO TAMBO', 398),
(86, 'EL ROSAL', 398),
(87, 'EL SALADO', 398),
(88, 'EL SAUCE', 398),
(89, 'EL SINAY', 398),
(90, 'EL TABLON', 398),
(91, 'EL TRIUNFO', 398),
(92, 'FILANDIA', 398),
(93, 'GARCIA MARQUEZ', 398),
(94, 'GAVILANES PLAYA RICA', 398),
(95, 'GOLONDRINAS', 398),
(96, 'GRANADA LLANOS', 398),
(97, 'GRANADA TABLERAL', 398),
(98, 'GUAYABAL PLAYA RICA', 398),
(99, 'GUAZABARITA', 398),
(100, 'GUELEITO', 398),
(101, 'HISPANDY', 398),
(102, 'HONDURAS', 398),
(103, 'HUISITO', 398),
(104, 'JARDIN DE LA PLAYA', 398),
(105, 'JUANA CASTAÑA', 398),
(106, 'JUNTAS HUISITO', 398),
(107, 'LA AGUADITA', 398),
(108, 'LA ALIANZA', 398),
(109, 'LA BANDA', 398),
(110, 'LA BERMEJA', 398),
(111, 'LA CAPILLA', 398),
(112, 'LA CHICUEÑA', 398),
(113, 'LA CONCORDIA', 398),
(114, 'LA COSTEÑITA', 398),
(115, 'LA CUCHILLA', 398),
(116, 'LA DORADA', 398),
(117, 'LA ESMERALDA', 398),
(118, 'LA ESPERANZA', 398),
(119, 'LA FLORIDA', 398),
(120, 'LA GALLERA', 398),
(121, 'LA INDEPENDENCIA', 398),
(122, 'LA LAGUNA DAJUANDO', 398),
(123, 'LA LAGUNA TAMBO', 398),
(124, 'LA LAJA', 398),
(125, 'LA LIBERTAD', 398),
(126, 'LA MANZALLA', 398),
(127, 'LA MUYUNGA', 398),
(128, 'LA NORCASIA', 398),
(129, 'LA PALMERA', 398),
(130, 'LA PALOMA', 398),
(131, 'LA PAZ', 398),
(132, 'LA PEDREGOZA', 398),
(133, 'LA PLANADA', 398),
(134, 'LA POZETA', 398),
(135, 'LA PRADERA', 398),
(136, 'LA PRIMAVERA', 398),
(137, 'LA PUBENZA', 398),
(138, 'LA ROMELIA', 398),
(139, 'LA SENDA BANDA', 398),
(140, 'LA VENTA', 398),
(141, 'LA VENTANA', 398),
(142, 'LA VICTORIA', 398),
(143, 'LAS BOTAS', 398),
(144, 'LAS CHUCARAS', 398),
(145, 'LAS FLORES', 398),
(146, 'LAS GAVIOTAS', 398),
(147, 'LAS GUACAS', 398),
(148, 'LAS HUERTAS', 398),
(149, 'LAS PALMAS LA GALLERA', 398),
(150, 'LAS PIEDRAS', 398),
(151, 'LAS VERANERAS', 398),
(152, 'LIMONCITO FONDAS', 398),
(153, 'LIMONCITO MIRRINGA', 398),
(154, 'LISBOA DAJUANDO', 398),
(155, 'LLANITOS HUISITO', 398),
(156, 'LOMA ALTA SANJUAQUIN', 398),
(157, 'LOMA DE ASTUDILLO', 398),
(158, 'LOMA DE PAJA', 398),
(159, 'LOMA LARGA QUILCASE', 398),
(160, 'LOMA LARGA SAN JUAQUIN', 398),
(161, 'LOS ALPES', 398),
(162, 'LOS ANAYES', 398),
(163, 'LOS ANDES', 398),
(164, 'LOS ANGELES', 398),
(165, 'LOS ARRAYANES', 398),
(166, 'LOS CUCHAROS', 398),
(167, 'LOS LINDEROS', 398),
(168, 'LOS LLANOS', 398),
(169, 'LOS NARANJOS', 398),
(170, 'LOS TEJARES', 398),
(171, 'MADROÑO', 398),
(172, 'MANIZALES', 398),
(173, 'MANZANARES', 398),
(174, 'MECAJE', 398),
(175, 'MONTE OSCURO', 398),
(176, 'MONTERREDONDO', 398),
(177, 'MOSQUERA', 398),
(178, 'MUNCHIQUE', 398),
(179, 'MURGUEITIO', 398),
(180, 'NAVARRO', 398),
(181, 'NAYITA', 398),
(182, 'NOVILLEROS', 398),
(183, 'NUEVA GRANADA', 398),
(184, 'NUEVA SANTA BARBARA', 398),
(185, 'OBRERO', 398),
(186, 'OJO DE AGUA', 398),
(187, 'ORTEGA LLANOS', 398),
(188, 'PALMICHAL', 398),
(189, 'PALO VERDE', 398),
(190, 'PANDIGUANDO', 398),
(191, 'PARAISO', 398),
(192, 'PASO MALO', 398),
(193, 'PATIO BONITO', 398),
(194, 'PEÑAS BLANCAS', 398),
(195, 'PEPITAL', 398),
(196, 'PEROLINDEZ', 398),
(197, 'PIAGUA', 398),
(198, 'PIEDRA DE BOLIVAR', 398),
(199, 'PIEDRA SANTA', 398),
(200, 'PINAR DEL RIO', 398),
(201, 'PITA', 398),
(202, 'PLAYA RICA', 398),
(203, 'POMORROSOS', 398),
(204, 'PUEBLO NUEVO PIAGUA', 398),
(205, 'PUENTE ALTA', 398),
(206, 'PUERTA LLAVE', 398),
(207, 'PUERTO RICO', 398),
(208, 'QUEBRADA HONDA', 398),
(209, 'QUILCACE', 398),
(210, 'RIO BLANCO', 398),
(211, 'RIO CLARO HUISITO', 398),
(212, 'RIO HONDO', 398),
(213, 'RIO SUCIO ARMONIVAL', 398),
(214, 'RISARALDA LOS ANDES', 398),
(215, 'RIVERA ESCOVAR', 398),
(216, 'SABALETAS', 398),
(217, 'SABANETAS', 398),
(218, 'SAN ANTONIO', 398),
(219, 'SAN FERNANDO', 398),
(220, 'SAN JOAQUIN', 398),
(221, 'SAN JOSE', 398),
(222, 'SAN JUAN DE MICAY', 398),
(223, 'SAN PEDRO HUISITO', 398),
(224, 'SAN PEDRO URIBE', 398),
(225, 'SAN ROQUE CAÑAVERAL', 398),
(226, 'SAN ROQUE ORIENTE', 398),
(227, 'SAN VICENTE', 398),
(228, 'SANTA BARBARA', 398),
(229, 'SANTA RITA', 398),
(230, 'SAYUMBO SOCORRITO', 398),
(231, 'SEGUENGUE', 398),
(232, 'SENDA MAGINES', 398),
(233, 'SEVILLA', 398),
(234, 'SIETE DE AGOSTO', 398),
(235, 'TAMAO', 398),
(236, 'TAMBORAL', 398),
(237, 'TRES QUEBRADAS SAN JOAQUIN', 398),
(238, 'TUYA ES COLOMBIA', 398),
(239, 'UNION GRAMALOTE', 398),
(240, 'URIBE', 398),
(241, 'VEINTE DE JULIO', 398),
(242, 'VERSALLES', 398),
(243, 'VILLA EL MAR FONDAS', 398),
(244, 'VILLA NUEVA', 398),
(245, 'VILLA OLIMPICA LA LAGUNA', 398),
(246, 'VISTA HERMOSA', 398),
(247, 'YARUMAL', 398),
(248, 'YUMBITO', 398),
(249, 'ZARZAL', 398),
(250, 'ZARZALITO', 398);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_zona`
--

CREATE TABLE `tbl_zona` (
  `id_zona` int(11) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_zona`
--

INSERT INTO `tbl_zona` (`id_zona`, `descripcion`) VALUES
(1, 'Zona 1'),
(2, 'Zona 2'),
(3, 'Zona 3'),
(4, 'Zona 4'),
(5, 'Zona 5');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_car_programas_actividades_valores`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_car_programas_actividades_valores` (
`descripcion` varchar(200)
,`rango_inicio` int(11)
,`rango_fin` int(11)
,`rango_inicio_dias` bigint(14)
,`rango_fin_dias` bigint(14)
,`rango_tipo` enum('dias','mes','años')
,`dosis` int(11)
,`intervalo_tipo` enum('dias','semanas','meses','años')
,`intervalo` int(11)
,`sexo` enum('Masculino','Femenino','ambos')
,`id_car_programa` int(11)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `view_car_programas_actividades_valores`
--
DROP TABLE IF EXISTS `view_car_programas_actividades_valores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_car_programas_actividades_valores`  AS  select `tbl_car_programas_actividades`.`descripcion` AS `descripcion`,`tbl_car_programas_actividades_valores`.`rango_inicio` AS `rango_inicio`,`tbl_car_programas_actividades_valores`.`rango_fin` AS `rango_fin`,(case when (`tbl_car_programas_actividades_valores`.`rango_tipo` = 'años') then (`tbl_car_programas_actividades_valores`.`rango_inicio` * 365) when (`tbl_car_programas_actividades_valores`.`rango_tipo` = 'semanas') then (`tbl_car_programas_actividades_valores`.`rango_inicio` * 7) when (`tbl_car_programas_actividades_valores`.`rango_tipo` = 'mes') then (`tbl_car_programas_actividades_valores`.`rango_inicio` * 30) when (`tbl_car_programas_actividades_valores`.`rango_tipo` = 'dias') then (`tbl_car_programas_actividades_valores`.`rango_inicio` * 1) end) AS `rango_inicio_dias`,(case when (`tbl_car_programas_actividades_valores`.`rango_tipo` = 'años') then (`tbl_car_programas_actividades_valores`.`rango_fin` * 365) when (`tbl_car_programas_actividades_valores`.`rango_tipo` = 'semanas') then (`tbl_car_programas_actividades_valores`.`rango_fin` * 7) when (`tbl_car_programas_actividades_valores`.`rango_tipo` = 'mes') then (`tbl_car_programas_actividades_valores`.`rango_fin` * 30) when (`tbl_car_programas_actividades_valores`.`rango_tipo` = 'dias') then (`tbl_car_programas_actividades_valores`.`rango_fin` * 1) end) AS `rango_fin_dias`,`tbl_car_programas_actividades_valores`.`rango_tipo` AS `rango_tipo`,`tbl_car_programas_actividades_valores`.`dosis` AS `dosis`,`tbl_car_programas_actividades_valores`.`intervalo_tipo` AS `intervalo_tipo`,`tbl_car_programas_actividades_valores`.`intervalo` AS `intervalo`,`tbl_car_programas_actividades_valores`.`sexo` AS `sexo`,`tbl_car_programas_actividades`.`id_car_programa` AS `id_car_programa` from (`tbl_car_programas_actividades_valores` join `tbl_car_programas_actividades` on((`tbl_car_programas_actividades_valores`.`id_car_actividades` = `tbl_car_programas_actividades`.`id_car_programas_actividades`))) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_asegurador`
--
ALTER TABLE `tbl_asegurador`
  ADD PRIMARY KEY (`id_asegurador`);

--
-- Indices de la tabla `tbl_car_categoria`
--
ALTER TABLE `tbl_car_categoria`
  ADD PRIMARY KEY (`id_car_categoria`);

--
-- Indices de la tabla `tbl_car_programas`
--
ALTER TABLE `tbl_car_programas`
  ADD PRIMARY KEY (`id_car_programas`);

--
-- Indices de la tabla `tbl_car_programas_actividades`
--
ALTER TABLE `tbl_car_programas_actividades`
  ADD PRIMARY KEY (`id_car_programas_actividades`);

--
-- Indices de la tabla `tbl_car_programas_actividades_valores`
--
ALTER TABLE `tbl_car_programas_actividades_valores`
  ADD PRIMARY KEY (`id_car_programas_actividades`),
  ADD UNIQUE KEY `tbl_car_programas_actividades_valores_idx1` (`id_car_actividades`,`rango_inicio`,`rango_fin`,`rango_tipo`,`dosis`,`intervalo`,`intervalo_tipo`,`sexo`);

--
-- Indices de la tabla `tbl_car_registro`
--
ALTER TABLE `tbl_car_registro`
  ADD PRIMARY KEY (`id_car_registro`);

--
-- Indices de la tabla `tbl_car_tipo_dato`
--
ALTER TABLE `tbl_car_tipo_dato`
  ADD PRIMARY KEY (`id_car_tipo_dato`);

--
-- Indices de la tabla `tbl_car_variables`
--
ALTER TABLE `tbl_car_variables`
  ADD PRIMARY KEY (`id_car_variables`);

--
-- Indices de la tabla `tbl_car_variablexcategoria`
--
ALTER TABLE `tbl_car_variablexcategoria`
  ADD PRIMARY KEY (`id_car_variablexcategoria`);

--
-- Indices de la tabla `tbl_codigos`
--
ALTER TABLE `tbl_codigos`
  ADD PRIMARY KEY (`id_codigos`),
  ADD UNIQUE KEY `tbl_codigos_idx2` (`codigo_inicio`,`codigo_fin`),
  ADD UNIQUE KEY `tbl_codigos_idx1` (`codigo_next_value`,`id_usuario`);

--
-- Indices de la tabla `tbl_config`
--
ALTER TABLE `tbl_config`
  ADD PRIMARY KEY (`id_config`);

--
-- Indices de la tabla `tbl_corregimientos`
--
ALTER TABLE `tbl_corregimientos`
  ADD PRIMARY KEY (`id_corregimiento`);

--
-- Indices de la tabla `tbl_departamentos`
--
ALTER TABLE `tbl_departamentos`
  ADD PRIMARY KEY (`id_departamentos`);

--
-- Indices de la tabla `tbl_documento_tipo`
--
ALTER TABLE `tbl_documento_tipo`
  ADD PRIMARY KEY (`id_documento_tipo`);

--
-- Indices de la tabla `tbl_estado_civil`
--
ALTER TABLE `tbl_estado_civil`
  ADD PRIMARY KEY (`id_estado_civil`);

--
-- Indices de la tabla `tbl_morbilidad`
--
ALTER TABLE `tbl_morbilidad`
  ADD PRIMARY KEY (`id_morbilidad`);

--
-- Indices de la tabla `tbl_municipios`
--
ALTER TABLE `tbl_municipios`
  ADD PRIMARY KEY (`id_municipio`);

--
-- Indices de la tabla `tbl_nivel_educativo`
--
ALTER TABLE `tbl_nivel_educativo`
  ADD PRIMARY KEY (`id_nivel_educativo`);

--
-- Indices de la tabla `tbl_perfil_tipo`
--
ALTER TABLE `tbl_perfil_tipo`
  ADD PRIMARY KEY (`id_perfil_tipo`);

--
-- Indices de la tabla `tbl_persona`
--
ALTER TABLE `tbl_persona`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `tbl_persona_familiaridad`
--
ALTER TABLE `tbl_persona_familiaridad`
  ADD PRIMARY KEY (`id_persona_familiaridad`);

--
-- Indices de la tabla `tbl_regimen`
--
ALTER TABLE `tbl_regimen`
  ADD PRIMARY KEY (`id_regimen`);

--
-- Indices de la tabla `tbl_tarjeta_familiar`
--
ALTER TABLE `tbl_tarjeta_familiar`
  ADD PRIMARY KEY (`id_tarjeta_familiar`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD UNIQUE KEY `codigo_2` (`codigo`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `tbl_veredas`
--
ALTER TABLE `tbl_veredas`
  ADD PRIMARY KEY (`id_vereda`);

--
-- Indices de la tabla `tbl_zona`
--
ALTER TABLE `tbl_zona`
  ADD PRIMARY KEY (`id_zona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_asegurador`
--
ALTER TABLE `tbl_asegurador`
  MODIFY `id_asegurador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `tbl_car_categoria`
--
ALTER TABLE `tbl_car_categoria`
  MODIFY `id_car_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `tbl_car_programas`
--
ALTER TABLE `tbl_car_programas`
  MODIFY `id_car_programas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `tbl_car_programas_actividades`
--
ALTER TABLE `tbl_car_programas_actividades`
  MODIFY `id_car_programas_actividades` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT de la tabla `tbl_car_programas_actividades_valores`
--
ALTER TABLE `tbl_car_programas_actividades_valores`
  MODIFY `id_car_programas_actividades` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;
--
-- AUTO_INCREMENT de la tabla `tbl_car_registro`
--
ALTER TABLE `tbl_car_registro`
  MODIFY `id_car_registro` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_car_tipo_dato`
--
ALTER TABLE `tbl_car_tipo_dato`
  MODIFY `id_car_tipo_dato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `tbl_car_variables`
--
ALTER TABLE `tbl_car_variables`
  MODIFY `id_car_variables` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT de la tabla `tbl_car_variablexcategoria`
--
ALTER TABLE `tbl_car_variablexcategoria`
  MODIFY `id_car_variablexcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT de la tabla `tbl_codigos`
--
ALTER TABLE `tbl_codigos`
  MODIFY `id_codigos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tbl_config`
--
ALTER TABLE `tbl_config`
  MODIFY `id_config` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_corregimientos`
--
ALTER TABLE `tbl_corregimientos`
  MODIFY `id_corregimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `tbl_departamentos`
--
ALTER TABLE `tbl_departamentos`
  MODIFY `id_departamentos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `tbl_documento_tipo`
--
ALTER TABLE `tbl_documento_tipo`
  MODIFY `id_documento_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `tbl_estado_civil`
--
ALTER TABLE `tbl_estado_civil`
  MODIFY `id_estado_civil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `tbl_morbilidad`
--
ALTER TABLE `tbl_morbilidad`
  MODIFY `id_morbilidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbl_municipios`
--
ALTER TABLE `tbl_municipios`
  MODIFY `id_municipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1103;
--
-- AUTO_INCREMENT de la tabla `tbl_nivel_educativo`
--
ALTER TABLE `tbl_nivel_educativo`
  MODIFY `id_nivel_educativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `tbl_perfil_tipo`
--
ALTER TABLE `tbl_perfil_tipo`
  MODIFY `id_perfil_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tbl_persona`
--
ALTER TABLE `tbl_persona`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `tbl_persona_familiaridad`
--
ALTER TABLE `tbl_persona_familiaridad`
  MODIFY `id_persona_familiaridad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `tbl_regimen`
--
ALTER TABLE `tbl_regimen`
  MODIFY `id_regimen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `tbl_tarjeta_familiar`
--
ALTER TABLE `tbl_tarjeta_familiar`
  MODIFY `id_tarjeta_familiar` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tbl_veredas`
--
ALTER TABLE `tbl_veredas`
  MODIFY `id_vereda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;
--
-- AUTO_INCREMENT de la tabla `tbl_zona`
--
ALTER TABLE `tbl_zona`
  MODIFY `id_zona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;