<?php
namespace dao;

use singleton\Dao;

/**
 * Class TestServiceDao
 * @package dao
 */
class TestServiceDao extends Dao {

    /**
     * @see TestService::getTest
     */
    public function selectTest($sample)
    {
        //$data = SampleModel::find($sample);
        return $data;
    }
}