-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema db_spex
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db_spex
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_spex` DEFAULT CHARACTER SET utf8 ;
USE `db_spex` ;

-- -----------------------------------------------------
-- Table `db_spex`.`curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_spex`.`curso` (
  `id_curso` INT NOT NULL AUTO_INCREMENT,
  `nome_curso` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_curso`),
  UNIQUE INDEX `id_UNIQUE` (`id_curso` ASC) VISIBLE,
  UNIQUE INDEX `id_pergunta_UNIQUE` (`nome_curso` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_spex`.`exame_sistema`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_spex`.`exame_sistema` (
  `id_exame` INT NOT NULL AUTO_INCREMENT,
  `duracao` TIME NOT NULL,
  PRIMARY KEY (`id_exame`),
  UNIQUE INDEX `id_UNIQUE` (`id_exame` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_spex`.`exame_sistema_realizado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_spex`.`exame_sistema_realizado` (
  `id_exame_realizado` INT NOT NULL AUTO_INCREMENT,
  `id_exame_sistema` INT NOT NULL,
  `data_realizacao` DATETIME NOT NULL,
  `nota_obtida` FLOAT NOT NULL,
  `tempo_decorrido` TIME NOT NULL,
  PRIMARY KEY (`id_exame_realizado`),
  UNIQUE INDEX `id_UNIQUE` (`id_exame_realizado` ASC) VISIBLE,
  INDEX `id_exame_idx` (`id_exame_sistema` ASC) VISIBLE,
  CONSTRAINT `id_exame_sistema`
    FOREIGN KEY (`id_exame_sistema`)
    REFERENCES `db_spex`.`exame_sistema` (`id_exame`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_spex`.`historico_aluno_exame_sistema`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_spex`.`historico_aluno_exame_sistema` (
  `id_historico_aluno` INT NOT NULL AUTO_INCREMENT,
  `id_exame_sistema_realizado` INT NOT NULL,
  PRIMARY KEY (`id_historico_aluno`),
  UNIQUE INDEX `id_UNIQUE` (`id_historico_aluno` ASC) VISIBLE,
  INDEX `id_exame_sistema_realizado_idx` (`id_exame_sistema_realizado` ASC) VISIBLE,
  CONSTRAINT `id_exame_sistema_realizado`
    FOREIGN KEY (`id_exame_sistema_realizado`)
    REFERENCES `db_spex`.`exame_sistema_realizado` (`id_exame_realizado`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_spex`.`estudante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_spex`.`estudante` (
  `id_estudante` INT NOT NULL AUTO_INCREMENT,
  `nome_estudante` VARCHAR(45) NOT NULL,
  `data_nasc` DATE NOT NULL,
  `telefone` CHAR(15) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `area_formacao` INT NOT NULL,
  `curso_pretendido` INT NOT NULL,
  `historico` INT,
  `nome_usuario` VARCHAR(45) NOT NULL UNIQUE,
  `senha_estudante` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_estudante`),
  UNIQUE INDEX `id_UNIQUE` (`id_estudante` ASC) VISIBLE,
  UNIQUE INDEX `telefone_UNIQUE` (`telefone` ASC) VISIBLE,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE,
  INDEX `area_formacao_idx` (`area_formacao` ASC) VISIBLE,
  INDEX `curso_pretendido_idx` (`curso_pretendido` ASC) VISIBLE,
  INDEX `historico_idx` (`historico` ASC) VISIBLE,
  CONSTRAINT `area_formacao`
    FOREIGN KEY (`area_formacao`)
    REFERENCES `db_spex`.`curso` (`id_curso`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `curso_pretendido`
    FOREIGN KEY (`curso_pretendido`)
    REFERENCES `db_spex`.`curso` (`id_curso`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `historico`
    FOREIGN KEY (`historico`)
    REFERENCES `db_spex`.`historico_aluno_exame_sistema` (`id_historico_aluno`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_spex`.`universidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_spex`.`universidade` (
  `id_universidade` INT NOT NULL AUTO_INCREMENT,
  `nome_universidade` VARCHAR(45) NOT NULL,
  `nome_abreviado` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id_universidade`),
  UNIQUE INDEX `id_universidade_UNIQUE` (`id_universidade` ASC) VISIBLE,
  UNIQUE INDEX `nome_universidade_UNIQUE` (`nome_universidade` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_spex`.`exame_universidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_spex`.`exame_universidade` (
  `id_exame` INT NOT NULL AUTO_INCREMENT,
  `duracao` TIME NOT NULL,
  `id_universidade` INT NOT NULL,
  PRIMARY KEY (`id_exame`),
  UNIQUE INDEX `id_UNIQUE` (`id_exame` ASC) VISIBLE,
  UNIQUE INDEX `id_universidade_UNIQUE` (`id_universidade` ASC) VISIBLE,
  CONSTRAINT `id_universidade`
    FOREIGN KEY (`id_universidade`)
    REFERENCES `db_spex`.`universidade` (`id_universidade`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_spex`.`pergunta_cadastrada`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_spex`.`pergunta_cadastrada` (
  `id_pergunta_cadastrada` INT NOT NULL AUTO_INCREMENT,
  `enunciado` VARCHAR(50) NOT NULL,
  `resposta` VARCHAR(50) NOT NULL,
  `curso` INT NOT NULL,
  `disciplina` INT NOT NULL,
  `tema` INT NOT NULL,
  `status` INT NOT NULL,
  PRIMARY KEY (`id_pergunta_cadastrada`),
  UNIQUE INDEX `id_UNIQUE` (`id_pergunta_cadastrada` ASC) VISIBLE,
  UNIQUE INDEX `enunciado_UNIQUE` (`enunciado` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_spex`.`disciplina`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_spex`.`disciplina` (
  `id_disciplina` INT NOT NULL AUTO_INCREMENT,
  `nome_disciplina` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_disciplina`),
  UNIQUE INDEX `id_UNIQUE` (`id_disciplina` ASC) VISIBLE,
  UNIQUE INDEX `nome_disciplina_UNIQUE` (`nome_disciplina` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_spex`.`disciplina_curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_spex`.`disciplina_curso` (
  `id_disciplina` INT NOT NULL,
  `id_curso` INT NOT NULL,
  PRIMARY KEY (`id_disciplina`, `id_curso`),
  INDEX `id_curso_idx` (`id_curso` ASC) VISIBLE,
  CONSTRAINT `id_curso`
    FOREIGN KEY (`id_curso`)
    REFERENCES `db_spex`.`curso` (`id_curso`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `id_disciplina`
    FOREIGN KEY (`id_disciplina`)
    REFERENCES `db_spex`.`disciplina` (`id_disciplina`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_spex`.`lista_perguntas_exame_universidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_spex`.`lista_perguntas_exame_universidade` (
  `id_exame_universidade` INT NOT NULL,
  `id_pergunta` INT NOT NULL,
  PRIMARY KEY (`id_exame_universidade`, `id_pergunta`),
  INDEX `id_pergunta_idx` (`id_pergunta` ASC) VISIBLE,
  CONSTRAINT `id_exame`
    FOREIGN KEY (`id_exame_universidade`)
    REFERENCES `db_spex`.`exame_universidade` (`id_exame`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `id_pergunta`
    FOREIGN KEY (`id_pergunta`)
    REFERENCES `db_spex`.`pergunta_cadastrada` (`id_pergunta_cadastrada`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_spex`.`lista_perguntas_exame_sistema`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_spex`.`lista_perguntas_exame_sistema` (
  `id_exame_sistema` INT NOT NULL,
  `id_pergunta` INT NOT NULL,
  PRIMARY KEY (`id_exame_sistema`, `id_pergunta`),
  INDEX `id_pergunta_idx` (`id_pergunta` ASC) VISIBLE,
  CONSTRAINT `exame_sistema`
    FOREIGN KEY (`id_exame_sistema`)
    REFERENCES `db_spex`.`exame_sistema` (`id_exame`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `pergunta`
    FOREIGN KEY (`id_pergunta`)
    REFERENCES `db_spex`.`pergunta_cadastrada` (`id_pergunta_cadastrada`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_spex`.`pergunta_acertada_exame_sistema`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_spex`.`pergunta_acertada_exame_sistema` (
  `id_exame_sistema_realizado` INT NOT NULL,
  `id_pergunta` INT NOT NULL,
  PRIMARY KEY (`id_exame_sistema_realizado`),
  INDEX `id_pergunta_idx` (`id_pergunta` ASC) VISIBLE,
  CONSTRAINT `id_exame_sistema_realizado1`
    FOREIGN KEY (`id_exame_sistema_realizado`)
    REFERENCES `db_spex`.`exame_sistema_realizado` (`id_exame_realizado`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `id_pergunta_acertada`
    FOREIGN KEY (`id_pergunta`)
    REFERENCES `db_spex`.`lista_perguntas_exame_sistema` (`id_exame_sistema`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_spex`.`pergunta_errada_exame_sistema`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_spex`.`pergunta_errada_exame_sistema` (
  `id_exame_sistema_realizado` INT NOT NULL,
  `id_pergunta` INT NOT NULL,
  PRIMARY KEY (`id_exame_sistema_realizado`),
  CONSTRAINT `id_exame_sistema_realizado2`
    FOREIGN KEY (`id_exame_sistema_realizado`)
    REFERENCES `db_spex`.`exame_sistema_realizado` (`id_exame_realizado`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `id_pergunta_errada`
    FOREIGN KEY (`id_pergunta`)
    REFERENCES `db_spex`.`lista_perguntas_exame_universidade` (`id_pergunta`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_spex`.`categoria_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_spex`.`categoria_usuario` (
  `id_categoria` INT NOT NULL AUTO_INCREMENT,
  `nome_categoria` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_categoria`),
  UNIQUE INDEX `id_categoria_UNIQUE` (`id_categoria` ASC) VISIBLE,
  UNIQUE INDEX `nome_categoria_UNIQUE` (`nome_categoria` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_spex`.`administrador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_spex`.`administrador` (
  `id_administrador` INT NOT NULL AUTO_INCREMENT,
  `nome_administrador` VARCHAR(45) NOT NULL,
  `telefone` CHAR(15) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `senha_administrador` VARCHAR(16) NOT NULL,
  `categoria` INT NOT NULL,
  PRIMARY KEY (`id_administrador`),
  UNIQUE INDEX `id_UNIQUE` (`id_administrador` ASC) VISIBLE,
  UNIQUE INDEX `telefone_UNIQUE` (`telefone` ASC) VISIBLE,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE,
  INDEX `categoria_idx` (`categoria` ASC) VISIBLE,
  CONSTRAINT `categoria`
    FOREIGN KEY (`categoria`)
    REFERENCES `db_spex`.`categoria_usuario` (`id_categoria`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_spex`.`curso_alvo_exame_sistema`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_spex`.`curso_alvo_exame_sistema` (
  `id_curso` INT NOT NULL,
  `id_exame_sistema` INT NOT NULL,
  PRIMARY KEY (`id_curso`, `id_exame_sistema`),
  INDEX `id_exame_idx` (`id_exame_sistema` ASC) VISIBLE,
  CONSTRAINT `id_curso1`
    FOREIGN KEY (`id_curso`)
    REFERENCES `db_spex`.`curso` (`id_curso`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `id_exame_sistema1`
    FOREIGN KEY (`id_exame_sistema`)
    REFERENCES `db_spex`.`exame_sistema` (`id_exame`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_spex`.`componente_exame_sistema`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_spex`.`componente_exame_sistema` (
  `id_exame_sistema` INT NOT NULL,
  `id_disciplina` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_exame_sistema`, `id_disciplina`),
  INDEX `id_disciplina_idx` (`id_disciplina` ASC) VISIBLE,
  CONSTRAINT `id_exame_sistema2`
    FOREIGN KEY (`id_exame_sistema`)
    REFERENCES `db_spex`.`exame_sistema` (`id_exame`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `id_disciplina1`
    FOREIGN KEY (`id_disciplina`)
    REFERENCES `db_spex`.`disciplina` (`nome_disciplina`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_spex`.`tema_disciplina`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_spex`.`tema_disciplina` (
  `id_tema` INT NOT NULL,
  `descricao` VARCHAR(50) NOT NULL,
  `id_disciplina` INT NOT NULL,
  PRIMARY KEY (`id_tema`),
  UNIQUE INDEX `descricao_UNIQUE` (`descricao` ASC) VISIBLE,
  INDEX `id_disciplina_idx` (`id_disciplina` ASC) VISIBLE,
  CONSTRAINT `id_disciplina2`
    FOREIGN KEY (`id_disciplina`)
    REFERENCES `db_spex`.`disciplina` (`id_disciplina`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_spex`.`universidade_curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_spex`.`universidade_curso` (
  `id_universidade` INT NOT NULL,
  `id_curso` INT NOT NULL,
  PRIMARY KEY (`id_universidade`, `id_curso`),
  INDEX `id_curso_idx` (`id_curso` ASC) VISIBLE,
  CONSTRAINT `id_universidade1`
    FOREIGN KEY (`id_universidade`)
    REFERENCES `db_spex`.`universidade` (`id_universidade`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `id_curso2`
    FOREIGN KEY (`id_curso`)
    REFERENCES `db_spex`.`curso` (`id_curso`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_spex`.`exame_universidade_realizado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_spex`.`exame_universidade_realizado` (
  `id_exame_realizado` INT NOT NULL AUTO_INCREMENT,
  `id_exame_universidade` INT NOT NULL,
  `data_realizacao` DATETIME NOT NULL,
  `nota_obtida` FLOAT NOT NULL,
  `tempo_decorrido` TIME NOT NULL,
  PRIMARY KEY (`id_exame_realizado`),
  UNIQUE INDEX `id_UNIQUE` (`id_exame_realizado` ASC) VISIBLE,
  INDEX `id_exame_idx` (`id_exame_universidade` ASC) VISIBLE,
  CONSTRAINT `id_exame_universidade`
    FOREIGN KEY (`id_exame_universidade`)
    REFERENCES `db_spex`.`exame_sistema` (`id_exame`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_spex`.`componente_exame_universidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_spex`.`componente_exame_universidade` (
  `id_exame_universidade` INT NOT NULL,
  `id_disciplina` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_exame_universidade`, `id_disciplina`),
  INDEX `id_disciplina_idx` (`id_disciplina` ASC) VISIBLE,
  CONSTRAINT `id_exame_universidade1`
    FOREIGN KEY (`id_exame_universidade`)
    REFERENCES `db_spex`.`exame_universidade` (`id_exame`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `id_disciplina3`
    FOREIGN KEY (`id_disciplina`)
    REFERENCES `db_spex`.`disciplina` (`nome_disciplina`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_spex`.`curso_alvo_exame_universidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_spex`.`curso_alvo_exame_universidade` (
  `id_curso` INT NOT NULL,
  `id_exame_universidade` INT NOT NULL,
  PRIMARY KEY (`id_curso`, `id_exame_universidade`),
  INDEX `id_exame_universidade_idx` (`id_exame_universidade` ASC) VISIBLE,
  CONSTRAINT `id_curso3`
    FOREIGN KEY (`id_curso`)
    REFERENCES `db_spex`.`curso` (`id_curso`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `id_exame_universidade2`
    FOREIGN KEY (`id_exame_universidade`)
    REFERENCES `db_spex`.`exame_universidade` (`id_exame`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_spex`.`pergunta_acertada_exame_universidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_spex`.`pergunta_acertada_exame_universidade` (
  `id_exame_universidade_realizado` INT NOT NULL,
  `id_pergunta` INT NOT NULL,
  PRIMARY KEY (`id_exame_universidade_realizado`),
  CONSTRAINT `id_exame_universidade_realizado`
    FOREIGN KEY (`id_exame_universidade_realizado`)
    REFERENCES `db_spex`.`exame_universidade_realizado` (`id_exame_realizado`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `id_pergunta1`
    FOREIGN KEY (`id_pergunta`)
    REFERENCES `db_spex`.`lista_perguntas_exame_universidade` (`id_pergunta`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_spex`.`pergunta_errada_exame_universidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_spex`.`pergunta_errada_exame_universidade` (
  `id_exame_universidade_realizado` INT NOT NULL,
  `id_pergunta` INT NOT NULL,
  PRIMARY KEY (`id_exame_universidade_realizado`),
  CONSTRAINT `id_exame_universidade_realizado1`
    FOREIGN KEY (`id_exame_universidade_realizado`)
    REFERENCES `db_spex`.`exame_universidade_realizado` (`id_exame_realizado`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `id_pergunta2`
    FOREIGN KEY (`id_pergunta`)
    REFERENCES `db_spex`.`lista_perguntas_exame_universidade` (`id_pergunta`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_spex`.`historico_aluno_exame_universidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_spex`.`historico_aluno_exame_universidade` (
  `id_historico_aluno` INT NOT NULL AUTO_INCREMENT,
  `id_exame_universidade_realizado` INT NOT NULL,
  PRIMARY KEY (`id_historico_aluno`),
  UNIQUE INDEX `id_UNIQUE` (`id_historico_aluno` ASC) VISIBLE,
  INDEX `id_exame_universidade_realizado_idx` (`id_exame_universidade_realizado` ASC) VISIBLE,
  CONSTRAINT `id_exame_universidade_realizado2`
    FOREIGN KEY (`id_exame_universidade_realizado`)
    REFERENCES `db_spex`.`exame_universidade_realizado` (`id_exame_realizado`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
