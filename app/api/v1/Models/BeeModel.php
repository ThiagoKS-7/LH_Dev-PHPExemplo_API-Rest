<?php

namespace Bee\App\v1\Models;

use Bee\Libraries\DatabaseLibrary;

/**
 * MODEL CLASS TO WORK WITH CHANNELS FROM CRM CLIENTS
 */
class BeeModel
{
    /**
     * GET ALL BEE
     */
    public function getAll()
    {
        $sql = '
            SELECT
                idbee_type
                , name
                , specie
                , date_added
                , date_update
            FROM
                bee_type                
        ';

        $ret = DatabaseLibrary::select('bee', $sql, []);

        return $ret;        
        
    }

    // ----------------------------------------------------------------------------------------------------

    /**
     * GET BEE ID
     */
    public function getById($beeId)
    {
        $sql = '
        	SELECT
                idbee_type
                , name
                , specie
                , date_added
                , date_update
            FROM
                bee_type   
        	WHERE
        	    idbee_type = ?        	    
        ';

        $params = [$beeId];

        return DatabaseLibrary::select('bee', $sql, $params);
    }

     /**
     * ADDED BEE
     */
    public function insert($parameters = []) {
        
        $fieldNames = array_keys($parameters);
        $fieldValues = array_values($parameters);
        $questionMarks = '(' . implode(', ', array_fill(0, count($parameters), '?')) . ')';

        $sql = "
            INSERT INTO bee_type
                (" . implode(", ", $fieldNames) . ")
            VALUES
                " . $questionMarks;

        $insert = DatabaseLibrary::insert('bee', $sql, $fieldValues);
        return $insert;
        
    }
}