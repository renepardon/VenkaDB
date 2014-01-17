<?php

namespace VenkaDB;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\ServiceManager\ServiceManager;

class VenkaDB extends TestCase
{
    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * @var ConfigurationFactory
     */
    protected $factory;
     
    public function setUp()
    {
        global $moduleConfig;

        $this->serviceManager = new ServiceManager();
        $this->serviceManager->setService('Config', $moduleConfig);
    }

    public function testNothing()
    {
    }
}
