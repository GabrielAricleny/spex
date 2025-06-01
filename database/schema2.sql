-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema db_spex
-- -----------------------------------------------------

CREATE SCHEMA IF NOT EXISTS `db_spex` DEFAULT CHARACTER SET utf8 ;
USE `db_spex` ;

-- -----------------------------------------------------
-- Table nivel_acesso
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `nivel_acesso` (
  `id_nivel` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(50) NOT NULL UNIQUE,
  PRIMARY KEY (`id_nivel`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table usuario
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nome_usuario` VARCHAR(45) NOT NULL UNIQUE,
  `senha` VARCHAR(255) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `nome_completo` VARCHAR(100) NOT NULL,
  `id_nivel_acesso` INT NOT NULL,
  PRIMARY KEY (`id_usuario`),
  INDEX `fk_usuario_nivel_acesso_idx` (`id_nivel_acesso`),
  CONSTRAINT `fk_usuario_nivel_acesso`
    FOREIGN KEY (`id_nivel_acesso`)
    REFERENCES `nivel_acesso` (`id_nivel`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table administrador
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administrador` (
  `id_administrador` INT NOT NULL AUTO_INCREMENT,
  `id_usuario` INT NOT NULL UNIQUE,
  `telefone` VARCHAR(20) NULL,
  PRIMARY KEY (`id_administrador`),
  INDEX `fk_administrador_usuario_idx` (`id_usuario`),
  CONSTRAINT `fk_administrador_usuario`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `usuario` (`id_usuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table curso
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `curso` (
  `id_curso` INT NOT NULL AUTO_INCREMENT,
  `nome_curso` VARCHAR(45) NOT NULL UNIQUE,
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table exame_sistema
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `exame_sistema` (
  `id_exame` INT NOT NULL AUTO_INCREMENT,
  `duracao` TIME NOT NULL,
  PRIMARY KEY (`id_exame`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table exame_sistema_realizado
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `exame_sistema_realizado` (
  `id_exame_realizado` INT NOT NULL AUTO_INCREMENT,
  `id_exame_sistema` INT NOT NULL,
  `data_realizacao` DATETIME NOT NULL,
  `nota_obtida` FLOAT NOT NULL,
  `tempo_decorrido` TIME NOT NULL,
  PRIMARY KEY (`id_exame_realizado`),
  INDEX `fk_exame_sistema_idx` (`id_exame_sistema` ASC),
  CONSTRAINT `fk_exame_sistema_realizado_exame_sistema`
    FOREIGN KEY (`id_exame_sistema`)
    REFERENCES `exame_sistema` (`id_exame`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table historico_aluno_exame_sistema
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `historico_aluno_exame_sistema` (
  `id_historico_aluno` INT NOT NULL AUTO_INCREMENT,
  `id_exame_sistema_realizado` INT NOT NULL,
  PRIMARY KEY (`id_historico_aluno`),
  INDEX `fk_historico_exame_realizado_idx` (`id_exame_sistema_realizado` ASC),
  CONSTRAINT `fk_historico_exame_realizado`
    FOREIGN KEY (`id_exame_sistema_realizado`)
    REFERENCES `exame_sistema_realizado` (`id_exame_realizado`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table estudante
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estudante` (
  `id_estudante` INT NOT NULL AUTO_INCREMENT,
  `nome_estudante` VARCHAR(45) NOT NULL,
  `data_nasc` DATE NOT NULL,
  `telefone` CHAR(15) NOT NULL UNIQUE,
  `email` VARCHAR(45) NOT NULL UNIQUE,
  `area_formacao` INT NOT NULL,
  `curso_pretendido` INT NOT NULL,
  `historico` INT,
  `nome_usuario` VARCHAR(45) NOT NULL UNIQUE,
  `senha_estudante` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`id_estudante`),
  INDEX `fk_area_formacao_idx` (`area_formacao` ASC),
  INDEX `fk_curso_pretendido_idx` (`curso_pretendido` ASC),
  INDEX `fk_historico_idx` (`historico` ASC),
  CONSTRAINT `fk_area_formacao`
    FOREIGN KEY (`area_formacao`)
    REFERENCES `curso` (`id_curso`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_curso_pretendido`
    FOREIGN KEY (`curso_pretendido`)
    REFERENCES `curso` (`id_curso`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_historico`
    FOREIGN KEY (`historico`)
    REFERENCES `historico_aluno_exame_sistema` (`id_historico_aluno`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table universidade
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `universidade` (
  `id_universidade` INT NOT NULL AUTO_INCREMENT,
  `nome_universidade` VARCHAR(45) NOT NULL UNIQUE,
  `nome_abreviado` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id_universidade`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table exame_universidade
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `exame_universidade` (
  `id_exame` INT NOT NULL AUTO_INCREMENT,
  `duracao` TIME NOT NULL,
  `id_universidade` INT NOT NULL UNIQUE,
  PRIMARY KEY (`id_exame`),
  CONSTRAINT `fk_exame_universidade_universidade`
    FOREIGN KEY (`id_universidade`)
    REFERENCES `universidade` (`id_universidade`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table disciplina
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `disciplina` (
  `id_disciplina` INT NOT NULL AUTO_INCREMENT,
  `nome_disciplina` VARCHAR(45) NOT NULL UNIQUE,
  PRIMARY KEY (`id_disciplina`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table disciplina_curso
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `disciplina_curso` (
  `id_disciplina` INT NOT NULL,
  `id_curso` INT NOT NULL,
  PRIMARY KEY (`id_disciplina`, `id_curso`),
  INDEX `fk_curso_idx` (`id_curso` ASC),
  CONSTRAINT `fk_disciplina_curso_curso`
    FOREIGN KEY (`id_curso`)
    REFERENCES `curso` (`id_curso`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_disciplina_curso_disciplina`
    FOREIGN KEY (`id_disciplina`)
    REFERENCES `disciplina` (`id_disciplina`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table tema
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tema` (
  `id_tema` INT NOT NULL AUTO_INCREMENT,
  `nome_tema` VARCHAR(100) NOT NULL UNIQUE,
  PRIMARY KEY (`id_tema`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table status_pergunta
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `status_pergunta` (
  `id_status` INT NOT NULL AUTO_INCREMENT,
  `descricao_status` VARCHAR(45) NOT NULL UNIQUE,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table pergunta_cadastrada
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pergunta_cadastrada` (
  `id_pergunta_cadastrada` INT NOT NULL AUTO_INCREMENT,
  `enunciado` VARCHAR(50) NOT NULL UNIQUE,
  `resposta` VARCHAR(50) NOT NULL,
  `curso` INT NOT NULL,
  `disciplina` INT NOT NULL,
  `tema` INT NOT NULL,
  `status` INT NOT NULL,
  PRIMARY KEY (`id_pergunta_cadastrada`),
  CONSTRAINT `fk_pergunta_curso`
    FOREIGN KEY (`curso`)
    REFERENCES `curso` (`id_curso`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_pergunta_disciplina`
    FOREIGN KEY (`disciplina`)
    REFERENCES `disciplina` (`id_disciplina`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_pergunta_tema`
    FOREIGN KEY (`tema`)
    REFERENCES `tema` (`id_tema`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_pergunta_status`
    FOREIGN KEY (`status`)
    REFERENCES `status_pergunta` (`id_status`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table lista_perguntas_exame_universidade
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lista_perguntas_exame_universidade` (
  `id_exame_universidade` INT NOT NULL,
  `id_pergunta` INT NOT NULL,
  PRIMARY KEY (`id_exame_universidade`, `id_pergunta`),
  INDEX `fk_pergunta_idx` (`id_pergunta` ASC),
  CONSTRAINT `fk_lista_perguntas_exame_universidade_exame`
    FOREIGN KEY (`id_exame_universidade`)
    REFERENCES `exame_universidade` (`id_exame`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_lista_perguntas_exame_universidade_pergunta`
    FOREIGN KEY (`id_pergunta`)
    REFERENCES `pergunta_cadastrada` (`id_pergunta_cadastrada`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table lista_perguntas_exame_sistema
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lista_perguntas_exame_sistema` (
  `id_exame_sistema` INT NOT NULL,
  `id_pergunta` INT NOT NULL,
  PRIMARY KEY (`id_exame_sistema`, `id_pergunta`),
  INDEX `fk_lista_pergunta_idx` (`id_pergunta` ASC),
  CONSTRAINT `fk_lista_perguntas_exame_sistema_exame`
    FOREIGN KEY (`id_exame_sistema`)
    REFERENCES `exame_sistema` (`id_exame`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_lista_perguntas_exame_sistema_pergunta`
    FOREIGN KEY (`id_pergunta`)
    REFERENCES `pergunta_cadastrada` (`id_pergunta_cadastrada`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table pergunta_acertada_exame_sistema
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pergunta_acertada_exame_sistema` (
  `id_exame_sistema_realizado` INT NOT NULL,
  `id_pergunta` INT NOT NULL,
  PRIMARY KEY (`id_exame_sistema_realizado`, `id_pergunta`),
  CONSTRAINT `fk_acerto_exame_realizado`
    FOREIGN KEY (`id_exame_sistema_realizado`)
    REFERENCES `exame_sistema_realizado` (`id_exame_realizado`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_acerto_pergunta`
    FOREIGN KEY (`id_pergunta`)
    REFERENCES `pergunta_cadastrada` (`id_pergunta_cadastrada`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Restauração dos valores de sistema
-- -----------------------------------------------------

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

