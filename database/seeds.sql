USE db_spex;

INSERT INTO usuario (nome_usuario, senha, email, nome_completo, id_nivel_acesso) VALUES
('mr_somebody', 'admin', 'mr.somebody@example.com', 'Mr. Somebody Administrator', 1);

INSERT INTO administrador (id_usuario, telefone) VALUES
(1, '000-000-000');

INSERT INTO curso (nome_curso) VALUES
('MED Ciências Físicas e Biológicas'),
('MED Ciências Económicas e Jurídicas'),
('MED Ciências Humanas'),
('MED Enfermagem'),
('MED Análises Clínicas'),
('MED Fisioterapia'),
('MED Farmácia'),
('MED Informática'),
('Gestão de Sistemas Informáticos'),
('MED Electricidade'),
('MED Desenho Técnico'),
('MED Mecânica'),
('MED Informática de Gestão'),
('MED Contabilidade'),
('MED Gestão de Recursos Humanos'),
('MED Gestão Empresarial'),
('MED Finanças'),
('MED Ensino de Língua Portuguesa'),
('MED Ensino de Matemática e Física'),
('MED Ensino de Inglês e EMC'),
('MED Ensino de Biologia e Química'),
('MED Instrução Primária'),
('MED Ensino de Educação Física'),
('MESCTI Ensino da Língua Portuguesa'),
('MESCTI Ensino da Matemática'),
('MESCTI Ensino da Informática'),
('MESCTI Ensino de História'),
('MESCTI Ensino da Língua Inglesa'),
('MESCTI Ensino Primário'),
('MESCTI Educação de Infância'),
('MESCTI Engenharia Informática'),
('MESCTI Engenharia de Telecomunicações'),
('MESCTI Engenharia Electrónica'),
('MESCTI Engenharia Electrotécnica'),
('MESCTI Engenharia Eléctrica'),
('MESCTI Engenharia de Construção Civil'),
('MESCTI Engenharia Mecânica'),
('MESCTI Ciência da Computação'),
('MESCTI Física'),
('MESCTI Química'),
('MESCTI Matemática'),
('MESCTI Economia'),
('MESCTI Gestão e Administração Pública'),
('MESCTI Gestão Empresarial'),
('MESCTI Contabilidade e Gestão'),
('MESCTI Gestão de Recursos Humanos'),
('MESCTI Contabilidade e Auditoria'),
('MESCTI Gestão de Finanças'),
('MESCTI Medicina'),
('MESCTI Medicina Geral'),
('MESCTI Enfermagem'),
('MESCTI Análises Clínicas e Saúde Pública'),
('MESCTI Fisioterapia'),
('MESCTI Nutrição'),
('MESCTI Farmacologia'),
('MESCTI Medicina Dentária'),
('MESCTI Oftamologia');

--INSERT INTO estudante
--(nome_estudante, data_nasc, telefone, email, area_formacao, curso_pretendido, nome_usuario, senha_estudante)
--VALUES
--('Mr. Somebody', '1990-01-01', '912345678', 'mr.somebody@example.com', 1, 25, 'somebody', 'somebody'),
--('Somebody Else', '2000-12-31', '923456781', 'somebody.else@example.com', 1, 26, 'somebody_else', 'somebody_else');
