<?php

namespace Bee\App\v1\Models;

use Bee\Libraries\DatabaseLibrary;

/**
 * MODEL CLASS TO WORK WITH CHANNELS FROM CRM CLIENTS
 */
class FlowersSearchModel
{
    /**
     * GET CHANNEL DATA BY CLIENT ID AND CHANNEL SLUG
     */
    public function getSearch($filter)
    {
        $sql = '
            SELECT
                fl.idflower
                , fl.name
                , fl.description as fl_description
                , fl.species
                , fl.date_added
                , fl.date_update
                , bf.idbee_type
                , bt.name as bee_description
                , blf.month
            FROM
                flower as fl
            INNER JOIN bee_flowers as bf ON (fl.idflower = bf.flower_id)
            INNER JOIN bee_type as bt ON (bf.idbee_type = bt.idbee_type)
            INNER JOIN blooming_flowers as blf ON ( bf.flower_id = blf.flower_id)
            WHERE 1=1
        ';

        if( isset($filter["beeId"]) && count($filter["beeId"]) > 0 )  {
            $sql .= " AND bf.idbee_type IN (" .implode(',',$filter["beeId"] ). ")";
        }

        if( isset($filter["month"]) && count($filter["month"]) > 0 )  {
            $sql .= " AND blf.month IN (" .implode(',',$filter["month"] ). ")";
        }

        $ret = DatabaseLibrary::select('bee', $sql, []);

        return $ret;        
        
    }

    // ----------------------------------------------------------------------------------------------------

    /**
     * BUSCA DE DADOS DO CANAL NO BANCO POR ID DO CANAL
     *
     * @param $channel_id
     * @param $client_id
     * @return bool|\Error|\Exception|\PDOException|\Throwable
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
}