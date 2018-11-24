<?php
/**
 * Access protected
 * Author: Sergii Zazymko
 * Date: 27.10.18
 * Time: 21:37
 */

namespace Album\Model\Album;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterAwareTrait;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;

/**
 * Class AlbumEntity
 * @package Album\Model\Album
 */
class AlbumEntity extends \ArrayObject implements InputFilterAwareInterface
{
    use InputFilterAwareTrait;
}
