<?php
/**
 * @access protected
 * @author Sergiy Zazymko <sergiy.zazymko@gns-it.com>
 */
namespace Word\Controller;

use PhpOffice\PhpWord\TemplateProcessor;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\ResponseInterface;
use Zend\View\Model\JsonModel;

/**
 * Class WordController
 * @package Word\Controller
 */
class WordController extends AbstractActionController
{
    /**
     * @return JsonModel|\Zend\View\Model\ViewModel
     * @throws \PhpOffice\PhpWord\Exception\CopyFileException
     * @throws \PhpOffice\PhpWord\Exception\CreateTemporaryFileException
     */
    public function indexAction()
    {
        if ($this->request instanceof \Zend\Console\Request) {
            echo __METHOD__ . "\n";
            die();
        }
        /** @var TemplateProcessor $templateProcessor */
        $templateProcessor = new TemplateProcessor('./data/word/Hello.docx');
        $templateProcessor->setValue('Name', 'John Doe');
        $templateProcessor->saveAs('./data/word/hello_3.docx');

        /** @var string $data */
        $data = file_get_contents(realpath('./data/word/hello_3.docx'));

        /** @var ResponseInterface $response */
        $response = $this->getEvent()->getResponse();
        $response->getHeaders()->addHeaders([
            'Content-Disposition' => 'attachment;filename="'. 'hello_3.docx' .'"',
            'Content-Type' => 'application/msword; charset=UTF-8',
            'Content-Transfer-Encoding' => 'binary',
            'Content-Length: ' . filesize('./data/word/hello_3.docx'),
            'Cache-Control' => 'must-revalidate',
            'Pragma' => 'public',
        ]);
        $response->setStatusCode(200);
        $response->setContent($data);

        return $response;
    }
}
