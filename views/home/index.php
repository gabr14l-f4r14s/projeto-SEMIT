<?php

/** @var array $pizzas */
/** @var int $totalIngredientesDisponiveis */
/** @var int $totalIngredientes */

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home | Bella Pizza Manager</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="public/img/favicon.svg">

</head>

<body>

    <div class="app-layout">

        <!-- Sidebar -->
        <aside class="sidebar">

            <div class="sidebar-logo">
                <div class="sidebar-icon">
                    <img src="public/img/icon_pizza_logo.svg" alt="Icone Bella Pizza">
                </div>
                <div>
                    <h2>Bella Pizza</h2>
                    <span>Sabor que conquista!</span>
                </div>
            </div>

            <nav class="sidebar-menu">

                <a href="index.php" class="sidebar-link active">

                    <img
                        src="public/img/icon_home_white.svg"
                        alt="Dashboard"
                        class="sidebar-menu-icon">

                    Home

                </a>

                <a href="?acao=ingredientes" class="sidebar-link">

                    <img
                        src="public/img/icon_ingredient_brown.svg"
                        alt="Ingredientes"
                        class="sidebar-menu-icon">

                    Ingredientes

                </a>

                <a href="?acao=create" class="sidebar-link">

                    <img
                        src="public/img/icon_add_brown.svg"
                        alt="Criar nova pizza"
                        class="sidebar-menu-icon">

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

                        <img
                            src="public/img/icon_calendar_white.svg"
                            alt="Calendário"
                            class="topbar-icon">

                        <?= date('d/m/Y'); ?>

                    </span>

                    <div class="topbar-divider"></div>

                    <span class="topbar-item">

                        <img
                            src="public/img/icon_clock_white.svg"
                            alt="Horário"
                            class="topbar-icon">

                        <span id="horaAtual"><?= date('H:i'); ?></span>

                    </span>
                </div>

            </header>

            <!-- Cabeçalho da página -->
            <section class="page-header">

                <div>
                    <h2 class="dashboard-title">

                        <img src="public/img/icon_pizza_logo.svg"
                            alt="Icone de pizza Dashboard"
                            class="dashboard-icon">

                        Lista de Pizzas

                    </h2>

                    <p>Gerencie o cardápio da sua pizzaria de forma simples e rápida.</p>

                    <div class="section-divider"></div>
                </div>

                <div class="page-actions">
                    <a href="?acao=create" class="btn btn-primary">

                        <img
                            src="public/img/icon_add_button.svg"
                            alt="Nova Pizza"
                            class="button-icon">

                        Nova Pizza

                    </a>

                    <a href="?acao=ingredientes" class="btn btn-ingredientes">

                        <img
                            src="public/img/icon_ingredient_white.svg"
                            alt="Gerenciar Ingredientes"
                            class="button-icon">

                        Gerenciar Ingredientes

                    </a>
                </div>

            </section>

            <!-- Tabela de pizzas -->
            <div class="table-card">

                <table class="table mb-0">

                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Nome</th>
                            <th>Ingredientes</th>
                            <th>Preço</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($pizzas as $pizza): ?>

                            <tr>

                                <td>
                                    <?php if ($pizza['disponivel']): ?>
                                        <span class="status-badge status-success">● Disponível</span>
                                    <?php else: ?>
                                        <span class="status-badge status-danger">● Indisponível</span>
                                    <?php endif; ?>
                                </td>

                                <td><?= htmlspecialchars($pizza['nome']); ?></td>

                                <td><?= htmlspecialchars($pizza['ingredientes'] ?? 'Sem ingredientes'); ?></td>

                                <td>R$ <?= number_format($pizza['preco'], 2, ',', '.'); ?></td>

                                <td>
                                    <a href="?acao=edit&id=<?= $pizza['id']; ?>" class="btn btn-edit btn-sm">

                                        <img
                                            src="public/img/icon_pencil_black.svg"
                                            alt="Editar"
                                            class="action-icon">

                                        Editar

                                    </a>

                                    <a
                                        href="#"
                                        class="btn btn-delete btn-sm btn-excluir"
                                        data-url="?acao=delete&id=<?= $pizza['id']; ?>"
                                        data-nome="<?= htmlspecialchars($pizza['nome']); ?>">

                                        <img
                                            src="public/img/icon_trash_white.svg"
                                            alt="Excluir"
                                            class="action-icon">

                                        Excluir

                                    </a>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

            <!-- Cards de estatísticas -->
            <section class="stats-grid">

                <div class="stat-card">
                    <div class="stat-icon stat-green">
                        <img src="public/img/icon_pizza_green.svg" alt="Pizzas cadastradas" class="stat-icon-img">
                    </div>
                    <div>
                        <strong><?= count($pizzas); ?></strong>
                        <span>Pizzas Cadastradas</span>
                        <small>No cardápio</small>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon stat-brown">
                        <img src="public/img/icon_ingredient_brown.svg" alt="Ingredientes disponíveis" class="stat-icon-img">
                    </div>
                    <div>
                        <strong class="text-brown">
                            <?= $totalIngredientesDisponiveis; ?>/<?= $totalIngredientes; ?>
                        </strong>
                        <span>Ingredientes Disponíveis</span>
                        <small>Gerenciáveis</small>
                    </div>
                </div>

            </section>

        </main>

    </div>

    <!-- Modal de confirmação -->
    <div id="modalConfirmacao" class="modal-custom d-none">

        <div class="modal-custom-content">

            <h5>Confirmar exclusão</h5>

            <p>
                Tem certeza que deseja excluir a pizza
                <strong id="nomePizzaModal"></strong>?
            </p>

            <div class="d-flex justify-content-end gap-2">

                <button id="btnCancelarExclusao" class="btn btn-cancelar">
                    Cancelar
                </button>

                <a id="btnConfirmarExclusao" href="#" class="btn btn-delete">
                    Excluir
                </a>

            </div>

        </div>

    </div>

    <!-- Scripts -->
    <script src="public/js/main.js"></script>

</body>

</html>