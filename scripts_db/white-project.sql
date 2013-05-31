-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.6.11 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             7.0.0.4393
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla white_project.acl_modules
CREATE TABLE IF NOT EXISTS `acl_modules` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`module_id`),
  UNIQUE KEY `module_name` (`module_name`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla white_project.acl_modules: 9 rows
/*!40000 ALTER TABLE `acl_modules` DISABLE KEYS */;
INSERT INTO `acl_modules` (`module_id`, `module_name`) VALUES
	(1, 'default'),
	(2, 'admin'),
	(3, 'users'),
	(5, 'frontend'),
	(26, 'publications'),
	(25, 'projects'),
	(27, 'images'),
	(28, 'developers'),
	(29, 'equipo');
/*!40000 ALTER TABLE `acl_modules` ENABLE KEYS */;


-- Volcando estructura para tabla white_project.acl_permissions
CREATE TABLE IF NOT EXISTS `acl_permissions` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(1) NOT NULL,
  `resource_uid` int(4) NOT NULL,
  `permission` varchar(64) CHARACTER SET latin1 NOT NULL,
  `name` varchar(250) CHARACTER SET latin1 NOT NULL,
  `menu` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`permission_id`),
  KEY `fk_acl_permissions_acl_roles` (`role_id`),
  KEY `fk_acl_permissions_acl_resources1` (`resource_uid`)
) ENGINE=MyISAM AUTO_INCREMENT=395 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla white_project.acl_permissions: 71 rows
/*!40000 ALTER TABLE `acl_permissions` DISABLE KEYS */;
INSERT INTO `acl_permissions` (`permission_id`, `role_id`, `resource_uid`, `permission`, `name`, `menu`) VALUES
	(1, 1, 1, 'index', 'Index', 0),
	(9, 6, 8, 'index', 'frontend', 0),
	(11, 6, 11, 'login', 'login', 0),
	(12, 6, 11, 'logout', 'logout', 0),
	(34, 6, 20, 'index', 'index', 0),
	(36, 1, 22, 'index', 'index users', 0),
	(37, 1, 22, 'add', 'add users', 0),
	(38, 1, 22, 'edit', 'edit users', 0),
	(39, 1, 22, 'delete', 'delete users', 0),
	(40, 1, 22, 'editpassword', 'editPassword User', 0),
	(41, 1, 23, 'index', 'index resources', 0),
	(42, 1, 23, 'add', 'add resources', 0),
	(43, 1, 23, 'edit', 'edit resources', 0),
	(44, 1, 23, 'delete', 'delete resource', 0),
	(45, 1, 24, 'index', 'index roles', 0),
	(46, 1, 24, 'edit', 'edit roles', 0),
	(47, 1, 24, 'delete', 'delete roles', 0),
	(48, 1, 25, 'index', 'index permissions', 0),
	(49, 1, 25, 'edit', 'edit permissions', 0),
	(50, 1, 25, 'delete', 'delete permission', 0),
	(51, 1, 26, 'index', 'index modules', 0),
	(52, 1, 26, 'edit', 'edit modules', 0),
	(53, 1, 26, 'add', 'add modules', 1),
	(54, 1, 26, 'delete', 'delete modules', 0),
	(55, 1, 24, 'add', 'add roles', 1),
	(56, 1, 25, 'add', 'add permissions', 0),
	(58, 1, 1, 'listresources', 'List Resources', 1),
	(59, 1, 1, 'checkconfig', 'Check Config', 1),
	(60, 6, 11, 'loginuser', 'Login User', 1),
	(74, 1, 23, 'listresources', 'List Resources', 1),
	(363, 6, 8, 'contacta', 'contacta', 1),
	(136, 1, 1, 'datadump', 'datadump', 1),
	(138, 1, 1, 'dump', 'dumps', 1),
	(139, 1, 1, 'permissionsdump', 'permissionsdump', 1),
	(140, 1, 1, 'restorepermissionsdump', 'restorepermissionsdump', 1),
	(372, 5, 69, 'toggle', 'toggle', 1),
	(371, 6, 11, 'logoutandback', 'logoutandback', 1),
	(370, 5, 69, 'delete', 'delete', 1),
	(227, 1, 54, 'execute', 'execute', 1),
	(367, 5, 69, 'index', 'index', 1),
	(368, 5, 69, 'add', 'add', 1),
	(369, 5, 69, 'edit', 'edit', 1),
	(233, 1, 55, 'delete', 'delete', 1),
	(234, 1, 55, 'toggle', 'toggle', 1),
	(362, 6, 8, 'premios', 'premios', 1),
	(364, 6, 8, 'detalles', 'detalles', 1),
	(347, 1, 65, 'index', 'index', 1),
	(348, 1, 65, 'dojo', 'dojo', 1),
	(359, 6, 8, 'equipo', 'equipo', 1),
	(360, 6, 8, 'proyectos', 'proyectos', 1),
	(361, 6, 8, 'publicaciones', 'publicaciones', 1),
	(373, 1, 70, 'add', 'add', 1),
	(374, 1, 70, 'edit', 'edit', 1),
	(375, 1, 70, 'delete', 'delete', 1),
	(376, 1, 70, 'index', 'index', 1),
	(377, 1, 72, 'index', 'index', 1),
	(378, 1, 72, 'add', 'add', 1),
	(379, 1, 72, 'edit', 'edit', 1),
	(380, 1, 72, 'delete', 'delete', 1),
	(381, 1, 72, 'resize', 'resize', 1),
	(385, 1, 73, 'index', 'index', 1),
	(383, 1, 73, 'useajax', 'useajax', 1),
	(384, 1, 73, 'usedojojs', 'usedojojs', 1),
	(388, 1, 74, 'index', 'index', 1),
	(387, 1, 69, 'addphotoform', 'addphotoform', 1),
	(389, 1, 74, 'add', 'add', 1),
	(390, 1, 74, 'edit', 'edit', 1),
	(391, 1, 74, 'delete', 'delete', 1),
	(392, 1, 75, 'addphoto', 'addphoto', 1),
	(393, 1, 75, 'deletephoto', 'deletephoto', 1),
	(394, 1, 75, 'reloadgallery', 'reloadgallery', 1);
/*!40000 ALTER TABLE `acl_permissions` ENABLE KEYS */;


-- Volcando estructura para tabla white_project.acl_resources
CREATE TABLE IF NOT EXISTS `acl_resources` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `resource` varchar(64) CHARACTER SET latin1 NOT NULL,
  `name_r` varchar(250) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `resource` (`resource`),
  KEY `fk_acl_resources_acl_modules1` (`module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla white_project.acl_resources: 17 rows
/*!40000 ALTER TABLE `acl_resources` DISABLE KEYS */;
INSERT INTO `acl_resources` (`uid`, `module_id`, `resource`, `name_r`) VALUES
	(1, 2, 'admin:index', 'Admin'),
	(8, 5, 'frontend:index', 'Frontend'),
	(11, 3, 'users:author', 'Author'),
	(20, 1, 'default:index', 'index'),
	(22, 3, 'users:index', 'Users'),
	(23, 3, 'users:resources', 'resources'),
	(24, 3, 'users:roles', 'roles'),
	(25, 3, 'users:permissions', 'permissions'),
	(26, 3, 'users:modules', 'modules'),
	(54, 2, 'admin:cli', 'cli'),
	(65, 2, 'admin:optimize', 'optimize'),
	(69, 25, 'projects:index', 'index'),
	(70, 26, 'publications:index', 'index'),
	(72, 27, 'images:index', 'index'),
	(73, 28, 'developers:index', 'index'),
	(74, 29, 'equipo:index', 'index'),
	(75, 25, 'projects:ajax', 'ajax');
/*!40000 ALTER TABLE `acl_resources` ENABLE KEYS */;


-- Volcando estructura para tabla white_project.acl_roles
CREATE TABLE IF NOT EXISTS `acl_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(64) CHARACTER SET latin1 NOT NULL,
  `role_parents` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `prefered_uri` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role_name` (`role_name`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla white_project.acl_roles: 3 rows
/*!40000 ALTER TABLE `acl_roles` DISABLE KEYS */;
INSERT INTO `acl_roles` (`role_id`, `role_name`, `role_parents`, `prefered_uri`) VALUES
	(1, 'Implementor', '5', 'admin'),
	(5, 'Administrator', '6', 'projects'),
	(6, 'Everyone', '0', '0');
/*!40000 ALTER TABLE `acl_roles` ENABLE KEYS */;


-- Volcando estructura para tabla white_project.acl_users
CREATE TABLE IF NOT EXISTS `acl_users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(4) NOT NULL,
  `user_name` varchar(64) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `password` varchar(250) CHARACTER SET latin1 NOT NULL,
  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `email` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '0',
  `person_id` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `validation_code` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `phone` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla white_project.acl_users: 4 rows
/*!40000 ALTER TABLE `acl_users` DISABLE KEYS */;
INSERT INTO `acl_users` (`uid`, `role_id`, `user_name`, `password`, `date`, `email`, `status`, `person_id`, `validation_code`, `phone`) VALUES
	(1, 1, 'Agustín Calderón', '1b51bc5fa5a990a0519ba9a01d8c18f92f241c849e5a442113d67db623ee593c', '2009-05-25 00:00:00', 'agustincl@gmail.com', 1, '0', '0', '687 780 786'),
	(2, 6, 'Guest', '', '0000-00-00 00:00:00', '0', 0, '0', '0', '0'),
	(3, 5, 'jdvdp', '1b51bc5fa5a990a0519ba9a01d8c18f92f241c849e5a442113d67db623ee593c', '0000-00-00 00:00:00', 'suombuel@gmail.com', 1, '0', '0', '687 780 786'),
	(5, 7, 'Adriá Lahuerta', 'c3e249fdaabe65a2a7b8a3d4e6d8e29ea3c444817d38b12c03e3979c4e7e8089', '2009-08-26 12:43:09', 'calvarez@iptours.com', 1, '0', '0', '12345');
/*!40000 ALTER TABLE `acl_users` ENABLE KEYS */;


-- Volcando estructura para tabla white_project.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_eng` varchar(100) COLLATE utf8_bin NOT NULL,
  `category_esp` varchar(100) COLLATE utf8_bin NOT NULL,
  `category_cat` varchar(100) COLLATE utf8_bin NOT NULL,
  `category_short` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla white_project.categories: 10 rows
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `category_eng`, `category_esp`, `category_cat`, `category_short`) VALUES
	(1, 'Planeamiento', 'Planeamiento', 'Planeamiento', 'planeamiento'),
	(2, 'Parques y jardines', 'Parques y jardines', 'Parques y jardines', 'parques_y_jardines'),
	(3, 'Paisaje', 'Paisaje', 'Paisaje', 'paisaje'),
	(4, 'Diseño urbano', 'Diseño urbano', 'Diseño urbano', 'diseno_urbano'),
	(5, 'Mobiliario urbano', 'Mobiliario urbano', 'Mobiliario urbano', 'mobiliario_urbano'),
	(6, 'Interiorismo', 'Interiorismo', 'Interiorismo', 'interiorismo'),
	(7, 'Nueva planta', 'Nueva planta', 'Nueva planta', 'nueva_planta'),
	(8, 'Rehabilitación', 'Rehabilitación', 'Rehabilitación', 'rehabilitacion'),
	(9, 'Efímeros', 'Efímeros', 'Efímeros', 'efimeros'),
	(10, 'Diseño', 'Diseño', 'Diseño', 'diseno');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;


-- Volcando estructura para tabla white_project.contacta
CREATE TABLE IF NOT EXISTS `contacta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contacto_esp` text COLLATE utf8_bin NOT NULL,
  `contacto_eng` text COLLATE utf8_bin,
  `contacto_cat` text COLLATE utf8_bin,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla white_project.contacta: 0 rows
/*!40000 ALTER TABLE `contacta` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacta` ENABLE KEYS */;


-- Volcando estructura para tabla white_project.equipo
CREATE TABLE IF NOT EXISTS `equipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipo_esp` text COLLATE utf8_bin,
  `equipo_eng` text COLLATE utf8_bin,
  `equipo_cat` text COLLATE utf8_bin,
  `photo` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '				',
  `description_esp` text COLLATE utf8_bin,
  `description_eng` text COLLATE utf8_bin,
  `description_cat` text COLLATE utf8_bin,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla white_project.equipo: 1 rows
/*!40000 ALTER TABLE `equipo` DISABLE KEYS */;
INSERT INTO `equipo` (`id`, `equipo_esp`, `equipo_eng`, `equipo_cat`, `photo`, `description_esp`, `description_eng`, `description_cat`) VALUES
	(1, '<div><b>JANSANA, DE LA VILLA, DE PAAUW, ARQUITECTES</b> es un estudio de arquitectura establecido en Barcelona dedicado al paisajismo, el diseño urbano, el urbanismo, la edificación, el interiorismo y la rehabilitación. Desarrolla sus proyectos a partir de una dilatada experiencia de más de 20 años de actividad trabajando tanto para la administración pública como para el sector privado.</div><div> </div><div>Imma Jansana, Conchita de la Villa y Robert de Paauw son los arquitectos asociados integrantes de la dirección del equipo que, siempre desde una perspectiva multidisciplinar, ha desarrollado entre otros el <b>Plan Director de las Zonas Verdes de Vitoria-Gasteiz</b>, la <b>Consolidación del entorno del Mesón Gitano en la Alcazaba de Almería</b>, la <b>Restauración del camino de acceso a la Cripta Güell</b> en Sta Coloma de Cervelló, la construcción de la <b>Nueva Gran Via l’Hospitalet</b>, el <b>Parque de la Clota</b> en Sabadell, los <b>Jardines de Rodrigo Caro</b> en Barcelona o el <b>Casal de barri Verdun</b> en Barcelona.</div><div> </div><div>Actualmente trabaja en el  <b>Equipamiento para los nuevos Vestuarios de la Zona Deportiva de la Devesa</b> en Girona, el <b>Parque del Molí de l’Amat </b>en Sabadell, <b>Ecoducto y balsas de retención en el Corredor Verde</b> de Cerdañola del Vallés o el <b>Parque litoral</b> en el Prat de Llobregat, entre otros.</div>', '<div><div><b>JANSANA, DE LA VILLA, DE PAAUW, ARQUITECTES</b>, is an architectural firm established in Barcelona, dedicated to landscape architecture, urban design, town planning, building, interior design and rehabilitation. The projects are developed from a vast experience of more than 20 years of activity working for both public administration and private sector.</div><div><br /></div><div>Imma Jansana, Conchita de la Villa and Robert de Paauw are the associated architects members of the management team that has carried out, always with a multi-disciplinary perspective, projects such as the <b>Master Plan Green Zones in Vitoria-Gasteiz</b>, the <b>Consolidation of the environments in Gitano Mesón next to the Alcazaba</b> of Almeria, the <b>Restoration of the access path to the Crypt Güell</b> in Santa Coloma de Cervello, the construction of the <b>New Gran Via l\'Hospitalet</b>, the Park Clota in Sabadell, the Rodrigo Caro Gardens in Barcelona or the Civic Center Verdun in Barcelona.</div><div><br /></div><div>Currently working on new the <b>New Dressing Rooms for the Sports Zone of  Devesa</b> in Girona, <b>Park of Molí de l’Amat</b> in Sabadell, <b>Ecoduct and retention ponds at a Green Corridor</b> in Cerdañola or <b>Coastline Park</b> in El Prat de Llobregat, among others.</div></div>', '<div><b>JANSANA, DE LA VILLA, DE PAAUW, ARQUITECTES</b> és un estudi d’arquitectura establert a Barcelona dedicat al paisatgime, el disseny urbà, l’urbanisme, l’edificació, l’interiorisme i la rehabilitació. Desenvolupa els seus projectes a partir d’una dilatada experiència de més de 20 anys d’activitat treballant tan per l’administració pública com pel sector privat.</div><div> </div><div>Imma Jansana, Conchita de la Villa i Robert de Paauw són els arquitectes associats integrants de la dirección de l’equip que, sempre des d’una perspectiva multidisciplinar, ha realitzat entre d’altres, projectes com el <b>Pla Director de les Zones Verdes de Vitòria-Gasteiz</b>, la <b>Consolidació de l’entorn del Mesón Gitano a l’Alcazaba d’Almeria</b>, la <b>Restauració del camí d’accès a la Cripta Güell</b> a Sta Coloma de Cervelló, la construcció de la <b>Nova Gran Via l’Hospitalet</b>, el <b>Parc de la Clota</b> a Sabadell, els <b>Jardins de Rodrigo Caro</b> a Barcelona o el <b>Casal de barri Verdum</b> a Barcelona.</div><div> </div><div>Actualment treballa en l’<b>Equipament per els nous vestidors de la Zona esportiva de la Devesa</b> a Girona, el <b>Parc del Molí de l’Amat</b> a Sabadell, en l’<b>Ecoducte i basses de retenció al Corredor Verd</b> de Cerdanyola del Vallés o el <b>Parc litoral</b> en el Prat de Llobregat.</div>', 'foto despatx mitja.jpg', 'De derecha a izquierda: Robert de Paauw, arquitecto; Carlota Socías, arquitecta; Imma Jansana, arquitecta; Toni Abelló, arquitecto; Betta Canepa, arquitecta; Barbara Hellin, arquitecta; Loli Casaus, administración; Conchita de la Villa Rivière, arquitecta', '', '');
/*!40000 ALTER TABLE `equipo` ENABLE KEYS */;


-- Volcando estructura para tabla white_project.prices
CREATE TABLE IF NOT EXISTS `prices` (
  `id` int(11) NOT NULL,
  `price` varchar(45) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  `year` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla white_project.prices: 0 rows
/*!40000 ALTER TABLE `prices` DISABLE KEYS */;
/*!40000 ALTER TABLE `prices` ENABLE KEYS */;


-- Volcando estructura para tabla white_project.projects
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `short_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `status` int(1) DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8_bin NOT NULL,
  `images` text COLLATE utf8_bin NOT NULL,
  `year` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `area` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `presupuesto` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `map` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `categories_id` int(11) NOT NULL,
  `photos` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `project_esp` varchar(255) COLLATE utf8_bin NOT NULL,
  `place_esp` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `description_esp` text COLLATE utf8_bin,
  `premios_esp` text COLLATE utf8_bin,
  `cliente_esp` text COLLATE utf8_bin,
  `associates_esp` text COLLATE utf8_bin,
  `colaborators_esp` text COLLATE utf8_bin,
  `consultors_esp` text COLLATE utf8_bin COMMENT '	',
  `constructor_esp` text COLLATE utf8_bin,
  `pdf_esp` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `project_cat` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `place_cat` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `description_cat` text COLLATE utf8_bin,
  `premios_cat` text COLLATE utf8_bin,
  `cliente_cat` text COLLATE utf8_bin,
  `associates_cat` text COLLATE utf8_bin,
  `colaborators_cat` text COLLATE utf8_bin,
  `consultors_cat` text COLLATE utf8_bin,
  `constructor_cat` text COLLATE utf8_bin,
  `pdf_cat` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `project_eng` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `place_eng` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `description_eng` text COLLATE utf8_bin,
  `premios_eng` text COLLATE utf8_bin,
  `cliente_eng` text COLLATE utf8_bin,
  `associates_eng` text COLLATE utf8_bin,
  `colaborators_eng` text COLLATE utf8_bin,
  `consultors_eng` text COLLATE utf8_bin,
  `constructor_eng` text COLLATE utf8_bin,
  `pdf_eng` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `short_name_UNIQUE` (`short_name`),
  KEY `fk_projects_categories1` (`categories_id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla white_project.projects: 13 rows
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` (`id`, `short_name`, `status`, `thumbnail`, `images`, `year`, `area`, `presupuesto`, `map`, `categories_id`, `photos`, `project_esp`, `place_esp`, `description_esp`, `premios_esp`, `cliente_esp`, `associates_esp`, `colaborators_esp`, `consultors_esp`, `constructor_esp`, `pdf_esp`, `project_cat`, `place_cat`, `description_cat`, `premios_cat`, `cliente_cat`, `associates_cat`, `colaborators_cat`, `consultors_cat`, `constructor_cat`, `pdf_cat`, `project_eng`, `place_eng`, `description_eng`, `premios_eng`, `cliente_eng`, `associates_eng`, `colaborators_eng`, `consultors_eng`, `constructor_eng`, `pdf_eng`) VALUES
	(2, 'zonas_verds_hospitalet', 1, '7', 'av_carrilet_bis.jpg,avda_carrilet.jpg,marti_codolar_buses_final.jpg,planol_1.jpg,planol_2.jpg,planol_3.jpg,s.eulalia_torder.jpg,sta_eulalia.jpg', '2005', '', '', '', 1, '', 'PLAN DIRECTOR DELS ESPAIS VERDS DE L’HOSPITALET', 'L’Hospitalet de Llobregat', 'Modelo definitorio de las líneas de trabajo básicas que puedan marcar las actuaciones en las zonas verdes en los próximos años, teniendo en cuenta vectores tan diversos como el urbanismo y el paisaje, los flujos que afectan al medio ambiente, la biodiversidad y también los aspectos sociales de relación y participación para promover campañas de fomento del comportamiento cívico y respetuoso con el medio.', '', 'Ayuntamiento de L\'Hospitalet', 'Matèria Verda S.L., Martí Boada, geógrafo;  Joan Rieradevall, doctor en Ciencias químicas.', '', '', '', '', 'PLA DIRECTOR DELS ESPAIS VERDS DE L’HOSPITALET', 'L’Hospitalet de Llobregat', 'Model definitori de les línies de treball bàsiques que puguin marcaran les actuacions en zones verdes en els propers anys, tot tenint en compte vectors tan diversos com l\\\'urbanisme i el paisatge, els fluxos que afecten al medi ambient, la biodiversitat i també els aspectes socials de relació i participació per tal de promoure campanyes de foment del comportament cívic i respectuós amb el medi.\r\n\r\nL\\\'estudi per a la definició del model verd de l\\\'Hospitalet ha requerit fer una radiografia de la realitat de l\\\'Hospitalet. De primer s\\\'han analitzat les dades generals de ciutat (geogràfiques, demogràfiques i econòmiques) i desprès, la situació dels vectors que afecten el model: estat de la gestió i manteniment de les zones verdes, urbanisme i política ambiental del municipi.\r\n\r\nEl model de gestió que es proposa per les zones verdes de l’Hospitalet es concreta en “una gestió eficaç i eficient, cívicament exemplar, focalitzada a crear un sistema verd viu, racional, cohesionat i de qualitat, que sigui proper, accessible i viscut per les persones i que contribueixi a la millora de la qualitat ambiental de l\\\'Hospitalet”.\r\n\r\nL\\\'anàlisi de la disposició dels parcs, jardins, petit verd i espais lliures sobre el territori de la ciutat  ens ha permès trobar la clau per desenvolupar un projecte de connexió paisatgístic a través d\\\'una trama triangular. \r\nUn gran triangle de relació d\\\'espais verds, format per la Cornisa Verda 5, la Rambla de la Marina i la Gran Via  que actuï com al centre d\\\'una retícula que relacioni la resta d\\\'espais verds de la ciutat.\r\n\r\nPropostes que es consideren crítiques per tal d\\\'aconseguir l\\\'objectiu són:\r\n\r\n•	Tenir un marc organitzatiu més àgil i a ser possible, amb ingressos propis.\r\n•	Implantar polítiques de racionalització, modernització, reconversió i normativització del manteniment del verd urbà.\r\n•	Adaptar la gestió i manteniment de les zones verdes urbanes als criteris de desenvolupament sostenible.\r\n•	Aconseguir una identitat de paisatge pròpia per l\\\'Hospitalet.\r\n•	Promoure el coneixement i ús de la oferta verda del municipi.\r\n•	Augmentar les hectàrees de zona verda urbana.', '', 'Ajuntament de l’Hospitalet', 'Matèria Verda SL; Martí Boada, geògraf; Joan Rieradevall, doctor en ciències químiques', '', '', '', '', 'MASTER PLAN FOR THE GREEN ZONES IN L\'HOSPITALET', 'L\'Hospitalet de Llobregat', 'Model defining the basic lines of work that can make the proceedings in the green areas in the coming years, given vectors as diverse as urban planning and landscape, the flows that affect the environment, biodiversity and social aspects relationship and engagement to promote campaigns to promote civic responsibility and environmentally friendly.\r\n\r\nThe study for the definition of the green model of L\'Hospitalet have requested an X-ray of the reality of L\'Hospitalet. First we have analyzed the city\\\'s general data (geographic, demographic and economic) and then the situation of the vectors that affect the model: state of the management and maintenance of green areas, urban development and municipal environmental policy.\r\n\r\nThe management model proposed for the green areas in L\'Hospitalet is specified in "an effective and efficient management, civic issue, focused on creating a vivid green, rational, cohesive quality that is close, accessible and lived for people and contribute to improving the environmental quality of L\'Hospitalet.\r\n\r\nThe analysis of the provision of parks, gardens, small green and open space over the territory of the city has allowed us to find the key to developing a draft landscape connection through a triangular pattern.\r\nA large triangular relationship of green space, formed by the cornice Verde 5, the Rambla de la Marina and Gran Via acting as the center of a grid linking the rest of the city\'s green spaces.\r\n\r\nProposals that are considered critical to achieving the goal are:\r\n\r\n• Have a more flexible organizational framework and, if possible, their own income.\r\n• Implement policies of rationalization, modernization, conversion and standardization of maintenance of urban green spaces.\r\n• Adapt the management and maintenance of urban green areas to sustainable development criteria.\r\n• Obtain an identity for itself Hospitalet landscape.\r\n• Promote awareness and use of green supply the municipality.\r\n• Increase the acres of urban parkland.', '', 'L\'Hospitalet City Council', '', 'Matèria Verda SL, Martí Boada, geographer, Joan Rieradevall, chemical D.Sc.', '', '', ''),
	(3, 'miguel_servet', 1, 'thumbnail.jpg', '2007-Parque_Miguel_Servet_1.jpg,2007-Parque_Miguel_Servet_2.jpg,2007-Parque_Miguel_Servet_3.jpg,2007-Parque_Miguel_Servet_4.jpg,2007-Parque_Miguel_Servet_5.jpg,2007-Parque_Miguel_Servet_6.jpg,as043.jpg,as044.jpg,esq.1.circulacion.jpg,esq.1.drenajes.jpg,esq.1.pavimento.jpg,esq.1.usos.jpg,esq.1.zonas.jpg,esq.2.contexto.jpg', '2007', '7 Ha', '9 millones €', '', 1, '', 'PLAN DIRECTOR DEL PARQUE MIGUEL SERVET', 'Huesca', 'El parque de Miguel Servet se ha ido formalizando a través de los años a partir de diferentes actuaciones, que lejos de dar unidad al conjunto se han establecido cada una de ellas por separado con intención de conformar un parque nuevo dentro del parque original. Es por eso que nuestra propuesta contempla como principio básico el de identificar todas las partes del lugar para así poder dotar al parque de diferentes usos desde una perspectiva global.', 'XII PREMIO NACIONAL DE LA ASOCIACIÓN ESPAÑOLA DE PARQUES Y JARDINES PÚBLICOS', 'Ayuntamiento de Huesca', 'Matèria Verda, SL', '', '', '', '', 'PLA DIRECTOR DEL PARC MIQUEL SERVET', 'Osca', 'El parc Miquel Servet s’ha anat formalitzant en el temps a partir de diferents actuacions que, lluny de donar d’unitat al conjunt, s’han establert cada una d’elles per separat amb la intenció de conformar un nou parc dins el parc original. És per això que la nostra proposta contempla com a principi bàsic el d’identificar totes les parts del lloc per poder dotar al parc de diferents usos des d’una perspectiva global.', 'XII PREMI NACIONAL DE LA ASOCIACIÓ ESPANYOLA DE PARCS I JARDINS PÚBLICS', 'Ayuntamiento de Huesca', 'Matèria Verda, SL', '', '', '', '', 'MASTER PLAN FOR THE PARC MIGUEL SERVET', 'Huesca', 'Miguel Servet Parc  has been formalized through the years through different performances. Far from giving the whole unit has been established each of them separately with the intention of forming a new park within the original park. That is why our proposal provides the basic principle of identifying all the parts of the site in order to provide the park of different uses from a global perspective. Defined as the first original structure to maintain, restore and propose more far-reaching actions in the surrounding areas which correspond to both sides the north and south parts of the park. In the northern sector, and replacing what is now an amalgam of different deteriorated elements, the proposal is to remodel the landscape of pine trees through unification, consolidation of tree species and understory for comprehensive treatment to provide a space for walking-being and living unit. In the south, however, the main area of activities is focused  with fairs and sporting uses toghether with a  new and relocated Park Bar.', 'XII NATIONAL AWARD OF THE SPANISH ASSOCIATION OF PUBLIC PARKS AND GARDENS', 'City Hall of Huesca', 'Matèria Verda, SL', '', '', '', ''),
	(4, 'prat_nord', 1, 'thumbnail.jpg', '1.jpg,2.jpg,3.jpg,4.jpg,5.jpg,6.jpg,7.jpg,8.jpg', '2008', '160 Ha', '', '', 1, '', 'PRAT NORD - CONCURSO RESTRINGIDO', 'El Prat de Llobregat', 'Un ensanche en el Delta del Llobregat. Un ensanche bisagra entre el parque agrario y la ciudad actual; un modelo que sale de la complejidad del paisaje del Delta del Llobregat, donde confluyen continuidad urbana, reencuentro de estructuras agrarias, flexibilidad y adaptabilidad de la trama urbana, superposición de usos, máxima accesibilidad, sostenibilidad ambiental y  complexión urbana.', 'MENCION DE HONOR POR LA PROPUESTA PAISAJISTICA', 'Ayuntamiento de El Prat de Llobregat e INCASOL', 'H+N+S Landschapsarchitecten\r\nJaume Artigues - Jordi Henrich, arquitectos\r\nAAUP, Jordi Romero i Asociados\r\nTaller de Ingeniería Ambiental, SL.', '', '', '', '', 'PRAT NORD - CONCURS RESTRINGIT', 'El Prat de Llobregat', 'Un eixample al Delta del Llobregat Un eixample frontissa entre el parc agrari i la ciutat actual. Un model que surt de la complexitat del paisatge del Delta del Llobregat, on conflueixen continuïtat urbana, retrobament d’estructures agràries, flexibilitat i adaptabilitat de la trama urbana, superposició d’usos, màxima accessibilitat, sostenibilitat ambiental i complexió urbana. Una estructura urbana amb una doble matriu.', 'MENCIÓ D’HONOR PER LA PROPOSTA PAISATGÍSTICA', 'Ajuntament de El Prat de Llobregat i INCASOL', 'H+N+S Landschapsarchitecten\r\nJaume Artigues - Jordi Henrich, arquitectes\r\nAAUP, Jordi Romero i Associats\r\nTaller de Ingenieria Ambiental, SL', '', '', '', '', 'PRAT NORD - RESTRICTED COMPETITION', 'El Prat de Llobregat', 'A urban grid in the Delta of the Llobregat river. A urban grid hinge between the agraric park  and the actual city, a model that comes from the complexity of the landscape of the Delta of the Llobregat, at the confluence of urban continuity, reunion of agricultural structures, flexibility and adaptability of the urban fabric, overlapping uses, maximazing accessibility , environmental sustainability and urban complexion. An urban structure with a double array.', 'HONORABLE MENTION FOR LANDSCAPE PROPOSAL', 'City hall of El Prat de Llobregat & INCASOL', 'H+N+S Landschapsarchitecten\r\nJaume Artigues & Jordi Henrich, architects\r\nAAUP, Jordi Romero & Partners\r\nTaller de Ingeniería Ambiental, SL', '', '', '', ''),
	(5, 'gava', 1, 'thumbnail.jpg', '1990-1993-Gava_1.jpg,1990-1993-Gava_1a.jpg,1990-1993-Gava_3.jpg,24_508_3.jpg,24_509_3.jpg,24_509_4.jpg,24_510_1.jpg,24_510_2.jpg,2473CA_1.jpg,2474CA_1.jpg,24F2CA_1.jpg,24F4CA_1.jpg,diapo033.jpg,FILE0007.jpg,IMG0040.jpg,SSL29725.JPG,SSL29727.JPG,SSL29728.JPG,SSL29729.JPG,SSL29732.JPG,SSL29733.JPG,SSL29734.JPG', '1993', '2,5 Ha', '', '', 3, '', 'PASEO MARITIMO DE GAVA-MARINAS', 'Gavá', 'El Paseo Marítimo de Gavá  se halla situado en la zona más occidental del Delta del Llobregat,  Se trataba de un espacio con un especial interés paisajístico, uno de los últimos reductos de ecosistema dunar, del cual el proyecto de paseo marítimo se propuso asegurar su pervivencia.', '1993 PREMIO FAD ESPACIOS EXTERIORES\r\n1995 FINALISTA EN LA III BIENAL DE ARQUITECTURA ESPAÑOLA', 'Ayuntamiento de Gavà\r\nVertix, SA', '', 'Josep Lascurain, biólogo\r\nFernando Castillo, arquitecto técnico\r\nFernando Benedicto, arquitecto técnico', '', 'TAU-ICESA', '', 'PASSEIG MARÍTIM DE GAVÀ- MARINES', 'Gavà', 'El Passeig Marítim de Gavà està situat a la zona més occidental del Delta del Llobregat.\r\nEra un espai d\'un especial interès paisatgístic, un dels darrers reductes d’ecosistemes dunars del Delta del Llobregat, del que el projecte de passeig marítim es proposà assegurar-ne la seva pervivència.', '1993 PREMI FAD ESPAIS EXTERIORS\r\n1995 FINALISTA A LA III BIENNAL  D’ARQUITECTURA ESPANYOLA', 'Ajuntament de Gavà\r\nVertix S.A.', '', 'Josep Lascurain, Biòleg\r\nFernando Castillo, arquitecto tècnic\r\nFernando Benedicto, arquitecto tècnic', '', 'TAU-ICESA', '', 'WATERFRONT PROMENADE OF GAVA-MARINAS', 'Gavà', 'The waterfront promenade of Gavà is located on the westernmost part of the Delta of the Llobregat River.\r\nIt was an area with a special landscape interest, one of the last strongholds of the dune ecosystem, reality that was  proposed to be ensured in this project . \r\nThe project was drawn up respecting and enhancing the natural elements, which played a crucial role in designing the new lines. The aim was to maintain the environmental characteristics of the dune systems.', '1993 FAD AWARD FOR LANDSCAPE DESIGN\r\n1995 FINALIST IN THE SPANISH ARCHITECTURE BIENNIAL III', 'City of Gava\r\nVertix SA', '', 'Josep Lascurain, biologist\r\nFernando Castillo, Technical Architect\r\nFernando Benedicto, Technical Architect', '', 'TAU-ICESA', ''),
	(6, 'corredor_verd', 1, 'thumbnail.jpg', '1.jpg,2.jpg,3.jpg,4.jpg,5.jpg,6.jpg,7.jpg,8.jpg,9.jpg', '2009', '139 Ha', '', '', 3, '', 'CORREDOR VERDE DE CERDANYOLA - CONCURSO RESTRINGIDO', 'Cerdanyola del Vallés', 'La transformación territorial del Vallés entre los últimos cincuenta años ha sido enorme. La trama paisajística que ha imperado durante siglos se ha hundido. Sobran coartadas para no coser este tejido tan maltratado. También motivaciones para intentarlo. Sin perder de vista, sin embargo, que las actuaciones de sutura tienen que haber entendido la lógica matricial a rescatar y tienen que ser compatibles con otras acciones realmente abordables en el futuro. El corredor del Centro Direccional del Vallés tiene que tener sentido en sí mismo y tiene que hacer de puente entre orillas verdaderas. En el espacio y en el tiempo.', 'MENCION POR LA PROPUESTA DEL PASO DE FAUNA Y BALSAS DE LAMINACION', 'Consorcio Urbanístico del Centro Direccional de Cerdañola del Vallés', 'ERF Estudi Ramon Folch, gestió i comunicació ambiental\r\nZETA INGENIEROS, ingenieros calculistas de estructuras\r\nRoser Vives, ingeniera agrónoma', '', '', '', '', 'CORREDOR VERD A CERDANYOLA - CONCURS RESTRINGIT', 'Cerdanyola del Vallès', 'La transformació territorial del Vallès ens els darrers cinquanta anys ha estat enorme. La trama paisatgística que hi ha imperat durant segles s’ha esfondrat. Sobren coartades per a no cosir aquest teixit tan maltractat. També motivacions per a intentar-ho. Sense perdre de vista, però, que les actuacions de sutura han d’haver entès la lògica matricial a rescatar i han de ser compatibles amb altres accions realment abordables en el futur. El corredor del Centre Direccional del Vallès ha de tenir sentit en ell mateix i ha de fer de pont entre ribes veritables. En l’espai i en el temps.', 'MENCIÓ PER LA PROPOSTA DEL PAS DE FAUNA i DE LES BASSES DE LAMINACIÓ', 'Consorci Urbanístic del Centre Direccional de Cerdanyola del Vallès', 'ERF Estudi Ramon Folch, gestió i comunicació ambiental\r\nZETA INGENIEROS, enginyers calculistes d’estructures \r\nRoser Vives , enginyera agrònoma', '', '', '', '', 'GREEN CORRIDOR RESTRICTED COMPETITION ', 'MENTION WITH THE PROPOSAL BY THE ECODUCT AND LAMINATING PONDS', 'Vallés territorial transformation among the last fifty years has been enormous. The landscape pattern that has prevailed for centuries has collapsed. There are so many opportunities for sewing this landscape so mistreated. Also reasons to try. Without losing sight, however, that the actions of suture must have understood the logic array to the rescue and must be consistent with other actions affordable in the future. The Green corridos of the Vallès Directional Centre has to make sense in itself and has to make a bridge between real banks. In space and time. Therefore, we intend to address the design according to an encapsulation of philosophies, delivery and performance scales appropriate to each case. Philosophy of action:. .Prevent genetic isolation of populations and System Collserola Coastal populations to Sant Llorenç de Munt and Prelitoral System. This is not only failing to ensure the traffic of large vertebrates, but gene flow from all species.', 'MENTION WITH THE PROPOSAL BY THE ECODUCT AND LAMINATING PONDS', 'Urbanistic Consortium Directional Centre of Cerdanyola del Vallès', 'ERF Estudi Ramon Folch, management and environmental communication\r\nZETA INGENIEROS, structural engineers calculators\r\nRoser Vives, agronomist', '', '', '', ''),
	(7, 'angel_guimera', 1, 'thumbnail.jpg', '1143_0_1.jpg,1143_0_2.jpg,1143_0_3.jpg,1144_0_1.jpg,1144_0_2.jpg,1144_0_4.jpg,117F94_1.jpg,1998-Angel_Guimera_1.jpg,1998-Angel_Guimera_1a.jpg,DETALL.jpg', '1999', '2312 m2', '246.400 €', '', 2, 'Lourdes Jansana', 'JARDINES DE ÀNGEL GUIMERÀ', 'Barcelona', 'Se trataba de unos jardines privados abandonados situados en el interior de un patio de manzana del casco viejo de El Prat de Llobregat y de un solar vacío a través del cual se debía acceder a los mismos.', 'FINALISTA PREMIOS FAD AÑO 2000 ESPACIOS EXTERIORES\r\nSeleccionada para la 1ª Bienal del paisaje de Barcelona 1999', 'Ayuntamiento de El Prat de Llobregat', '', 'Fernando Benedicto, arquitecto técnico\r\nJosé Manuel Arenales, arquitecto técnico\r\nJosep Selga, biólogo\r\nPau Esteban, biólogo\r\nRobert de Paauw, estudiante de arquitectura\r\nSandra Llovet, estudiante de arquitectura\r\nServicio de Urbanismo del Ayuntamiento de El Prat de Llobregat', '', 'SEPISA', '', 'JARDINS D’ÀNGEL GUIMERÀ', 'Barcelona', 'Es tractava d\'uns jardins privats abandonats situats a l\'interior d\'un pati d\'illa del casc antic del Prat de Llobregat i d\'un solar buit a través del qual s’havia d’accedir a aquests.  D\'una banda teníem els antics jardins amb una vegetació molt frondosa formada per espècies de fruiters de prunus, figueres, llorers, acàcies i amb arbres d\'especial interès per la seva mida i port com eren unes quantes palmeres canariensis. Tot el sòl es trobava entapissat d’acants i enfiladisses.\r\n Aquest jardí havia estat abandonat durant uns 20 anys i havia arribat a establir un ecosistema propi que li permetia una vida vegetativa autònoma. Es podia considerar que ens trobàvem davant d\'un hàbitat absolutament adaptat al clima mediterrani del Prat.', 'FINALISTA PREMIS FAD ANY 2000 ESPAIS EXTERIORS\r\nSeleccionat per a la 1ª Bienal del paisatge de Barcelona 1999', 'Ajuntament del Prat de Llobregat', '', 'Fernando Benedicto, arquitecte tècnic\r\nJosé Manuel Arenales, arquitecte tècnic\r\nJosep Selga, biòleg	\r\nPau Esteban, biòleg\r\nRobert de Paauw, estudiant d’arquitectura\r\nSandra Llovet, estudiante d’arquitectura\r\nServei d’Urbanisme de l’Ajuntament del Prat de Llobregat', '', 'SEPISA', '', '', '', '', '', '', '', '', '', '', ''),
	(8, 'rodrigo_caro', 1, 'thumbnail.jpg', '_N7X5768+69.jpg,_N7X5798+99.jpg,_N7X5810+11.jpg,_N7X5901+02-v1.jpg,_N7X5922+23.jpg,_N7X6335+36.jpg,_N7X6339+40.jpg,_N7X6375+76.jpg,_N7X6415+16.jpg,_N7X6415+16a.jpg,_N7X6429+30.jpg,_N7X6436+37.jpg,esq.1.zonas.jpg,_N7X6438.jpg,_N7X6447+48.jpg,_N7X6455+56.jpg,1.situacio.jpg,2.plantes.jpg,2005-2006-jardins_ rodrigo_caro_2.jpg,2005-2006-jardins_rodrigo_caro_1.jpg,Dibuix_2.jpg,esbos.jpg,general_-_ foto_robert_de_paauw.jpg,jocs_infantils_-_robert_de_paauw.jpg', '2007', '5.250 m2', '850.000 €', '', 2, '', 'JARDINES RODRIGO CARO', 'Barcelona', 'El emplazamiento de los jardines es el solar resultante del alargamiento de la calle Rodrigo Caro, antes sin salida y hoy conectado en la calle Artesanía. De esta manera se creó un espacio verde con una topografía bastante pronunciada, con 21 metros de desnivel repartidos en algunas plataformas probablemente heredadas de la construcción del nuevo tramo de calle y que originariamente se utilizaban unas como aparcamiento y otras como huertos por parte de los vecinos.', '', 'PRONOBA,SA\r\nAyuntamiento de Barcelona ”Pla de Barris”', '', 'Jordi Fàbregas, maestro jardinero\r\nJosep Selga, biólogo\r\nCarolina Sendra, engeniera técnica agrícola\r\nTaller de Ingenieria Ambiental, SL\r\nFernando Benedicto, arquitecto técnico', '', '', '', 'JARDINS RODRIGO CARO', 'Barcelona', 'L’emplaçament dels jardins és el solar resultant de l’allargament del carrer Rodrigo Caro, abans sense sortida i avui connectat al carrer Artesania. D’aquesta manera es creà un espai verd amb una topografia força pronunciada, amb 21 metres de desnivell  repartits en algunes plataformes probablement heretades de la construcció del nou tram de carrer i que originàriament es feien servir unes com a aparcament i altres com a horts per part dels veïns.', '', 'PRONOBA,SA; Ajuntament de Barcelona ”Pla de Barris”', '', 'Jordi Fàbregas,mestre jardiner\r\nJosep Selga, biòleg\r\nCarolina Sendra, enginyera tècnica agrícola \r\nTaller de Ingenieria Ambiental, SL\r\nFernando Benedicto, arquitecto técnico', '', 'CESPA FERROVIAL', '', '', '', '', '', '', '', '', '', '', ''),
	(9, 'la_clota', 1, 'thumbnail.jpg', '1.jpg,2.jpg,3.jpg,4.jpg,5.jpg,6.jpg,7.jpg,9.jpg,10.jpg,11.jpg,12.jpg,13.jpg,14.jpg,15.jpg,16.jpg,17.jpg,CIMG8485.JPG,CIMG8488.JPG,CIMG8492.JPG,Imagen097.jpg,IMG_3745.jpg,SSL23321.JPG,SSL23559.JPG,SSL24620.JPG,SSL24621.JPG', '2009', '4.5 Ha', '933.700 €', '', 2, '', 'PARQUE DE LA CLOTA', 'Sabadell', 'El parque de la Clota ocupa un antiguo meandro del río Ripoll, junto al barrio de Can Puiggener. Su uso más reciente está asociado al vertido indiscriminado de tierras, pero anteriormente albergó una serie de asentamientos espontáneos en forma de barracas por  la necesidad de alojamiento para los inmigrantes debido a la creciente industria local en los años 50, que fueron derribados más tarde. Los restos de estos escombros fueron la base del vertedero descontrolado que nos encontramos previo a la obra.', 'SELECCION PREMIOS FAD ESPACIOS EXTERIORES 2010', 'VIMUSA\r\nLei de barrios - Ayuntamiento de Sabadell', '', 'Benedicto Gestió de Projectes\r\nSLP Bàrbara Pla Ortiz, ingeniera  técnica agrícola y paisajista', '', 'Jardí Natura, SL', '', 'PARC DE LA CLOTA', 'Sabadell', 'El parc de la Clota ocupa un antic meandre del riu Ripoll, al costat del barri de Can Puiggener. El seu ús més recent està associat a l’abocament indiscriminat de terres, però anteriorment va albergar una sèrie d’assentaments espontanis en forma de barraques per la necessitat d’allotjament per immigrants degut a la creixent industria local als anys 50, que foren enderrocats més tard. Les restes d’aquests enderrocs varen ser la base de l’abocador descontrolat que trobàrem abans de l’obra.', 'SELECCIONAT PREMIS FAD ESPAIS EXTERIORS 2010', 'VIMUSA, Llei de barris - Ajuntament de Sabadell', '', 'Benedicto Gestió de Projectes, SLP \r\nBàrbara Pla Ortiz, enginyera  tècnica agrícola i paisatgista', '', 'Jardí Natura, SL', '', 'PARK OF LA CLOTA', 'Sabadell', 'Clota The park occupies an old meander of the River Ripoll, near the district of Can Puiggener. Its most recent use is associated with indiscriminate disposal of land, but in the past hosted a number of settlements as a barracks by the need for housing for immigrants due to the growing local industry in the 50’s, which were later demolished. These  rubble remains out of control were the base of the landfill that we found.', 'FAD PRICE SELECTION IN THE EXTERIOR SPACES', 'VIMUSA, Llei de barris – City Hall of Sabadell', '', 'Benedicto Gestió de Projectes, SLP, technical architects\r\nBàrbara Pla Ortiz, agronomist', '', 'JARDI NATURA, SL', ''),
	(10, 'gran_via', 1, 'thumbnail.jpg', '1.jpg,2.jpg,3.jpg,4.jpg,5.jpg,6.jpg,7.jpg,8.jpg,9.jpg,10.jpg,11.jpg', '2003-2007', '7 Ha', '5,95 millones €', '', 4, '', 'NUEVA GRANVIA DE L’HOSPITALET - URBANIZACIÓN EN SUPERFICIE', 'L’Hospitalet de Llobregat', 'La actuación consistió en diseñar y construir las calzadas laterales de los lados mar y montaña y las tres grandes losas de conexión entre los dos lados. El ancho total de la actuación, calzada central deprimida,  incluida alcanza los 96m. La actuación se basa en el proyecto redactado por la Ingeniería  Cicsa y los arquitectos Gomez  y Costa.', 'PREMIO CONSTRUMAT 2009 A LA INNOVACIÓN TECNOLÓGICA\r\nINSTITUTO DE TECNOLOGÍA DE LA CONSTRUCCIÓN DE CATALUÑA', 'Consorcio para la Reforma de la Granvia de l’Hospitalet', '', 'Auding, Ingenierías y auditorías', 'Estudi de paisatge Josep Selga.S.L.', 'COPISA Constructora Pirenaica, SA\r\nFCC Construcción, SA\r\nCOMAPA', '', 'NOVA GRANVIA DE L’HOSPITALET- URBANITZACIÓ A NIVELL CIUTAT', 'L’Hospitalet de Llobregat', 'L’objectiu de l’actuació és reordenar la part sud de l’Hospitalet recuperant-la per la ciutat. La Gran Via és un eix de circulació rodada que travessa Barcelona i l’Hospitalet d’est a oest. En el seu pas per l’Hospitalet era una autovia de 10 carrils que separava la part de mar, d’edificació industrial de la part de muntanya preferent ment residencial.', 'PREMI CONSTRUMAT 2009 A LA INNOVACIÓ TECNOLÒGICA.\r\nINSTITUT DE TECNOLOGIA DE LA CONSTRUCCIÓ DE CATALUNYA', 'Consorci per a la Reforma de la Granvia de l’Hospitalet', '', 'Auding, Ingenierías y auditorías', 'Estudi de paisatge Josep Selga.S.L.', 'COPISA Constructora Pirenaica, SA\r\nFCC Construcción, SA\r\nCOMAPA', '', '', '', '', '', '', '', '', '', '', ''),
	(11, 'verdum', 1, 'thumbnail.jpg', '1.jpg,2.jpg,3.jpg,4.jpg,5.jpg,6.jpg,7.jpg,8.jpg,9.jpg,10.jpg,11.jpg,12.jpg,13.jpg,14.jpg,15.jpg', '2010', '450 M2', '600.000 €', '', 6, 'Adrià Goula', 'CASAL DE BARRIO VERDUM', 'Barcelona', 'Se sitúa en un local en planta baja del edificio nuevo de viviendas del Gobernador C1. El programa comprende tres aulas equipadas para realizar actividades artísticas, lúdicas y docentes, una sala polivalente, una sala de reuniones, una sala de administración-monitores con ventanilla para atención al público y un “paseo interior” que comunica todas las estancias a la vez que engloba espacios de estancia, puntos de encuentro y un punto de acceso a Internet.', '', 'Ayuntamiento de Barcelona – ProNouBarris SA', '', 'Benedicto gestión de proyectos, SL, Arquitectos Técnicos\r\nQuadrant,  Ingeniería de instalaciones y tecnologías Ambientales\r\nAdrià Goula, fotógrafo de arquitectura', '', 'Grup GULINVES, SL', '', 'CASAL DE BARRI VERDUM', 'Barcelona', 'El nou Casal de barri Verdum es situa en un local en planta baixa de l’edifici d’habitatges protegits C1. \r\n\r\nEl programa comprèn tres aules equipades per realitzar activitats artístiques, lúdiques i docents, una sala polivalent, una sala de reunions, una sala d’administració-monitors amb finestreta per atenció al públic i el passeig interior que comunica totes les estances a la vegada que engloba espais d’estada, punts de trobada i un punt d’accés a internet.', '', 'Ajuntament de Barcelona  – ProNouBarris, SA', '', 'Benedicto Gestió de projectes, SL, arquitectes tècnics \r\nQuadrant Enginyeria d’instal·lacions i Tecnologies Ambientals\r\nAdrià Goula, fotògraf d’arquitectura', '', 'Grup Gulinves, SL', '', '', '', '', '', '', '', '', '', '', ''),
	(12, 'seva', 1, 'thumbnail.jpg', '1.jpg,2.jpg,3.jpg,4.jpg,5.jpg,6.jpg,7.jpg,8.jpg', '2004', '250m2', '240.000 €', '', 7, '', 'VIVIENDA UNIFAMILAR AISLADA', 'Seva', '-', '', 'Bernard de Paauw', '', '', '', 'Construccions Bassas', '', 'HABITATGE UNIFAMILIAR AÏLLAT', 'Seva', '', '', 'Bernard de Paauw', '', '', '', 'Construccions Bassas', '', '', '', '', '', '', '', '', '', '', ''),
	(13, 'caixa_forum', 1, 'thumbnail.jpg', '1.jpg,2.jpg,3.jpg,4.jpg,5.jpg', '2009', '25.000 m2', '', '', 8, '', 'CAIXAFORUM EN LAS ANTIGUAS ATARAZANAS DE SEVILLA – CONCURSO RESTRINGIDO', 'Sevilla', 'En el espacio diáfano del complejo monumental de las Atarazanas los ocho muros longitudinales con arcos que separan las naves crean una alternancia de espacios caracterizados por intensidades lumínicas distintas. En estos espacios fluidos domina una atmósfera absolutamente sorprendente en que perspectivas siempre distintas van ofreciéndose a quien se pasea por este enorme vacío casi metafísico.', '', 'Obra Social “la Caixa”', '', 'Jordi Garcés, arquitecto', '', '', '', 'CAIXAFORUM A LES ANTIGUES DRASSANES DE SEVILLA – CONCURS RESTRINGIT', 'Sevilla', 'A l\'espai diàfan del complex monumental de les Drassanes els vuit murs longitudinals amb arcs que separen les naus creen una alternança d\'espais caracteritzats per intensitats lumíniques diferents.  En aquests espais fluids domina una atmosfera absolutament sorprenent en que perspectives sempre diferents van oferint a qui es passeja per aquest enorme buit gairebé metafísic.  És a partir d\'aquestes consideracions perceptives i físiques que s\'ha decidit preservar al màxim el caràcter d\'aquest espai, per així valoritzar la part més antiga i original del conjunt proposant l\'enderrocament de totes les naus afegides en planta superior.  ', '', 'Obra Social "la Caixa"  ', 'Jordi Garcés, arquitecte  ', '', '', '', '', 'CAIXAFORUM IN THE OLD SHIPYARDS OF SEVILLE - RESTRICTED COMPETITION ', 'Sevilla', 'In the open space of the monumental complex of the eight shipyards longitudinal walls with arches separating the aisles create alternating spaces characterized by different light intensities. In these fluid spaces dominates an absolutely amazing atmosphere in which different perspectives can be richen by the visitors through this huge metaphysical void. It is from these perceptual and physical considerations that the decision was taken:  preserve as much as the character of this area in order to enhance the oldest and most original and proposing the demolition of all lately added buildings on the upper floors.', '', 'Obra Social "la Caixa" ', '', 'Jordi Garcés, architect ', '', '', ''),
	(14, 'sopar_liceu', 1, 'thumbnail.jpg', '1.jpg,2.jpg,3.jpg,4.jpg,5.jpg,6.jpg,2002-Sopar_al_Liceu_1.jpg,2002-Sopar_al_Liceu_0.jpg', '2002', '480 m2', '19.242 €', '', 9, '', 'PAISAJE  PARA LA CENA DE ENTREGA DEL I PREMIO INTERNACIONAL DE PERIODISMO CONDE DE BARCELONA EN EL GRAN TEATRO DEL LICEU', 'Barcelona', 'El encargo fue el de montar un paisaje que enmarcara el evento de una cena sin entrar en competencia con el entorno de la platea del Gran Liceu de Barcelona.  La propuesta fue la de trasladar por unas horas un paisaje real en este interior. Se trataba de un paisaje con vegetación característica de los humedales (Cortaderia selloana) de portes consolidados dada la representatividad del evento.', '', 'Fundació Compte de Barcelona', 'Joan Bordas, jardinero\r\nFlora Miserachs, arreglos florales\r\nBlai Puig, interiorista', 'Xisca Salom i Carlota Socias, arquitectas', '', 'Jardinería Bordas', '', 'PAISATGE PEL SOPAR D’ENTREGA DEL I PREMI INTERNACIONAL DE PERIODISME COMTE DE BARCELONA AL GRAN TEATRE DEL LICEU', 'Barcelona', 'L’ encàrrec va ser muntar un paisatge que rubriqués l’esdeveniment d’un sopar sense entrar en competència amb l’entorn de la platea del Gran Liceu de Barcelona.\r\n\r\nLa proposta va ser la de traslladar per unes hores un paisatge real en aquest interior. Es tractava d’un paisatge amb vegetació característica d’aiguamolls (Cortaderia seollana) de ports consolidats donada la representativitat de l’event.', '', 'Fundació Comte de Barcelona', 'Joan Bordas, jardiner\r\nFlora Miserachs, arranjaments floral. \r\nBlai Puig, interiorista.', 'Xisca Salom i Carlota Socias, arquitectes.', '', 'Jardineria Bordas', '', 'LANDSCAPE FOR DINNER DELIVERY OF INTERNATIONAL JOURNALISM AWARD I CONDE DE BARCELONA EN EL Gran Teatre del Liceu ', 'Barcelona', 'Flora, floral arrangements. Blai Puig, interior. CONTRIBUTORS: Salom Xisca i Carlota Members, architects. PROMOTER: Compte de Barcelona Fundació BUILDER: Garden Bordas  The assignment was to set up a landscape that framed the event of a dinner without competing with the environment of the audience at the Gran Liceu of Barcelona. The proposal was to move for a few hours real landscapes in the interior. It was a landscape with vegetation characteristic of wetlands (Cortaderia selloana) consolidated delivery charges due to the representativeness of the event. ', '', 'Compte de Barcelona Fundació', 'Joan Bordas, gardener. \r\nMiserachs Flora, floral arrangements. \r\nBlai Puig, interior.', 'Salom Xisca i Carlota Members, architects.', '', 'Garden Bordas', '');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;


-- Volcando estructura para tabla white_project.projects_has_prices
CREATE TABLE IF NOT EXISTS `projects_has_prices` (
  `id_projects_has_prices` int(11) NOT NULL,
  `projects_id` int(11) NOT NULL,
  `prices_id` int(11) NOT NULL,
  PRIMARY KEY (`id_projects_has_prices`),
  KEY `fk_projects_has_prices_prices1` (`prices_id`),
  KEY `fk_projects_has_prices_projects1` (`projects_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla white_project.projects_has_prices: 0 rows
/*!40000 ALTER TABLE `projects_has_prices` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects_has_prices` ENABLE KEYS */;


-- Volcando estructura para tabla white_project.projects_has_publications
CREATE TABLE IF NOT EXISTS `projects_has_publications` (
  `id_projects_has_publications` int(11) NOT NULL,
  `publications_id` int(11) NOT NULL,
  `projects_id` int(11) NOT NULL,
  PRIMARY KEY (`id_projects_has_publications`),
  KEY `fk_projects_has_publications_projects1` (`projects_id`),
  KEY `fk_projects_has_publications_publications1` (`publications_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla white_project.projects_has_publications: 0 rows
/*!40000 ALTER TABLE `projects_has_publications` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects_has_publications` ENABLE KEYS */;


-- Volcando estructura para tabla white_project.publications
CREATE TABLE IF NOT EXISTS `publications` (
  `id` int(11) NOT NULL,
  `publication` varchar(255) COLLATE utf8_bin NOT NULL,
  `year` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla white_project.publications: 0 rows
/*!40000 ALTER TABLE `publications` DISABLE KEYS */;
/*!40000 ALTER TABLE `publications` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
