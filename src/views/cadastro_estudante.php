<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPEX - Cadastrar Estudante</title>
    <link rel="stylesheet" href="../../public/css/bulma/css/bulma.min.css">
</head>

<body>
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-half">
                <div class="box has-background-link">
                    <h1 class="has-text-centered has-text-white subtitle">
                        Crie uma conta SPEX e aproveite a experiência completa.
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="columns is-centered">
            <div class="column is-half">
                <div class="box">
                    <form action="/src/controllers/EstudanteController.php" method="post">
                        <div class="field">
                            <label for="nome_estudante" class="label">Nome do Estudante:</label>
                            <div class="control">
                                <input type="text" id="nome_estudante" name="nome_estudante" class="input" required>
                            </div>
                        </div>

                        <div class="field">
                            <label for="nome_usuario" class="label">Nome de Usuário:</label>
                            <div class="control">
                                <input type="text" id="nome_usuario" name="nome_usuario" class="input" required>
                            </div>
                        </div>

                        <div class="field">
                            <label for="data_nascimento" class="label">Data de Nascimento:</label>
                            <div class="control">
                                <input type="text" id="data_nascimento" name="data_nascimento" class="input" required>
                            </div>
                        </div>

                        <div class="field">
                            <label for="telefone_estudante" class="label">Telefone:</label>
                            <div class="control">
                                <input type="text" id="telefone_estudante" name="telefone_estudante" class="input" required>
                            </div>
                        </div>

                        <div class="field">
                            <label for="email_estudante" class="label">E-mail:</label>
                            <div class="control">
                                <input type="email" id="email_estudante" name="email_estudante" class="input" required>
                            </div>
                        </div>

                        <div class="field">
                            <label for="area_formacao" class="label">Area de Formação:</label>
                            <select id="area_formacao" name="area_formacao" class="input">
                                <optgroup label="Liceus / Puniv">
                                    <option value="1">MED Ciências Físicas e Biológicas</option>
                                    <option value="2">MED Ciências Económicas e Jurídicas</option>
                                    <option value="3">MED Ciências Humanas</option>
                                </optgroup>
                                <optgroup label="Área de Saúde">
                                    <option value="4">MED Enfermagem</option>
                                    <option value="5">MED Análises Clínicas</option>
                                    <option value="6">MED Fisioterapia</option>
                                    <option value="7">MED Farmácia</option>
                                </optgroup>
                                <optgroup label="Politécnicos">
                                    <option value="8">MED Informática</option>
                                    <option value="9">MED Gestão de Sistemas Informáticos</option>
                                    <option value="10">MED Electricidade</option>
                                    <option value="11">MED Desenho Técnico</option>
                                    <option value="12">MED Mecânica</option>
                                </optgroup>
                                <optgroup label="Gestão / Economia">
                                    <option value="13">MED Informática de Gestão</option>
                                    <option value="14">MED Contabilidade</option>
                                    <option value="15">MED Gestão de Recursos Humanos</option>
                                    <option value="16">MED Gestão Empresarial</option>
                                    <option value="17">MED Finanças</option>
                                </optgroup>
                                <optgroup label="Magistérios / Formação de Professores">
                                    <option value="18">MED Ensino da Língua Portuguesa</option>
                                    <option value="19">MED Ensino de Matemática e Física</option>
                                    <option value="20">MED Ensino de Inglês e EMC</option>
                                    <option value="21">MED Ensino de Biologia e Química</option>
                                    <option value="22">MED Instrução Primária</option>
                                    <option value="23">MED Ensino de Educação Física</option>
                                </optgroup>
                            </select>
                        </div>

                        <div class="field">
                            <label for="curso_pretendido" class="label">Curso Pretendido:</label>
                            <select id="curso_pretendido" name="curso_pretendido" class="input">
                                <optgroup label="Educação / Ensino">
                                    <option value="24">MESCTI Ensino da Língua Portuguesa</option>
                                    <option value="25">MESCTI Ensino da Matemática</option>
                                    <option value="26">MESCTI Ensino da Informática</option>
                                    <option value="27">MESCTI Ensino da História</option>
                                    <option value="28">MESCTI Ensino da Língua Inglesa</option>
                                    <option value="29">MESCTI Ensino Primário</option>
                                    <option value="30">MESCTI Educação de Infância</option>
                                </optgroup>
                                <optgroup label="Engenharias">
                                    <option value="31">MESCTI Engenharia Informática</option>
                                    <option value="32">MESCTI Engenharia Telecomunicações</option>
                                    <option value="33">MESCTI Engenharia Electrónica</option>
                                    <option value="34">MESCTI Engenharia Electrotécnica</option>
                                    <option value="35">MESCTI Engenharia Eléctrica</option>
                                    <option value="36">MESCTI Engenharia de Construção Civil</option>
                                    <option value="37">MESCTI Engenharia Mecânica</option>
                                </optgroup>
                                <optgroup label="Ciências">
                                    <option value="38">MESCTI Ciência da Computação</option>
                                    <option value="39">MESCTI Física</option>
                                    <option value="40">MESCTI Química</option>
                                    <option value="41">MESCTI Matemática</option>
                                </optgroup>
                                <optgroup label="Gestão / Economia">
                                    <option value="42">MESCTI Economia</option>
                                    <option value="43">MESCTI Gestão e Administração Pública</option>
                                    <option value="44">MESCTI Gestão Empresarial</option>
                                    <option value="45">MESCTI Contabilidade e Gestão</option>
                                    <option value="46">MESCTI Gestão de Recursos Humanos</option>
                                    <option value="47">MESCTI Contabilidade e Auditoria</option>
                                    <option value="48">MESCTI Gestão de Finanças</option>
                                </optgroup>
                                <optgroup label="Saúde / Medicina">
                                    <option value="49">MESCTI Medicina</option>
                                    <option value="50">MESCTI Medicina Geral</option>
                                    <option value="49">MESCTI Enfermagem</option>
                                    <option value="49">MESCTI Análises Clínicas e Saúde Pública</option>
                                    <option value="49">MESCTI Fisioterapia</option>
                                    <option value="49">MESCTI Nutrição</option>
                                    <option value="49">MESCTI Farmacologia</option>
                                    <option value="49">MESCTI Medicina Dentária</option>
                                    <option value="49">MESCTI Oftamologia</option>
                                </optgroup>
                            </select>
                        </div>

                        <div class="field">
                            <label for="senha_estudante" class="label">Senha para Login:</label>
                            <div class="control">
                                <input type="password" id="senha_estudante" name="senha_estudante" class="input" required>
                            </div>
                        </div>

                        <div class="field">
                            <label for="senha_estudante_confirmada" class="label">Confirmar Senha:</label>
                            <div class="control">
                                <input type="password" id="senha_estudante_confirmada" name="senha_estudante_confirmada" class="input" required>
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-link is-fullwidth">Cadastrar-se</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>