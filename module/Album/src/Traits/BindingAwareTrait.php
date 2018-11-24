<?php
/**
 * @access protected
 * @author Sergiy Zazymko <sergiy.zazymko@gns-it.com>
 */

namespace Album\Traits;

/**
 * Trait BindingAwareTrait
 * @package Album\Model
 */
trait BindingAwareTrait
{
    /**
     * @param $data
     */
    public function exchangeArray($data)
    {
        foreach ($data as $key => $value)
        {
            if (property_exists(self::class, $key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * @return array
     */
    public function getArrayCopy()
    {
        /** @var array $arrayCopy */
        $arrayCopy = [];

        foreach ($this as $key => $value) {
            $arrayCopy[$key] = $value;
        }

        return $arrayCopy;
    }
}
