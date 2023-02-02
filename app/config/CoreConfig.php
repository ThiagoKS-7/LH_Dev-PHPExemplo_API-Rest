<?php

namespace Bee\Config;

use Dotenv\Dotenv;

/**
 * CORE CLASS
 */
class CoreConfig
{
    /*
     * LOAD CONFIGURATION .ENV FILE
     */
    public static function loadEnvs()
    {
        try {           
            
            $dotenv = new Dotenv(__DIR__ . '/../../environment', 'development.env');            
            $dotenv->load();
            
        } catch (\Exception $e) {
            
            self::showErrorsIfNotInProd($e);
        }
    }

    /**
     * API RESPONSE METHOD
     */
    public static function response($responseCode, $responseBody)
    {
        $response = self::formatResponse($responseCode, $responseBody);

        header('Content-Type: application/json', true, $responseCode);
        echo json_encode($response);
        fastcgi_finish_request();
    }

    /*
     * ADJUSTED RETURN DATA
     */
    public static function formatResponse($responseCode, $responseBody)
    {
        return [
            'httpCode'  => $responseCode
            , 'body'    => $responseBody
        ];
    }

    /*
     * ADJUSTED JSON OR ARRAY TO OBJECT
     */
    public static function adjustedData($postData)
    {
        if ( is_array($postData)) {

            return json_decode(json_encode($postData));
        
        } else {

            json_decode($postData);
            if (json_last_error() === JSON_ERROR_NONE) {
                return json_decode($postData);
            } else {
                return json_decode(json_encode([]));
            }
        }
    }   

    /*
     * PRINT ERRORS
     */
    public static function showErrorsIfNotInProd($e)
    {
        if (getenv("APP_ENV") != 'production') {
            
            self::response($e->getCode(), $e->getMessage());
            exit;
        
        } else {

            self::response(400, ['status' => 'warning', 'data' => ['message' => "Ops! We have some generic problem. Please, try again!"]]);
            exit;
        }
    }
}
