<?php

// Define o fuso horário utilizado pela aplicação.
date_default_timezone_set('America/Bahia');

// Carrega a configuração do banco de dados e os controllers.
require_once 'config/database.php';
require_once 'controllers/PizzaController.php';
require_once 'controllers/IngredienteController.php';

// Inicializa os controllers da aplicação.
$controller = new PizzaController($pdo);
$ingredienteController = new IngredienteController($pdo);

// Obtém a ação solicitada ou utiliza a listagem como padrão.
$acao = $_GET['acao'] ?? 'listar';

// Direciona a requisição para o método correspondente.
switch ($acao) {

    case 'listar':
        $controller->listar();
        break;

    case 'create':
        $controller->create();
        break;

    case 'store':
        $controller->store();
        break;

    case 'delete':
        $controller->delete();
        break;
    case 'edit':
        $controller->edit();
        break;

    case 'update':
        $controller->update();
        break;

    case 'ingredientes':
        $ingredienteController->listar();
        break;

    case 'alternar_ingrediente':
        $ingredienteController->alternar();
        break;

    case 'store_ingrediente':
        $ingredienteController->store();
        break;
    
    case 'delete_ingrediente':
    $ingredienteController->delete();
    break;

    default:
        die("Ação inválida.");
}
