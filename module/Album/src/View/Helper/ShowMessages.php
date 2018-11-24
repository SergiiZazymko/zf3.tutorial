<?php
/**
 * @access protected
 * @author Sergiy Zazymko <sergiy.zazymko@gns-it.com>
 */

namespace Album\View\Helper;

use Zend\Mvc\Plugin\FlashMessenger\FlashMessenger;
use Zend\View\Helper\AbstractHelper;

/**
 * Class ShowMessages
 * @package Album\View\Helper
 */
class ShowMessages extends AbstractHelper
{
    /**
     * @return string
     */
    public function __invoke()
    {
        /** @var FlashMessenger $flashMessanger */
        $flashMessanger = new FlashMessenger;

        /** @var array $messages */
        $messages = $flashMessanger->getMessages();

        /** @var array $errorMessages */
        $errorMessages = $flashMessanger->getErrorMessages();

        /** @var string $result */
        $result = '';

        if (count($messages)) {
            $result .= '<ul class="list-unstyled">';
            foreach ($messages as $message) {
                $result .= "<li class='alert-success'>$message</li>";
            }
            $result .= '</ul>';
        }

        if (count($errorMessages)) {
            $result .= '<ul class="list-unstyled">';
            foreach ($errorMessages as $message) {
                $result .= "<li class='alert-danger'>$message</li>";
            }
            $result .= '</ul>';
        }

        return $result;
    }
}