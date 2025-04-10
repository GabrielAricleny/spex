<?php
session_start();

if (!isset($_SESSION['id_estudante'])) {
    header("Location: ../public/index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SPEX</title>
    <link rel="stylesheet" href="../../public/css/bulma/css/bulma.min.css">
    <link rel="stylesheet" href="../../public/css/fontawesome/css/all.min.css">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
            --secondary-gradient: linear-gradient(135deg, #f72585 0%, #b5179e 100%);
            --box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f9f9ff;
            min-height: 100vh;
        }

        .navbar {
            background: var(--primary-gradient);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-item {
            font-weight: 600;
            color: white;
        }

        .navbar-item:hover {
            color: #f8f8f8 !important;
            background: rgba(255, 255, 255, 0.1) !important;
        }

        .logout-btn {
            background: white;
            color: #3a0ca3 !important;
            border: none;
            font-weight: 600;
            border-radius: 6px;
            transition: var(--transition);
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            color: #3a0ca3;
        }

        .dashboard-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: #3a0ca3;
            position: relative;
            display: inline-block;
        }

        .dashboard-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 80px;
            height: 4px;
            background: var(--secondary-gradient);
            border-radius: 2px;
        }

        .dashboard-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            height: 100%;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .dashboard-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .dashboard-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 0;
            background: var(--primary-gradient);
            transition: var(--transition);
        }

        .dashboard-card:hover::after {
            height: 100%;
        }

        .card-icon {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #3a0ca3;
        }

        .card-description {
            color: #7a7a7a;
            margin-bottom: 1.5rem;
        }

        .card-button {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 600;
            transition: var(--transition);
        }

        .card-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.3);
            color: white;
        }

        .user-welcome {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--box-shadow);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .user-name {
            font-weight: 600;
            color: #3a0ca3;
        }

        .user-email {
            color: #7a7a7a;
            font-size: 0.9rem;
        }

        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--box-shadow);
            margin-bottom: 1.5rem;
        }

        .stats-value {
            font-size: 2rem;
            font-weight: 700;
            color: #3a0ca3;
        }

        .stats-label {
            color: #7a7a7a;
            font-size: 0.9rem;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .fade-in {
            animation: fadeIn 0.8s ease;
        }
    </style>
</head>

<body>
    <nav class="navbar is-fixed-top">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="#" style="font-size: 1.2rem;">
                    <i class="fas fa-graduation-cap" style="margin-right: 10px;"></i>
                    <strong>SPEX</strong>
                </a>
            </div>

            <div class="navbar-menu">
                <div class="navbar-end">
                    <div class="navbar-item">
                        <a class="button logout-btn" href="/src/controllers/AuthController.php?logout=true">
                            <i class="fas fa-sign-out-alt" style="margin-right: 8px;"></i> Sair
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <section class="section" style="margin-top: 80px;">
        <div class="container fade-in">
            <!-- User Welcome Section -->
            <div class="user-welcome">
                <div class="user-info">
                    <div class="user-avatar">
                        <?php echo strtoupper(substr($_SESSION['nome_estudante'], 0, 1)); ?>
                    </div>
                    <div>
                        <div class="user-name">Olá, <?php echo $_SESSION['nome_estudante']; ?></div>
                        <div class="user-email"><?php echo $_SESSION['email_estudante']; ?></div>
                    </div>
                </div>
                <div>
                    <div class="stats-card has-text-centered">
                        <div class="stats-value"><?php echo rand(70, 100); ?>%</div>
                        <div class="stats-label">Desempenho médio</div>
                    </div>
                </div>
            </div>

            <h1 class="dashboard-title">Painel de Controle</h1>

            <div class="columns is-multiline">
                <!-- Simulados Card -->
                <div class="column is-one-third">
                    <div class="dashboard-card has-text-centered">
                        <div class="card-icon">
                            <i class="fas fa-edit"></i>
                        </div>
                        <h2 class="card-title">Simulados</h2>
                        <p class="card-description">Pratique com questões de exames anteriores em um ambiente simulado.</p>
                        <a class="button card-button">
                            <i class="fas fa-edit" style="margin-right: 8px;"></i> Acessar
                        </a>
                    </div>
                </div>

                <!-- Resultados Card -->
                <div class="column is-one-third">
                    <div class="dashboard-card has-text-centered">
                        <div class="card-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h2 class="card-title">Resultados</h2>
                        <p class="card-description">Acompanhe seu progresso e veja seu desempenho detalhado.</p>
                        <a class="button card-button">
                            <i class="fas fa-chart-line" style="margin-right: 8px;"></i> Ver
                        </a>
                    </div>
                </div>

                <!-- Configurações Card -->
                <div class="column is-one-third">
                    <div class="dashboard-card has-text-centered">
                        <div class="card-icon">
                            <i class="fas fa-cog"></i>
                        </div>
                        <h2 class="card-title">Configurações</h2>
                        <p class="card-description">Personalize sua experiência de estudo e preferências.</p>
                        <a class="button card-button">
                            <i class="fas fa-cog" style="margin-right: 8px;"></i> Ajustar
                        </a>
                    </div>
                </div>

                <!-- Novo Card: Meu Progresso -->
                <div class="column is-one-third">
                    <div class="dashboard-card has-text-centered">
                        <div class="card-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <h2 class="card-title">Meu Progresso</h2>
                        <p class="card-description">Veja suas conquistas e metas alcançadas.</p>
                        <a class="button card-button">
                            <i class="fas fa-trophy" style="margin-right: 8px;"></i> Visualizar
                        </a>
                    </div>
                </div>

                <!-- Novo Card: Comunidade -->
                <div class="column is-one-third">
                    <div class="dashboard-card has-text-centered">
                        <div class="card-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h2 class="card-title">Comunidade</h2>
                        <p class="card-description">Conecte-se com outros estudantes e compartilhe conhecimento.</p>
                        <a class="button card-button">
                            <i class="fas fa-users" style="margin-right: 8px;"></i> Participar
                        </a>
                    </div>
                </div>

                <!-- Novo Card: Materiais -->
                <div class="column is-one-third">
                    <div class="dashboard-card has-text-centered">
                        <div class="card-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <h2 class="card-title">Materiais</h2>
                        <p class="card-description">Acesse materiais de estudo e resumos exclusivos.</p>
                        <a class="button card-button">
                            <i class="fas fa-book" style="margin-right: 8px;"></i> Estudar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>