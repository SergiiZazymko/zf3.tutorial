<?php
/**
 * @access protected
 * @author Sergiy Zazymko <sergiy.zazymko@gns-it.com>
 */

namespace Blog\Model;

/**
 * Interface PostCommandInterface
 * @package Blog\Model
 */
interface PostCommandInterface
{
    /**
     * @param PostEntity $post
     * @return mixed
     */
    public function insert(PostEntity $post);

    /**
     * @param PostEntity $post
     * @return mixed
     */
    public function update(PostEntity $post);

    /**
     * @param PostEntity $post
     * @return mixed
     */
    public function delete(PostEntity $post);
}
