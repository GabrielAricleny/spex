<?php
    session_start();

    $paginaCss = ['inicio'];
    $paginaJs  = ['particulas'];

    $utilizadorLogado = $_SESSION['utilizador'] ?? null;
    $nomeUtilizador   = $utilizadorLogado['nome'] ?? '';
    $nivelAcesso      = $utilizadorLogado['nivel_acesso'] ?? null;

    require __DIR__ . '/templates/cabecalho.php';
?>

<section class="hero is-fullheight-with-navbar" style="background: linear-gradient(to bottom, #121212, #000000);">
     <div class="particulas"></div>
     <div class="hero-body">
          <div class="container has-text-centered">
                <figure class="image is-128x128 is-inline-block mb-4">
                     <img src="/img/spex-logo.png" alt="Logotipo SPEX">
                </figure>
                
                <h1 class="title is-1 has-text-white has-text-weight-bold">Bem-vindo ao SPEX</h1>&nbsp;
                <p class="subtitle is-4 has-text-white-ter">
                     A melhor plataforma de preparação para os exames de acesso ao Ensino Superior em Angola
                </p>&nbsp;

                <?php if ($utilizadorLogado): ?>
                    <?php if ($nivelAcesso === 'admin'): ?>
                        <div class="buttons is-centered mt-5">
                            <a href="?rota=painel_admin" class="button is-medium is-warning cta-button">
                                <span class="icon"><i class="fas fa-tools"></i></span>
                                <span>Painel de Administração</span>
                            </a>
                            <a href="?rota=crud_usuario" class="button is-medium is-info cta-button">
                                <span class="icon"><i class="fas fa-users-cog"></i></span>
                                <span>Gerir Usuários</span>
                            </a>
                            <a href="?rota=crud_curso" class="button is-medium is-success cta-button">
                                <span class="icon"><i class="fas fa-graduation-cap"></i></span>
                                <span>Gerir Cursos</span>
                            </a>
                            <a href="?rota=crud_exame_sistema" class="button is-medium is-primary cta-button">
                                <span class="icon"><i class="fas fa-file-alt"></i></span>
                                <span>Gerir Exames</span>
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="buttons is-centered mt-5">
                            <a href="/exames" class="button is-medium cta-button">
                                <span class="icon"><i class="fas fa-file-alt"></i></span>
                                <span>Meus Exames</span>
                            </a>
                            <a href="/meu-progresso" class="button is-medium cta-button">
                                <span class="icon"><i class="fas fa-chart-bar"></i></span>
                                <span>Meu Progresso</span>
                            </a>
                            <a href="/perfil" class="button is-medium cta-button">
                                <span class="icon"><i class="fas fa-user-circle"></i></span>
                                <span>Perfil</span>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                     <div class="buttons is-centered mt-5">
                          <a href="/exames-demo" class="button is-medium cta-button">
                                <span class="icon"><i class="fas fa-edit"></i></span>
                                <span>Experimentar Exame</span>
                          </a>
                          <a href="/como-funciona" class="button is-medium cta-button">
                                <span class="icon"><i class="fas fa-info-circle"></i></span>
                                <span>Como Funciona</span>
                          </a>
                          <a href="?rota=cadastro_estudante" class="button is-medium cta-button">
                                <span class="icon"><i class="fas fa-user-plus"></i></span>
                                <span>Criar Conta</span>
                          </a>
                     </div>
                <?php endif; ?>
          </div>
     </div>
</section>

<section class="section has-background-black">
     <div class="container">
          <h2 class="section-title title has-text-white has-text-centered mb-6">Recursos em Destaque</h2>
          <div class="columns is-multiline is-flex is-align-items-stretch">
                <div class="column is-4">
                     <div class="feature-box has-text-centered is-flex is-flex-direction-column is-justify-content-space-between" style="height: 100%;">
                          <div>
                                <span class="icon is-large mb-3 has-text-white">
                                     <i class="fas fa-book-open fa-2x"></i>
                                </span>
                                <h3 class="title is-5 has-text-white">Conteúdo Abrangente</h3>
                                <p class="has-text-white">Material didáctico completo e actualizado, focado nos exames de acesso das principais universidades.</p>
                          </div>
                     </div>
                </div>
                <div class="column is-4">
                     <div class="feature-box has-text-centered is-flex is-flex-direction-column is-justify-content-space-between" style="height: 100%;">
                          <div>
                                <span class="icon is-large mb-3 has-text-white">
                                     <i class="fas fa-chalkboard-teacher fa-2x"></i>
                                </span>
                                <h3 class="title is-5 has-text-white">Exames Realistas</h3>
                                <p class="has-text-white">Testes práticos que simulam o ambiente real das provas, com correção imediata.</p>
                          </div>
                     </div>
                </div>
                <div class="column is-4">
                     <div class="feature-box has-text-centered is-flex is-flex-direction-column is-justify-content-space-between" style="height: 100%;">
                          <div>
                                <span class="icon is-large mb-3 has-text-white">
                                     <i class="fas fa-chart-line fa-2x"></i>
                                </span>
                                <h3 class="title is-5 has-text-white">Acompanhamento de Progresso</h3>
                                <p class="has-text-white">Relatórios detalhados para acompanhar o teu desempenho e evolução nos estudos.</p>
                          </div>
                     </div>
                </div>
          </div>
     </div>
</section>

<?php require __DIR__ . '/templates/rodape.php'; ?>
