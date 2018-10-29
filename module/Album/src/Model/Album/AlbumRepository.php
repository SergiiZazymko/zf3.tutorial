<?php
/**
 * Access protected
 * Author: Sergii Zazymko
 * Date: 27.10.18
 * Time: 21:39
 */

namespace Album\Model\Album;

use Zend\Db\ResultSet\ResultSet;
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

    /**
     * @param $id
     * @return \ArrayObject
     */
    public function getAlbum($id)
    {
        /** @var int $id */
        $id = intval($id);

        /** @var ResultSet $resultSet */
        $resultSet = $this->tableGateway->select(['id' => $id]);

        /** @var \ArrayObject $row */
        $row = $resultSet->current();

        if (! $row) {
            throw new \RuntimeException(
                sprintf('Couldn\'t find album with identifier %d', $id)
            );
        }

        return $row;
    }

    /**
     * @param AlbumEntity $album
     * @return mixed
     */
    public function saveAlbum(AlbumEntity $album)
    {
        /** @var array $data */
        $data = [
            'artist' => $album['artist'],
            'title' => $album['title'],
        ];

        /** @var int $id */
        $id = intval($album['id']);

        if (0 === $id) {
            return $this->tableGateway->insert($data);
        }

        if (! $this->getAlbum($id)) {
            throw new \RuntimeException(
                sprintf('Couldn\'t find album with identifier %d', $id)
            );
        }

        return $this->tableGateway->update($data, [
            'id' => $id,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteAlbum($id)
    {
        return $this->tableGateway->delete([
            'id'=> intval($id),
        ]);
    }
}
