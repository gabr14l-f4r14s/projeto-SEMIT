<?php

/**
 * Model responsável pelas operações relacionadas
 * às pizzas e seus ingredientes no banco de dados.
 */
class PizzaModel
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
     * Retorna todas as pizzas cadastradas juntamente
     * com seus ingredientes e status de disponibilidade.
     */
    public function listar()
    {
        $sql = "SELECT 
                p.id,
                p.nome,
                p.preco,
                GROUP_CONCAT(ing.nome ORDER BY ing.nome SEPARATOR ', ') AS ingredientes,
                CASE 
                    WHEN COUNT(i.id) > 0 THEN 0
                    ELSE 1
                END AS disponivel
            FROM pizzas p
            LEFT JOIN pizza_ingredientes pi ON p.id = pi.pizza_id
            LEFT JOIN ingredientes ing ON pi.ingrediente_id = ing.id
            LEFT JOIN ingredientes i ON pi.ingrediente_id = i.id AND i.disponivel = 0
            GROUP BY p.id, p.nome, p.preco
            ORDER BY p.nome";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Cadastra uma nova pizza e associa
     * os ingredientes selecionados.
     */
    public function salvar($nome, $preco, $ingredientes)
    {
        $sql = "INSERT INTO pizzas (nome, preco)
            VALUES (?, ?)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([$nome, $preco]);

        $pizzaId = $this->pdo->lastInsertId();

        foreach ($ingredientes as $ingredienteId) {
            $sql = "INSERT INTO pizza_ingredientes (pizza_id, ingrediente_id)
                VALUES (?, ?)";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([$pizzaId, $ingredienteId]);
        }
    }

    /**
     * Remove uma pizza cadastrada.
     */
    public function excluir($id)
    {
        $sql = "DELETE FROM pizzas WHERE id = ?";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([$id]);
    }

    /**
     * Retorna os dados de uma pizza
     * a partir do seu identificador.
     */
    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM pizzas WHERE id = ?";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Atualiza os dados da pizza e
     * redefine seus ingredientes associados.
     */
    public function atualizar($id, $nome, $preco, $ingredientes)
    {
        $sql = "UPDATE pizzas
            SET nome = ?, preco = ?
            WHERE id = ?";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([$nome, $preco, $id]);

        $sql = "DELETE FROM pizza_ingredientes
            WHERE pizza_id = ?";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([$id]);

        foreach ($ingredientes as $ingredienteId) {
            $sql = "INSERT INTO pizza_ingredientes (pizza_id, ingrediente_id)
                VALUES (?, ?)";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([$id, $ingredienteId]);
        }
    }

    /**
     * Retorna todos os ingredientes cadastrados.
     */
    public function listarIngredientes()
    {
        $sql = "SELECT * FROM ingredientes
                ORDER BY nome";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retorna os identificadores dos ingredientes
     * associados a uma determinada pizza.
     */
    public function buscarIngredientesDaPizza($pizzaId)
    {
        $sql = "SELECT ingrediente_id
                FROM pizza_ingredientes
                WHERE pizza_id = ?";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([$pizzaId]);

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * Retorna a quantidade de ingredientes
     * atualmente disponíveis.
     */
    public function contarIngredientesDisponiveis()
    {
        $sql = "SELECT COUNT(*) FROM ingredientes WHERE disponivel = 1";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchColumn();
    }

    /**
     * Verifica se já existe uma pizza cadastrada
     * com o mesmo nome.
     *
     * Durante a edição, a própria pizza é
     * desconsiderada na comparação.
     */
    public function existePorNome($nome, $id = null)
    {
        if ($id === null) {

            $sql = "SELECT COUNT(*) FROM pizzas
                    WHERE LOWER(nome) = LOWER(?)";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$nome]);
        } else {

            $sql = "SELECT COUNT(*) FROM pizzas
                    WHERE LOWER(nome) = LOWER(?)
                    AND id <> ?";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$nome, $id]);
        }

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
