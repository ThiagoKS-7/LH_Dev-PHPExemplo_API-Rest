<?php

namespace Bee\App;

class Routes
{
    public function __invoke()
    {
        return [

            'api' => [
                 ['/bee', 'Bee\Api\v1\Controllers\BeeController', 'GET', 'getBeeList']
                ,['/bee', 'Bee\Api\v1\Controllers\BeeController', 'POST', 'addedBee']
                ,['/bee/{idBee}', 'Bee\Api\v1\Controllers\BeeController', 'GET', 'getBeeId']

                ,['/flowers', 'Bee\Api\v1\Controllers\FlowersController', 'GET', 'getFlowersList']
                ,['/flowers', 'Bee\Api\v1\Controllers\FlowersController', 'POST', 'addedFlower']
                ,['/flowers/{idFlower}', 'Bee\Api\v1\Controllers\FlowersController', 'GET', 'getFlowersListId']
                
                ,['/search', 'Bee\Api\v1\Controllers\FlowersSearchController', 'POST', 'getSearch']

            ],
            'test' => [
                 ['/test', 'Bee\Api\v1\Controllers\IndexController', 'GET', 'index']
                ,['/test', 'Bee\Api\v1\Controllers\IndexController', 'POST', 'testPost']
                ,['/test/{$}', 'Bee\Api\v1\Controllers\IndexController', 'GET', 'testGet']
            ]
            
            
            // '/'         => ['Bee\Controllers\IndexController', 'GET', 'index'],            
            // '/test'     => ['Bee\Controllers\IndexController', 'POST', 'testPost'],            
            // '/test/{$}' => ['Bee\Controllers\IndexController', 'GET', 'testGet'],

            // /* ROTAS DA API */
            // /* BEE */
            // '/bee' => ['Bee\Api\v1\Controllers\BeeController', 'GET', 'getBeeList'],
            // '/bee/add' => ['Bee\Api\v1\Controllers\BeeController', 'POST', 'addedBee'],
            // '/bee/{idBee}' => ['Bee\Api\v1\Controllers\BeeController', 'GET', 'getBeeId'],                      

            // '/flowers'  => ['Bee\Api\v1\Controllers\FlowersController', 'GET', 'getFlowersList'],
            // '/flowers/add' => ['Bee\Api\v1\Controllers\FlowersController', 'POST', 'addedFlower'],
            // '/flowers/{idFlower}'  => ['Bee\Api\v1\Controllers\FlowersController', 'GET', 'getFlowersListId'],            
            // '/search'  => ['Bee\Api\v1\Controllers\FlowersSearchController', 'POST', 'getSearch'],

        ];
    }
}