<?php
/**
 * @access protected
 * @author Sergiy Zazymko <sergiy.zazymko@gns-it.com>
 */

namespace Blog\Model;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\Adapter\Driver\StatementInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\ResultSet\ResultSetInterface;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Hydrator\HydratorInterface;
use Zend\Hydrator\Reflection as ReflectionHydrator;

/**
 * Class ZendDbSqlRepository
 * @package Blog\Model
 */
class ZendDbSqlRepository implements PostRepositoryInterface
{
    /** @var AdapterInterface $adapter */
    private $adapter;

    /** @var HydratorInterface $hydrator */
    private $hydrator;

    /** @var PostEntity $prototype */
    private $prototype;

    /**
     * ZendDbSqlRepository constructor.
     * @param AdapterInterface $adapter
     */
    public function __construct(
        AdapterInterface $adapter,
        HydratorInterface $hydrator,
        PostEntity $postEntity
    ) {
        $this->adapter = $adapter;
        $this->hydrator = $hydrator;
        $this->prototype = $postEntity;
    }

    /**
     * @return array|mixed|ResultSetInterface
     */
    public function fetchAll()
    {
        /** @var Sql $sql */
        $sql = new Sql($this->adapter);

        /** @var Select $select */
        $select = $sql->select('posts');

        /** @var StatementInterface $stmt */
        $stmt = $sql->prepareStatementForSqlObject($select);

        /** @var ResultInterface $result */
        $result = $stmt->execute();

        // var_dump($result);die;

        if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
            return [];
        }

        /** @var ResultSetInterface $resultSet */
        // $resultSet = new ResultSet;
        // $resultSet->initialize($result);

        /** @var ResultSetInterface $resultSet */
        $resultSet = new HydratingResultSet(
            $this->hydrator,
            $this->prototype
        );
        $resultSet->initialize($result);

        //var_dump($resultSet);die;

        return $resultSet;

    }

    public function fetch($id)
    {
        // TODO: Implement fetch() method.
    }
}
