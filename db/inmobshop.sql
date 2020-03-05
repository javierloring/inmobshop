-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema InmobShop
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `InmobShop`;

CREATE SCHEMA `InmobShop`;
-- -----------------------------------------------------
-- Table `gestores`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestores` ;

CREATE TABLE IF NOT EXISTS `gestores` (
  `id_gestor` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre_gestor` VARCHAR(45) NOT NULL,
  `contraseña_gestor` VARCHAR(255) NOT NULL,
  `email_gestor` VARCHAR(254) NOT NULL,
  PRIMARY KEY (`id_gestor`),
  UNIQUE INDEX `nombre_gestor_UNIQUE` (`nombre_gestor` ASC),
  UNIQUE INDEX `contraseña_gestor_UNIQUE` (`contraseña_gestor` ASC),
  UNIQUE INDEX `email_gestor_UNIQUE` (`email_gestor` ASC))
ENGINE = InnoDB;
			-- -----------------------------------------------------
			-- INSERT `gestores`
			-- -----------------------------------------------------
			INSERT INTO `gestores` (nombre_gestor, contraseña_gestor, email_gestor) VALUES
			('gestor1', '$2y$10$VSrfIxrUvUXKsQcrGV2enOAEe6nwcjC36ykXgfL00jq5oPfG95jfK', 'gestor1@inmobshop.com'),
			('gestor2', '$2y$10$ARKhcVX4UPSmv/wA.hQTJOWa07EmFtQcMbRjHdnzDr.9BSdo8qg4G', 'gestor2@inmobshop.com')
-- -----------------------------------------------------
-- Table `usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `usuarios` ;

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre_usuario` VARCHAR(45) NOT NULL,
  `contraseña` VARCHAR(255) NOT NULL,
  `email` VARCHAR(254) NOT NULL COMMENT '\n',
  `telefono` VARCHAR(9) NOT NULL,
  `activado` BIT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_usuario`))
ENGINE = InnoDB;
			-- -----------------------------------------------------
			-- INSERT `usuarios`
			-- -----------------------------------------------------
			-- passusu*
			INSERT INTO `usuarios` (nombre_usuario, contraseña, email, telefono) VALUES
			('usuario1', '$2y$10$yJ7BX7xAWT.L2Or1IeH9SebOllFtT37IuR57oyhPcQcz8i3XnL4US', 'usuario1@inmobshop.com', 666999555),
			('usuario2', '$2y$10$a1CyRo1ar29HzIQKzF/qtuqXDMrgePifWcECfMGs.2rpioPPlb/IG', 'usuario2@inmobshop.com', 666888555),
			('usuario3', '$2y$10$LN6X7MCaaF8UxcUp7puQIeILDaSA4JpbeTV1Yj.pdh9sMXpfgpLIK', 'usuario3@inmobshop.com', 666777555),
			('usuario4', '$2y$10$Dx2WStF6sJfHB2r4w0QqA.H4c.svx2mKEZg61eSRhTYp12fOgirHy', 'usuario4@inmobshop.com', 666444555),
			('usuario5', '$2y$10$UdhrQJdwz/oahTWRLUme9eXkI95riYZIalcIiA/.bfovU8aDn2O2K', 'usuario5@inmobshop.com', 666333555),
			('usuario6', '$2y$10$veCfLZgqZhi66qFM/Ayld.9xbCA9/F4F2szHInQS4YdFX.jmBqPsK', 'usuario6@inmobshop.com', 666222555)
-- -----------------------------------------------------
-- Table `profesionales`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `profesionales` ;

CREATE TABLE IF NOT EXISTS `profesionales` (
  `id_profesional` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nif` VARCHAR(9) NOT NULL,
  `id_usuario` MEDIUMINT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_profesional`),
  INDEX `fk_profesionales_usuarios1_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_profesionales_usuarios1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `particulares`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `particulares` ;

CREATE TABLE IF NOT EXISTS `particulares` (
  `id_particular` MEDIUMINT UNSIGNED NOT NULL,
  `dni` VARCHAR(9) NOT NULL,
  `id_usuario` MEDIUMINT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_particular`),
  INDEX `fk_particulares_usuarios1_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_particulares_usuarios1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `demandantes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `demandantes` ;

CREATE TABLE IF NOT EXISTS `demandantes` (
  `id_demandante` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_usuario` MEDIUMINT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_demandante`),
  INDEX `fk_demandantes_usuarios1_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_demandantes_usuarios1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `servicios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `servicios` ;

CREATE TABLE IF NOT EXISTS `servicios` (
  `id_servicio` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `nivel` ENUM('1', '2', '3', '4', '5', 'CAMBIO') NOT NULL,
  `descripcion` VARCHAR(255) NOT NULL,
  `num_anuncios` SMALLINT NOT NULL,
  `num_dias` SMALLINT NOT NULL,
  `precio` DECIMAL NOT NULL,
  `moneda` VARCHAR(45) NOT NULL DEFAULT '€',
  `id_gestor` SMALLINT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_servicio`),
  INDEX `fk_tarifas_administradores1_idx` (`id_gestor` ASC),
  CONSTRAINT `fk_tarifas_administradores1`
    FOREIGN KEY (`id_gestor`)
    REFERENCES `gestores` (`id_gestor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `informes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `informes` ;

CREATE TABLE IF NOT EXISTS `informes` (
  `id_informe` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre_informe` VARCHAR(45) NOT NULL,
  `fecha_informe` TIMESTAMP NOT NULL,
  `url_informe` VARCHAR(255) NOT NULL COMMENT 'archivo guarda la url del pdf',
  `destinatario_informe` ENUM('publico', 'privado', 'profesional') NOT NULL,
  `activado` BIT NOT NULL,
  `id_gestor` SMALLINT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_informe`),
  INDEX `fk_informes_administradores1_idx` (`id_gestor` ASC),
  UNIQUE INDEX `url_informe_UNIQUE` (`url_informe` ASC),
  CONSTRAINT `fk_informes_administradores1`
    FOREIGN KEY (`id_gestor`)
    REFERENCES `gestores` (`id_gestor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `terrenos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `terrenos` ;

CREATE TABLE IF NOT EXISTS `terrenos` (
  `id_terreno` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo_suelo` ENUM('SUELO_URBANO', 'SUELO_URBANIZABLE', 'SUELO_RUSTICO') NOT NULL,
  `superficie` DECIMAL UNSIGNED NOT NULL,
  `unidad` ENUM('m2', 'Ha') NOT NULL DEFAULT 'm2',
  `agua` BIT NULL DEFAULT 0,
  `luz` BIT NULL DEFAULT 0,
  PRIMARY KEY (`id_terreno`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pisos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pisos` ;

CREATE TABLE IF NOT EXISTS `pisos` (
  `id_piso` MEDIUMINT NOT NULL,
  `tipo_piso` ENUM('PISO', 'DUPLEX', 'ESTUDIO', 'LOFT', 'BAJO', 'ATICO') NOT NULL,
  `planta` TINYINT NOT NULL,
  `fachada` ENUM('EXTERIOR', 'INTERIOR') NULL,
  PRIMARY KEY (`id_piso`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viviendas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `viviendas` ;

CREATE TABLE IF NOT EXISTS `viviendas` (
  `id_vivienda` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo_vivienda` ENUM('PISO', 'CHALET_UNIFAMILIAR', 'CASA_RUSTICA', 'CASA_ESPECIAL') NOT NULL,
  `num_habitaciones` SMALLINT UNSIGNED NOT NULL DEFAULT 1,
  `num_baños` SMALLINT NOT NULL DEFAULT 1,
  `estado_vivienda` ENUM('BUENO', 'REFORMAR') NULL,
  `equipamiento` ENUM('VACIO', 'COCINA', 'COCINA_MUEBLES') NULL,
  `orientacion` ENUM('NORTE', 'SUR', 'ESTE', 'OESTE') NULL,
  `ascensor` BIT NULL,
  `arm_empotrados` BIT NULL,
  `calefaccion` BIT NULL,
  `aire_acond` BIT NULL,
  `terraza` BIT NULL,
  `balcon` BIT NULL,
  `trastero` BIT NULL,
  `plaza_garaje` BIT NULL,
  `piscina_propia` BIT NULL DEFAULT 0 COMMENT 'CHECK\nif tipo_vivienda == \'PISO\' \npiscina_propia = NULL',
  `urbanizacion` BIT NOT NULL,
  `piscina_comun` BIT NOT NULL,
  `zonas_verdes` BIT NOT NULL,
  `id_piso` MEDIUMINT NULL,
  PRIMARY KEY (`id_vivienda`),
  INDEX `fk_viviendas_pisos1_idx` (`id_piso` ASC),
  CONSTRAINT `fk_viviendas_pisos1`
    FOREIGN KEY (`id_piso`)
    REFERENCES `pisos` (`id_piso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `construcciones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `construcciones` ;

CREATE TABLE IF NOT EXISTS `construcciones` (
  `id_construccion` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo_construccion` ENUM('VIVIENDA', 'LOCAL', 'OFICINA', 'GARAJE', 'TRASTERO', 'NAVE') NOT NULL,
  `sup_util` DECIMAL UNSIGNED NOT NULL,
  `sup_construida` DECIMAL UNSIGNED NOT NULL,
  `unidad` VARCHAR(45) NULL DEFAULT 'm2',
  `id_vivienda` MEDIUMINT UNSIGNED NULL,
  PRIMARY KEY (`id_construccion`),
  INDEX `fk_construcciones_viviendas1_idx` (`id_vivienda` ASC),
  CONSTRAINT `fk_construcciones_viviendas1`
    FOREIGN KEY (`id_vivienda`)
    REFERENCES `viviendas` (`id_vivienda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coordenadas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coordenadas` ;

CREATE TABLE IF NOT EXISTS `coordenadas` (
  `id_coordenadas` INT NOT NULL,
  `longitud` DECIMAL NULL,
  `latitud` DECIMAL NULL,
  PRIMARY KEY (`id_coordenadas`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `inmuebles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `inmuebles` ;

CREATE TABLE IF NOT EXISTS `inmuebles` (
  `id_inmueble` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `via` VARCHAR(45) NOT NULL,
  `numero_via` SMALLINT NOT NULL,
  `cod_postal` MEDIUMINT UNSIGNED NOT NULL,
  `provincia` VARCHAR(45) NOT NULL,
  `localidad` VARCHAR(45) NOT NULL,
  `id_terreno` MEDIUMINT UNSIGNED NULL,
  `id_construccion` MEDIUMINT UNSIGNED NULL,
  `id_coordenadas` INT NOT NULL,
  PRIMARY KEY (`id_inmueble`),
  INDEX `fk_inmuebles_terrenos1_idx` (`id_terreno` ASC),
  INDEX `fk_inmuebles_construcciones1_idx` (`id_construccion` ASC),
  INDEX `fk_inmuebles_coordenadas1_idx` (`id_coordenadas` ASC),
  CONSTRAINT `fk_inmuebles_terrenos1`
    FOREIGN KEY (`id_terreno`)
    REFERENCES `terrenos` (`id_terreno`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_inmuebles_construcciones1`
    FOREIGN KEY (`id_construccion`)
    REFERENCES `construcciones` (`id_construccion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_inmuebles_coordenadas1`
    FOREIGN KEY (`id_coordenadas`)
    REFERENCES `coordenadas` (`id_coordenadas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contratos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contratos` ;

CREATE TABLE IF NOT EXISTS `contratos` (
  `id_contratos` INT NOT NULL,
  `activado` BIT NOT NULL,
  `fecha` DATE NOT NULL,
  `id_servico` TINYINT UNSIGNED NOT NULL,
  `id_profesional` SMALLINT UNSIGNED NULL,
  `id_particular` MEDIUMINT UNSIGNED NULL,
  `contratoscol` VARCHAR(45) NULL,
  `id_gestor` SMALLINT UNSIGNED NULL,
  PRIMARY KEY (`id_contratos`),
  INDEX `fk_contratos_tarifas1_idx` (`id_servico` ASC),
  INDEX `fk_contratos_profesionales1_idx` (`id_profesional` ASC),
  INDEX `fk_contratos_particulares1_idx` (`id_particular` ASC),
  INDEX `fk_contratos_gestores1_idx` (`id_gestor` ASC),
  CONSTRAINT `fk_contratos_tarifas1`
    FOREIGN KEY (`id_servico`)
    REFERENCES `servicios` (`id_servicio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contratos_profesionales1`
    FOREIGN KEY (`id_profesional`)
    REFERENCES `profesionales` (`id_profesional`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contratos_particulares1`
    FOREIGN KEY (`id_particular`)
    REFERENCES `particulares` (`id_particular`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contratos_gestores1`
    FOREIGN KEY (`id_gestor`)
    REFERENCES `gestores` (`id_gestor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `operaciones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `operaciones` ;

CREATE TABLE IF NOT EXISTS `operaciones` (
  `id_operacion` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo_operacion` ENUM('COMPRA', 'ALQUILER', 'VACACIONAL', 'COMPARTIR') NOT NULL,
  `precio` DECIMAL NOT NULL,
  `moneda` VARCHAR(45) NOT NULL DEFAULT '€',
  `tiempo` ENUM('SEMANA', 'QUINCENA', 'MES') NULL COMMENT 'if tipo_operacion == \'COMPRA\' tiempo = NULL\nelse tipo_operacion = ENUM',
  PRIMARY KEY (`id_operacion`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anuncios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `anuncios` ;

CREATE TABLE IF NOT EXISTS `anuncios` (
  `id_anuncios` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `fecha_anuncio` TIMESTAMP NOT NULL,
  `activado` BIT NOT NULL DEFAULT 0,
  `id_operacion` INT UNSIGNED NOT NULL,
  `id_inmueble` INT NOT NULL COMMENT 'CHECK\nid_terreno != NULL || id_construccion != NULL',
  `descripcion` VARCHAR(255) NULL,
  `id_profesional` SMALLINT UNSIGNED NULL COMMENT 'CHECK\n(id_profesional != NULL || id_part != NULL) &&\n(id_profesional == NULL || id_part == NULL)',
  `id_particular` MEDIUMINT UNSIGNED NULL COMMENT 'CHECK\n(id_profesional != NULL || id_part != NULL) &&\n(id_profesional == NULL || id_part == NULL)',
  `id_contrato` INT NULL,
  `id_gestor` SMALLINT UNSIGNED NULL,
  PRIMARY KEY (`id_anuncios`),
  INDEX `fk_anuncios_profesionales1_idx` (`id_profesional` ASC),
  INDEX `fk_anuncios_particulares1_idx` (`id_particular` ASC),
  INDEX `fk_anuncios_inmuebles1_idx` (`id_inmueble` ASC),
  INDEX `fk_anuncios_contratos1_idx` (`id_contrato` ASC),
  INDEX `fk_anuncios_gestores1_idx` (`id_gestor` ASC),
  INDEX `fk_anuncios_operaciones1_idx` (`id_operacion` ASC),
  CONSTRAINT `fk_anuncios_profesionales1`
    FOREIGN KEY (`id_profesional`)
    REFERENCES `profesionales` (`id_profesional`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anuncios_particulares1`
    FOREIGN KEY (`id_particular`)
    REFERENCES `particulares` (`id_particular`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anuncios_inmuebles1`
    FOREIGN KEY (`id_inmueble`)
    REFERENCES `inmuebles` (`id_inmueble`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anuncios_contratos1`
    FOREIGN KEY (`id_contrato`)
    REFERENCES `contratos` (`id_contratos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anuncios_gestores1`
    FOREIGN KEY (`id_gestor`)
    REFERENCES `gestores` (`id_gestor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anuncios_operaciones1`
    FOREIGN KEY (`id_operacion`)
    REFERENCES `operaciones` (`id_operacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fotos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fotos` ;

CREATE TABLE IF NOT EXISTS `fotos` (
  `numero_foto` TINYINT UNSIGNED NOT NULL,
  `texto` VARCHAR(45) NULL,
  `contenido` BLOB NOT NULL,
  `id_anuncios` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`numero_foto`, `id_anuncios`),
  INDEX `fk_fotos_anuncios1_idx` (`id_anuncios` ASC),
  CONSTRAINT `fk_fotos_anuncios1`
    FOREIGN KEY (`id_anuncios`)
    REFERENCES `anuncios` (`id_anuncios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `videos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `videos` ;

CREATE TABLE IF NOT EXISTS `videos` (
  `numero_video` TINYINT NOT NULL,
  `texto` VARCHAR(45) NULL,
  `contenido` BLOB NOT NULL,
  `id_anuncios` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`numero_video`, `id_anuncios`),
  INDEX `fk_videos_anuncios1_idx` (`id_anuncios` ASC),
  CONSTRAINT `fk_videos_anuncios1`
    FOREIGN KEY (`id_anuncios`)
    REFERENCES `anuncios` (`id_anuncios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `busquedas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `busquedas` ;

CREATE TABLE IF NOT EXISTS `busquedas` (
  `id_busqueda` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre_busqueda` VARCHAR(45) NOT NULL,
  `via` VARCHAR(45) NULL,
  `numero_via` TINYINT NULL,
  `cod_postal` MEDIUMINT NULL,
  `localidad` VARCHAR(45) NULL,
  `provincia` VARCHAR(45) NULL,
  `operacion` ENUM('VENTA', 'ALQUILER', 'COMPARTIR', 'VACACIONAL') NULL,
  `superficie_min` DECIMAL NULL,
  `superficie_max` DECIMAL NULL,
  `unidad` ENUM('m2', 'Ha') NULL,
  `precio_min` DECIMAL NULL,
  `precio_max` DECIMAL NULL,
  `moneda` VARCHAR(45) NULL DEFAULT '€',
  `terreno` BIT NULL,
  `tipo_suelo` ENUM('SUELO_URBANO', 'SUELO_URBANIZABLE', 'SUELO_RUSTICO') NULL,
  `construccion` BIT NULL,
  `tipo_construccion` ENUM('VIVIENDA', 'LOCAL', 'OFICINA', 'GARAJE', 'TRASTERO', 'NAVE') NULL,
  `tipo_vivienda` ENUM('PISO', 'CHALET_UNIFAMILIAR', 'CASA_RUSTICA', 'CASA_ESPECIAL') NULL,
  `tipo_piso` ENUM('PISO', 'DUPLEX', 'ESTUDIO', 'LOFT', 'BAJO', 'ATICO') NULL,
  `estado_vivienda` ENUM('BUENO', 'REFORMAR') NULL,
  `equipmiento` ENUM('VACIA', 'COCINA', 'COCINA_MUEBLES') NULL,
  `orientacion` ENUM('NORTE', 'SUR', 'ESTE', 'OESTE') NULL,
  `num_habitaciones` TINYINT NULL,
  `num_baños` TINYINT NULL,
  `ascensor` BIT NULL,
  `arm_empotrados` BIT NULL,
  `calefaccion` BIT NULL,
  `aire_acond` BIT NULL,
  `terraza` BIT NULL,
  `balcon` BIT NULL,
  `trastero` BIT NULL,
  `plaza_garaje` BIT NULL,
  `planta` TINYINT NULL,
  `fachada` ENUM('EXTERIOR', 'INTERIOR') NULL,
  `piscina_propia` BIT NULL,
  `urbanizacion` BIT NULL,
  `piscina_comun` BIT NULL,
  `zonas_verdes` BIT NULL,
  `id_demandante` SMALLINT UNSIGNED NOT NULL,
  `id_coordenadas` INT NOT NULL,
  PRIMARY KEY (`id_busqueda`),
  INDEX `fk_busquedas_demandantes1_idx` (`id_demandante` ASC),
  INDEX `fk_busquedas_coordenadas1_idx` (`id_coordenadas` ASC),
  CONSTRAINT `fk_busquedas_demandantes1`
    FOREIGN KEY (`id_demandante`)
    REFERENCES `demandantes` (`id_demandante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_busquedas_coordenadas1`
    FOREIGN KEY (`id_coordenadas`)
    REFERENCES `coordenadas` (`id_coordenadas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contactos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contactos` ;

CREATE TABLE IF NOT EXISTS `contactos` (
  `id_demandante` SMALLINT UNSIGNED NOT NULL,
  `id_anuncios` INT UNSIGNED NOT NULL,
  `fecha` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id_demandante`, `id_anuncios`),
  INDEX `fk_demandantes_has_anuncios_anuncios1_idx` (`id_anuncios` ASC),
  INDEX `fk_demandantes_has_anuncios_demandantes1_idx` (`id_demandante` ASC),
  CONSTRAINT `fk_demandantes_has_anuncios_demandantes1`
    FOREIGN KEY (`id_demandante`)
    REFERENCES `demandantes` (`id_demandante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_demandantes_has_anuncios_anuncios1`
    FOREIGN KEY (`id_anuncios`)
    REFERENCES `anuncios` (`id_anuncios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coincidencias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coincidencias` ;

CREATE TABLE IF NOT EXISTS `coincidencias` (
  `id_anuncios` INT UNSIGNED NOT NULL,
  `id_busqueda` INT UNSIGNED NOT NULL,
  `fecha` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id_anuncios`, `id_busqueda`),
  INDEX `fk_anuncios_has_busquedas_busquedas1_idx` (`id_busqueda` ASC),
  INDEX `fk_anuncios_has_busquedas_anuncios1_idx` (`id_anuncios` ASC),
  CONSTRAINT `fk_anuncios_has_busquedas_anuncios1`
    FOREIGN KEY (`id_anuncios`)
    REFERENCES `anuncios` (`id_anuncios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anuncios_has_busquedas_busquedas1`
    FOREIGN KEY (`id_busqueda`)
    REFERENCES `busquedas` (`id_busqueda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `registros`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `registros` ;

CREATE TABLE IF NOT EXISTS `registros` (
  `id_registro` MEDIUMINT NOT NULL,
  `fecha_hora` TIMESTAMP NOT NULL,
  `id_servicio` TINYINT UNSIGNED NULL,
  `id_informe` MEDIUMINT UNSIGNED NULL,
  `id_contrato` INT NULL,
  PRIMARY KEY (`id_registro`),
  INDEX `fk_registros_tarifas1_idx` (`id_servicio` ASC),
  INDEX `fk_registros_informes1_idx` (`id_informe` ASC),
  INDEX `fk_registros_contratos1_idx` (`id_contrato` ASC),
  CONSTRAINT `fk_registros_tarifas1`
    FOREIGN KEY (`id_servicio`)
    REFERENCES `servicios` (`id_servicio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_registros_informes1`
    FOREIGN KEY (`id_informe`)
    REFERENCES `informes` (`id_informe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_registros_contratos1`
    FOREIGN KEY (`id_contrato`)
    REFERENCES `contratos` (`id_contratos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `favoritos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `favoritos` ;

CREATE TABLE IF NOT EXISTS `favoritos` (
  `id_anuncios` INT UNSIGNED NOT NULL,
  `id_usuario` MEDIUMINT UNSIGNED NOT NULL,
  INDEX `fk_favoritos_anuncios1_idx` (`id_anuncios` ASC),
  INDEX `fk_favoritos_usuarios1_idx` (`id_usuario` ASC),
  PRIMARY KEY (`id_anuncios`, `id_usuario`),
  CONSTRAINT `fk_favoritos_anuncios1`
    FOREIGN KEY (`id_anuncios`)
    REFERENCES `anuncios` (`id_anuncios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_favoritos_usuarios1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
