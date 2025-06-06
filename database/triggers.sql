DELIMITER $$

CREATE TRIGGER trg_historico_aluno_before_insert
BEFORE INSERT ON historico_aluno
FOR EACH ROW
BEGIN
  IF NEW.tipo_exame = 'sistema' THEN
    IF NOT EXISTS (SELECT 1 FROM exame_sistema_realizado WHERE id_exame_realizado = NEW.id_exame_realizado) THEN
      SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: id_exame_realizado não existe em exame_sistema_realizado para tipo_exame sistema.';
    END IF;
  ELSEIF NEW.tipo_exame = 'universidade' THEN
    IF NOT EXISTS (SELECT 1 FROM exame_universidade_realizado WHERE id_exame_realizado = NEW.id_exame_realizado) THEN
      SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: id_exame_realizado não existe em exame_universidade_realizado para tipo_exame universidade.';
    END IF;
  ELSE
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: tipo_exame inválido.';
  END IF;
END$$

CREATE TRIGGER trg_historico_aluno_before_update
BEFORE UPDATE ON historico_aluno
FOR EACH ROW
BEGIN
  IF NEW.tipo_exame = 'sistema' THEN
    IF NOT EXISTS (SELECT 1 FROM exame_sistema_realizado WHERE id_exame_realizado = NEW.id_exame_realizado) THEN
      SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: id_exame_realizado não existe em exame_sistema_realizado para tipo_exame sistema.';
    END IF;
  ELSEIF NEW.tipo_exame = 'universidade' THEN
    IF NOT EXISTS (SELECT 1 FROM exame_universidade_realizado WHERE id_exame_realizado = NEW.id_exame_realizado) THEN
      SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: id_exame_realizado não existe em exame_universidade_realizado para tipo_exame universidade.';
    END IF;
  ELSE
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: tipo_exame inválido.';
  END IF;
END$$

CREATE TRIGGER trg_resultado_exame_before_insert
BEFORE INSERT ON resultado_exame
FOR EACH ROW
BEGIN
  IF NEW.tipo_exame = 'sistema' THEN
    IF NOT EXISTS (SELECT 1 FROM exame_sistema_realizado WHERE id_exame_realizado = NEW.id_exame_realizado) THEN
      SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: id_exame_realizado não existe em exame_sistema_realizado para tipo_exame sistema.';
    END IF;
  ELSEIF NEW.tipo_exame = 'universidade' THEN
    IF NOT EXISTS (SELECT 1 FROM exame_universidade_realizado WHERE id_exame_realizado = NEW.id_exame_realizado) THEN
      SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: id_exame_realizado não existe em exame_universidade_realizado para tipo_exame universidade.';
    END IF;
  ELSE
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: tipo_exame inválido.';
  END IF;
END$$

CREATE TRIGGER trg_resultado_exame_before_update
BEFORE UPDATE ON resultado_exame
FOR EACH ROW
BEGIN
  IF NEW.tipo_exame = 'sistema' THEN
    IF NOT EXISTS (SELECT 1 FROM exame_sistema_realizado WHERE id_exame_realizado = NEW.id_exame_realizado) THEN
      SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: id_exame_realizado não existe em exame_sistema_realizado para tipo_exame sistema.';
    END IF;
  ELSEIF NEW.tipo_exame = 'universidade' THEN
    IF NOT EXISTS (SELECT 1 FROM exame_universidade_realizado WHERE id_exame_realizado = NEW.id_exame_realizado) THEN
      SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: id_exame_realizado não existe em exame_universidade_realizado para tipo_exame universidade.';
    END IF;
  ELSE
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: tipo_exame inválido.';
  END IF;
END$$

DELIMITER ;

DELIMITER //

CREATE TRIGGER trg_usuario_no_duplicate_insert
BEFORE INSERT ON usuario
FOR EACH ROW
BEGIN
    IF EXISTS (SELECT 1 FROM usuario WHERE nome_utilizador = NEW.nome_utilizador) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Nome de utilizador já existe.';
    END IF;

    IF EXISTS (SELECT 1 FROM usuario WHERE email = NEW.email) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Email já existe.';
    END IF;
END;
//

CREATE TRIGGER trg_usuario_no_duplicate_update
BEFORE UPDATE ON usuario
FOR EACH ROW
BEGIN
    IF NEW.nome_utilizador <> OLD.nome_utilizador AND EXISTS (SELECT 1 FROM usuario WHERE nome_utilizador = NEW.nome_utilizador) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Nome de utilizador já existe.';
    END IF;

    IF NEW.email <> OLD.email AND EXISTS (SELECT 1 FROM usuario WHERE email = NEW.email) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Email já existe.';
    END IF;
END;
//

DELIMITER ;

DELIMITER //

CREATE TRIGGER trg_administrador_no_duplicate_insert
BEFORE INSERT ON administrador
FOR EACH ROW
BEGIN
    IF EXISTS (SELECT 1 FROM administrador WHERE telefone = NEW.telefone) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Telefone de administrador já existe.';
    END IF;
END;
//

CREATE TRIGGER trg_administrador_no_duplicate_update
BEFORE UPDATE ON administrador
FOR EACH ROW
BEGIN
    IF NEW.telefone <> OLD.telefone AND EXISTS (SELECT 1 FROM administrador WHERE telefone = NEW.telefone) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Telefone de administrador já existe.';
    END IF;
END;
//

DELIMITER ;

DELIMITER //

CREATE TRIGGER trg_estudante_no_duplicate_insert
BEFORE INSERT ON estudante
FOR EACH ROW
BEGIN
    IF EXISTS (SELECT 1 FROM estudante WHERE telefone = NEW.telefone) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Telefone de estudante já existe.';
    END IF;
END;
//

CREATE TRIGGER trg_estudante_no_duplicate_update
BEFORE UPDATE ON estudante
FOR EACH ROW
BEGIN
    IF NEW.telefone <> OLD.telefone AND EXISTS (SELECT 1 FROM estudante WHERE telefone = NEW.telefone) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Telefone de estudante já existe.';
    END IF;
END;
//

DELIMITER ;