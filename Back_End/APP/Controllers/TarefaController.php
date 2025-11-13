<?php
// Declaração do namespace do controller
namespace APP\Controllers;

// Importa a DAO da tarefa para acessar métodos de banco
use APP\DAO\TarefaDAO;
// Importa o Model da tarefa para criar objetos de tarefa
use APP\Models\TarefaModel;
// Importa interfaces do Slim para manipular requisições e respostas
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

// Declaração da classe final do controller (não pode ser extendida)
final class TarefaController
{
    // Listar todas as tarefas
    public function listar(Request $request, Response $response, array $args): Response
    {
        // Cria uma instância do DAO para acessar os métodos do banco
        $tarefaDAO = new TarefaDAO();

        // Prepara o array de retorno com mensagem, status HTTP e dados das tarefas
        $results = [
            'message' => "Tarefas listadas com sucesso!",
            'status' => 200,
            'data' => $tarefaDAO->listarTodas(), // Chama o método listarTodas() da DAO
        ];

        // Converte o array para JSON e escreve no corpo da resposta
        $response->getBody()->write(json_encode($results));

        // Retorna a resposta com cabeçalho JSON e status 200
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
    // Inserir nova tarefa
    public function inserir(Request $request, Response $response, array $args): Response
    {
        // Captura os dados enviados pelo cliente (POST)
        $data = $request->getParsedBody();

        // Cria instância do DAO para manipular banco
        $tarefaDAO = new TarefaDAO();

        // Cria um objeto Model para representar a nova tarefa
        $tarefa = new TarefaModel();
        $tarefa->setDescricao($data['descricao']); // Define a descrição da tarefa

        // Chama o método da DAO para inserir a tarefa no banco
        $tarefaDAO->inserirTarefa($tarefa);

        // Prepara a resposta JSON
        $results = [
            "status" => 200,
            "message" => "Tarefa inserida com sucesso!",
            "data" => $data
        ];

        // Escreve o JSON no corpo da resposta
        $response->getBody()->write(json_encode($results));

        // Retorna a resposta com header JSON e status 200
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
    // Alterar tarefa
    // Alterar tarefa
    public function alterar(Request $request, Response $response, array $args): Response
    {
        // Captura os dados enviados (POST/PUT)
        $data = $request->getParsedBody();

        // Captura o ID da tarefa que vem na URL
        $id = intval($args['id']);

        // Cria instância do DAO
        $tarefaDAO = new TarefaDAO();

        // Cria objeto Model e define a nova descrição
        $tarefa = new TarefaModel();
        $tarefa->setDescricao($data['descricao']);

        // Chama o método da DAO para atualizar a tarefa no banco
        $tarefaDAO->alterarTarefa($tarefa, $id);

        // Prepara a resposta JSON
        $results = [
            "status" => 200,
            "message" => "Tarefa alterada com sucesso!",
            "data" => $data
        ];

        // Escreve no corpo da resposta
        $response->getBody()->write(json_encode($results));

        // Retorna a resposta JSON com status 200
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
    // Excluir tarefa
       // Excluir tarefa
    public function excluir(Request $request, Response $response, array $args): Response
    {
        // Pega o ID da tarefa a ser excluída da URL
        $id = intval($args['id']);

        // Cria instância do DAO
        $tarefaDAO = new TarefaDAO(); 

        // Chama o método para excluir a tarefa do banco
        $tarefaDAO->excluirTarefa($id);

        // Prepara a resposta JSON
        $results = [
            'status' => 200,
            'message' => 'Tarefa excluída com sucesso',
        ];

        // Escreve o JSON no corpo da resposta
        $response->getBody()->write(json_encode($results));

        // Retorna a resposta JSON com status 200
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    // Marcar tarefa como concluída
    // Marcar tarefa como concluída
    public function concluir(Request $request, Response $response, array $args): Response
    {
        // Captura o ID da tarefa a ser concluída da URL
        $id = intval($args['id']);

        // Cria instância do DAO
        $tarefaDAO = new TarefaDAO(); 

        // Chama o método para marcar a tarefa como concluída
        $tarefaDAO->concluirTarefa($id);

        // Prepara a resposta JSON
        $results = [
            'status' => 200,
            'message' => 'Tarefa concluída com sucesso',
        ];

        // Escreve o JSON no corpo da resposta
        $response->getBody()->write(json_encode($results));

        // Retorna a resposta JSON com header e status
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
