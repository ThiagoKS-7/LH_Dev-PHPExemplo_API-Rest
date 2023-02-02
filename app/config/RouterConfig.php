<?php

namespace Bee\Config;

use Bee\App\Routes;
use Bee\Config\CoreConfig;

/**
 * CORE CLASS TO WORK WITH ROUTES
 */
class RouterConfig
{
    /*
     * MAIN FUNCTION TO RUN ROUTES
     */
    public static function get()
    {
        $founded = false;        
        $correctMethod = false;

        $class = '';
        $function = '';
        $method = '';
        
        $calledUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $calledUri = explode('/', $calledUrl);

        $registeredRoutes = new Routes();
        $registeredRoutes = $registeredRoutes();
        $routeKey = array_keys($registeredRoutes);

        foreach ($routeKey as $key => $value) {          
           $route = self::getUriElements($registeredRoutes[$value],$value);

            foreach ($route as $keyUri => $data) {                
                
                $routeElementParts = explode('/', $data['url']);
                $payloadGet = [];
                for ($i = 0; $i < count($routeElementParts); $i++) {

                    if (strpos($routeElementParts[$i], '{') !== false && count($calledUri) == count($routeElementParts)) {

                        $routeElementParts[$i] = $calledUri[$i];
                        $payloadGet[] = $calledUri[$i];                   
                    }
                }

                if ($calledUrl == implode('/', $routeElementParts)) {

                    $class = $data["controller_name"];
                    $method = strtoupper($data["method"]);
                    $function = $data["function_name"];
                    $founded = true;
                    if ($_SERVER['REQUEST_METHOD'] == $method && $_SERVER['REQUEST_URI'] == $calledUrl ) {

                        $correctMethod = true;

                        switch ($_SERVER['REQUEST_METHOD']) {
                            case 'GET':                        
                                
                                $payload[] = $payloadGet[0];
                                break;
                            case 'POST':
                                
                                if(!empty($_POST)) {
                                    $payload = [$_POST];
                                }
                              
                                if (empty($_POST)) {

                                    $rest_json = file_get_contents("php://input");

                                    if (self::isJSON($rest_json)) {
                                        $payload = json_decode($rest_json, true);
                                    } else {
                                        $payload = $rest_json;
                                    }
                                }

                                break;
                            case 'PUT':
                                
                                break;
                            case 'DELETE':
                                
                                break;
                            default:
                                die($_SERVER['REQUEST_METHOD']);
                                break;
                        }

                        break;
                    }
                }
            }        
        }

        if ($founded) {

            if ( ! $correctMethod){

                CoreConfig::response(405, "Method Not Allowed");
            }

            $class = new $class;
            call_user_func_array( [ $class, $function ], $payload );
        
        } else {

            CoreConfig::response(404, "Not found");
        }
    }

    private static function getUriElements($uriParts,$urlSession)
    {
        $result = [];
        foreach ($uriParts as $key => $value) {
           $result[] = [
                 "url" => $value[0]
                ,"controller_name" => $value[1]
                ,"function_name" => $value[3]
                ,"method" => $value[2]
           ];
        }
        return $result;
    }

    private static function isJSON($json)
    {
        try {

            $jhonson = json_decode($json);

            return (json_last_error() === JSON_ERROR_NONE);

        } catch (\Exception $e) {
            return (json_last_error() === JSON_ERROR_NONE);
        }

    }
}
