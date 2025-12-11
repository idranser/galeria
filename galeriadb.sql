-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 11-12-2025 a las 15:40:24
-- Versión del servidor: 11.4.8-MariaDB-cll-lve
-- Versión de PHP: 8.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vidabyte_galeriadb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id` int(11) NOT NULL,
  `nombre_archivo` varchar(255) NOT NULL,
  `fecha_subida` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `nombre_archivo`, `fecha_subida`) VALUES
(1, 'wilstermann-aurora.jpg', '2025-07-18 15:54:46'),
(4, 'the_strongest-always_ready2.jpg', '2025-07-18 15:56:06'),
(5, 'the_strongest-always_ready.jpg', '2025-07-18 15:56:10'),
(6, 'real_tomayapo-real_oruro_.jpg', '2025-07-18 15:56:18'),
(7, 'Atletico Bucaramanga vs Atlético Mineiro.jpg', '2025-07-18 15:56:24'),
(9, 'Bolivia-vs-Brasil.jpg', '2025-07-18 20:39:01'),
(10, 'bocajuniorsyuniondesantafe.jpg.jpg', '2025-07-18 23:01:54'),
(11, 'abb_aurora.png', '2025-07-19 17:41:56'),
(12, 'bolivar_oriente_petrolero.png', '2025-07-19 17:42:00'),
(13, 'riverplate_barcelona.png', '2025-07-19 17:42:05'),
(14, 'universitario_sanjose.png', '2025-07-19 17:42:11'),
(15, 'venezuela_bolivia.png', '2025-07-19 17:42:15'),
(16, 'blooming nacional potosi.png', '2025-07-27 04:01:57'),
(17, 'independiente  petrolero oriente petrolero 2.jpg', '2025-07-27 04:02:13'),
(18, 'independiente  petrolero oriente petrolero.png', '2025-07-27 04:02:30'),
(19, 'universitario de vinto guabira.png', '2025-07-27 04:02:43'),
(20, 'aurora san antonio.jpg', '2025-07-30 22:22:10'),
(21, 'san antonio bulo bulo abb.jpg', '2025-08-02 21:12:36'),
(22, 'the strongest blooming.png', '2025-08-03 21:21:52'),
(23, 'manchester united everton.jpg', '2025-08-03 21:22:18'),
(24, 'independiente universitario.jpg', '2025-08-03 21:22:31'),
(25, 'guabira universitario.jpg', '2025-08-03 21:22:38'),
(27, 'blooming the strongest.jpg', '2025-08-03 21:23:37'),
(28, 'san antonio bulo bulo bolivar.jpeg', '2025-08-07 00:15:28'),
(29, 'atletico mineiro flamengo (2).jpg', '2025-08-07 00:16:52'),
(30, 'atletico mineiro flamengo.jpg', '2025-08-07 00:16:57'),
(31, 'bragantino botafogo.jpeg', '2025-08-07 00:17:57'),
(32, 'aurora oriente petrolero.png', '2025-08-08 19:13:15'),
(34, 'universitario-de-vinto-vs-oriente-petrolero.jpg', '2025-08-08 19:14:44'),
(35, 'abb real oruro.jpg', '2025-08-08 19:43:51'),
(36, 'Wilstermann-vs-San-Antonio-Bulo-Bulo.jpg', '2025-08-13 04:13:44'),
(37, 'aurora blooming.jpg', '2025-08-14 05:58:50'),
(38, 'guabir-vs-independiente-petrolero-2025-07-01-02-00.jpg', '2025-08-14 05:58:58'),
(39, 'Bolivar-vs-The-Strongest.jpg', '2025-08-27 22:52:58'),
(40, 'Bolivar-TheStrongest-enVivo.jpg', '2025-08-27 22:53:07'),
(41, 'bolivarthestrongest.jpg', '2025-08-27 22:53:18'),
(42, 'Blooming-vs-Oriente-Petrolero.jpg', '2025-08-31 21:15:33'),
(43, 'realorurosanjose.jpeg', '2025-08-31 21:15:40'),
(44, 'universitariorealtomayapo.jpg', '2025-09-12 20:55:38'),
(45, 'Bolivar-vs-Guabira.jpg', '2025-09-12 20:59:13'),
(46, 'bolivarguabira.jpg', '2025-09-12 20:59:21'),
(47, 'oriente petrolero real oruro.jpg', '2025-09-13 17:30:44'),
(48, 'aurora the strongest.jpeg', '2025-09-14 05:07:20'),
(49, 'abb-wilsterman.jpg', '2025-09-14 18:46:44'),
(50, 'gvsanjosealwaysready.jpg', '2025-09-14 21:12:21'),
(51, 'independiente petrolero blooming.jpg', '2025-09-14 23:09:26'),
(52, 'san antonio oriente petrolero.jpg', '2025-09-16 19:05:28'),
(53, 'realoruroaurora.jpg', '2025-09-16 23:07:11'),
(54, 'sanjoseabb.jpg', '2025-09-17 19:16:06'),
(55, 'wilstermannacionalpotosi.png', '2025-09-17 20:34:01'),
(56, 'aurorarealtomayapo.jpg', '2025-09-19 22:52:14'),
(57, 'alwaysreadyuniversitario.jpg', '2025-09-19 22:52:22'),
(58, 'independientepetrolerosanantoniobulobulo.png', '2025-09-20 22:50:52'),
(59, 'San-Jose-vs-Blooming.jpg', '2025-09-21 23:02:17'),
(60, 'alwaysreadywilsterman.jpg', '2025-09-21 23:03:23'),
(61, 'universitario-de-vinto-vs-totora-real-oruro.jpg', '2025-09-22 19:10:07'),
(62, 'oriente-petrolero-vs-independiente-petrolero.jpg', '2025-09-23 19:33:31'),
(63, 'nacionalpotosisanjose.jpg', '2025-09-24 17:58:50'),
(64, 'nacionalpotosigvsanjose.jpg', '2025-09-24 17:58:54'),
(65, 'wilstermanblooming.jpg', '2025-09-24 22:18:00'),
(66, 'Real-Tomayapo-vs-Always-Ready-768x402.jpg', '2025-09-25 03:22:47'),
(67, 'sanantonionbulobulothestrongest.jpg', '2025-09-25 23:54:23'),
(68, 'abbuniversitariovinto.jpg', '2025-09-25 23:54:57'),
(69, 'independientepetrolerorealtomayapo.jpg', '2025-09-27 17:33:34'),
(70, 'universitariowilsterman.jpg', '2025-09-29 02:19:44'),
(72, 'guabiraabb.png', '2025-09-30 00:12:18'),
(73, 'universitariorealoruro.jpg', '2025-10-04 03:44:32'),
(74, 'realtomayaposanantoniobulobulo.jpg', '2025-10-05 03:12:26'),
(75, 'thestrongestsanjose.jpg', '2025-10-06 20:20:21'),
(76, 'realoruroabb.jpg', '2025-10-06 20:20:33'),
(77, 'nacionalpotosiuniversitario.jpg', '2025-10-08 03:26:54'),
(78, 'nacionalpotosirealoruro.jpg', '2025-10-11 21:31:19'),
(79, 'universitarioabb.jpg', '2025-10-11 21:31:32'),
(80, 'guabiraaurora.png', '2025-10-12 15:29:22'),
(81, 'orientepetrolerosanjose.jpg', '2025-10-13 03:51:36'),
(82, 'realtomayapoguabira.jpg', '2025-10-17 21:44:05'),
(83, 'thestrongestindependientepetrolero.jpg', '2025-10-17 22:07:42'),
(84, 'bloomingbolivar.jpg', '2025-10-18 19:30:53'),
(85, 'bloomingbolivar2.jpg', '2025-10-18 19:31:29'),
(86, 'alwaysreadyblooming.png', '2025-10-22 18:22:49'),
(87, 'The-Strongest-vs-GV-San-Jose.jpg', '2025-10-23 23:08:43'),
(88, 'sanjosethestrongest.jpg', '2025-10-23 23:09:02'),
(89, 'blooming-vs-guabira-en-vivo.jpg', '2025-10-25 20:55:30'),
(90, 'bloomingguabira.jpg', '2025-10-25 20:55:33'),
(91, 'sanjoseorientepetrolero.jpg', '2025-10-26 19:04:38'),
(92, 'auroraalwaysready.jpg', '2025-10-26 19:04:41'),
(93, 'nacionalpotosivsrealorurobolivia.jpg', '2025-10-27 03:49:13'),
(94, 'wilstermanstrongest.jpg', '2025-10-27 03:49:31'),
(95, 'auroraguabira.jpeg', '2025-10-28 18:30:27'),
(96, 'bloomingalwaysready.jpg', '2025-10-28 18:30:34'),
(97, 'bloomingalwaysready2.jpg', '2025-10-28 18:30:39'),
(98, 'Real-Oruro-vs-Universitario-de-Vinto.jpg', '2025-10-29 19:00:14'),
(99, 'wilstermannsanjose.png', '2025-10-29 23:38:03'),
(100, 'thestrongestyorientepetrolero.jpg', '2025-10-30 20:49:10'),
(101, 'realtomayapoindependiente.jpg', '2025-10-30 20:49:22'),
(102, 'thestrongestoriente.jpg', '2025-10-30 20:54:00'),
(103, 'Real-Tomayapo-vs-Independiente-Petrolero.jpg', '2025-10-30 20:55:28'),
(104, 'bloomingaurora.png', '2025-10-31 18:29:14'),
(105, 'bolivarsanantonio.png', '2025-10-31 18:29:22'),
(106, 'strongestabb.jpg', '2025-11-03 04:02:29'),
(107, 'oriente-petrolero-vs-guabira.jpg', '2025-11-03 04:45:38'),
(108, 'orienteguabira.jpg', '2025-11-03 04:48:05'),
(109, 'bolivaruniversitario.jpg', '2025-11-03 04:56:54'),
(110, 'bolivaruniversitario2.jpg', '2025-11-03 04:56:59'),
(111, 'aurora-vs-independiente-petrolero.jpg', '2025-11-03 04:58:00'),
(112, 'San-Antonio-Bulo-Bulo-vs-Always-Ready.jpg', '2025-11-04 15:45:44'),
(113, 'Nacional-Potosi-vs.-Blooming.jpg', '2025-11-04 15:45:48'),
(114, 'bolivaraurora.jpg', '2025-11-08 04:31:05'),
(115, 'bolivaraurora2.jpg', '2025-11-08 04:31:09'),
(116, 'aurorawilstermann.jpeg', '2025-11-09 17:10:55'),
(117, 'orientepetroleroblooming.jpeg', '2025-11-09 17:11:02'),
(118, 'thestrongestbolivar.jpg', '2025-11-09 17:11:13'),
(119, 'nacionalpotosiorientepetrolero.jpeg', '2025-11-13 04:17:57'),
(120, 'thestrongestaurora.jpeg', '2025-11-13 04:18:03'),
(121, 'Universitario-de-Vinto-vs-Blooming.jpg', '2025-11-13 16:36:43'),
(122, 'copasimonbolivarjunior.jpg', '2025-11-17 17:44:09'),
(123, 'liganacionalsub16.jpg', '2025-11-17 18:13:18'),
(124, 'gvsanjoseaurora.jpeg', '2025-11-21 15:53:16'),
(125, 'independientepetroleroabb.png', '2025-11-21 15:53:21'),
(126, 'wilstermannorientepetrolero.jpg', '2025-11-22 15:06:50'),
(127, 'always-ready-vs-bolivar.jpg', '2025-11-23 17:15:06'),
(128, 'Always-Ready-vs-Bolivar-1024x536.jpg', '2025-11-23 17:15:09'),
(129, 'universitario-de-vinto-vs-nacional-potosi-en-vivo-como-llegan-al-partido_862x485.png', '2025-11-23 17:26:25'),
(130, 'universitarionacionalpotosi.jpg', '2025-11-23 17:26:32'),
(131, 'guabira-vs-san-antonio-bulo-bulo-en-vivo-como-llegan-al-partido_862x485.png', '2025-11-23 17:41:56'),
(132, 'Real-Oruro-vs-Blooming-1024x536.jpg', '2025-11-25 23:40:50'),
(133, 'guabirastrongest.png', '2025-11-26 18:51:13'),
(134, 'ABB-vs-Always-Ready-1024x536.jpg', '2025-11-28 17:04:37'),
(135, 'nacionalpotosiindependientepetrolero.jpg', '2025-11-29 19:26:16'),
(136, 'san-antonio-bulo-bulo-vs-universitario-de-vinto-en-vivo-como-llegan-al-partido_862x485.jpg', '2025-11-29 19:26:30'),
(137, 'guabira-vs-gv-san-jose-en-vivo-como-llegan-al-partido_862x485.jpg', '2025-11-29 19:26:34'),
(138, 'orientepetrolerovsblooming.jpg', '2025-11-30 18:43:46'),
(139, 'the-strongest-vs-bolivar-en-vivo-como-llegan-al-partido_862x485.jpg', '2025-11-30 23:32:32'),
(140, 'independientepetrolerovsguabira.jpeg', '2025-12-02 19:53:25'),
(141, 'real-tomayapo-vs-oriente-petrolero-en-vivo-como-llegan-al-partido_862x485.jpg', '2025-12-03 19:15:41'),
(142, 'bloomingabb.jpeg', '2025-12-03 19:16:27'),
(143, 'bloomingabb2.jpeg', '2025-12-03 19:16:31'),
(144, 'wilstermann-vs-totora-real-oruro-en-vivo-como-llegan-al-partido_862x485.jpg', '2025-12-03 19:17:58'),
(145, 'guabirawilsterman.jpeg', '2025-12-07 06:06:19'),
(146, 'realoruroblooming.jpg', '2025-12-07 06:06:25'),
(147, 'f1.jpeg', '2025-12-07 16:21:46'),
(148, 'independientepetrolerobolivar.jpg', '2025-12-07 17:05:56'),
(149, 'The-Strongest-vs-Always-Ready.png', '2025-12-07 17:06:04'),
(150, 'Aurora-vs-Universitario-de-Vinto-768x402.jpg', '2025-12-07 17:12:46'),
(151, 'san-antonio-bulo-bulo-vs-real-tomayapo-en-vivo-como-llegan-al-partido_862x485.jpg', '2025-12-08 19:04:43'),
(152, 'nacional-potosi-vs-abb-en-vivo-como-llegan-al-partido_862x485.jpg', '2025-12-08 19:07:07'),
(153, 'abborientepetrolero.jpg', '2025-12-11 19:27:28'),
(154, 'realoruronacionalpotosi.jpg', '2025-12-11 19:31:38'),
(155, 'Always-Ready-vs-Guabira.jpg', '2025-12-11 19:36:42'),
(156, 'bolivarsanantoniobulobulo.jpg', '2025-12-11 19:39:45'),
(157, 'realtomayapothestrongest.jpg', '2025-12-11 19:47:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2b$10$yX1mLPoLcBt0OkYIY3W2j.MJKDQiOTuUW3yQMEyfZIFoHRoa5SB9u');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
