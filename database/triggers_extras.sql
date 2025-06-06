-- TRIGGERS EXTRAS DO SISTEMA SPEX
-- Estas triggers são opcionais e servem para melhorar a rastreabilidade, segurança e gestão automatizada.

-- 🔐 1. Trigger para registar alterações de níveis de acesso
DELIMITER //
CREATE TRIGGER log_alteracao_nivel_acesso
AFTER UPDATE ON nivel_acesso
FOR EACH ROW
BEGIN
  INSERT INTO log_alteracoes_nivel_acesso (id_nivel_acesso, descricao_antiga, descricao_nova, data_alteracao)
  VALUES (OLD.id_nivel_acesso, OLD.descricao, NEW.descricao, NOW());
END;
//
DELIMITER ;

-- 🧑‍🎓 2. Trigger para registar inscrições em exames
DELIMITER //
CREATE TRIGGER log_inscricao_exame
AFTER INSERT ON exame_estudante
FOR EACH ROW
BEGIN
  INSERT INTO log_inscricoes_exames (id_estudante, id_exame_sistema, data_inscricao)
  VALUES (NEW.id_estudante, NEW.id_exame_sistema, NOW());
END;
//
DELIMITER ;

-- 🧹 3. Trigger para eliminar automaticamente exames do sistema que expiraram há mais de 1 ano
DELIMITER //
CREATE TRIGGER auto_delete_exames_expirados
AFTER INSERT ON exame_sistema
FOR EACH ROW
BEGIN
  DELETE FROM exame_sistema
  WHERE data_fim < NOW() - INTERVAL 1 YEAR;
END;
//
DELIMITER ;

-- 🧠 4. Trigger para bloquear perguntas duplicadas na mesma disciplina
DELIMITER //
CREATE TRIGGER bloquear_pergunta_duplicada
BEFORE INSERT ON pergunta_cadastrada
FOR EACH ROW
BEGIN
  IF EXISTS (
    SELECT 1 FROM pergunta_cadastrada
    WHERE conteudo = NEW.conteudo
      AND id_disciplina = NEW.id_disciplina
  ) THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Já existe uma pergunta igual para esta disciplina.';
  END IF;
END;
//
DELIMITER ;

-- 📈 5. Trigger para registar alteração de nota no histórico de exames
DELIMITER //
CREATE TRIGGER log_alteracao_nota
AFTER UPDATE ON historico_exame
FOR EACH ROW
BEGIN
  IF OLD.nota_final <> NEW.nota_final THEN
    INSERT INTO log_alteracoes_notas (id_historico_exame, nota_antiga, nota_nova, data_alteracao)
    VALUES (OLD.id_historico_exame, OLD.nota_final, NEW.nota_final, NOW());
  END IF;
END;
//
DELIMITER ;
