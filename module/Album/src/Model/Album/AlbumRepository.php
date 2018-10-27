<?php
/**
 * Access protected
 * Author: Sergii Zazymko
 * Date: 27.10.18
 * Time: 21:39
 */

namespace Album\Model\Album;

use Zend\Db\TableGateway\TableGatewayInterface;

/**
 * Class AlbumRepository
 * @package Album\Model\Album
 */
class AlbumRepository
{
    /** @var TableGatewayInterface */
    protected $tableGateway;

    /**
     * AlbumRepository constructor.
     * @param TableGatewayInterface $tableGateway
     */
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @return mixed
     */
    public function fetchAll()
    {
        return $this->tableGateway->select();
    }
}
