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

    /**
     * @return array|\Zend\Http\Response
     */
    public function editAction()
    {
        /** @var int $id */
        $id = (int) $this->params()->fromRoute('id', null);
        if (! $id) {
            $this->redirect()->toRoute('album', ['action' => 'add']);
        }

        try {
            /** @var AlbumEntity $album */
            $album = $this->repository->getAlbum($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('album', ['action' => 'index']);
        }

        /** @var AlbumForm $form */
        $form = new AlbumForm;
        $form->bind($album);
        $form->get('submit')->setAttribute('value', 'Edit');

        /** @var Request $request */
        $request = $this->getRequest();

        /** @var array $viewData */
        $viewData = [
            'id' => $id,
            'form' => $form,
        ];

        if (! $request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($album->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return $viewData;
        }

        $this->repository->saveAlbum($album);

        return $this->redirect()->toRoute('album', ['action' => 'index']);
    }

    /**
     * @return array
     */
    public function deleteAction()
    {
        /** @var int $id */
        $id = (int) $this->params()->fromRoute('id', null);

        if (! $id) {
            $this->redirect()->toRoute('album');
        }

        /** @var Request $request */
        $request = $this->getRequest();

        if ($request->isPost()) {
            /** @var string $del */
            $del = $request->getPost('del', 'No');

            if ('Yes' === $del) {
                $id = (int) $request->getPost('id');
                $this->repository->deleteAlbum($id);
            }

            return $this->redirect()->toRoute('album');
        }

        return [
            'id' => $id,
            'album' => $this->repository->getAlbum($id),
        ];
    }
}
