-- Población de la base de datos para el proyecto InmobShop, CFGS DAW, IES Aguadulce, Almería.
-- Alumno: Javier Loring Moreno

SET NAMES utf8mb4;
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

USE `inmobshop`;
-- ---------------------------------------------
-- INSERCIONES EN LA TABLA GESTORES
-- ---------------------------------------------
SET AUTOCOMMIT = 0;
INSERT INTO `gestores`(
	`id_gestor`,
	`usuario`,
	`password`,
	`nombre`,
	`email`
) VALUES (
	1,
	'pepe',
	'$2y$10$nr7cXANRC91YbsTxsGe/6egRddv7HfwdhujsF3pVmUKMnG6bJKqE2',
	'José Martínez Martínez',
	'pepe.martinez@inmobshop.com'
),(
	2,
	'maria',
	'$2y$10$CAXANm1jcVpv22J6ZH4YUe/gzszLyBfMEBO1aJlJ1wkd3iUGLL6te',
	'María Fernández Fernández',
	'maria.fernandez@inmobshop.com'
);
COMMIT;
-- ---------------------------------------------
-- INSERCIONES EN LA TABLA USUARIOS
-- ---------------------------------------------
SET AUTOCOMMIT = 0;
INSERT INTO `usuarios`(
	`id_usuario`,
	`usuario`,
	`password`,
	`nombre`,
	`email`,
	`last_session`,
	`activado`,
	`telefono`,
	`token`,
	`token_password`,
	`password_request`
) VALUES (
	1,
	'pedro',
	'$2y$10$AV799ZMj8ACGPh3./8IX8un6GBlNAtRgiqeqk/t.jW4kb.wV37xhO',
	'Pedro González González',
	'pedrogonzalez@email.com',
	NULL,
	0,
	'666666666',
	NULL,
	NULL,
	0
),(
	2,
	'marta',
	'$2y$10$/UxBMycnimQZ6UE3rQq9Pev3hH0gnNNoGmKP1F8AyEnsXdXe2fYCu',
	'Marta Gómez Gómez',
	'martagomez@email.com',
	NULL,
	0,
	'777777777',
	NULL,
	NULL,
	0
),(
	3,
	'juan',
	'$2y$10$LRBchz41YWfw/TDIabfS.Oi3Kxo9Xd4ibeMz5jG17ql7YYrk6UNjG',
	'Juan Gutiérrez Gutiérrez',
	'juangutierrez@email.com',
	NULL,
	0,
	'888888888',
	NULL,
	NULL,
	0
),(
	4,
	'julia',
	'$2y$10$DRAuQmaJQ4WNIfz/vj3wHupmiUNxGGT/p0tbGi2mPfXmui9uCpAsq',
	'Julia García García',
	'juliagarcia@email.com',
	NULL,
	0,
	'999999999',
	NULL,
	NULL,
	0
),(
	5,
	'tomas',
	'$2y$10$gFhY3Rs/W5pZH4o2d9EUGuGj.UQIXfcluGe90eNyF/O0L7d8X2Qdi',
	'Tomás López López',
	'tomaslopez@email.com',
	NULL,
	0,
	'555555555',
	NULL,
	NULL,
	0
),(
	6,
	'pablo',
	'$2y$10$S.mwySOtiG.R82XmdbkDE.dlVItRIMuk4tTYDwQGqsG1mYPTgt.Ba',
	'Pablo Hernández Hernández',
	'pablohernandez@email.com',
	NULL,
	0,
	'444444444',
	NULL,
	NULL,
	0
),(
	7,
	'rebeca',
	'$2y$10$RP5MQZE11FVkcq3BkVaBeO9gxkQ84O.mqdGwxAs9YhY7wC1Df/YLC',
	'Rebeca Méndez Méndez',
	'rebecamendez@email.com',
	NULL,
	0,
	'333333333',
	NULL,
	NULL,
	0
),(
	8,
	'judas',
	'$2y$10$p.0t5KrgSgVuMIvAKgzRguwKseMXketNaSxQ.SWbHf46sAZevgN4q',
	'Judas Fernández Fernández',
	'judasfernandez@email.com',
	NULL,
	0,
	'222222222',
	NULL,
	NULL,
	0
),(
	9,
	'elena',
	'$2y$10$WBrgqyGBwckeiuFL9NGtvulR1pMZgDUliUu98zotqApX7VWNpxq/6',
	'Elena Ruíz Ruíz',
	'elenaruiz@email.com',
	NULL,
	0,
	'111111111',
	NULL,
	NULL,
	0
),(
	10,
	'diego',
	'$2y$10$k5m2tKaNFhf79im9ufYFkOhlUuPSpdYCjtpU5Zt8HHInQJzSDAOm.',
	'Diego Pérez Pérez',
	'diegoperez@email.com',
	NULL,
	0,
	'000000000',
	NULL,
	NULL,
	0
);
COMMIT;
-- ---------------------------------------------
-- INSERCIONES EN LA TABLA PROFESIONALES
-- ---------------------------------------------
SET AUTOCOMMIT = 0;
INSERT INTO `profesionales`(
	`id_profesional`,
	`nombre_comercial`,
	`nif`,
	`url_logo`,
	`id_usuario`
) VALUES (
	1,
	'Valle Alto S.L.',
	'B12345678',
	'/datos/logos-profesionales/prof#1',
	6
),(
	2,
	'Altamira S.L.',
	'B12345677',
	'/datos/logos-profesionales/prof#2',
	7
),(
	3,
	'Grupo XXI',
	'B12345676',
	'/datos/logos-profesionales/prof#3',
	8
);
COMMIT;
-- ---------------------------------------------
-- INSERCIONES EN LA TABLA PARTICULARES
-- ---------------------------------------------
SET AUTOCOMMIT = 0;
INSERT INTO `particulares`(
	`id_particular`,
	`dni`,
	`id_usuario`
) VALUES (
	1,
	'25555555W',
	1
),(
	2,
	'25555554R',
	2
),(
	3,
	'25555553T',
	3
),(
	4,
	'25555552E',
	4
),(
	5,
	'25555551K',
	5
);
COMMIT;
-- ---------------------------------------------
-- INSERCIONES EN LA TABLA DEMANDANTES
-- ---------------------------------------------
SET AUTOCOMMIT = 0;
INSERT INTO `demandantes`(
	`id_demandante`,
	`id_usuario`
) VALUES (
	1,
	9
),(
	2,
	10
);
COMMIT;
-- ---------------------------------------------
-- INSERCIONES EN LA TABLA SERVICIOS
-- ---------------------------------------------
SET AUTOCOMMIT = 0;
INSERT INTO `servicios`(
	`id_servicio`,
	`nombre_servicio`,
	`nivel_servicio`,
	`descripcion`,
	`num_anuncios`,
	`num_dias`,
	`precio`,
	`moneda`,
	`estado_revision`,
	`fecha_alta`,
	`estado_vigencia`,
	`fecha_baja`,
	`id_gestor`
) VALUES (
	1,
	'Vacaional-particulares',
	'2',
	'El servicio vacacional-particulares ofrece la publicación de tres anuncios destacados con color y mejora de posición en listados, durante un plazo de tres meses por un precio de 25 euros.',
	3,
	90,
	25,
	'€',
	'aprobado',
	'2020/04/01',
	'vigente',
	'2021/04/01',
	1
), (
	2,
	'Estándar-particulares',
	'1',
	'El servicio estándar-particulares ofrece la publicación de 1 anuncio durante un plazo de un año por un precio de 15 euros.',
	1,
	365,
	15,
	'€',
	'aprobado',
	'2020/04/01',
	'vigente',
	'2021/04/01',
	1
),(
	3,
	'Estándar-obra-nueva-profesionales',
	'2',
	'El servicio "estándar-obra-nueva-profesionales" ofrece la publicación de un total de cinco inmuebles de obra nueva, durante seis meses por un precio de 50 euros.',
	5,
	180,
	50,
	'€',
	'aprobado',
	'2020/04/01',
	'vigente',
	'2021/04/01',
	2
), (
	4,
	'Mejorado-estándar',
	'3',
	'El servicio "mejorado-estándar" ofrece la publicación de 3 anuncios durante un plazo de un año, con un resalto de color, posición y banner 1/2 en página de búsqueda, por un precio de 50 euros.',
	3,
	365,
	50,
	'€',
	'aprobado',
	'2020/04/01',
	'vigente',
	'2021/04/01',
	2
);
COMMIT;
-- ---------------------------------------------
-- INSERCIONES EN LA TABLA INFORMES
-- ---------------------------------------------
SET AUTOCOMMIT = 0;
INSERT INTO `informes`(
    `id_informe`,
    `nombre_informe`,
    `fecha_informe`,
    `url_informe`,
    `destinatario_informe`,
    `estado_revision`,
    `id_gestor`
) VALUES (
    1,
    'Estadística de terrenos',
    '2020/04/01',
    '/negocio/informes-gestores/gest#1/est-terrenos.php',
    'publico',
    'pendiente',
    1
),(
    2,
    'Estadística de alquileres',
    '2020/04/01',
    '/negocio/informes-gestores/gest#2/est-alquileres.php',
    'publico',
    'aprobado',
    2
),(
    3,
    'Precio medio de venta de viviendas de cuatro dormitorios',
    '2020/04/01',
    '/negocio/informes-gestores/gest#2/venta-viviendas-4d.php',
    'privado',
    'pendiente',
    2
),(
    4,
    'Superficie media de viviendas de obra nueva',
    '2020/04/01',
    '/negocio/informes-gestores/gest#1/sup-media-von.php',
    'profesional',
    'pendiente',
    1
);
COMMIT;
-- ---------------------------------------------
-- INSERCIONES EN LA TABLA REGISTROS
-- ---------------------------------------------
SET AUTOCOMMIT = 0;
INSERT INTO `registros`(
    `id_registro`,
    `fecha_registro`,
    `texto_registro`,
    `id_servicio`,
    `id_informe`,
    `id_contrato`,
	`id_anuncio`
) VALUES (
    1,
    '2020/04/01 12:00:00',
    'PROPUESTA-SERVICIO:vacacional-particulares;GESTOR-SERVICIO:José Matínez;FECHA-HORA:01/04/2020 a las 12:00:00;',
    1,
    NULL,
    NULL,
    NULL
),(
    2,
    '2020/04/01 13:00:00',
    'PROPUESTA-SERVICIO:estándar-particulares;GESTOR-SERVICIO:José Matínez;FECHA-HORA:01/04/2020 a las 13:00:00;',
    2,
    NULL,
    NULL,
    NULL
),(
    3,
    '2020/04/01 14:00:00',
    'PROPUESTA-SERVICIO:estándar-obra-nueva-profesionales;GESTOR-SERVICIO:María Fernández Fernández;FECHA-HORA:01/04/2020 a las 14:00:00;',
    3,
    NULL,
    NULL,
    NULL
),(
    4,
    '2020/04/01 15:00:00',
    'PROPUESTA-SERVICIO:mejorado-estándar;GESTOR-SERVICIO:María Fernández Fernández;FECHA-HORA:01/04/2020 a las 15:00:00;',
    4,
    NULL,
    NULL,
    NULL
),(
    5,
    '2020/04/01 12:30:00',
    'ALTA-SERVICIO:vacacional-particulares;GESTOR-SERVICIO:José Matínez;FECHA-HORA:01/04/2020 a las 12:30:00;',
    1,
    NULL,
    NULL,
    NULL
),(
    6,
    '2020/04/01 13:30:00',
    'ALTA-SERVICIO:estándar-particulares;GESTOR-SERVICIO:José Matínez;FECHA-HORA:01/04/2020 a las 13:30:00;',
    2,
    NULL,
    NULL,
    NULL
),(
    7,
    '2020/04/01 14:30:00',
    'ALTA-SERVICIO:estándar-obra-nueva-profesionales;GESTOR-SERVICIO:María Fernández Fernández;FECHA-HORA:01/04/2020 a las 14:30:00;',
    3,
    NULL,
    NULL,
    NULL
),(
    8,
    '2020/04/01 15:30:00',
    'ALTA-SERVICIO:mejorado-estándar;GESTOR-SERVICIO:María Fernández Fernández;FECHA-HORA:01/04/2020 a las 15:30:00;',
    4,
    NULL,
    NULL,
    NULL
),(
    9,
    '2020/04/01 12:30:00',
    'PROPUESTA-INFORME:Estadística de terrenos;GESTOR-SERVICIO:José Martínez Martínez;FECHA-HORA:01/04/2020 a las 12:30:00;',
    NULL,
    1,
    NULL,
    NULL
),(
    10,
    '2020/04/01 12:45:00',
    'ALTA-INFORME:Estadística de terrenos;GESTOR-SERVICIO:José Martínez Martínez;FECHA-HORA:01/04/2020 a las 12:30:00;',
    NULL,
    1,
    NULL,
    NULL
),(
    11,
    '2020/04/01 13:00:00',
    'PROPUESTA-INFORME:Estadística de alquileres;GESTOR-SERVICIO:María Fernández Fernández;FECHA-HORA:01/04/2020 a las 13:30:00;',
    NULL,
    2,
    NULL,
    NULL
),(
    12,
    '2020/04/01 13:30:00',
    'ALTA-INFORME:Estadística de alquileres;GESTOR-SERVICIO:María Fernández Fernández;FECHA-HORA:01/04/2020 a las 13:30:00;',
    NULL,
    2,
    NULL,
    NULL
),(
    13,
    '2020/04/01 13:45:00',
    'PROPUESTA-INFORME:Precio medio de venta de viviendas de cuatro dormitorios;GESTOR-SERVICIO:María Fernández Fernández;FECHA-HORA:01/04/2020 a las 13:45:00;',
    NULL,
    3,
    NULL,
    NULL
),(
    14,
    '2020/04/01 14:30:00',
    'ALTA-INFORME:Precio medio de venta de viviendas de cuatro dormitorios;GESTOR-SERVICIO:María Fernández Fernández;FECHA-HORA:01/04/2020 a las 14:30:00;',
    NULL,
    3,
    NULL,
    NULL
),(
    15,
    '2020/04/01 14:30:00',
    'PROPUESTA-INFORME:Superficie media de viviendas de obra nueva;GESTOR-SERVICIO:José Martínez Martínez;FECHA-HORA:01/04/2020 a las 14:30:00;',
    NULL,
    4,
    NULL,
    NULL
),(
    16,
    '2020/04/01 14:45:00',
    'ALTA-INFORME:Superficie media de viviendas de obra nueva;GESTOR-SERVICIO:José Martínez Martínez;FECHA-HORA:01/04/2020 a las 14:45:00;',
    NULL,
    4,
    NULL,
    NULL
),(
    17,
    '2020/04/05 12:00:00',
    'ALTA-CONTRATO:estándar-particulares;USUARIO-PARTICULAR:Pedro González González;FECHA-HORA:05/04/2020 a las 12:00:00;',
    NULL,
    NULL,
    1,
    NULL
),(
    18,
    '2020/04/05 12:15:00',
    'ALTA-CONTRATO:estándar-particulares;USUARIO-PARTICULAR:Marta Gómez Gómez;FECHA-HORA:05/04/2020 a las 12:15:00;',
    NULL,
    NULL,
    2,
    NULL
),(
    19,
    '2020/04/05 12:30:00',
    'ALTA-CONTRATO:estándar-obra-nueva-profesionales;USUARIO-PROFESIONAL:Pablo Hernández Hernández;FECHA-HORA:05/04/2020 a las 12:30:00;',
    NULL,
    NULL,
    3,
    NULL
),(
    20,
    '2020/04/05 13:00:00',
    'ALTA-CONTRATO:estándar-obra-nueva-profesionales;USUARIO-PROFESIONAL:Rebeca Méndez Méndez;FECHA-HORA:05/04/2020 a las 13:00:00;',
    NULL,
    NULL,
    4,
    NULL
),(
    21,
    '2020/04/05 13:30:00',
    'ALTA-CONTRATO:Vacacional-particulares;USUARIO-PARTICULAR:Juan Gutiérrez Gutiérrez;FECHA-HORA:05/04/2020 a las 13:00:00;',
    NULL,
    NULL,
    5,
    NULL
),(
    22,
    '2020/04/05 13:45:00',
    'ALTA-CONTRATO:Vacacional-particulares;USUARIO-PARTICULAR:Julia García García;FECHA-HORA:05/04/2020 a las 13:00:00;',
    NULL,
    NULL,
    6,
    NULL
),(
    23,
    '2020/04/05 13:45:00',
    'ALTA-CONTRATO:Estándar-particulares;USUARIO-PARTICULAR:Tomás López López;FECHA-HORA:05/04/2020 a las 13:45:00;',
    NULL,
    NULL,
    7,
    NULL
),(
    24,
    '2020/04/05 14:00:00',
    'ALTA-CONTRATO:Mejorado-estándar;USUARIO-PROFESIONAL:Rebeca Méndez Méndez;FECHA-HORA:05/04/2020 a las 14:00:00;',
    NULL,
    NULL,
    8,
    NULL
),(
    25,
    '2020/04/06 14:00:00',
    'PROPUESTA-ANUNCIO:Estándar-obra-nueva-profesionales;USUARIO-PROFESIONAL:Rebeca Méndez Méndez;FECHA-HORA:06/04/2020 a las 14:00:00;',
    NULL,
    NULL,
    NULL,
    1
),(
    26,
    '2020/04/06 14:15:00',
    'ALTA-ANUNCIO:Estándar-obra-nueva-profesionales;USUARIO-PROFESIONAL:Rebeca Méndez Méndez;GESTOR-ANUNCIO:José Martínez Martínez;FECHA-HORA:06/04/2020 a las 14:15:00;',
    NULL,
    NULL,
    NULL,
    1
),(
    27,
    '2020/04/06 14:05:00',
    'PROPUESTA-ANUNCIO:Estándar-obra-nueva-profesionales;USUARIO-PROFESIONAL:Rebeca Méndez Méndez;FECHA-HORA:06/04/2020 a las 14:05:00;',
    NULL,
    NULL,
    NULL,
    2
),(
    28,
    '2020/04/06 14:20:00',
    'ALTA-ANUNCIO:Estándar-obra-nueva-profesionales;USUARIO-PROFESIONAL:Rebeca Méndez Méndez;GESTOR-ANUNCIO:José Martínez Martínez;FECHA-HORA:06/04/2020 a las 14:20:00;',
    NULL,
    NULL,
    NULL,
    2
),(
    29,
    '2020/04/06 14:10:00',
    'PROPUESTA-ANUNCIO:Estándar-obra-nueva-profesionales;USUARIO-PROFESIONAL:Rebeca Méndez Méndez;FECHA-HORA:06/04/2020 a las 14:10:00;',
    NULL,
    NULL,
    NULL,
    3
),(
    30,
    '2020/04/06 14:25:00',
    'ALTA-ANUNCIO:Estándar-obra-nueva-profesionales;USUARIO-PROFESIONAL:Rebeca Méndez Méndez;GESTOR-ANUNCIO:José Martínez Martínez;FECHA-HORA:06/04/2020 a las 14:25:00;',
    NULL,
    NULL,
    NULL,
    3
),(
    31,
    '2020/04/06 14:30:00',
    'PROPUESTA-ANUNCIO:Estándar-obra-nueva-profesionales;USUARIO-PROFESIONAL:Pablo Hernández Hernández;FECHA-HORA:06/04/2020 a las 14:30:00;',
    NULL,
    NULL,
    NULL,
    4
),(
    32,
    '2020/04/06 14:45:00',
    'ALTA-ANUNCIO:Estándar-obra-nueva-profesionales;USUARIO-PROFESIONAL:Pablo Hernández Hernández;GESTOR-ANUNCIO:María Fernández Fernández;FECHA-HORA:06/04/2020 a las 14:45:00;',
    NULL,
    NULL,
    NULL,
    4
),(
    33,
    '2020/04/06 14:35:00',
    'PROPUESTA-ANUNCIO:Estándar-obra-nueva-profesionales;USUARIO-PROFESIONAL:Pablo Hernández Hernández;FECHA-HORA:06/04/2020 a las 14:35:00;',
    NULL,
    NULL,
    NULL,
    5
),(
    34,
    '2020/04/06 14:50:00',
    'ALTA-ANUNCIO:Estándar-obra-nueva-profesionales;USUARIO-PROFESIONAL:Pablo Hernández Hernández;GESTOR-ANUNCIO:María Fernández Fernández;FECHA-HORA:06/04/2020 a las 14:50:00;',
    NULL,
    NULL,
    NULL,
    5
),(
    35,
    '2020/04/06 14:35:00',
    'PROPUESTA-ANUNCIO:Mejorado-estándar;USUARIO-PROFESIONAL:Rebeca Méndez Méndez;FECHA-HORA:06/04/2020 a las 14:35:00;',
    NULL,
    NULL,
    NULL,
    6
),(
    36,
    '2020/04/06 14:50:00',
    'ALTA-ANUNCIO:Mejorado-estándar;USUARIO-PROFESIONAL:Rebeca Méndez Méndez;GESTOR-ANUNCIO:José Martínez Martínez;FECHA-HORA:06/04/2020 a las 14:50:00;',
    NULL,
    NULL,
    NULL,
    6
),(
    37,
    '2020/04/06 14:40:00',
    'PROPUESTA-ANUNCIO:Vacacional-particulares;USUARIO-PARTICULAR:Juan Gutiérrez Gutiérrez;FECHA-HORA:06/04/2020 a las 14:40:00;',
    NULL,
    NULL,
    NULL,
    7
),(
    38,
    '2020/04/06 14:55:00',
    'ALTA-ANUNCIO:Vacacional-particulares;USUARIO-PARTICULAR:Juan Gutiérrez Gutiérrez;GESTOR-ANUNCIO:José Martínez Martínez;FECHA-HORA:06/04/2020 a las 14:55:00;',
    NULL,
    NULL,
    NULL,
    7
),(
    39,
    '2020/04/06 14:45:00',
    'PROPUESTA-ANUNCIO:Vacacional-particulares;USUARIO-PARTICULAR:Juan Gutiérrez Gutiérrez;FECHA-HORA:06/04/2020 a las 14:45:00;',
    NULL,
    NULL,
    NULL,
    8
),(
    40,
    '2020/04/06 15:00:00',
    'ALTA-ANUNCIO:Vacacional-particulares;USUARIO-PARTICULAR:Juan Gutiérrez Gutiérrez;GESTOR-ANUNCIO:José Martínez Martínez;FECHA-HORA:06/04/2020 a las 15:00:00;',
    NULL,
    NULL,
    NULL,
    8
),(
    41,
    '2020/04/06 14:50:00',
    'PROPUESTA-ANUNCIO:Vacacional-particulares;USUARIO-PROFESIONAL:Rebeca Méndez Méndez;FECHA-HORA:06/04/2020 a las 14:50:00;',
    NULL,
    NULL,
    NULL,
    9
),(
    42,
    '2020/04/06 15:05:00',
    'ALTA-ANUNCIO:Vacacional-particulares;USUARIO-PROFESIONAL:Rebeca Méndez Méndez;GESTOR-ANUNCIO:José Martínez Martínez;FECHA-HORA:06/04/2020 a las 15:05:00;',
    NULL,
    NULL,
    NULL,
    9
),(
    43,
    '2020/04/06 14:55:00',
    'PROPUESTA-ANUNCIO:Estándar-obra-nueva-profesionales;USUARIO-PROFESIONAL:Pablo Hernández Hernández;FECHA-HORA:06/04/2020 a las 14:55:00;',
    NULL,
    NULL,
    NULL,
    10
),(
    44,
    '2020/04/06 15:10:00',
    'ALTA-ANUNCIO:Estándar-obra-nueva-profesionales;USUARIO-PROFESIONAL:Pablo Hernández Hernández;GESTOR-ANUNCIO:María Fernández Fernádez;FECHA-HORA:06/04/2020 a las 15:10:00;',
    NULL,
    NULL,
    NULL,
    10
),(
    45,
    '2020/04/06 15:00:00',
    'PROPUESTA-ANUNCIO:Estándar-obra-nueva-profesionales;USUARIO-PROFESIONAL:Pablo Hernández Hernández;FECHA-HORA:06/04/2020 a las 15:00:00;',
    NULL,
    NULL,
    NULL,
    11
),(
    46,
    '2020/04/06 15:15:00',
    'ALTA-ANUNCIO:Estándar-obra-nueva-profesionales;USUARIO-PROFESIONAL:Pablo Hernández Hernández;GESTOR-ANUNCIO:María Fernández Fernádez;FECHA-HORA:06/04/2020 a las 15:15:00;',
    NULL,
    NULL,
    NULL,
    11
),(
    47,
    '2020/04/06 15:05:00',
    'PROPUESTA-ANUNCIO:Estándar-obra-nueva-profesionales;USUARIO-PROFESIONAL:Pablo Hernández Hernández;FECHA-HORA:06/04/2020 a las 15:05:00;',
    NULL,
    NULL,
    NULL,
    12
),(
    48,
    '2020/04/06 15:20:00',
    'ALTA-ANUNCIO:Estándar-obra-nueva-profesionales;USUARIO-PROFESIONAL:Pablo Hernández Hernández;GESTOR-ANUNCIO:María Fernández Fernádez;FECHA-HORA:06/04/2020 a las 15:20:00;',
    NULL,
    NULL,
    NULL,
    12
),(
    49,
    '2020/04/06 15:10:00',
    'PROPUESTA-ANUNCIO:Estándar-obra-nueva-profesionales;USUARIO-PROFESIONAL:Rebeca Méndez Méndez;FECHA-HORA:06/04/2020 a las 15:10:00;',
    NULL,
    NULL,
    NULL,
    13
),(
    50,
    '2020/04/06 15:25:00',
    'ALTA-ANUNCIO:Estándar-obra-nueva-profesionales;USUARIO-PROFESIONAL:Rebeca Méndez Méndez;GESTOR-ANUNCIO:José Martínez Martínez;FECHA-HORA:06/04/2020 a las 15:25:00;',
    NULL,
    NULL,
    NULL,
    13
),(
    51,
    '2020/04/06 15:15:00',
    'PROPUESTA-ANUNCIO:Estándar-obra-nueva-profesionales;USUARIO-PROFESIONAL:Rebeca Méndez Méndez;FECHA-HORA:06/04/2020 a las 15:15:00;',
    NULL,
    NULL,
    NULL,
    14
),(
    52,
    '2020/04/06 15:30:00',
    'ALTA-ANUNCIO:Estándar-obra-nueva-profesionales;USUARIO-PROFESIONAL:Rebeca Méndez Méndez;GESTOR-ANUNCIO:José Martínez Martínez;FECHA-HORA:06/04/2020 a las 15:30:00;',
    NULL,
    NULL,
    NULL,
    14
),(
    53,
    '2020/04/06 15:20:00',
    'PROPUESTA-ANUNCIO:Mejorado-estándar;USUARIO-PROFESIONAL:Rebeca Méndez Méndez;FECHA-HORA:06/04/2020 a las 15:20:00;',
    NULL,
    NULL,
    NULL,
    15
),(
    54,
    '2020/04/06 15:35:00',
    'ALTA-ANUNCIO:Mejorado-estándar;USUARIO-PROFESIONAL:Rebeca Méndez Méndez;GESTOR-ANUNCIO:José Martínez Martínez;FECHA-HORA:06/04/2020 a las 15:35:00;',
    NULL,
    NULL,
    NULL,
    15
),(
    55,
    '2020/04/06 15:25:00',
    'PROPUESTA-ANUNCIO:Vacacional-particulares;USUARIO-PARTICULAR:Julia García García;FECHA-HORA:06/04/2020 a las 15:25:00;',
    NULL,
    NULL,
    NULL,
    16
),(
    56,
    '2020/04/06 15:40:00',
    'ALTA-ANUNCIO:Vacacional-particulares;USUARIO-PARTICULAR:Julia García García;GESTOR-ANUNCIO:María Fernández Fernández;FECHA-HORA:06/04/2020 a las 15:40:00;',
    NULL,
    NULL,
    NULL,
    16
),(
    57,
    '2020/04/06 15:30:00',
    'PROPUESTA-ANUNCIO:Vacacional-particulares;USUARIO-PARTICULAR:Julia García García;FECHA-HORA:06/04/2020 a las 15:30:00;',
    NULL,
    NULL,
    NULL,
    17
),(
    58,
    '2020/04/06 15:45:00',
    'ALTA-ANUNCIO:Vacacional-particulares;USUARIO-PARTICULAR:Julia García García;GESTOR-ANUNCIO:María Fernández Fernández;FECHA-HORA:06/04/2020 a las 15:45:00;',
    NULL,
    NULL,
    NULL,
    17
),(
    59,
    '2020/04/06 15:35:00',
    'PROPUESTA-ANUNCIO:Vacacional-particulares;USUARIO-PARTICULAR:Juan Gutiérrez Gutierrez;FECHA-HORA:06/04/2020 a las 15:35:00;',
    NULL,
    NULL,
    NULL,
    18
),(
    60,
    '2020/04/06 15:50:00',
    'ALTA-ANUNCIO:Vacacional-particulares;USUARIO-PARTICULAR:Juan Gutiérrez Gutierrez;GESTOR-ANUNCIO:José Martínez Martínez;FECHA-HORA:06/04/2020 a las 15:50:00;',
    NULL,
    NULL,
    NULL,
    18
),(
    61,
    '2020/04/06 15:40:00',
    'PROPUESTA-ANUNCIO:Vacacional-particulares;USUARIO-PARTICULAR:Julía García García;FECHA-HORA:06/04/2020 a las 15:40:00;',
    NULL,
    NULL,
    NULL,
    19
),(
    62,
    '2020/04/06 15:55:00',
    'ALTA-ANUNCIO:Vacacional-particulares;USUARIO-PARTICULAR:Julia García García;GESTOR-ANUNCIO:María Fernández Fernández;FECHA-HORA:06/04/2020 a las 15:55:00;',
    NULL,
    NULL,
    NULL,
    19
),(
    63,
    '2020/04/06 15:45:00',
    'PROPUESTA-ANUNCIO:Estándar-particulares;USUARIO-PARTICULAR:Tomás López López;FECHA-HORA:06/04/2020 a las 15:45:00;',
    NULL,
    NULL,
    NULL,
    20
),(
    64,
    '2020/04/06 16:00:00',
    'ALTA-ANUNCIO:Estándar-particulares;USUARIO-PARTICULAR:Tomás López López;GESTOR-ANUNCIO:María Fernández Fernández;FECHA-HORA:06/04/2020 a las 16:00:00;',
    NULL,
    NULL,
    NULL,
    20
),(
    65,
    '2020/04/06 15:50:00',
    'PROPUESTA-ANUNCIO:Estándar-particulares;USUARIO-PARTICULAR:Marta Gómez Gómez;FECHA-HORA:06/04/2020 a las 15:50:00;',
    NULL,
    NULL,
    NULL,
    21
),(
    66,
    '2020/04/06 16:05:00',
    'ALTA-ANUNCIO:Estándar-particulares;USUARIO-PARTICULAR:Marta Gómez Gómez;GESTOR-ANUNCIO:María Fernández Fernández;FECHA-HORA:06/04/2020 a las 16:05:00;',
    NULL,
    NULL,
    NULL,
    21
),(
    67,
    '2020/04/06 15:55:00',
    'PROPUESTA-ANUNCIO:Estándar-particulares;USUARIO-PARTICULAR:Marta Gómez Gómez;FECHA-HORA:06/04/2020 a las 15:55:00;',
    NULL,
    NULL,
    NULL,
    22
),(
    68,
    '2020/04/06 16:10:00',
    'ALTA-ANUNCIO:Estándar-particulares;USUARIO-PARTICULAR:Marta Gómez Gómez;GESTOR-ANUNCIO:María Fernández Fernández;FECHA-HORA:06/04/2020 a las 16:10:00;',
    NULL,
    NULL,
    NULL,
    22
);
COMMIT;
-- ---------------------------------------------
-- INSERCIONES EN LA TABLA CONTRATOS
-- ---------------------------------------------
SET AUTOCOMMIT = 0;
INSERT INTO `contratos`(
    `id_contrato`,
    `pagado`,
    `fecha_contrato`,
    `id_servicio`,
    `id_profesional`,
    `id_particular`
) VALUES (
    1,
    1,
    '2020/04/05',
    2,
    NULL,
    1
),(
    2,
    1,
    '2020/04/05',
    2,
    NULL,
    2
),(
    3,
    1,
    '2020/04/05',
    3,
    6,
    NULL
),(
    4,
    1,
    '2020/04/05',
    3,
    7,
    NULL
),(
    5,
    1,
    '2020/04/05',
    1,
    NULL,
    3
),(
    6,
    1,
    '2020/04/05',
    1,
    NULL,
    4
),(
    7,
    1,
    '2020/04/05',
    2,
    NULL,
    5
),(
    8,
    1,
    '2020/04/05',
    4,
    7,
    NULL
);
COMMIT;
-- ---------------------------------------------
-- INSERCIONES EN LA TABLA ANUNCIOS
-- ---------------------------------------------
SET AUTOCOMMIT = 0;
INSERT INTO `anuncios`(
	`id_anuncio`,
	`fecha_anuncio`,
	`estado`,
	`id_operacion`,
	`id_inmueble`,
	`descripcion`,
	`id_profesional`,
	`id_particular`,
	`id_contrato`,
	`id_gestor`,
	`id_fotos`
)
VALUES (
	1,
	'2020/04/06',
	'aprobado',
	1,
	1,
	'Piso de nueva construcción en zona norte de Jerez...',
	7,
	NULL,
	4,
	1,
	1
),(
	2,
	'2020/04/06',
	'aprobado',
	2,
	2,
	'Piso de nueva construcción en zona norte de Jerez...',
	7,
	NULL,
	4,
	1,
	2
),(
	3,
	'2020/04/06',
	'aprobado',
	3,
	3,
	'Piso de nueva construcción en zona norte de Jerez...',
	7,
	NULL,
	4,
	1,
	3
),(
	4,
	'2020/04/06',
	'aprobado',
	4,
	4,
	'Apartamento de nueva construcción en zona norte de Jerez...',
	6,
	NULL,
	3,
	2,
	4
),(
	5,
	'2020/04/06',
	'aprobado',
	5,
	5,
	'Apartamento de nueva construcción en zona norte de Jerez...',
	6,
	NULL,
	3,
	2,
	5
),(
	6,
	'2020/04/06',
	'aprobado',
	6,
	6,
	'Magnífico piso en el centro de Jerez...',
	7,
	NULL,
	8,
	1,
	6
),(
	7,
	'2020/04/06',
	'aprobado',
	7,
	7,
	'Magnífico apartamento en la playa en Valdelagrana...',
	NULL,
	3,
	5,
	1,
	7
),(
	8,
	'2020/04/06',
	'aprobado',
	8,
	8,
	'Magnífico apartamento en la playa en Valdelagrana...',
	NULL,
	3,
	5,
	1,
	8
),(
	9,
	'2020/04/06',
	'aprobado',
	9,
	9,
	'Magnífico chalet en gran parcela en urbanización Vistahermosa... ',
	7,
	NULL,
	8,
	1,
	9
),(
	10,
	'2020/04/06',
	'aprobado',
	10,
	10,
	'Magnífico unifamiliar de obra nueva en zona norte de Jerez...',
	6,
	NULL,
	3,
	2,
	10
),(
	11,
	'2020/04/06',
	'aprobado',
	11,
	11,
	'Magnífico unifamiliar de obra nueva en zona norte de Jerez...',
	6,
	NULL,
	3,
	2,
	11
),(
	12,
	'2020/04/06',
	'aprobado',
	12,
	12,
	'Magnífico unifamiliar de obra nueva en zona norte de Jerez...',
	6,
	NULL,
	3,
	2,
	12
),(
	13,
	'2020/04/06',
	'aprobado',
	13,
	13,
	'Magnífico chalet pareado de obra nueva en zona norte de Jerez...',
	7,
	NULL,
	4,
	1,
	13
),(
	14,
	'2020/04/06',
	'aprobado',
	14,
	14,
	'Magnífico chalet pareado de obra nueva en zona norte de Jerez...',
	7,
	NULL,
	4,
	1,
	14
),(
	15,
	'2020/04/06',
	'aprobado',
	15,
	15,
	'Magnífico chalet en la mejor zona de Jerez...',
	7,
	NULL,
	8,
	1,
	15
),(
	16,
	'2020/04/06',
	'aprobado',
	16,
	16,
	'Magnífico chalet a pie de playa en Vistahermosa...',
	null,
	4,
	6,
	2,
	16
),(
	17,
	'2020/04/06',
	'aprobado',
	17,
	17,
	'Magnífico chalet a pie de playa en Vistahermosa...',
	null,
	4,
	6,
	2,
	17
),(
	18,
	'2020/04/06',
	'aprobado',
	18,
	18,
	'Magnífica casa rural en plena Sierra de Grazalema...',
	null,
	3,
	5,
	1,
	18
),(
	19,
	'2020/04/06',
	'aprobado',
	19,
	19,
	'Magnífica casa rural en plena Sierra de Grazalema...',
	null,
	4,
	6,
	2,
	19
),(
	20,
	'2020/04/06',
	'aprobado',
	20,
	20,
	'Magnífico local comercial en la mejor zona de Jerez...',
	null,
	5,
	7,
	2,
	20
),(
	21,
	'2020/04/06',
	'aprobado',
	21,
	21,
	'Magnífica nave industrial en la mejor polígono de Jerez...',
	null,
	2,
	2,
	2,
	21
),(
	22,
	'2020/04/06',
	'aprobado',
	22,
	22,
	'Magnífica parcela en la mejor zona de Jerez...',
	null,
	1,
	1,
	2,
	22
);
COMMIT;
-- ---------------------------------------------
-- INSERCIONES EN LA TABLA OPERACIONES
-- ---------------------------------------------
SET AUTOCOMMIT = 0;
INSERT INTO `operaciones`(
    `id_operacion`,
    `tipo_operacion`,
    `precio`,
    `moneda`,
    `tiempo`
) VALUES (
    1,
    'compra',
    250000,
    '€',
    NULL
),(
    2,
    'compra',
    275000,
    '€',
    NULL
),(
    3,
    'compra',
    150000,
    '€',
    NULL
),(
    4,
    'compra',
    95000,
    '€',
    NULL
),(
    5,
    'compra',
    110000,
    '€',
    NULL
),(
    6,
    'alquiler',
    1500,
    '€',
    'MES'
),(
    7,
    'vacacional',
    1100,
    '€',
    'QUINCENA'
),(
    8,
    'vacacional',
    1050,
    '€',
    'QUINCENA'
),(
    9,
    'compra',
    2125000,
    '€',
    NULL
),(
    10,
    'compra',
    450000,
    '€',
    NULL
),(
    11,
    'compra',
    355000,
    '€',
    NULL
),(
    12,
    'compra',
    460000,
    '€',
    NULL
),(
    13,
    'compra',
    480000,
    '€',
    NULL
),(
    14,
    'compra',
    410000,
    '€',
    NULL
),(
    15,
    'alquiler',
    4500,
    '€',
    'MES'
),(
    16,
    'vacacional',
    2000,
    '€',
    'QUINCENA'
),(
    17,
    'vacacional',
    1800,
    '€',
    'QUINCENA'
),(
    18,
    'vacacional',
    800,
    '€',
    'SEMANA'
),(
    19,
    'vacacional',
    1000,
    '€',
    'SEMANA'
),(
    20,
    'alquiler',
    2100,
    '€',
    'MES'
),(
    21,
    'alquiler',
    3200,
    '€',
    'MES'
),(
    22,
    'compra',
    1250000,
    '€',
    NULL
);
COMMIT;
-- ---------------------------------------------
-- INSERCIONES EN LA TABLA INMUEBLES
-- ---------------------------------------------
SET AUTOCOMMIT = 0;
INSERT INTO `inmuebles`(
	`id_inmueble`,
	`via`,
	`numero_via`,
	`cod_postal`,
	`provincia`,
	`localidad`,
	`id_terreno`,
	`id_construccion`,
	`id_coordenadas`
) VALUES (
	1,
	'Avenida Tío Pepe',
	4,
	11407,
	'Cádiz',
	'Jerez de la Frontera',
	NULL,
	1,
	1
),(
	2,
	'Calle Hermano Eugenio',
	3,
	11407,
	'Cádiz',
	'Jerez de la Frontera',
	NULL,
	2,
	2
),(
	3,
	'Calle Costa del Sol',
	1,
	11407,
	'Cádiz',
	'Jerez de la Frontera',
	NULL,
	3,
	3
),(
	4,
	'Calle de Guatemala',
	'4',
	11407,
	'Cádiz',
	'Jerez de la Frontera',
	NULL,
	4,
	4
),(
	5,
	'Calle Sierra del Pinar',
	1,
	11407,
	'Cádiz',
	'Jerez de la Frontera',
	NULL,
	5,
	5
),(
	6,
	'Calle Medina',
	26,
	11402,
	'Cádiz',
	'Jerez de la Frontera',
	NULL,
	6,
	6
),(
	7,
	'Calle olas',
	11,
	11500,
	'Cádiz',
	'El Puerto de Santa María',
	NULL,
	7,
	7
),(
	8,
	'Avenida Santa María del Mar',
	20,
	'11500',
	'Cádiz',
	'El Puerto de Santa María',
	NULL,
	8,
	8
),(
	9,
	'Calle Bergantín',
	27,
	11500,
	'Cádiz',
	'El Puerto de Santa María',
	NULL,
	9,
	9
),(
	10,
	'Calle Caracas',
	21,
	11407,
	'Cádiz',
	'Jerez de la Frontera',
	NULL,
	10,
	10
),(
	11,
	'Calle Caracas',
	21,
	11407,
	'Cádiz',
	'Jerez de la Frontera',
	NULL,
	11,
	11
),(
	12,
	'Calle Caracas',
	21,
	11407,
	'Cádiz',
	'Jerez de la Frontera',
	NULL,
	12,
	12
),(
	13,
	'Calle Pitágoras',
	4,
	11407,
	'Cádiz',
	'Jerez de la Frontera',
	NULL,
	13,
	13
),(
	14,
	'Calle Pitágoras',
	6,
	11407,
	'Cádiz',
	'Jerez de la Frontera',
	NULL,
	14,
	14
),(
	15,
	'Avenida de Visley',
	2,
	11407,
	'Cádiz',
	'Jerez de la Frontera',
	NULL,
	15,
	15
),(
	16,
	'Calle Altair',
	25,
	11500,
	'Cádiz',
	'El Puerto de Santa María',
	NULL,
	16,
	16
),(
	17,
	'Calle Bellavista',
	5,
	11500,
	'Cádiz',
	'El Puerto de Santa María',
	NULL,
	17,
	17
),(
	18,
	'Calle del Chorrito',
	4,
	11610,
	'Cádiz',
	'Grazalema',
	NULL,
	18,
	18
),(
	19,
	'Calle de Los Ángeles',
	8,
	11610,
	'Cádiz',
	'Grazalema',
	NULL,
	19,
	19
),(
	20,
	'Calle Sevilla',
	42,
	11402,
	'Cádiz',
	'Jerez de la Frontera',
	NULL,
	20,
	20
),(
	21,
	'Avenida de la Ilustración',
	10,
	11407,
	'Cádiz',
	'Jerez de la Frontera',
	NULL,
	21,
	21
),(
	22,
	'Avenida de Andalucía',
	71,
	11407,
	'Cádiz',
	'Jerez de la Frontera',
	1,
	NULL,
	22
);
COMMIT;
-- ---------------------------------------------
-- INSERCIONES EN LA TABLA TERRENOS
-- ---------------------------------------------
SET AUTOCOMMIT = 0;
INSERT INTO `terrenos`(
    `id_terreno`,
    `tipo_suelo`,
    `superficie`,
    `unidad`,
    `agua`,
    `luz`
) VALUES (
    1,
    'SUELO_URBANO',
    2500,
    'm2',
    1,
    1
),(
    2,
    'SUELO_URBANO',
    3100,
    'm2',
    1,
    1
);
COMMIT;
-- ---------------------------------------------
-- INSERCIONES EN LA TABLA CONSTRUCCIONES
-- ---------------------------------------------
SET AUTOCOMMIT = 0;
INSERT INTO `construcciones`(
	`id_construccion`,
	`tipo_construccion`,
	`sup_util`,
	`sup_construida`,
	`unidad`,
	`id_vivienda`
) VALUES (
	1,
	'VIVIENDA',
	120,
	150,
	'm2',
	1
),(
	2,
	'VIVIENDA',
	120,
	150,
	'm2',
	2
),(
	3,
	'VIVIENDA',
	90,
	112,
	'm2',
	3
),(
	4,
	'VIVIENDA',
	60,
	75,
	'm2',
	4
),(
	5,
	'VIVIENDA',
	65,
	80,
	'm2',
	5
),(
	6,
	'VIVIENDA',
	130,
	165,
	'm2',
	6
),(
	7,
	'VIVIENDA',
	75,
	90,
	'm2',
	7
),(
	8,
	'VIVIENDA',
	75,
	90,
	'm2',
	8
),(
	9,
	'VIVIENDA',
	210,
	240,
	'm2',
	9
),(
	10,
	'VIVIENDA',
	185,
	210,
	'm2',
	10
),(
	11,
	'VIVIENDA',
	140,
	165,
	'm2',
	11
),(
	12,
	'VIVIENDA',
	150,
	170,
	'm2',
	12
),(
	13,
	'VIVIENDA',
	120,
	150,
	'm2',
	13
),(
	14,
	'VIVIENDA',
	120,
	150,
	'm2',
	14
),(
	15,
	'VIVIENDA',
	320,
	360,
	'm2',
	15
),(
	16,
	'VIVIENDA',
	120,
	150,
	'm2',
	16
),(
	17,
	'VIVIENDA',
	120,
	150,
	'm2',
	17
),(
	18,
	'VIVIENDA',
	130,
	155,
	'm2',
	18
),(
	19,
	'VIVIENDA',
	160,
	190,
	'm2',
	19
),(
	20,
	'LOCAL',
	120,
	150,
	'm2',
	NULL
),(
	21,
	'NAVE',
	300,
	330,
	'm2',
	NULL
);
COMMIT;
-- ---------------------------------------------
-- INSERCIONES EN LA TABLA PISOS
-- ---------------------------------------------
SET AUTOCOMMIT = 0;
INSERT INTO `pisos`(
	`id_piso`,
	`tipo_piso`,
	`planta`,
	`fachada`
) VALUES (
	1,
	'PISO',
	5,
	'EXTERIOR'
),(
	2,
	'DUPLEX',
	3,
	'EXTERIOR'
),(
	3,
	'ATICO',
	8,
	'EXTERIOR'
),(
	4,
	'ESTUDIO',
	2,
	'EXTERIOR'
),(
	5,
	'LOFT',
	3,
	'EXTERIOR'
),(
	6,
	'PISO',
	4,
	'EXTERIOR'
),(
	7,
	'PISO',
	3,
	'EXTERIOR'
),(
	8,
	'BAJO',
	0,
	'INTERIOR'
);
COMMIT;
-- ---------------------------------------------
-- INSERCIONES EN LA TABLA VIVIENDAS
-- ---------------------------------------------
SET AUTOCOMMIT = 0;
INSERT INTO `viviendas`(
	`id_vivienda`,
	`tipo_vivienda`,
	`num_habitaciones`,
	`num_baños`,
	`estado_vivienda`,
	`equipamiento`,
	`orientacion`,
	`ascensor`,
	`arm_empotrados`,
	`calefaccion`,
	`aire_acond`,
	`terraza`,
	`balcon`,
	`trastero`,
	`plaza_garaje`,
	`piscina_propia`,
	`urbanizacion`,
	`piscina_comun`,
	`zonas_verdes`,
	`id_piso`
) VALUES (
	1,
	'PISO',
	4,
	2,
	'NUEVO',
	'COCINA',
	'SUR',
	1,
	1,
	0,
	1,
	1,
	0,
	1,
	1,
	0,
	1,
	1,
	1,
	1
),(
	2,
	'PISO',
	4,
	2,
	'NUEVO',
	'COCINA',
	'SUR',
	1,
	1,
	0,
	1,
	1,
	0,
	1,
	1,
	0,
	1,
	1,
	1,
	2
),(
	3,
	'PISO',
	3,
	2,
	'NUEVO',
	'COCINA',
	'ESTE',
	1,
	1,
	0,
	1,
	1,
	0,
	0,
	0,
	0,
	0,
	0,
	0,
	3
),(
	4,
	'PISO',
	1,
	1,
	'NUEVO',
	'COCINA',
	'ESTE',
	1,
	1,
	0,
	1,
	1,
	0,
	0,
	0,
	0,
	1,
	1,
	1,
	4
),(
	5,
	'PISO',
	2,
	1,
	'NUEVO',
	'COCINA',
	'SUR',
	1,
	1,
	0,
	1,
	1,
	0,
	1,
	1,
	0,
	1,
	1,
	1,
	5
),(
	6,
	'PISO',
	5,
	3,
	'BUENO',
	'COCINA_MUEBLES',
	'ESTE',
	1,
	1,
	1,
	1,
	1,
	0,
	1,
	1,
	0,
	0,
	0,
	0,
	6
),(
	7,
	'PISO',
	2,
	1,
	'BUENO',
	'COCINA_MUEBLES',
	'SUR',
	1,
	1,
	0,
	1,
	1,
	0,
	0,
	1,
	0,
	1,
	1,
	1,
	7
),(
	8,
	'PISO',
	2,
	1,
	'BUENO',
	'COCINA_MUEBLES',
	'SUR',
	1,
	1,
	0,
	1,
	1,
	0,
	0,
	1,
	0,
	1,
	1,
	1,
	8
),(
	9,
	'CHALET_UNIFAMILIAR',
	6,
	4,
	'BUENO',
	'COCINA',
	'SUR',
	0,
	1,
	1,
	1,
	1,
	0,
	1,
	1,
	1,
	0,
	0,
	1,
	NULL
),(
	10,
	'CHALET_UNIFAMILIAR',
	5,
	2,
	'NUEVO',
	'COCINA',
	'OESTE',
	0,
	1,
	1,
	1,
	1,
	0,
	1,
	1,
	0,
	0,
	0,
	1,
	NULL
),(
	11,
	'CHALET_UNIFAMILIAR',
	4,
	2,
	'NUEVO',
	'COCINA',
	'OESTE',
	0,
	1,
	1,
	1,
	1,
	0,
	1,
	1,
	0,
	0,
	0,
	1,
	NULL
),(
	12,
	'CHALET_UNIFAMILIAR',
	5,
	2,
	'NUEVO',
	'COCINA',
	'SUR',
	0,
	1,
	1,
	1,
	1,
	0,
	1,
	1,
	1,
	0,
	0,
	1,
	NULL
),(
	13,
	'CHALET_UNIFAMILIAR',
	4,
	2,
	'NUEVO',
	'COCINA',
	'ESTE',
	0,
	1,
	1,
	1,
	1,
	0,
	1,
	1,
	1,
	1,
	0,
	1,
	NULL
),(
	14,
	'CHALET_UNIFAMILIAR',
	4,
	2,
	'NUEVO',
	'COCINA',
	'OESTE',
	0,
	1,
	1,
	1,
	1,
	0,
	1,
	1,
	0,
	0,
	0,
	1,
	NULL
),(
	15,
	'CHALET_UNIFAMILIAR',
	8,
	4,
	'BUENO',
	'COCINA_MUEBLES',
	'SUR',
	1,
	1,
	1,
	1,
	1,
	0,
	1,
	1,
	1,
	0,
	0,
	1,
	NULL
),(
	16,
	'CHALET_UNIFAMILIAR',
	4,
	2,
	'BUENO',
	'COCINA_MUEBLES',
	'OESTE',
	0,
	1,
	0,
	1,
	1,
	0,
	1,
	1,
	1,
	0,
	0,
	1,
	NULL
),(
	17,
	'CHALET_UNIFAMILIAR',
	4,
	2,
	'BUENO',
	'COCINA_MUEBLES',
	'ESTE',
	0,
	1,
	0,
	1,
	1,
	0,
	1,
	1,
	0,
	1,
	1,
	1,
	NULL
),(
	18,
	'CASA_RUSTICA',
	5,
	3,
	'BUENO',
	'COCINA_MUEBLES',
	'ESTE',
	0,
	0,
	1,
	1,
	1,
	0,
	0,
	1,
	1,
	0,
	0,
	1,
	NULL
),(
	19,
	'CASA_RUSTICA',
	6,
	4,
	'BUENO',
	'COCINA_MUEBLES',
	'SUR',
	0,
	0,
	1,
	1,
	1,
	0,
	0,
	1,
	1,
	0,
	0,
	1,
	NULL
);
COMMIT;
-- ---------------------------------------------
-- INSERCIONES EN LA TABLA FOTOS
-- ---------------------------------------------
SET AUTOCOMMIT = 0;
INSERT INTO `fotos`(
	`id_fotos`,
	`urls_textos_fotos`
) VALUES (
	1,
	'"/datos/user-fotografias/prof-id-2/fotos-1/f1.jpg":"Vista del exterior del edificio.",
	"/datos/user-fotografias/prof-id-2/fotos-1/f2.jpg":"Vista del portal y ascensores.",
	"/datos/user-fotografias/prof-id-2/fotos-1/f3.jpg":"Vista del salón-comedor."'
),(
	2,
	'"/datos/user-fotografias/prof-id-2/fotos-2/f1.jpg":"Vista del exterior del edificio.",
	"/datos/user-fotografias/prof-id-2/fotos-2/f2.jpg":"Vista del portal y ascensores.",
	"/datos/user-fotografias/prof-id-2/fotos-2/f3.jpg":"Vista del salón-comedor."'
),(
	3,
	'"/datos/user-fotografias/prof-id-2/fotos-3/f1.jpg":"Vista del exterior del edificio.",
	"/datos/user-fotografias/prof-id-2/fotos-3/f2.jpg":"Vista del portal y ascensores.",
	"/datos/user-fotografias/prof-id-2/fotos-3/f3.jpg":"Vista del salón-comedor."'
),(
	4,
	'"/datos/user-fotografias/prof-id-1/fotos-1/f1.jpg":"Vista del exterior del edificio.",
	"/datos/user-fotografias/prof-id-1/fotos-1/f2.jpg":"Vista del portal y ascensores.",
	"/datos/user-fotografias/prof-id-1/fotos-1/f3.jpg":"Vista del salón-comedor."'
),(
	5,
	'"/datos/user-fotografias/prof-id-1/fotos-2/f1.jpg":"Vista del exterior del edificio.",
	"/datos/user-fotografias/prof-id-1/fotos-2/f2.jpg":"Vista del portal y ascensores.",
	"/datos/user-fotografias/prof-id-1/fotos-2/f3.jpg":"Vista del salón-comedor."'
),(
	6,
	'"/datos/user-fotografias/prof-id-2/fotos-4/f1.jpg":"Vista del exterior del edificio.",
	"/datos/user-fotografias/prof-id-2/fotos-4/f2.jpg":"Vista del portal y ascensores.",
	"/datos/user-fotografias/prof-id-2/fotos-4/f3.jpg":"Vista del salón-comedor."'
),(
	7,
	'"/datos/user-fotografias/part-id-3/fotos-1/f1.jpg":"Vista del exterior del edificio.",
	"/datos/user-fotografias/part-id-3/fotos-1/f2.jpg":"Vista del salón-comedor.",
	"/datos/user-fotografias/part-id-3/fotos-1/f3.jpg":"Vista del dormitorio."'
),(
	8,
	'"/datos/user-fotografias/part-id-3/fotos-2/f1.jpg":"Vista del exterior del edificio.",
	"/datos/user-fotografias/part-id-3/fotos-2/f2.jpg":"Vista del salón-comedor.",
	"/datos/user-fotografias/part-id-3/fotos-2/f3.jpg":"Vista del dormitorio."'
),(
	9,
	'"/datos/user-fotografias/prof-id-2/fotos-5/f1.jpg":"Vista del exterior de la casa.",
	"/datos/user-fotografias/prof-id-2/fotos-5/f2.jpg":"Vista de la entrada desde el jardín.",
	"/datos/user-fotografias/prof-id-2/fotos-5/f3.jpg":"Vista del vestíbulo."'
),(
	10,
	'"/datos/user-fotografias/prof-id-1/fotos-3/f1.jpg":"Vista del exterior de la casa.",
	"/datos/user-fotografias/prof-id-1/fotos-3/f2.jpg":"Vista de la entrada desde el jardín.",
	"/datos/user-fotografias/prof-id-1/fotos-3/f3.jpg":"Vista del vestíbulo."'
),(
	11,
	'"/datos/user-fotografias/prof-id-1/fotos-4/f1.jpg":"Vista del exterior de la casa.",
	"/datos/user-fotografias/prof-id-1/fotos-4/f2.jpg":"Vista de la entrada desde el jardín.",
	"/datos/user-fotografias/prof-id-1/fotos-4/f3.jpg":"Vista del vestíbulo."'
),(
	12,
	'"/datos/user-fotografias/prof-id-1/fotos-5/f1.jpg":"Vista del exterior de la casa.",
	"/datos/user-fotografias/prof-id-1/fotos-5/f2.jpg":"Vista de la entrada desde el jardín.",
	"/datos/user-fotografias/prof-id-1/fotos-5/f3.jpg":"Vista del vestíbulo."'
),(
	13,
	'"/datos/user-fotografias/prof-id-2/fotos-6/f1.jpg":"Vista del exterior de la casa.",
	"/datos/user-fotografias/prof-id-2/fotos-6/f2.jpg":"Vista de la entrada desde el jardín.",
	"/datos/user-fotografias/prof-id-2/fotos-6/f3.jpg":"Vista del vestíbulo."'
),(
	14,
	'"/datos/user-fotografias/prof-id-2/fotos-7/f1.jpg":"Vista del exterior de la casa.",
	"/datos/user-fotografias/prof-id-2/fotos-7/f2.jpg":"Vista de la entrada desde el jardín.",
	"/datos/user-fotografias/prof-id-2/fotos-7/f3.jpg":"Vista del vestíbulo."'
),(
	15,
	'"/datos/user-fotografias/prof-id-2/fotos-8/f1.jpg":"Vista del exterior de la casa.",
	"/datos/user-fotografias/prof-id-2/fotos-8/f2.jpg":"Vista de la entrada desde el jardín.",
	"/datos/user-fotografias/prof-id-2/fotos-8/f3.jpg":"Vista del vestíbulo."'
),(
	16,
	'"/datos/user-fotografias/part-id-4/fotos-1/f1.jpg":"Vista del exterior del edificio.",
	"/datos/user-fotografias/part-id-4/fotos-1/f2.jpg":"Vista del portal y ascensores.",
	"/datos/user-fotografias/part-id-4/fotos-1/f3.jpg":"Vista del salón-comedor."'
),(
	17,
	'"/datos/user-fotografias/part-id-4/fotos-2/f1.jpg":"Vista del exterior del edificio.",
	"/datos/user-fotografias/part-id-4/fotos-2/f2.jpg":"Vista del portal y ascensores.",
	"/datos/user-fotografias/part-id-4/fotos-2/f3.jpg":"Vista del salón-comedor."'
),(
	18,
	'"/datos/user-fotografias/part-id-3/fotos-3/f1.jpg":"Porche exterior con vistas de la sierra.",
	"/datos/user-fotografias/part-id-3/fotos-3/f2.jpg":"El camino hacia el río.",
	"/datos/user-fotografias/part-id-3/fotos-3/f3.jpg":"Buhardilla adaptada a dormitorios."'
),(
	19,
	'"/datos/user-fotografias/part-id-4/fotos-3/f1.jpg":"Vista del camino de acceso a la casa.",
	"/datos/user-fotografias/part-id-4/fotos-3/f2.jpg":"Vistas del entrono natural Sierra de Grazalema.",
	"/datos/user-fotografias/part-id-4/fotos-3/f3.jpg":"Salón con chimenea y gran comedor."'
),(
	20,
	'"/datos/user-fotografias/part-id-5/fotos-1/f1.jpg":"Escaparate del local desde la calle.",
	"/datos/user-fotografias/part-id-5/fotos-1/f2.jpg":"Zona interior con aseo.",
	"/datos/user-fotografias/part-id-5/fotos-1/f3.jpg":"Almacén independiente."'
),(
	21,
	'"/datos/user-fotografias/part-id-2/fotos-1/f1.jpg":"Vista de la fachada de la nave",
	"/datos/user-fotografias/part-id-2/fotos-1/f2.jpg":"Oficina interior.",
	"/datos/user-fotografias/part-id-2/fotos-1/f3.jpg":"Estructura del puente grua."'
),(
	22,
	'"/datos/user-fotografias/part-id-1/fotos-1/f1.jpg":"Vista aérea del solar.",
	"/datos/user-fotografias/part-id-1/fotos-1/f2.jpg":"Acceso desde la calle.",
	"/datos/user-fotografias/part-id-1/fotos-1/f3.jpg":"Poste de la acometida eléctrica."'
);
COMMIT;
-- ---------------------------------------------
-- INSERCIONES EN LA TABLA COORDENADAS
-- ---------------------------------------------
SET AUTOCOMMIT = 0;
INSERT INTO `coordenadas`(
	`id_coordenadas`,
	`longitud`,
	`latitud`
) VALUES (
	1,
	'36.7130295',
	'-6.1091092'
),(
	2,
	'36.7070904',
	'-6.1140093'
),(
	3,
	'36.7075900',
	'-6.1345200'
),(
	4,
	'36.7063870',
	'-6.1231947'
),(
	5,
	'36.7059000',
	'-6.1268200'
),(
	6,
	'36.6821701',
	'-6.1333149'
),(
	7,
	'36.5773071',
	'-6.2210421'
),(
	8,
	'36.5710125',
	'-6.2208027'
),(
	9,
	'36.5850048',
	'-6.2640183'
),(
	10,
	'36.7047286',
	'-6.1233883'
),(
	11,
	'36.7047286',
	'-6.1233883'
),(
	12,
	'36.7047286',
	'-6.1233883'
),(
	13,
	'36.7134940',
	'-6.1055047'
),(
	14,
	'36.7134940',
	'-6.1055047'
),(
	15,
	'36.6951081',
	'-6.1315582'
),(
	16,
	'36.5903675',
	'-6.2704147'
),(
	17,
	'36.5823442',
	'-6.2668154'
),(
	18,
	'36.7602300',
	'-5.3705600'
),(
	19,
	'36.7600700',
	'-5.3669900'
),(
	20,
	'36.6901600',
	'-6.1355511'
),(
	21,
	'36.7097345',
	'-6.1194207'
),(
	22,
	'36.7037756',
	'-6.1195643'
),(
	23,
	'36.5816270',
	'-6.2146830'
),(
	24,
	'36.5820877',
	'-6.2608287'
),(
	25,
	'36.6850064',
	'-6.1260744'
);
COMMIT;
-- ---------------------------------------------
-- INSERCIONES EN LA TABLA BUSQUEDAS
-- ---------------------------------------------
SET AUTOCOMMIT = 0;
INSERT INTO `busquedas`(
	`id_busqueda`,
	`nombre_busqueda`,
	`provincia`,
	`localidad`,
	`via`,
	`numero_via`,
	`cod_postal`,
	`tipo_operacion`,
	`superficie_min`,
	`superficie_max`,
	`unidad`,
	`precio_min`,
	`precio_max`,
	`tipo_suelo`,
	`tipo_construccion`,
	`tipo_vivienda`,
	`tipo_piso`,
	`estado_vivienda`,
	`equipamiento`,
	`orientacion`,
	`num_habitaciones`,
	`num_baños`,
	`ascensor`,
	`arm_empotrados`,
	`calefaccion`,
	`aire_acond`,
	`terraza`,
	`balcon`,
	`trastero`,
	`plaza_garaje`,
	`planta`,
	`fachada`,
	`piscina_propia`,
	`urbanizacion`,
	`piscina_comun`,
	`zonas_verdes`,
	`id_demandante`,
	`id_coordenadas`
) VALUES (
	1,
	'Alquileres_Valdelagrana',
	'Cádiz',
	'Puerto de Santa María, Valdelagrana',
	NULL,
	NULL,
	NULL,
	'ALQUILER',
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	'VIVIENDA',
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	1,
	23
),(
	2,
	'Alquileres_Vistahermosa',
	'Cádiz',
	'Puerto de Santa María, Vista Hermosa',
	NULL,
	NULL,
	NULL,
	'ALQUILER',
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	'VIVIENDA',
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	2,
	24
),(
	3,
	'Alquileres_Jerez',
	'Cádiz',
	'Jerez de la Frontera',
	NULL,
	NULL,
	NULL,
	'ALQUILER',
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	'VIVIENDA',
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	2,
	25
);
COMMIT;
-- ---------------------------------------------
-- INSERCIONES EN LA TABLA CONTACTOS
-- ---------------------------------------------
SET AUTOCOMMIT = 0;
INSERT INTO `contactos`(
	`id_demandante`,
	`id_anuncio`,
	`fecha`
) VALUES (
	1,
	7,
	'2020/04/07'
),(
	2,
	6,
	'2020/04/07'
);
COMMIT;
-- ---------------------------------------------
-- INSERCIONES EN LA TABLA COINCIDENCIAS
-- ---------------------------------------------
SET AUTOCOMMIT = 0;
INSERT INTO `coincidencias`(
	`id_anuncio`,
	`id_busqueda`,
	`fecha`
) VALUES (
	7,
	1,
	'2020/04/07'
),(
	8,
	1,
	'2020/04/07'
),(
	16,
	2,
	'2020/04/07'
),(
	17,
	2,
	'2020/04/07'
),(
	6,
	3,
	'2020/04/07'
);
COMMIT;
-- ---------------------------------------------
-- INSERCIONES EN LA TABLA FAVORITOS
-- ---------------------------------------------
SET AUTOCOMMIT = 0;
INSERT INTO `favoritos`(
	`id_anuncio`,
	`id_usuario`
) VALUES (
	6,
	10
);
COMMIT;
