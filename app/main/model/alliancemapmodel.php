<?php
/**
 * Created by PhpStorm.
 * User: exodus4d
 * Date: 19.05.2015
 * Time: 20:14
 */

namespace Model;

use DB\SQL\Schema;

class AllianceMapModel extends BasicModel {

    protected $table = 'alliance_map';

    protected $fieldConf = [
        'active' => [
            'type' => Schema::DT_BOOL,
            'nullable' => false,
            'default' => 1,
            'index' => true
        ],
        'allianceId' => [
            'type' => Schema::DT_INT,
            'index' => true,
            'belongs-to-one' => 'Model\AllianceModel',
            'constraint' => [
                [
                    'table' => 'alliance',
                    'on-delete' => 'CASCADE'
                ]
            ]
        ],
        'mapId' => [
            'type' => Schema::DT_INT,
            'index' => true,
            'belongs-to-one' => 'Model\MapModel',
            'constraint' => [
                [
                    'table' => 'map',
                    'on-delete' => 'CASCADE'
                ]
            ]
        ]
    ];

    /**
     * see parent
     */
    public function clearCacheData(){
        // clear map cache
        $this->mapId->clearCacheData();
    }

    /**
     * overwrites parent
     * @param null $db
     * @param null $table
     * @param null $fields
     * @return bool
     */
    public static function setup($db=null, $table=null, $fields=null){
        $status = parent::setup($db,$table,$fields);

        if($status === true){
            $status = parent::setMultiColumnIndex(['allianceId', 'mapId'], true);
        }

        return $status;
    }
}