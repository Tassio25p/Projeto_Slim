<?php

namespace APP\DAO;

use APP\Models\TarefaModel;
use PDO;

class TarefaDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    // Listar todas as tarefas
    public function listarTodas(): array
    {
        $sql = "SELECT * FROM tarefas ORDER BY data_criacao DESC";
        $tarefas = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $tarefas;
    }

    // Inserir nova tarefa
    public function inserirTarefa(TarefaModel $tarefa): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO tarefas (descricao, status, data_criacao) 
             VALUES (:descricao, 0, NOW())"
        );

        $stmt->execute([
            "descricao" => $tarefa->getDescricao()
        ]);
    }

    // Alterar tarefa
    public function alterarTarefa(TarefaModel $tarefa, int $id): void
    {
        $stmt = $this->pdo->prepare(
            "UPDATE tarefas 
             SET descricao = :descricao 
             WHERE id = :id"
        );

        $stmt->execute([
            "descricao" => $tarefa->getDescricao(),
            "id" => $id
        ]);
    }

    // Excluir tarefa
    public function excluirTarefa(int $id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM tarefas WHERE id = :id");
        $stmt->execute(["id" => $id]);
    }

    // Marcar como concluída
    public function concluirTarefa(int $id): void
    {
        $stmt = $this->pdo->prepare("UPDATE tarefas SET status = 1 WHERE id = :id");
        $stmt->execute(["id" => $id]);
    }
}
