<?php
/**
 * Access protected
 * Author: Sergii Zazymko
 * Date: 25.10.18
 * Time: 20:10
 */

namespace Album\Controller;

use Album\Model\Album\AlbumRepository;
use Stdlib\Db\Table;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class AlbumController
 * @package Album\Controller
 */
class AlbumController extends AbstractActionController
{
    /** @var AlbumRepository $repository */
    protected $repository;

    /**
     * AlbumController constructor.
     * @param AlbumRepository $repository
     */
    public function __construct(AlbumRepository $repository)
    {
        $this->repository = $repository;
    }


    public function indexAction()
    {
        var_dump($this->repository->fetchAll()->current());
        var_dump(Table::ALBUM);
        echo __METHOD__;
        die;
    }

    public function addAction()
    {
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }
}
