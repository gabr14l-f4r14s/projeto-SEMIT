<?php

/** @var array $ingredientes */

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ingredientes | Bella Pizza Manager</title>

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

                    <img
                        src="public/img/icon_home_brown.svg"
                        alt="Dashboard"
                        class="sidebar-menu-icon">

                    Home

                </a>

                <a href="?acao=ingredientes" class="sidebar-link active">

                    <img
                        src="public/img/icon_ingredient_white.svg"
                        alt="Ingredientes"
                        class="sidebar-menu-icon">

                    Ingredientes

                </a>

                <a href="?acao=create" class="sidebar-link">

                    <img
                        src="public/img/icon_add_brown.svg"
                        alt="Nova Pizza"
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
                            class="topbar-icon"
                            alt="Calendário">

                        <?= date('d/m/Y'); ?>

                    </span>

                    <div class="topbar-divider"></div>

                    <span class="topbar-item">

                        <img
                            src="public/img/icon_clock_white.svg"
                            class="topbar-icon"
                            alt="Horário">

                        <span id="horaAtual"><?= date('H:i'); ?></span>

                    </span>

                </div>

            </header>

            <!-- Conteúdo da página -->
            <section class="page-header">

                <h1 class="page-title">

                    <img
                        src="public/img/icon_pizza_logo.svg"
                        alt="Ingredientes"
                        class="dashboard-icon">

                    Ingredientes

                </h1>

                <p class="page-description">
                    Gerencie os ingredientes disponíveis para o preparo das pizzas.
                </p>

                <div class="section-divider"></div>

                <!-- Mensagens de validação -->
                <?php if (isset($_GET['erro']) && $_GET['erro'] === 'ingrediente_vazio'): ?>

                    <div class="alert alert-danger">
                        Informe o nome do ingrediente antes de cadastrar.
                    </div>

                <?php endif; ?>

                <?php if (isset($_GET['erro']) && $_GET['erro'] === 'ingrediente_em_uso'): ?>

                    <div class="alert alert-danger">
                        Este ingrediente está associado a uma ou mais pizzas e não pode ser excluído.
                    </div>

                <?php endif; ?>

                <?php if (isset($_GET['erro']) && $_GET['erro'] === 'ingrediente_duplicado'): ?>

                    <div class="alert alert-danger">
                        Já existe um ingrediente cadastrado com esse nome.
                    </div>

                <?php endif; ?>

                <!-- Formulário de cadastro -->
                <form action="?acao=store_ingrediente" method="POST" class="ingredient-form">

                    <div class="ingredient-input-group">

                        <input
                            type="text"
                            name="nome"
                            class="form-control"
                            placeholder="Ex.: Mussarela"
                            required>

                        <button type="submit" class="btn btn-primary">

                            <img
                                src="public/img/icon_add_button.svg"
                                alt="Adicionar"
                                class="button-icon">

                            Adicionar Ingrediente

                        </button>

                    </div>

                </form>

                <!-- Tabela de ingredientes -->
                <div class="table-card table-card-no-margin">
                    <table class="table mb-0">

                        <thead>

                            <tr>

                                <th>Nome</th>

                                <th>Status</th>

                                <th>Ações</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach ($ingredientes as $ingrediente): ?>

                                <tr>

                                    <td><?= htmlspecialchars($ingrediente['nome']); ?></td>

                                    <td>

                                        <?php if ($ingrediente['disponivel']): ?>

                                            <span class="status-badge status-success">
                                                ● Disponível
                                            </span>


                                        <?php else: ?>

                                            <span class="status-badge status-danger">
                                                ● Indisponível
                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <td>

                                        <a
                                            href="?acao=alternar_ingrediente&id=<?= $ingrediente['id']; ?>"
                                            class="btn btn-edit btn-sm">

                                            <img
                                                src="public/img/icon_pencil_black.svg"
                                                alt="Status"
                                                class="action-icon">

                                            Alterar Status

                                        </a>

                                        <a
                                            href="#"
                                            class="btn btn-delete btn-sm btn-excluir"
                                            data-url="?acao=delete_ingrediente&id=<?= $ingrediente['id']; ?>"
                                            data-nome="<?= htmlspecialchars($ingrediente['nome']); ?>">

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

            </section>

        </main>     

    </div>

    <!-- Modal de confirmação -->
    <div id="modalConfirmacao" class="modal-custom d-none">

        <div class="modal-custom-content">

            <h5>Confirmar exclusão</h5>

            <p>
                Tem certeza que deseja excluir o ingrediente
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