-- MySQL Workbench Forward Engineering
SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS,
  UNIQUE_CHECKS = 0;
SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS,
  FOREIGN_KEY_CHECKS = 0;
SET @OLD_SQL_MODE = @@SQL_MODE,
  SQL_MODE = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
-- -----------------------------------------------------
-- Schema db_spex
-- -----------------------------------------------------
DROP DATABASE IF EXISTS `db_spex`;
CREATE SCHEMA IF NOT EXISTS `db_spex` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `db_spex`;
-- -----------------------------------------------------
-- Table nivel_acesso
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `nivel_acesso` (
  `id_nivel` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(100) NOT NULL UNIQUE,
  `criado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_nivel`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- -----------------------------------------------------
-- Table usuario
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nome_usuario` VARCHAR(100) NOT NULL UNIQUE,
  `nome_completo` VARCHAR(200) NOT NULL,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `senha` VARCHAR(255) NOT NULL,
  `id_nivel_acesso` INT NOT NULL,
  `criado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`),
  INDEX `fk_usuario_nivel_acesso_idx` (`id_nivel_acesso`),
  CONSTRAINT `fk_usuario_nivel_acesso` FOREIGN KEY (`id_nivel_acesso`) REFERENCES `nivel_acesso` (`id_nivel`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- -----------------------------------------------------
-- Table administrador
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administrador` (
  `id_usuario` INT NOT NULL,
  `telefone` VARCHAR(25) NULL,
  `criado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`),
  CONSTRAINT `fk_administrador_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- -----------------------------------------------------
-- Table estudante
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estudante` (
  `id_usuario` INT NOT NULL,
  `data_nasc` DATE NOT NULL,
  `telefone` VARCHAR(25) NOT NULL UNIQUE,
  `area_formacao` INT NOT NULL,
  `curso_pretendido` INT NOT NULL,
  `criado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`),
  CONSTRAINT `fk_estudante_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario`(`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_area_formacao` FOREIGN KEY (`area_formacao`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_curso_pretendido` FOREIGN KEY (`curso_pretendido`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- -----------------------------------------------------
-- Table curso
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `curso` (
  `id_curso` INT NOT NULL AUTO_INCREMENT,
  `nome_curso` VARCHAR(150) NOT NULL UNIQUE,
  `nivel_curso` ENUM('medio', 'superior'),
  `criado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_curso`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- -----------------------------------------------------
-- Table exame_sistema
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `exame_sistema` (
  `id_exame` INT NOT NULL AUTO_INCREMENT,
  `duracao` TIME NOT NULL,
  `criado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_exame`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- -----------------------------------------------------
-- Table exame_universidade
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `exame_universidade` (
  `id_exame` INT NOT NULL AUTO_INCREMENT,
  `duracao` TIME NOT NULL,
  `id_universidade` INT NOT NULL,
  `criado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_exame`),
  CONSTRAINT `fk_exame_universidade_universidade` FOREIGN KEY (`id_universidade`) REFERENCES `universidade` (`id_universidade`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- -----------------------------------------------------
-- Table universidade
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `universidade` (
  `id_universidade` INT NOT NULL AUTO_INCREMENT,
  `nome_universidade` VARCHAR(150) NOT NULL UNIQUE,
  `nome_abreviado` VARCHAR(30) NOT NULL,
  `criada_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizada_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_universidade`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- -----------------------------------------------------
-- Table disciplina
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `disciplina` (
  `id_disciplina` INT NOT NULL AUTO_INCREMENT,
  `nome_disciplina` VARCHAR(150) NOT NULL UNIQUE,
  `criada_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizada_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_disciplina`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- -----------------------------------------------------
-- Table disciplina_curso
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `disciplina_curso` (
  `id_disciplina` INT NOT NULL,
  `id_curso` INT NOT NULL,
  `criado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_disciplina`, `id_curso`),
  CONSTRAINT `fk_disciplina_curso_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_disciplina_curso_disciplina` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id_disciplina`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- -----------------------------------------------------
-- Table tema
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tema` (
  `id_tema` INT NOT NULL AUTO_INCREMENT,
  `nome_tema` VARCHAR(200) NOT NULL UNIQUE,
  `criado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_tema`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- -----------------------------------------------------
-- Table status_pergunta
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `status_pergunta` (
  `id_status` INT NOT NULL AUTO_INCREMENT,
  `descricao_status` VARCHAR(100) NOT NULL UNIQUE,
  `criado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_status`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- -----------------------------------------------------
-- Table pergunta
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pergunta` (
  `id_pergunta` INT NOT NULL AUTO_INCREMENT,
  `enunciado` VARCHAR(1000) NOT NULL,
  `resposta` VARCHAR(1000) NOT NULL,
  `curso` INT NOT NULL,
  `disciplina` INT NOT NULL,
  `tema` INT NOT NULL,
  `status` INT NOT NULL,
  `criada_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizada_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pergunta`),
  CONSTRAINT `fk_pergunta_curso_pergunta` FOREIGN KEY (`curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pergunta_disciplina_pergunta` FOREIGN KEY (`disciplina`) REFERENCES `disciplina` (`id_disciplina`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pergunta_tema_pergunta` FOREIGN KEY (`tema`) REFERENCES `tema` (`id_tema`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pergunta_status_pergunta` FOREIGN KEY (`status`) REFERENCES `status_pergunta` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- -----------------------------------------------------
-- Table lista_perguntas_exame_universidade
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lista_perguntas_exame_universidade` (
  `id_exame_universidade` INT NOT NULL,
  `id_pergunta` INT NOT NULL,
  `criada_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizada_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_exame_universidade`, `id_pergunta`),
  CONSTRAINT `fk_lista_perguntas_exame_universidade_exame` FOREIGN KEY (`id_exame_universidade`) REFERENCES `exame_universidade` (`id_exame`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_lista_perguntas_exame_universidade_pergunta` FOREIGN KEY (`id_pergunta`) REFERENCES `pergunta` (`id_pergunta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- -----------------------------------------------------
-- Table lista_perguntas_exame_sistema
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lista_perguntas_exame_sistema` (
  `id_exame_sistema` INT NOT NULL,
  `id_pergunta` INT NOT NULL,
  `criada_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizada_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_exame_sistema`, `id_pergunta`),
  CONSTRAINT `fk_lista_perguntas_exame_sistema_exame` FOREIGN KEY (`id_exame_sistema`) REFERENCES `exame_sistema` (`id_exame`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_lista_perguntas_exame_sistema_pergunta` FOREIGN KEY (`id_pergunta`) REFERENCES `pergunta` (`id_pergunta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- -----------------------------------------------------
-- Table historico_aluno
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `historico_aluno` (
  `id_historico_aluno` INT NOT NULL AUTO_INCREMENT,
  `id_usuario` INT NOT NULL,
  `tipo_exame` ENUM('sistema', 'universidade') NOT NULL,
  `id_exame_realizado` INT NOT NULL,
  `nota_obtida` FLOAT NOT NULL,
  `data_realizacao` DATETIME NOT NULL,
  `tempo_decorrido` TIME NOT NULL,
  `criado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_historico_aluno`),
  CONSTRAINT `fk_historico_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- -----------------------------------------------------
-- Table exame_sistema_realizado
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `exame_sistema_realizado` (
  `id_exame_realizado` INT NOT NULL AUTO_INCREMENT,
  `id_exame_sistema` INT NOT NULL,
  `id_usuario` INT NOT NULL,
  `data_realizacao` DATETIME NOT NULL,
  `nota_obtida` FLOAT NOT NULL,
  `tempo_decorrido` TIME NOT NULL,
  `criado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_exame_realizado`),
  CONSTRAINT `fk_exame_sistema_realizado_exame_sistema` FOREIGN KEY (`id_exame_sistema`) REFERENCES `exame_sistema` (`id_exame`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_exame_sistema_realizado_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- -----------------------------------------------------
-- Table exame_universidade_realizado
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `exame_universidade_realizado` (
  `id_exame_realizado` INT NOT NULL AUTO_INCREMENT,
  `id_exame_universidade` INT NOT NULL,
  `id_usuario` INT NOT NULL,
  `data_realizacao` DATETIME NOT NULL,
  `nota_obtida` FLOAT NOT NULL,
  `tempo_decorrido` TIME NOT NULL,
  `criado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_exame_realizado`),
  CONSTRAINT `fk_exame_universidade_realizado_exame` FOREIGN KEY (`id_exame_universidade`) REFERENCES `exame_universidade` (`id_exame`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_exame_universidade_realizado_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- -----------------------------------------------------
-- Table resultado_exame
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `resultado_exame` (
  `id_resposta` INT NOT NULL AUTO_INCREMENT,
  `id_usuario` INT NOT NULL,
  `tipo_exame` ENUM('sistema', 'universidade') NOT NULL,
  `id_exame_realizado` INT NOT NULL,
  `id_pergunta` INT NOT NULL,
  `resposta_dada` VARCHAR(1000) NOT NULL,
  `correta` BOOLEAN NOT NULL,
  `criado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_resposta`),
  CONSTRAINT `fk_resposta_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_resposta_pergunta` FOREIGN KEY (`id_pergunta`) REFERENCES `pergunta` (`id_pergunta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- -----------------------------------------------------
-- Table pergunta_acertada_exame_sistema
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pergunta_acertada_exame_sistema` (
  `id_exame_sistema_realizado` INT NOT NULL,
  `id_pergunta` INT NOT NULL,
  `criada_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizada_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_exame_sistema_realizado`, `id_pergunta`),
  CONSTRAINT `fk_acerto_exame_realizado` FOREIGN KEY (`id_exame_sistema_realizado`) REFERENCES `exame_sistema_realizado` (`id_exame_realizado`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_acerto_pergunta` FOREIGN KEY (`id_pergunta`) REFERENCES `pergunta` (`id_pergunta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SOURCE /var/www/spex.edu.ao/database/triggers.sql

-- -----------------------------------------------------
-- Restauração dos valores de sistema
-- -----------------------------------------------------
SET SQL_MODE = @OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS;
-- NOTA: 
-- O campo id_exame_realizado em historico_aluno e resposta pode referenciar tanto exame_sistema_realizado quanto exame_universidade_realizado.
-- Para garantir integridade referencial, pode-se usar triggers ou lógica de aplicação, pois MySQL não suporta foreign key polimórfica.