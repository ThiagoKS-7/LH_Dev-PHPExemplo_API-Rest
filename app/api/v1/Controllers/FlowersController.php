<?php

namespace Bee\Api\v1\Controllers;

use Bee\App\v1\Models\FlowerModel;
use Bee\Config\CoreConfig;

/*
 * CONTROLLER CLASS TO WORK WITH FLOWERS FUNCTIONS
 */
class FlowersController
{
    private $track = '';
    public $responseCode = 206;
    public $responseData = [
        'status' => 'warning'
        , 'data' => ['message' => "Ops! We have some generic problem. Please, try again!"]
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
    public function getFlowersList()
    {
        
        $this->responseCode = 204;
        $this->responseData = [
            'status' => 'warning'
            , 'data' => ['message' => "No content"]
        ];
        
        $flowerModel = new FlowerModel;
        $result = $flowerModel->getAll();

        if ( ! empty($result)) {

            $this->responseCode = 200;
            $this->responseData = [
                'status' => 'success'
                , 'data' => $result
            ];
        }
    }

    /**
     * CALL TO GETBEEID
     */
    public function getFlowersListId($flowerId)
    {        
        $this->responseCode = 204;
        $this->responseData = [
            'status' => 'warning'
            , 'data' => ['message' => "No content"]
        ];
        
        $flowerModel = new FlowerModel;
        $result = $flowerModel->getById((int)$flowerId);

        if ( ! empty($result)) {

            $this->responseCode = 200;
            $this->responseData = [
                'status' => 'success'
                , 'data' => $result
            ];
        }
    }

    /**
     * ADDED FLOWER
     */
    public function addedFlower($params)
    {        
        $validate = $this->validate($params);

        if(!$validate) {
            $result = [];
            $flowerModel = new FlowerModel;
            foreach ($params as $key => $value) {
                $payload = [
                    "name" => $value['name']
                    ,"species" => $value['specie']
                    ,"description" => $value['description']
                    ,"date_added" => date("Y-m-d h:m:s")
                    ,"date_update" => date("Y-m-d h:m:s")
                ];

                $flowerId = $flowerModel->insertFlower($payload);
                $this->addedBloomingFlower($flowerId, $value['month']);
                $this->addedBeeFlower($flowerId, $value['bee']);                
                $result[] = $flowerId;
            }

            if ( ! empty($result)) {

                $this->responseCode = 200;
                $this->responseData = [
                    'status' => 'success'
                    , 'data' => $result
                ];
            }

        } else {
            $this->responseCode = 400;
            $this->responseData = [
                'status' => 'warning'
                , 'data' => ['message' => "Payload invalid"]
            ];
        }
    }

    /**
     * ADDED BLOOMING_FLOWERS
     */
    private function addedBloomingFlower($flowerId, $params)
    {        
        $flowerModel = new FlowerModel;
        foreach ($params as $key => $value) {
            $payload = [
                "flower_id" => $flowerId
                ,"month" => $value                
            ];

            $result = $flowerModel->insertBloomingFlower($payload);
        }         
    }

    /**
     * ADDED BEE_FLOWERS
     */
    private function addedBeeFlower($flowerId, $params)
    {        
        $flowerModel = new FlowerModel;
        foreach ($params as $key => $value) {
            $payload = [
                "flower_id" => $flowerId
                ,"idbee_type" => $value
            ];

            $result = $flowerModel->insertBeeFlowers($payload);
        }         
    }

    /**
     * VALIADTE  PAYLOAD
     */
    private function validate($data)
    {
        $result = [];

        foreach ($data as $key => $value) {

            if( 
                isset($value['name']) 
                && isset($value['specie']) 
                && isset($value['description']) 
                && isset($value['bee']) 
                && isset($value['month'])
            ) {
                $result[] = true;
            } else {
               $result[] = false;
            }
        }
        
        $ret = in_array(false, $result);

        return $ret;
    }
    
}