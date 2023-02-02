<?php

namespace Bee\Api\v1\Controllers;

use Bee\App\v1\Models\BeeModel;
use Bee\Config\CoreConfig;

/*
 * CONTROLLER CLASS TO WORK WITH CUSTOMER FUNCTIONS
 */
class BeeController
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
    public function getBeeList()
    {
        
        $this->responseCode = 204;
        $this->responseData = [
            'status' => 'warning'
            , 'data' => ['message' => "No content"]
        ];
        
        $beeModel = new BeeModel;
        $result = $beeModel->getAll();

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
    public function getBeeId($beeId)
    {
        $this->responseCode = 204;
        $this->responseData = [
            'status' => 'warning'
            , 'data' => ['message' => "No content"]
        ];
        
        $beeModel = new BeeModel;
        $result = $beeModel->getById((int)$beeId);

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
    public function addedBee($params)
    {
        $validate = $this->validate($params);

        if(!$validate) {

            $beeModel = new BeeModel;
            foreach ($params as $key => $value) {
                $payload = [
                    "name" => $value['name']
                    ,"specie" => $value['specie']
                    ,"date_added" => date("Y-m-d h:m:s")
                    ,"date_update" => date("Y-m-d h:m:s")
                ];
                $result[] = $beeModel->insert($payload);
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
     * CALL TO GETBEEID
     */
    public function updateBee($params)
    {
        echo "<pre>";
        var_dump($params);
        echo "</pre>";
    }

    private function validate($data)
    {
        $result = [];
        foreach ($data as $key => $value) {
            if(isset($value['name']) && isset($value['specie']) ) {
                $result[] = true;
            } else {
               $result[] = false;
            }
        }
        
        $ret = in_array(false, $result);

        return $ret;
    }
}