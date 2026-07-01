<?php

/**
 * Model responsável pelas operações relacionadas
 * aos ingredientes no banco de dados.
 */
class IngredienteModel
{
    private $pdo;

     /**
     * Inicializa o model com a conexão PDO.
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Retorna todos os ingredientes cadastrados
     * ordenados alfabeticamente.
     */
    public function listar()
    {
        $sql = "SELECT * FROM ingredientes ORDER BY nome";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Cadastra um novo ingrediente
     * com status disponível.
     */
    public function salvar($nome)
    {
        $sql = "INSERT INTO ingredientes (nome, disponivel)
                VALUES (?, 1)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([$nome]);
    }

    /**
     * Alterna a disponibilidade
     * do ingrediente selecionado.
     */
    public function alternarDisponibilidade($id)
    {
        $sql = "UPDATE ingredientes
                SET disponivel = CASE
                    WHEN disponivel = 1 THEN 0
                    ELSE 1
                END
                WHERE id = ?";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([$id]);
    }

     /**
     * Verifica se o ingrediente
     * está associado a alguma pizza.
     */
    public function estaEmUso($id)
    {
        $sql = "SELECT COUNT(*) FROM pizza_ingredientes WHERE ingrediente_id = ?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetchColumn() > 0;
    }

    /**
     * Remove um ingrediente do banco de dados.
     */
    public function excluir($id)
    {
        $sql = "DELETE FROM ingredientes WHERE id = ?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }

    /**
     * Verifica se já existe um ingrediente
     * cadastrado com o mesmo nome.
     */
    public function existePorNome($nome)
    {
        $sql = "SELECT COUNT(*) FROM ingredientes WHERE LOWER(nome) = LOWER(?)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([$nome]);

        return $stmt->fetchColumn() > 0;
    }

    /**
     * Retorna o total de ingredientes cadastrados.
     */
    public function totalIngredientes()
    {
        $sql = "SELECT COUNT(*) FROM ingredientes";

        return $this->pdo->query($sql)->fetchColumn();
    }
}
