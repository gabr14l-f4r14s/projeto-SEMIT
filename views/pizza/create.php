<?php

/** @var array $ingredientes */

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Pizza | Bella Pizza Manager</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="public/img/favicon.svg">

</head>

<body>

    <!-- Layout principal -->
    <div class="app-layout">

        <!-- Sidebar -->
        <aside class="sidebar">

            <div class="sidebar-logo">
                <div class="sidebar-icon">
                    <img src="public/img/icon_pizza_logo.svg" alt="Bella Pizza">
                </div>

                <div>
                    <h2>Bella Pizza</h2>
                    <span>Sabor que conquista!</span>
                </div>
            </div>

            <nav class="sidebar-menu">

                <a href="index.php" class="sidebar-link">
                    <img src="public/img/icon_home_brown.svg" alt="Dashboard" class="sidebar-menu-icon">
                    Home
                </a>

                <a href="?acao=ingredientes" class="sidebar-link">
                    <img src="public/img/icon_ingredient_brown.svg" alt="Ingredientes" class="sidebar-menu-icon">
                    Ingredientes
                </a>

                <a href="?acao=create" class="sidebar-link active">
                    <img src="public/img/icon_add_white.svg" alt="Nova Pizza" class="sidebar-menu-icon">
                    Criar nova pizza
                </a>

            </nav>

        </aside>

        <!-- Conteúdo principal -->
        <main class="main-content">

            <!-- Barra superior -->
            <header class="topbar">

                <div>
                    <h1>Bella Pizza Manager</h1>
                    <p>Sistema de Gerenciamento</p>
                </div>

                <div class="topbar-info">

                    <span class="topbar-item">
                        <img src="public/img/icon_calendar_white.svg" class="topbar-icon" alt="Calendário">
                        <?= date('d/m/Y'); ?>
                    </span>

                    <div class="topbar-divider"></div>

                    <span class="topbar-item">
                        <img src="public/img/icon_clock_white.svg" class="topbar-icon" alt="Horário">
                        <span id="horaAtual"><?= date('H:i'); ?></span>
                    </span>

                </div>

            </header>

            <section class="page-header">

                <h1 class="page-title">

                    <img
                        src="public/img/icon_pizza_logo.svg"
                        alt="Nova Pizza"
                        class="dashboard-icon">

                    Nova Pizza
                </h1>

                <p class="page-description">
                    Cadastre uma nova pizza para disponibilizá-la no cardápio.
                </p>

                <div class="section-divider"></div>

                <!-- Mensagens de validação das pizzas cadastradas -->
                <?php if (isset($_GET['erro']) && $_GET['erro'] === 'pizza_duplicada'): ?>

                    <div class="alert alert-danger">
                        Já existe uma pizza cadastrada com esse nome.
                    </div>

                <?php endif; ?>

                <!-- Mensagens de validação dos ingredientes -->
                <?php if (isset($_GET['erro']) && $_GET['erro'] === 'ingredientes'): ?>

                    <div class="alert alert-danger">
                        Selecione pelo menos um ingrediente para a pizza.
                    </div>

                <?php endif; ?>

                <!-- Mensagens de validação dos preços -->
                <?php if (isset($_GET['erro']) && $_GET['erro'] === 'preco_invalido'): ?>

                    <div class="alert alert-danger">
                        Informe um preço válido para a pizza.
                    </div>

                <?php endif; ?>




                <!-- Formulário de cadastro -->
                <form action="?acao=store" method="POST">

                    <div class="mb-3">
                        <label class="form-label">Nome:</label>

                        <input
                            type="text"
                            name="nome"
                            class="form-control"
                            placeholder="Ex.: Calabresa"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Preço:</label>

                        <input
                            type="text"
                            name="preco"
                            inputmode="decimal"
                            class="form-control"
                            placeholder="Ex.: 30,00"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label ingredients-label">
                            Ingredientes:
                        </label>

                        <?php foreach ($ingredientes as $ingrediente): ?>

                            <div class="form-check">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="ingredientes[]"
                                    value="<?= $ingrediente['id']; ?>"
                                    id="ingrediente<?= $ingrediente['id']; ?>">

                                <label
                                    class="form-check-label"
                                    for="ingrediente<?= $ingrediente['id']; ?>">

                                    <?= htmlspecialchars($ingrediente['nome']); ?>

                                    <?php if (!$ingrediente['disponivel']): ?>
                                        <span class="text-danger">
                                            (Indisponível)
                                        </span>
                                    <?php endif; ?>

                                </label>

                            </div>

                        <?php endforeach; ?>

                    </div>

                    <div class="d-flex gap-2">

                        <button type="submit" class="btn btn-primary">
                            Salvar
                        </button>

                        <a href="index.php" class="btn btn-cancelar">
                            Cancelar
                        </a>

                    </div>

                </form>

            </section>

        </main>

    </div>

    <!-- Scripts -->
    <script src="public/js/main.js"></script>

</body>

</html>