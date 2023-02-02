<?php

namespace Bee\Controllers;

/**
 * NÃO APAGAR ESSA CONTROLLER E NÃO ADICIONAR NENHUM OUTRO MÉTODO NELA
 * POIS É UTILIZADA PELA INFRA PARA VERIFICAÇÃO DO STATUS (HEALTHCHECK)
 */
class IndexController
{
    public function index()
    {
        header('Content-Type: application/json', true, 200);
        echo json_encode("Teste Abelha");
        exit;
    }
   
    public function testPost($dataPost)
    {        
        header('Content-Type: application/json', true, 200);
        echo json_encode([$dataPost]);        
        exit;
    }

    public function test()
    {        
        header('Content-Type: application/json', true, 200);
        echo json_encode(['Testget']);        
        exit;
    }
    
    public function testGet($data)
    {
        header('Content-Type: application/json', true, 200);
        echo json_encode([$data]);        
        exit;
    }
}