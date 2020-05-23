-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema InmobShop
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `InmobShop` ;

-- -----------------------------------------------------
-- Schema InmobShop
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `InmobShop` DEFAULT CHARACTER SET utf8 COLLATE
utf8_spanish_ci;
USE `InmobShop` ;

-- -----------------------------------------------------
-- Table `gestores`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestores` ;

CREATE TABLE IF NOT EXISTS `gestores` (
  `id_gestor` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(45) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `email` VARCHAR(254) NOT NULL,
  PRIMARY KEY (`id_gestor`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `password_gestor_UNIQUE` ON `gestores` (`password` ASC);

CREATE UNIQUE INDEX `email_gestor_UNIQUE` ON `gestores` (`email` ASC);

CREATE UNIQUE INDEX `usuario_UNIQUE` ON `gestores` (`usuario` ASC);


-- -----------------------------------------------------
-- Table `usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `usuarios` ;

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(45) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `email` VARCHAR(254) NOT NULL,
  `last_session` DATETIME NULL,
  `cookie` VARCHAR(60) NULL,
  `activado` BIT NOT NULL DEFAULT 0,
  `telefono` VARCHAR(9) NOT NULL,
  `token` VARCHAR(32) NOT NULL,
  `token_password` VARCHAR(60) NULL,
  `password_request` BIT DEFAULT 0,
  PRIMARY KEY (`id_usuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `profesionales`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `profesionales` ;

CREATE TABLE IF NOT EXISTS `profesionales` (
  `id_profesional` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre_comercial` VARCHAR(45) NULL,
  `nif` VARCHAR(9) NOT NULL,
  `direccion` VARCHAR(100) NULL,
  `url_logo` VARCHAR(254) NULL,
  `id_usuario` MEDIUMINT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_profesional`),
  CONSTRAINT `fk_profesionales_usuarios1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_anunciantes_prof_usuarios1_idx` ON `profesionales` (`id_usuario` ASC);


-- -----------------------------------------------------
-- Table `particulares`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `particulares` ;

CREATE TABLE IF NOT EXISTS `particulares` (
  `id_particular` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `dni` VARCHAR(9) NOT NULL,
  `direccion` VARCHAR(100) NULL,
  `id_usuario` MEDIUMINT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_particular`),
  CONSTRAINT `fk_particulares_usuarios1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_anunciantes_part_usuarios1_idx` ON `particulares` (`id_usuario` ASC);


-- -----------------------------------------------------
-- Table `demandantes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `demandantes` ;

CREATE TABLE IF NOT EXISTS `demandantes` (
  `id_demandante` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_usuario` MEDIUMINT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_demandante`),
  CONSTRAINT `fk_demandantes_usuarios1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_demandantes_usuarios1_idx` ON `demandantes` (`id_usuario` ASC);


-- -----------------------------------------------------
-- Table `servicios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `servicios` ;

CREATE TABLE IF NOT EXISTS `servicios` (
  `id_servicio` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre_servicio` VARCHAR(45) NOT NULL,
  `destinatario` ENUM('particular', 'profesional', 'todos'),
  `nivel_servicio` ENUM('1', '2', '3', '4', '5') NOT NULL,
  `descripcion` VARCHAR(255) NOT NULL,
  `num_anuncios` SMALLINT NOT NULL,
  `num_dias` SMALLINT NOT NULL,
  `precio` DECIMAL(6,2) NOT NULL,
  `moneda` VARCHAR(45) NOT NULL DEFAULT '€',
  `estado_revision` ENUM('pendiente', 'aprobado', 'revision') NOT NULL DEFAULT 'pendiente',
  `fecha_alta` DATE NULL,
  `estado_vigencia` ENUM('vigente', 'baja') NOT NULL,
  `fecha_baja` DATE NULL,
  `id_gestor` SMALLINT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_servicio`),
  CONSTRAINT `fk_servicios_gestores1`
    FOREIGN KEY (`id_gestor`)
    REFERENCES `gestores` (`id_gestor`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE INDEX `fk_tarifas_administradores1_idx` ON `servicios` (`id_gestor` ASC);


-- -----------------------------------------------------
-- Table `informes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `informes` ;

CREATE TABLE IF NOT EXISTS `informes` (
  `id_informe` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre_informe` VARCHAR(100) NOT NULL,
  `fecha_informe` TIMESTAMP NOT NULL,
  `url_informe` VARCHAR(255) NOT NULL COMMENT 'la url del informe informe_dompdf.php donde lo ha subido el gestor de la aplicación',
  `destinatario_informe` ENUM('publico', 'particular', 'profesional') NOT NULL,
  `estado_revision` ENUM('pendiente', 'aprobado', 'revision') NOT NULL,
  `id_gestor` SMALLINT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_informe`),
  CONSTRAINT `fk_informes_administradores1`
    FOREIGN KEY (`id_gestor`)
    REFERENCES `gestores` (`id_gestor`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fk_informes_administradores1_idx` ON `informes` (`id_gestor` ASC);

CREATE UNIQUE INDEX `url_informe_UNIQUE` ON `informes` (`url_informe` ASC);


-- -----------------------------------------------------
-- Table `terrenos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `terrenos` ;

CREATE TABLE IF NOT EXISTS `terrenos` (
  `id_terreno` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo_suelo` ENUM('Suelo_urbano', 'Suelo_urbanizable', 'Suelo_rústico') NOT NULL,
  `superficie` DECIMAL(10,2) UNSIGNED NOT NULL,
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
  `tipo_piso` ENUM('Piso', 'Duplex', 'Estudio', 'Loft', 'Bajo', 'Ático') NOT NULL,
  `planta` TINYINT NOT NULL,
  `fachada` ENUM('Exterior', 'Interior') NULL,
  PRIMARY KEY (`id_piso`),
  CONSTRAINT `pisos_chk_1` CHECK (
    (
      (`tipo_piso` = 'Bajo')
      AND (`planta` = 0)
    )
    OR (`tipo_piso` != 'Bajo')
  )
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viviendas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `viviendas` ;

CREATE TABLE IF NOT EXISTS `viviendas` (
  `id_vivienda` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo_vivienda` ENUM('Piso', 'Chalet_unifamiliar', 'Casa_rústica', 'Casa_especial') NOT NULL,
  `num_habitaciones` SMALLINT UNSIGNED NOT NULL DEFAULT 1,
  `num_banyos` SMALLINT COLLATE utf8_spanish_ci NOT NULL DEFAULT 1,
  `estado_vivienda` ENUM('Nuevo', 'Bueno', 'Reformar') NULL,
  `equipamiento` ENUM('Vacío', 'Cocina', 'Amueblado') NULL,
  `orientacion` ENUM('Norte', 'Sur', 'Este', 'Oeste') NULL,
  `ascensor` BIT NOT NULL DEFAULT 0,
  `arm_empotrados` BIT NOT NULL DEFAULT 0,
  `calefaccion` BIT NOT NULL DEFAULT 0,
  `aire_acond` BIT NOT NULL DEFAULT 0,
  `terraza` BIT NOT NULL DEFAULT 0,
  `balcon` BIT NOT NULL DEFAULT 0,
  `trastero` BIT NOT NULL DEFAULT 0,
  `plaza_garaje` BIT NOT NULL DEFAULT 0,
  `piscina_propia` BIT NOT NULL DEFAULT 0,
  `urbanizacion` BIT NOT NULL DEFAULT 0,
  `piscina_comun` BIT NOT NULL DEFAULT 0,
  `zonas_verdes` BIT NOT NULL DEFAULT 0,
  `id_piso` MEDIUMINT NULL,
  PRIMARY KEY (`id_vivienda`),
  CONSTRAINT `fk_viviendas_pisos1`
    FOREIGN KEY (`id_piso`)
    REFERENCES `pisos` (`id_piso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `viviendas_chk_1` CHECK (
	  NOT((`piscina_comun` != 0) AND (`piscina_propia` != 0 ))
  )
)
ENGINE = InnoDB;

CREATE INDEX `fk_viviendas_pisos1_idx` ON `viviendas` (`id_piso` ASC);


-- -----------------------------------------------------
-- Table `construcciones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `construcciones` ;

CREATE TABLE IF NOT EXISTS `construcciones` (
  `id_construccion` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo_construccion` ENUM('Vivienda', 'Local', 'Oficina', 'Garaje', 'Trastero', 'Nave') NOT NULL,
  `sup_util` DECIMAL(8,2) UNSIGNED NOT NULL,
  `sup_construida` DECIMAL(8,2) UNSIGNED NOT NULL,
  `unidad` VARCHAR(45) NULL DEFAULT 'm2',
  `id_vivienda` MEDIUMINT UNSIGNED NULL,
  PRIMARY KEY (`id_construccion`),
  CONSTRAINT `fk_construcciones_viviendas1`
    FOREIGN KEY (`id_vivienda`)
    REFERENCES `viviendas` (`id_vivienda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_construcciones_viviendas1_idx` ON `construcciones` (`id_vivienda` ASC);


-- -----------------------------------------------------
-- Table `coordenadas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coordenadas` ;

CREATE TABLE IF NOT EXISTS `coordenadas` (
  `id_coordenadas` INT NOT NULL,
  `longitud` DECIMAL(10,7) NULL,
  `latitud` DECIMAL(10,7) NULL,
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

CREATE INDEX `fk_inmuebles_terrenos1_idx` ON `inmuebles` (`id_terreno` ASC);

CREATE INDEX `fk_inmuebles_construcciones1_idx` ON `inmuebles` (`id_construccion` ASC);

CREATE INDEX `fk_inmuebles_coordenadas1_idx` ON `inmuebles` (`id_coordenadas` ASC);


-- -----------------------------------------------------
-- Table `contratos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contratos` ;

CREATE TABLE IF NOT EXISTS `contratos` (
  `id_contrato` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `pagado` BIT NOT NULL DEFAULT 0,
  `fecha_contrato` DATE NOT NULL,
  `id_servicio` TINYINT UNSIGNED NOT NULL,
  `id_profesional` SMALLINT UNSIGNED NULL,
  `id_particular` MEDIUMINT UNSIGNED NULL,
  PRIMARY KEY (`id_contrato`),
  CONSTRAINT `fk_contratos_servicios1`
    FOREIGN KEY (`id_servicio`)
    REFERENCES `servicios` (`id_servicio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contratos_anunciantes_prof1`
    FOREIGN KEY (`id_profesional`)
    REFERENCES `profesionales` (`id_profesional`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contratos_anunciantes_part1`
    FOREIGN KEY (`id_particular`)
    REFERENCES `particulares` (`id_particular`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `contratos_chk_1` CHECK (
    (
      (`id_profesional` IS NOT NULL)
      OR (`id_particular` IS NOT NULL)
    )
    AND (
      (`id_profesional` IS NULL)
      OR (`id_particular` IS NULL)
    )
  )
)
ENGINE = InnoDB;

CREATE INDEX `fk_contratos_tarifas1_idx` ON `contratos` (`id_servicio` ASC);

CREATE INDEX `fk_contratos_anunciantes_prof1_idx` ON `contratos` (`id_profesional` ASC);

CREATE INDEX `fk_contratos_anunciantes_part1_idx` ON `contratos` (`id_particular` ASC);


-- -----------------------------------------------------
-- Table `operaciones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `operaciones` ;

CREATE TABLE IF NOT EXISTS `operaciones` (
  `id_operacion` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo_operacion` ENUM('venta', 'alquiler', 'vacacional', 'compartir') NOT NULL,
  `precio` DECIMAL(12,2) NOT NULL,
  `moneda` VARCHAR(45) NOT NULL DEFAULT '€',
  `tiempo` ENUM('Semana', 'Quincena', 'Mes') NULL,
  PRIMARY KEY (`id_operacion`),
  CONSTRAINT `operaciones_chk_1` CHECK (
	  NOT((`tipo_operacion` = 'venta') AND (`tiempo` = 'Semana'))
	  AND NOT((`tipo_operacion` = 'venta') AND  (`tiempo` = 'Quincena'))
	  AND NOT((`tipo_operacion` = 'venta') AND (`tiempo` = 'Mes'))
  )
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fotos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fotos` ;

CREATE TABLE IF NOT EXISTS `fotos` (
  `id_fotos` INT UNSIGNED NOT NULL,
  `urls_textos_fotos` TEXT NOT NULL,
  PRIMARY KEY (`id_fotos`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anuncios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `anuncios` ;

CREATE TABLE IF NOT EXISTS `anuncios` (
  `id_anuncio` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `fecha_anuncio` TIMESTAMP NOT NULL,
  `estado` ENUM('pendiente', 'aprobado') NOT NULL DEFAULT 'pendiente',
  `id_operacion` INT UNSIGNED NOT NULL,
  `id_inmueble` INT UNSIGNED NOT NULL,
  `descripcion` TEXT NULL,
  `id_profesional` SMALLINT UNSIGNED NULL,
  `id_particular` MEDIUMINT UNSIGNED NULL,
  `id_contrato` INT UNSIGNED NULL,
  `id_gestor` SMALLINT UNSIGNED NULL,
  `id_fotos` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_anuncio`),
  CONSTRAINT `fk_anuncios_profesionales1`
    FOREIGN KEY (`id_profesional`)
    REFERENCES `profesionales` (`id_profesional`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_anuncios_particulares1`
    FOREIGN KEY (`id_particular`)
    REFERENCES `particulares` (`id_particular`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_anuncios_inmuebles1`
    FOREIGN KEY (`id_inmueble`)
    REFERENCES `inmuebles` (`id_inmueble`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_anuncios_contratos1`
    FOREIGN KEY (`id_contrato`)
    REFERENCES `contratos` (`id_contrato`)
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
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anuncios_fotos1`
    FOREIGN KEY (`id_fotos`)
    REFERENCES `fotos` (`id_fotos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `anuncios_chk_1` CHECK (
    (
      (`id_profesional` IS NOT NULL)
      OR (`id_particular` IS NOT NULL)
    )
    AND (
      (`id_profesional` IS NULL)
      OR (`id_particular` IS NULL)
    )
  )
)
ENGINE = InnoDB;

CREATE INDEX `fk_anuncios_anunciantes_prof1_idx` ON `anuncios` (`id_profesional` ASC);

CREATE INDEX `fk_anuncios_anunciantes_part1_idx` ON `anuncios` (`id_particular` ASC);

CREATE INDEX `fk_anuncios_inmuebles1_idx` ON `anuncios` (`id_inmueble` ASC);

CREATE INDEX `fk_anuncios_contratos1_idx` ON `anuncios` (`id_contrato` ASC);

CREATE INDEX `fk_anuncios_gestores1_idx` ON `anuncios` (`id_gestor` ASC);

CREATE INDEX `fk_anuncios_operaciones1_idx` ON `anuncios` (`id_operacion` ASC);

CREATE INDEX `fk_anuncios_fotos1_idx` ON `anuncios` (`id_fotos` ASC);


-- -----------------------------------------------------
-- Table `busquedas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `busquedas` ;

CREATE TABLE IF NOT EXISTS `busquedas` (
  `id_busqueda` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre_busqueda` VARCHAR(45) NOT NULL,
  `pais` VARCHAR(45) NULL DEFAULT 'Espanya',
  `provincia` VARCHAR(45) NOT NULL,
  `localidad` VARCHAR(45) NULL,
  `via` VARCHAR(45) NULL,
  `numero_via` TINYINT NULL,
  `cod_postal` MEDIUMINT NULL,
  `tipo_operacion` ENUM('Venta', 'Alquiler', 'Compartir', 'Vacacional') NOT NULL,
  `superficie_min` DECIMAL(10,2) NULL,
  `superficie_max` DECIMAL(10,2) NULL,
  `unidad` ENUM('m2', 'Ha') NULL,
  `precio_min` DECIMAL(10,2) NULL,
  `precio_max` DECIMAL(10,2) NULL,
  `moneda` VARCHAR(45) NULL DEFAULT '€',
  `tipo_suelo` ENUM('Suelo_urbano', 'Suelo_urbanizable', 'Suelo_rústico') NULL,
  `tipo_construccion` ENUM('Vivienda', 'Local', 'Oficina', 'Garaje', 'Trastero', 'Nave') NULL,
  `tipo_vivienda` ENUM('Piso', 'Chalet_unifamiliar', 'Casa_rústica', 'Casa_especial') NULL,
  `tipo_piso` ENUM('Piso', 'Duplex', 'Estudio', 'Loft', 'Bajo', 'Ático') NULL,
  `estado_vivienda` ENUM('Nueva', 'Bueno', 'Reformar') NULL,
  `equipamiento` ENUM('Vacía', 'Cocina', 'Amueblada') NULL,
  `orientacion` ENUM('Norte', 'Sur', 'Este', 'Oeste') NULL,
  `num_habitaciones` TINYINT NULL,
  `num_banyos` TINYINT COLLATE utf8_spanish_ci NULL,
  `ascensor` BIT NULL DEFAULT 0,
  `arm_empotrados` BIT NULL DEFAULT 0,
  `calefaccion` BIT NULL DEFAULT 0,
  `aire_acond` BIT NULL DEFAULT 0,
  `terraza` BIT NULL DEFAULT 0,
  `balcon` BIT NULL DEFAULT 0,
  `trastero` BIT NULL DEFAULT 0,
  `plaza_garaje` BIT NULL DEFAULT 0,
  `planta` TINYINT NULL,
  `fachada` ENUM('Exterior', 'Interior') NULL,
  `piscina_propia` BIT NULL DEFAULT 0,
  `urbanizacion` BIT NULL DEFAULT 0,
  `piscina_comun` BIT NULL DEFAULT 0,
  `zonas_verdes` BIT NULL DEFAULT 0,
  `id_demandante` SMALLINT UNSIGNED NOT NULL,
  `id_coordenadas` INT NOT NULL,
  PRIMARY KEY (`id_busqueda`),
  CONSTRAINT `fk_busquedas_demandantes1`
    FOREIGN KEY (`id_demandante`)
    REFERENCES `demandantes` (`id_demandante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_busquedas_coordenadas1`
    FOREIGN KEY (`id_coordenadas`)
    REFERENCES `coordenadas` (`id_coordenadas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `busquedas_chk_1` CHECK (
    (`tipo_suelo` IS NOT NULL)
    OR (`tipo_construccion` IS NOT NULL)
  )
)
ENGINE = InnoDB;

CREATE INDEX `fk_busquedas_demandantes1_idx` ON `busquedas` (`id_demandante` ASC);

CREATE INDEX `fk_busquedas_coordenadas1_idx` ON `busquedas` (`id_coordenadas` ASC);


-- -----------------------------------------------------
-- Table `contactos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contactos` ;

CREATE TABLE IF NOT EXISTS `contactos` (
  `id_demandante` SMALLINT UNSIGNED NOT NULL,
  `id_anuncio` INT UNSIGNED NOT NULL,
  `fecha` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id_demandante`, `id_anuncio`),
  CONSTRAINT `fk_demandantes_has_anuncios_demandantes1`
    FOREIGN KEY (`id_demandante`)
    REFERENCES `demandantes` (`id_demandante`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_demandantes_has_anuncios_anuncios1`
    FOREIGN KEY (`id_anuncio`)
    REFERENCES `anuncios` (`id_anuncio`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fk_demandantes_has_anuncios_anuncios1_idx` ON `contactos` (`id_anuncio` ASC);

CREATE INDEX `fk_demandantes_has_anuncios_demandantes1_idx` ON `contactos` (`id_demandante` ASC);


-- -----------------------------------------------------
-- Table `coincidencias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coincidencias` ;

CREATE TABLE IF NOT EXISTS `coincidencias` (
  `id_anuncio` INT UNSIGNED NOT NULL,
  `id_busqueda` INT UNSIGNED NOT NULL,
  `fecha` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id_anuncio`, `id_busqueda`),
  CONSTRAINT `fk_anuncios_has_busquedas_anuncios1`
    FOREIGN KEY (`id_anuncio`)
    REFERENCES `anuncios` (`id_anuncio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anuncios_has_busquedas_busquedas1`
    FOREIGN KEY (`id_busqueda`)
    REFERENCES `busquedas` (`id_busqueda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_anuncios_has_busquedas_busquedas1_idx` ON `coincidencias` (`id_busqueda` ASC);

CREATE INDEX `fk_anuncios_has_busquedas_anuncios1_idx` ON `coincidencias` (`id_anuncio` ASC);


-- -----------------------------------------------------
-- Table `registros`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `registros` ;

CREATE TABLE IF NOT EXISTS `registros` (
  `id_registro` MEDIUMINT NOT NULL AUTO_INCREMENT,
  `fecha_registro` TIMESTAMP NOT NULL,
  `texto_registro` VARCHAR(255) NOT NULL,
  `id_servicio` TINYINT UNSIGNED NULL,
  `id_informe` MEDIUMINT UNSIGNED NULL,
  `id_contrato` INT UNSIGNED NULL,
  `id_anuncio` INT UNSIGNED NULL,
  PRIMARY KEY (`id_registro`),
  CONSTRAINT `fk_registros_servicios1`
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
    REFERENCES `contratos` (`id_contrato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_registros_anuncios1`
    FOREIGN KEY (`id_anuncio`)
    REFERENCES `anuncios` (`id_anuncio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `registros_chk_1` CHECK(
    (
      (`id_servicio` != NULL)
      AND (`id_informe` = NULL)
      AND (`id_contrato` = NULL)
      AND (`id_anuncio` = NULL)
    ) OR (
      (`id_servicio` = NULL)
      AND (`id_informe` != NULL)
      AND (`id_contrato` = NULL)
      AND (`id_anuncio` = NULL)
    ) OR (
      (`id_servicio` = NULL)
      AND (`id_informe` = NULL)
      AND (`id_contrato` != NULL)
      AND (`id_anuncio` = NULL)
    ) OR (
      (`id_servicio` = NULL)
      AND (`id_informe` = NULL)
      AND (`id_contrato` = NULL)
      AND (`id_anuncio` != NULL)
    )
  )
)
ENGINE = InnoDB;

CREATE INDEX `fk_registros_servicios1_idx` ON `registros` (`id_servicio` ASC);

CREATE INDEX `fk_registros_informes1_idx` ON `registros` (`id_informe` ASC);

CREATE INDEX `fk_registros_contratos1_idx` ON `registros` (`id_contrato` ASC);

CREATE INDEX `fk_registros_anuncios1_idx` ON `registros` (`id_anuncio` ASC);

-- -----------------------------------------------------
-- Table `favoritos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `favoritos` ;

CREATE TABLE IF NOT EXISTS `favoritos` (
  `id_anuncio` INT UNSIGNED NOT NULL,
  `id_usuario` MEDIUMINT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_anuncio`, `id_usuario`),
  CONSTRAINT `fk_favoritos_anuncios1`
    FOREIGN KEY (`id_anuncio`)
    REFERENCES `anuncios` (`id_anuncio`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_favoritos_usuarios1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fk_favoritos_anuncios1_idx` ON `favoritos` (`id_anuncio` ASC);

CREATE INDEX `fk_favoritos_usuarios1_idx` ON `favoritos` (`id_usuario` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
