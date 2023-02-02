<?php

namespace Bee\App\v1\Models;

use Bee\Libraries\DatabaseLibrary;

/**
 * MODEL CLASS TO WORK WITH CHANNELS FROM CRM CLIENTS
 */
class FlowerModel
{
    /**
     * GET CHANNEL DATA BY CLIENT ID AND CHANNEL SLUG
     */
    public function getAll()
    {
        
            
        $sql = '
            SELECT
                idflower
                , name
                , description
                , species
                , date_added
                , date_update
            FROM
                flower                
        ';

        $ret = DatabaseLibrary::select('bee', $sql, []);

        return $ret;        
        
    }

    // ----------------------------------------------------------------------------------------------------

    /**
     * BUSCA DE FLORES POR ID
     *    
     */
    public function getById($flowerId)
    {
        $sql = '
        	SELECT
                idflower
                , name
                , description
                , species
                , date_added
                , date_update
            FROM
                flower
        	WHERE
        	    idflower = ?        	    
        ';

        $params = [$flowerId];

        $ret = DatabaseLibrary::select('bee', $sql, $params);

        return $ret;
    }

    /**
     * ADDED FLOWERS
     */
    public function insertFlower($parameters = []) {
        
        $fieldNames = array_keys($parameters);
        $fieldValues = array_values($parameters);
        $questionMarks = '(' . implode(', ', array_fill(0, count($parameters), '?')) . ')';

        $sql = "
            INSERT INTO flower
                (" . implode(", ", $fieldNames) . ")
            VALUES
                " . $questionMarks;

        $insert = DatabaseLibrary::insert('bee', $sql, $fieldValues);
        return $insert;
        
    }

    /**
     * ADDED BLOOMING_FLOWERS
     */
    public function insertBloomingFlower($parameters = []) {
        
        $fieldNames = array_keys($parameters);
        $fieldValues = array_values($parameters);
        $questionMarks = '(' . implode(', ', array_fill(0, count($parameters), '?')) . ')';

        $sql = "
            INSERT INTO blooming_flowers
                (" . implode(", ", $fieldNames) . ")
            VALUES
                " . $questionMarks;

        $insert = DatabaseLibrary::insert('bee', $sql, $fieldValues);
        return $insert;
        
    }

    /**
     * ADDED BEE_FLOWERS
     */
    public function insertBeeFlowers($parameters = []) {
        
        $fieldNames = array_keys($parameters);
        $fieldValues = array_values($parameters);
        $questionMarks = '(' . implode(', ', array_fill(0, count($parameters), '?')) . ')';

        $sql = "
            INSERT INTO bee_flowers
                (" . implode(", ", $fieldNames) . ")
            VALUES
                " . $questionMarks;

        $insert = DatabaseLibrary::insert('bee', $sql, $fieldValues);
        return $insert;
        
    }
}