<?php

require_once 'models/IngredienteModel.php';

/**
 * Controller responsável pelo gerenciamento dos ingredientes.
 * Atua como intermediário entre a View e o Model.
 */
class IngredienteController
{
    private $model;

    /**
     * Inicializa o controller com uma instância do model.
     */
    public function __construct($pdo)
    {
        $this->model = new IngredienteModel($pdo);
    }

    /**
     * Exibe a listagem de ingredientes cadastrados.
     */
    public function listar()
    {
        $ingredientes = $this->model->listar();

        require 'views/ingrediente/index.php';
    }

     /**
     * Alterna o status de disponibilidade do ingrediente.
     */
    public function alternar()
    {
        $id = $_GET['id'];

        $this->model->alternarDisponibilidade($id);

        header('Location: index.php?acao=ingredientes');
        exit;
    }
     /**
     * Valida e realiza o cadastro de um novo ingrediente.
     */
    public function store()
    {
        $nome = trim($_POST['nome'] ?? '');

        if ($nome === '') {
            header('Location: index.php?acao=ingredientes&erro=ingrediente_vazio');
            exit;
        }

        if ($this->model->existePorNome($nome)) {
            header('Location: index.php?acao=ingredientes&erro=ingrediente_duplicado');
            exit;
        }

        $this->model->salvar($nome);

        header('Location: index.php?acao=ingredientes');
        exit;
    }

    /**
     * Remove um ingrediente caso ele não esteja associado
     * a nenhuma pizza cadastrada.
     */
    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if ($id === null) {
            header('Location: index.php?acao=ingredientes');
            exit;
        }

        if ($this->model->estaEmUso($id)) {
            header('Location: index.php?acao=ingredientes&erro=ingrediente_em_uso');
            exit;
        }

        $this->model->excluir($id);

        header('Location: index.php?acao=ingredientes');
        exit;
    }
}
