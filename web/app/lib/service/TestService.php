<?php
namespace service;

use singleton\Service;

class TestService extends Service {


    /**
     * @see TestController::getTest
     */
    public function getTest($sample)
    {
        $result = TestServiceDao::getInstance()->selectTest($sample);
        return $result;
    }

    /**
     * @see TestController::
     */
    public function isTest($sample)
    {
        $result = TestServiceDao::getInstance()->selectTest($sample);
        return $result;
    }
}