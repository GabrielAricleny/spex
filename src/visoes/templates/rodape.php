<!-- Scripts globais (burger menu) -->
<script src="/js/navbar.js"></script>

<!-- Scripts específicos de cada página -->
<?php if (!empty($paginaJs)): ?>
    <?php foreach ((array)$paginaJs as $js): ?>
        <script src="/js/<?= htmlspecialchars($js) ?>.js"></script>
    <?php endforeach; ?>
<?php endif; ?>

</body>

<footer class="footer has-background-dark has-text-light">
    <div class="container">
        <div class="columns is-variable is-6 is-multiline">

            <!-- Sobre o SPEX -->
            <div class="column is-5-tablet is-3-desktop">
                <p class="title is-6 has-text-light">Sobre o SPEX</p>
                <p>O SPEX é uma plataforma angolana dedicada à preparação eficaz para os exames de acesso ao Ensino Superior. Oferece uma base de dados de exames, aulas em modo-texto e outros recursos de estudo.</p>
                <p class="mt-2">Desenvolvido por: <span style="color:#fff; font-weight:bold;">Team PCGG</span><br>[Paula, Celestina, Gracieth, Gabriel]</p>
            </div>

            <!-- Links Rápidos -->
            <div class="column is-5-tablet is-3-desktop">
                <p class="title is-6 has-text-light">Links Rápidos</p>
                <ul>
                    <li><a href="?rota=inicio" class="has-text-light">Página Inicial</a></li>
                    <li><a href="?rota=exames_demo" class="has-text-light">Exames de Demonstração</a></li>
                    <li><a href="?rota=aulas_demo" class="has-text-light">Aulas Abertas</a></li>
                    <li><a href="?rota=registro" class="has-text-light">Criar Conta</a></li>
                    <li><a href="?rota=login" class="has-text-light">Entrar</a></li>
                </ul>
            </div>

            <!-- Ajuda e Recursos -->
            <div class="column is-5-tablet is-3-desktop">
                <p class="title is-6 has-text-light">Ajuda e Recursos</p>
                <ul>
                    <li><a href="?rota=faq" class="has-text-light">Perguntas Frequentes</a></li>
                    <li><a href="?rota=dicas_estudo" class="has-text-light">Dicas de Estudo</a></li>
                    <li><a href="?rota=novidades" class="has-text-light">Novidades da Plataforma</a></li>
                    <li><a href="?rota=contacto" class="has-text-light">Fala Connosco</a></li>
                </ul>
            </div>

            <!-- Institucional e Legal -->
            <div class="column is-5-tablet is-3-desktop">
                <p class="title is-6 has-text-light">Informações Legais</p>
                <ul>
                    <li><a href="?rota=termos" class="has-text-light">Termos de Uso</a></li>
                    <li><a href="?rota=privacidade" class="has-text-light">Política de Privacidade</a></li>
                    <li><a href="?rota=acessibilidade" class="has-text-light">Acessibilidade</a></li>
                    <li><a href="?rota=contacto" class="has-text-light">Contacto</a></li>
                </ul>
            </div>

            <!-- Redes Sociais -->
            <div class="column is-12">
                <hr class="has-background-grey-dark">
                <div class="content has-text-centered">
                    <p>Siga-nos nas redes sociais:</p>
                    <a href="#" class="icon has-text-light mx-1"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="icon has-text-light mx-1"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="icon has-text-light mx-1"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="icon has-text-light mx-1"><i class="fab fa-telegram"></i></a>
                </div>
                <div class="content has-text-centered mt-2">
                    <p class="is-size-7">
                        &copy; <?= date('Y') ?> SPEX – Todos os direitos reservados.
                    </p>
                </div>
            </div>

        </div>
    </div>
</footer>
</html>

