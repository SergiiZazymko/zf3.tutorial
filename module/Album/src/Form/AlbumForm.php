<?php
/**
 * Access protected
 * Author: Sergii Zazymko
 * Date: 31.10.18
 * Time: 20:48
 */

namespace Album\Form;

use Zend\Form\Element\Hidden;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;

/**
 * Class AlbumForm
 * @package Album\Form
 */
class AlbumForm extends Form
{
    /**
     * AlbumForm constructor.
     * @param null $name
     * @param array $options
     */
    public function __construct($name = null, array $options = [])
    {
        parent::__construct('album');
        $this->init();
    }

    /**
     *
     */
    public function init()
    {
        $this
            ->add([
                'name' => 'id',
                'type' => Hidden::class,
            ])->add([
                'name' => 'title',
                'type' => Text::class,
                'options' => [
                    'label' => 'Title',
                ],
            ])->add([
                'name' => 'artist',
                'type' => Text::class,
                'options' => [
                    'label' => 'Artist',
                ],
            ])->add([
                'name' => 'submit',
                'type' => Submit::class,
                'attributes' => [
                    'value' => 'Go!',
                    'id' => 'submitbutton',
                ],
            ]);
    }
}
