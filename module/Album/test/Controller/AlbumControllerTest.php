<?php
/**
 * @access protected
 * @author Sergiy Zazymko <sergiy.zazymko@gns-it.com>
 */

namespace AlbumTest\Controller;

use Album\Controller\AlbumController;
use Album\Model\Album\AlbumEntity;
use Album\Model\Album\AlbumRepository;
use Prophecy\Argument;
use Zend\Http\Response;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\ArrayUtils;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

/**
 * Class AlbumControllerTest
 * @package AlbumTest\Controller
 */
class AlbumControllerTest extends AbstractHttpControllerTestCase
{
    /** @var bool $traceError */
    protected $traceError = true;

    /** @var $albumRepository */
    protected $albumRepository;

    /**
     *
     */
    protected function setUp()
    {
        // The module configuration should still be applicable for tests.
        // You can override configuration here with test case specific values,
        // such as sample view templates, path stacks, module_listener_options,
        // etc.
        $configOverrides = [];

        $this->setApplicationConfig(ArrayUtils::merge(
            // Grabbing the full application configuration:
            include __DIR__ . '/../../../../config/application.config.php',
            $configOverrides
        ));

        parent::setUp();

        $this->configureServiceManager($this->getApplicationServiceLocator());
    }

    /**
     * @param ServiceLocatorInterface $serviceManager
     */
    protected function configureServiceManager(ServiceLocatorInterface $serviceManager)
    {
        $serviceManager->setAllowOverride(true);
        $serviceManager->setService('config', $this->updateConfig($serviceManager->get('config')));
        $serviceManager->setService(AlbumRepository::class, $this->mockAlbumRepository()->reveal());
        $serviceManager->setAllowOverride(false);
    }

    /**
     * @param $config
     * @return mixed
     */
    protected function updateConfig($config)
    {
        $config['zf3_db'] = [];
        return $config;
    }

    /**
     * @return \Prophecy\Prophecy\ObjectProphecy
     */
    protected function mockAlbumRepository()
    {
        $this->albumRepository = $this->prophesize(AlbumRepository::class);
        return $this->albumRepository;
    }

    /**
     * @throws \Exception
     */
    public function testIndexActionCanBeAccessed()
    {
        $this->albumRepository->fetchAll()->willReturn([]);

        $this->dispatch('/album');
        $this->assertResponseStatusCode(Response::STATUS_CODE_200);
        $this->assertModuleName('Album');
        $this->assertControllerName(AlbumController::class);
        $this->assertControllerClass('AlbumController');
        $this->assertMatchedRouteName('album');
    }

    /**
     * @throws \Exception
     */
    public function testAddActionRedirectsAfterValidPost()
    {
        $this->albumRepository
            ->saveAlbum(Argument::type(AlbumEntity::class))
            ->shouldBeCalled();

        /** @var array $postData */
        $postData = [
            'title' => 'The Singles',
            'artist' => 'The Prodigy',
            'id' => '',
        ];

        $this->dispatch('/album/add', 'POST', $postData);
        $this->assertResponseStatusCode(Response::STATUS_CODE_302);
        $this->assertRedirectTo('/album');
    }

    /**
     * @throws \Exception
     */
    public function testAddActionShowEmptyFormAfterGet()
    {
        $this->dispatch('/album/add');
        $this->assertResponseStatusCode(Response::STATUS_CODE_200);
    }

    /**
     * @throws \Exception
     */
    public function testAddActionShowFormWithErrorsAfterInvalidPost()
    {
        /** @var array $postData */
        $postData = [
            'title' => '',
            'artist' => 'The Prodigy',
            'id' => '',
        ];

        $this->dispatch('/album/add', 'POST', $postData);
        $this->assertResponseStatusCode(Response::STATUS_CODE_200);
    }

    /**
     *
     */
    public function testEditActionRedirectAfterValidPost()
    {
        $this->albumRepository
            ->getAlbum(1)
            ->willReturn(new AlbumEntity);

        $this->albumRepository
            ->saveAlbum(Argument::type(AlbumEntity::class))
            ->shouldBeCalled();

        /** @var array $postData */
        $postData = [
            'title' => 'Remixes',
            'artist' => 'The Prodigy',
            'id' => '',
        ];

        $this->dispatch('/album/edit/1', 'POST', $postData);
        $this->assertResponseStatusCode(Response::STATUS_CODE_302);
        $this->assertRedirectTo('/album');
    }

    /**
     * @throws \Exception
     */
    public function testEditActionShowFilledInFormAfterGet()
    {
        $this->albumRepository
            ->getAlbum(1)
            ->willReturn(new AlbumEntity);

        $this->dispatch('/album/edit/1');
        $this->assertResponseStatusCode(Response::STATUS_CODE_200);
    }

    /**
     * @throws \Exception
     */
    public function testEditActionShownFormWithErrorsAfterInvalidPost()
    {
        $this->albumRepository
            ->getAlbum(1)
            ->willReturn(new AlbumEntity);

        /** @var array $postData */
        $postData = [
            'title' => '',
            'artist' => 'The Prodigy',
            'id' => '',
        ];

        $this->dispatch('/album/edit/1', 'POST', $postData);
        $this->assertResponseStatusCode(Response::STATUS_CODE_200);
    }

    /**
     * @throws \Exception
     */
    public function testDeleteActionRedirectsAfterValidPost()
    {
        $this->albumRepository
            ->deleteAlbum(1)
            ->shouldBeCalled();

        $postData = [
            'id' => 1,
            'del' => 'Yes'
        ];

        $this->dispatch('/album/delete/1', 'POST', $postData);
        $this->assertResponseStatusCode(Response::STATUS_CODE_302);
        $this->assertRedirectTo('/album');
    }
}
