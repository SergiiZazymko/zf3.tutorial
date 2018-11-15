<?php
/**
 * @access protected
 * @author Sergiy Zazymko <sergiy.zazymko@gns-it.com>
 */
namespace Word\Controller;

use PhpOffice\PhpWord\TemplateProcessor;
use Zend\Mvc\Controller\AbstractActionController;

class WordController extends AbstractActionController
{
    public function indexAction()
    {
        $templateProcessor = new TemplateProcessor('./data/word/Hello.docx');
        $templateProcessor->setValue('Name', 'John Doe');

        $templateProcessor->saveAs('./data/word/hello_3.docx');
    }
}
