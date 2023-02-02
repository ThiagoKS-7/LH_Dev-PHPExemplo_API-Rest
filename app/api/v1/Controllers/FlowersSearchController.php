<?php

namespace Bee\Api\v1\Controllers;

use Bee\App\v1\Models\FlowersSearchModel;
use Bee\Config\CoreConfig;

/*
 * CONTROLLER CLASS TO WORK WITH FLOWERS FUNCTIONS
 */
class FlowersSearchController
{
    private $track = '';
    public $responseCode = 206;
    public $responseData = [
        'status' => 'warning'
        , 'data' => ['message' => "Ops! We have some generic problem. Please, try again!"]
    ];

    private $month = [
         '1' => "Janeiro"
        ,'2' => "Fevereiro"
        ,'3' => "Março"
        ,'4' => "Abril"
        ,'5' => "Maio"
        ,'6' => "Junho"
        ,'7' => "Julho"
        ,'8' => "Agosto"
        ,'9' => "Setembro"
        ,'10' => "Outubro"
        ,'11' => "Novembro"
        ,'12' => "Dezembr"
    ];

    /**
     * CONSTRUCTION
     */
    public function __construct()
    {
        
    }

    /**
     * DESTRUCTION RETURN
     */
    public function __destruct()
    {
        CoreConfig::response($this->responseCode, $this->responseData);
    }

    /**
     * CALL TO GETBEELIST
     */
    public function getSearch($params)
    {
      
        $this->responseCode = 204;
        $this->responseData = [
            'status' => 'warning'
            , 'data' => ['message' => "No content"]
        ];

        $flowerSearchModel = new FlowersSearchModel;
        $getSearch = $flowerSearchModel->getSearch($params[0]);

        if ( ! empty($getSearch)) {

            $this->responseCode = 200;
            $this->responseData = [
                'status' => 'success'
                , 'data' => $this->formatData($getSearch)
            ];
        }
    }

    private function formatData($data) 
    {

        $result = [];       
        $tempId = 0;

        foreach ($data as $key => $value) {

            if($tempId != $value['idflower']) {
               
               $parseFlowers = [
                    "id"        => $value['idflower']
                    ,"name"     => $value['name']
                    ,"description"     => $value['fl_description']
                    ,"species"  => $value['species']
                    ,"date_added"  => $value['date_added']
                    ,"date_update"  => $value['date_update']
                    ,"blooming_flowers"  => $this->parseMonth($data, $value['idflower'])
                    ,"bee"  => $this->parseBee($data, $value['idflower'])
                ];

                $result['flowers'][] = $parseFlowers;
            }
            
            $tempId = $value['idflower'];            
        }

        return $result;
    }

    private function parseBee($dataBee, $flower_id) 
    {
        $resultBee = [];
        
        foreach ($dataBee as $key => $value) {
            
            if($flower_id == $value['idflower']) {
                $resultBee[$value['idbee_type']] = [
                    "id" => $value['idbee_type']                    
                    , "description" => $value['bee_description']
                ];
            }

        }

        return $resultBee;
    }
    
    private function parseMonth($dateMonth, $flower_id) 
    {
        $resultMonth = [];
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        foreach ($dateMonth as $key => $value) {
            
            if($flower_id == $value['idflower']) {
                $resultMonth[$value['month']] = [
                    "id" => $value['month']                    
                    , "description" =>  $this->month[$value['month']]
                ];
            }

        }

        return $resultMonth;
    }

}