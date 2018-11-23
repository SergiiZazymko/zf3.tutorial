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
    /** @var string $input */
    protected $input = './data/word/order_LOCKED.docx';

    /** @var string $output*/
    protected $output = './data/word/output.docx';

    /**
     * @return JsonModel|\Zend\View\Model\ViewModel
     * @throws \PhpOffice\PhpWord\Exception\CopyFileException
     * @throws \PhpOffice\PhpWord\Exception\CreateTemporaryFileException
     */
    public function indexAction()
    {
        // If this is called from console
        if ($this->request instanceof \Zend\Console\Request) {
            echo __METHOD__ . "\n";
            die();
        }
        /** @var TemplateProcessor $templateProcessor */
        $templateProcessor = new TemplateProcessor($this->input);
        $templateProcessor->setValue('blankid', '1000001');
        $templateProcessor->setValue('orderseries', 'CO');
        $templateProcessor->setValue('ordernumber', '1000001');
        $templateProcessor->setValue('advcatefullname', 'Рамаданова Галина Степанівна');
        $templateProcessor->setValue('certnum', '6/6');
        $templateProcessor->setValue('certat_day', '02');
        $templateProcessor->setValue('certat_month', '12');
        $templateProcessor->setValue('certat_year', '2004');
        $templateProcessor->setValue('certcalc_region', 'Кіровоградської');
        $templateProcessor->setValue('regnum', '1');
        $templateProcessor->setValue('regat_day', '30');
        $templateProcessor->setValue('regat_month', '12');
        $templateProcessor->setValue('regat_year', '1993');
        $templateProcessor->setValue('regcalc_region', 'Волинської');
        $templateProcessor->saveAs($this->output);

        /** @var string $data */
        $data = file_get_contents(realpath($this->output));

        /** @var ResponseInterface $response */
        $response = $this->getEvent()->getResponse();
        $response->getHeaders()->addHeaders([
            'Content-Disposition' => 'attachment;filename="'. basename($this->output) .'"',
            'Content-Type' => 'application/msword; charset=UTF-8',
            'Content-Transfer-Encoding' => 'binary',
            'Content-Length: ' . filesize($this->output),
            'Cache-Control' => 'must-revalidate',
            'Pragma' => 'public',
        ]);
        $response->setStatusCode(200);
        $response->setContent($data);

        return $response;
    }
}
