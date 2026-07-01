<?php

require_once 'models/PizzaModel.php';

/**
 * Controller responsável pelo gerenciamento das pizzas.
 * Atua como intermediário entre as Views e o Model.
 */
class PizzaController
{
    private $model;

    /**
     * Inicializa o controller com uma instância do model.
     */
    public function __construct($pdo)
    {
        $this->model = new PizzaModel($pdo);
    }

    /**
     * Exibe a página inicial juntamente com
     * as informações do dashboard.
     */
    public function listar()
    {
        $pizzas = $this->model->listar();

        $totalIngredientesDisponiveis = $this->model->contarIngredientesDisponiveis();

        $totalIngredientes = $this->model->totalIngredientes();

        require 'views/home/index.php';
    }

    /**
     * Exibe o formulário para cadastro de uma nova pizza.
     */
    public function create()
    {
        $ingredientes = $this->model->listarIngredientes();

        require 'views/pizza/create.php';
    }

    /**
     * Valida os dados enviados pelo formulário
     * e realiza o cadastro de uma nova pizza.
     */
    public function store()
    {
        $nome = trim($_POST['nome'] ?? '');

        $preco = trim($_POST['preco'] ?? '');
        $preco = str_replace(',', '.', $preco);
        $precoValido = filter_var($preco, FILTER_VALIDATE_FLOAT);

        $ingredientes = $_POST['ingredientes'] ?? [];

        if ($nome === '' || $precoValido === false || $precoValido <= 0) {
            header('Location: ?acao=create&erro=preco_invalido');
            exit;
        }

        if (empty($ingredientes)) {
            header('Location: ?acao=create&erro=ingredientes');
            exit;
        }

        if ($this->model->existePorNome($nome)) {
            header('Location: ?acao=create&erro=pizza_duplicada');
            exit;
        }

        $this->model->salvar($nome, $precoValido, $ingredientes);

        header('Location: index.php');
        exit;
    }

    /**
     * Remove uma pizza cadastrada.
     */
    public function delete()
    {
        $id = $_GET['id'];

        $this->model->excluir($id);

        header('Location: index.php');
        exit;
    }

    /**
     * Exibe o formulário de edição
     * com os dados da pizza selecionada.
     */
    public function edit()
    {
        $id = $_GET['id'];

        $pizza = $this->model->buscarPorId($id);

        $ingredientes = $this->model->listarIngredientes();

        $ingredientesDaPizza = $this->model->buscarIngredientesDaPizza($id);

        require 'views/pizza/edit.php';
    }

    /**
     * Valida os dados enviados e atualiza
     * as informações da pizza selecionada.
     */
    public function update()
    {
        $id = $_POST['id'] ?? null;

        $nome = trim($_POST['nome'] ?? '');

        $preco = trim($_POST['preco'] ?? '');
        $preco = str_replace(',', '.', $preco);
        $precoValido = filter_var($preco, FILTER_VALIDATE_FLOAT);

        $ingredientes = $_POST['ingredientes'] ?? [];

        if ($id === null || $nome === '' || $precoValido === false || $precoValido <= 0) {
            header('Location: ?acao=edit&id=' . $id . '&erro=preco_invalido');
            exit;
        }

        if (empty($ingredientes)) {
            header('Location: ?acao=edit&id=' . $id . '&erro=ingredientes');
            exit;
        }

        if ($this->model->existePorNome($nome, $id)) {
            header('Location: ?acao=edit&id=' . $id . '&erro=pizza_duplicada');
            exit;
        }

        $this->model->atualizar($id, $nome, $precoValido, $ingredientes);

        header('Location: index.php');
        exit;
    }
}
