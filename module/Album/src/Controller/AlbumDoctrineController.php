<?php
/**
 * @access protected
 * @author Sergiy Zazymko <sergiy.zazymko@gns-it.com>
 */

namespace Album\Controller;

use Album\Entity\Album;
use Album\Traits\EntityManagerAwareTrait;
use Doctrine\ORM\EntityManagerInterface;
use Zend\Mvc\Console\View\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class AlbumDoctrineController
 * @package Album\Controller
 */
class AlbumDoctrineController extends AbstractActionController implements EntityManagerAwareInterface
{
    use EntityManagerAwareTrait;

//    public function __construct(EntityManagerInterface $entityManager)
//    {
//        $this->entityManager = $entityManager;
//    }

    /**
     * @return ViewModel|\Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        /** @var array $albums */
        //$albums = $this->entityManager->getRepository(Album::class)->findAll();
        $entityManager = $this->getEntityManager();
        $albums = $entityManager->getRepository(Album::class)->findAll();
        return ['albums' => $albums];
    }
}
