<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use PDO;

final class PesquisaAtendimentoController {

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create(Request $request, Response $response, array $args)
    {
        $data = $request->getParsedBody();

        $sql = "INSERT INTO pesquisa_atendimento 
        (usuario_id, hasBandaLarga, bandaLargaFornecedor, bandaLargaVelocidade, bandaLargaValor, 
         hasLinkDedicado, linkDedicadoFornecedor, linkDedicadoVelocidade, linkDedicadoValor, 
         hasLinhaFixa, linhaFixaFornecedor, linhaFixaVelocidade, linhaFixaValor, hasPabx, pabxFornecedor, 
         pabxVelocidade, pabxValor, hasSdwan, sdwanFornecedor, sdwanVelocidade, sdwanValor, 
         hasGestaoTrafego, gestaoTrafegoFornecedor, gestaoTrafegoVelocidade, gestaoTrafegoValor, 
         hasDesktop, desktopFornecedor, desktopVelocidade, desktopValor, hasNotebook, notebookFornecedor, 
         notebookVelocidade, notebookValor, hasOffice365, office365Fornecedor, office365Velocidade, 
         office365Valor, hasGoogleWorkspace, googleWorkspaceFornecedor, googleWorkspaceVelocidade, 
         googleWorkspaceValor, hasCloud, cloudFornecedor, cloudVelocidade, cloudValor, hasServidor, 
         servidorFornecedor, servidorVelocidade, servidorValor, hasSite, siteUrl, hasInstagram, 
         instagramUrl, hasLinkedin, linkedinUrl, hasEspecialista, especialista, dataAgendamento, is_deleted) 
        VALUES 
        (:usuario_id, :hasBandaLarga, :bandaLargaFornecedor, :bandaLargaVelocidade, :bandaLargaValor, 
         :hasLinkDedicado, :linkDedicadoFornecedor, :linkDedicadoVelocidade, :linkDedicadoValor, 
         :hasLinhaFixa, :linhaFixaFornecedor, :linhaFixaVelocidade, :linhaFixaValor, :hasPabx, :pabxFornecedor, 
         :pabxVelocidade, :pabxValor, :hasSdwan, :sdwanFornecedor, :sdwanVelocidade, :sdwanValor, 
         :hasGestaoTrafego, :gestaoTrafegoFornecedor, :gestaoTrafegoVelocidade, :gestaoTrafegoValor, 
         :hasDesktop, :desktopFornecedor, :desktopVelocidade, :desktopValor, :hasNotebook, :notebookFornecedor, 
         :notebookVelocidade, :notebookValor, :hasOffice365, :office365Fornecedor, :office365Velocidade, 
         :office365Valor, :hasGoogleWorkspace, :googleWorkspaceFornecedor, :googleWorkspaceVelocidade, 
         :googleWorkspaceValor, :hasCloud, :cloudFornecedor, :cloudVelocidade, :cloudValor, :hasServidor, 
         :servidorFornecedor, :servidorVelocidade, :servidorValor, :hasSite, :siteUrl, :hasInstagram, 
         :instagramUrl, :hasLinkedin, :linkedinUrl, :hasEspecialista, :especialista, :dataAgendamento, :is_deleted)";

        $stmt = $this->db->prepare($sql);

        // Vinculação de parâmetros
        $stmt->bindParam(':usuario_id', $data['usuario_id']);
        // Bind outros parâmetros...

        if($stmt->execute()) {
            return $response->withJson(['message' => 'Dados inseridos com sucesso.'], 201);
        } else {
            return $response->withJson(['message' => 'Erro ao inserir os dados.'], 500);
        }
    }
    
     // Método para buscar todas as pesquisas de atendimento (GET)
     public function getAll(Request $request, Response $response, array $args)
     {
         $sql = "SELECT * FROM pesquisa_atendimento WHERE is_deleted = 0";
         $stmt = $this->db->prepare($sql);
         $stmt->execute();
         $result = $stmt->fetchAll();
 
         return $response->withJson($result);
     }
 
     // Método para buscar uma pesquisa de atendimento específica por ID (GET)
     public function getById(Request $request, Response $response, array $args)
     {
         $id = $args['id'];
         $sql = "SELECT * FROM pesquisa_atendimento WHERE id = :id AND is_deleted = 0";
         $stmt = $this->db->prepare($sql);
         $stmt->bindParam(':id', $id);
         $stmt->execute();
         $result = $stmt->fetch();
 
         if ($result) {
             return $response->withJson($result);
         } else {
             return $response->withJson(['message' => 'Registro não encontrado.'], 404);
         }
     }
}
