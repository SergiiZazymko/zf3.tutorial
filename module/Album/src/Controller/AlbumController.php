<?php
/**
 * Access protected
 * Author: Sergii Zazymko
 * Date: 25.10.18
 * Time: 20:10
 */

namespace Album\Controller;

use Album\Form\AlbumForm;
use Album\Model\Album\AlbumEntity;
use Album\Model\Album\AlbumRepository;
use Zend\Http\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class AlbumController
 * @package Album\Controller
 */
class AlbumController extends AbstractActionController
{
    /** @var AlbumRepository $repository */
    protected $repository;

    /**
     * AlbumController constructor.
     * @param AlbumRepository $repository
     */
    public function __construct(AlbumRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        return new ViewModel([
            'albums' => $this->repository->fetchAll(),
        ]);
    }

    /**
     * @return array|\Zend\Http\Response
     */
    public function addAction()
    {
        /** @var AlbumForm $form */
        $form = new AlbumForm;
        $form->get('submit')->setValue('Add');

        /** @var Request $request */
        $request = $this->getRequest();

        if (! $request->isPost()) {
            return [
                'form' => $form,
            ];
            //return new ViewModel([
            //    'form' => $form,
            //]);
        }

        /** @var AlbumEntity $album */
        $album = new AlbumEntity;
        $form->setInputFilter($album->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return [
                'form' => $form,
            ];
        }

        $album->exchangeArray($form->getData());
        $this->repository->saveAlbum($album);

        return $this->redirect()->toRoute('album');
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }
}
