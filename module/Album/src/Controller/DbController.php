<?php
/**
 * @access protected
 * @author Sergiy Zazymko <sergiy.zazymko@gns-it.com>
 */

namespace Album\Controller;

use Album\Model\Album\AlbumRepository;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\StatementInterface;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class DbController
 * @package Album\Controller
 */
class DbController extends AbstractActionController
{
    /** @var AlbumRepository $repository */
    protected $repository;

    /**
     * DbController constructor.
     * @param AlbumRepository $repository
     */
    public function __construct(AlbumRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     *
     */
    public function addAction()
    {
        die;
        /** @var AdapterInterface $adapter */
        $adapter = $this->repository->getTableGateway()->getAdapter();

        /** @var string $query */
        $sql = file_get_contents('./data/sql/insert.sql');

        /** @var StatementInterface $statement */
        $statement = $adapter->query($sql);
        $statement->execute();

        die('success');
    }
}
