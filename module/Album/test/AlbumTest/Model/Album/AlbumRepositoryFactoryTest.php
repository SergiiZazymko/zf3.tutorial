<?php
/**
 * @access protected
 * @author Sergiy Zazymko <sergiy.zazymko@gns-it.com>
 */

namespace AlbumTest\Model\Album;

use Album\Model\Album\AlbumRepository;
use Album\Model\Album\AlbumRepositoryFactory;
use PHPUnit\Framework\TestCase;
use Test\Bootstrap;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AlbumRepositoryFactoryTest extends TestCase
{
    /** @var ServiceLocatorInterface $serviceManger */
    protected $serviceManager;

    public function setUp()
    {
        $this->serviceManager = Bootstrap::getServiceManager();
    }

    /**
     * @return FactoryInterface
     */
    public function testInstanse()
    {
        /** @var FactoryInterface $instance */
        $instance = new AlbumRepositoryFactory;
        $this->assertInstanceOf(FactoryInterface::class, $instance);
        return $instance;
    }


    /**
     * @depends testInstanse
     *
     * @param FactoryInterface $factory
     */
    public function testServiceCanBeCreated(FactoryInterface $factory)
    {
//        var_dump($this->serviceManager->get(AlbumRepository::class));
//        die;
//        $this->assertTrue($this->serviceManager->has(AlbumRepository::class));

//        $service = $factory->
    }
}
