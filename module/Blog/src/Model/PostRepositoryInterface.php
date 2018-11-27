<?php
/**
 * @access protected
 * @author Sergiy Zazymko <sergiy.zazymko@gns-it.com>
 */

namespace Blog\Model;

/**
 * Interface PostRepositoryInterface
 * @package Model
 */
interface PostRepositoryInterface
{
    /**
     * @return mixed
     */
    public function fetchAll();

    /**
     * @param $id
     * @return mixed
     */
    public function fetch($id);
}
