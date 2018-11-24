<?php
/**
 * @access protected
 * @author Sergiy Zazymko <sergiy.zazymko@gns-it.com>
 */

namespace Album\Model;

/**
 * Interface BindableInterface
 * @package Album\Model
 */
interface BindableInterface
{
    /**
     * @return mixed
     */
    public function exchangeArray($data);

    /**
     * @return mixed
     */
    public function getArrayCopy();
}
