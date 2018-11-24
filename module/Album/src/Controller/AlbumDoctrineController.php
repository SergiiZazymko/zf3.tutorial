<?php
/**
 * @access protected
 * @author Sergiy Zazymko <sergiy.zazymko@gns-it.com>
 */

namespace Album\Controller;

use Album\Entity\Album;
use Album\Form\AlbumForm;
use Album\Traits\EntityManagerAwareTrait;
use Doctrine\ORM\EntityManager;
use Zend\Form\Form;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class AlbumDoctrineController
 * @package Album\Controller
 */
class AlbumDoctrineController extends AbstractActionController implements EntityManagerAwareInterface
{
    use EntityManagerAwareTrait;

    /**
     * @return ViewModel|\Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        /** @var array $albums */
        $albums = $this->getEntityManager()->getRepository(Album::class)->findAll();
        return ['albums' => $albums];
    }

    /**
     * @return ViewModel
     */
    public function addAction()
    {
        /** @var Album $album */
        $album = new Album;

        /** @var Form $form */
        $form = new AlbumForm;
        $form->bind($album);
        $form->get('submit')->setValue('Add album');
        $form->setInputFilter($album->getInputFilter());

        if (! $this->getRequest()->isPost() || ! $form->setData($this->params()->fromPost())->isValid()) {
            return $this->defaultViewModel('album/album/add' ,[
                'form' => $form
            ]);
        }

        /** @var EntityManager $dem */
        $dem = $this->getEntityManager();
        $dem->persist($album);
        $dem->flush();
        $this->flashMessenger()->addMessage('Your album was added successfully');
        $this->redirect()->toRoute('album-doctrine');
    }

    public function editAction()
    {
        /** @var EntityManager $dem */
        $dem = $this->getEntityManager();

        /** @var int $id */
        $id = $this->params()->fromRoute('id');

        /** @var Album $album */
        $album = $dem->find(Album::class, $id);

        /** @var Form $form */
        $form = new AlbumForm;
        $form->bind($album);
        $form->get('submit')->setValue('Edit album');

        if (! $this->getRequest()->isPost()) {
            return $this->defaultViewModel('album/album/edit', [
                'form' => $form,
            ]);
        }

        if (! $form->setData($this->params()->fromPost())->isValid()) {
            $this->flashMessenger()->addErrorMessage('Not valid form');
            return $this->defaultViewModel('album/album/edit', [
                'form' => $form,
            ]);
        }

        $dem->persist($album);
        $dem->flush();
        $this->flashMessenger()->addMessage('Your album was edited successfully');
        return $this->redirect()->toRoute('album-doctrine');
    }

    /**
     * @return ViewModel
     */
    public function deleteAction()
    {
        /** @var EntityManager $dem */
        $dem = $this->getEntityManager();

        /** @var int $id */
        $id = $this->params()->fromRoute('id');

        /** @var Album $album */
        $album = $dem->find(Album::class, $id);

        if (! $this->getRequest()->isPost()) {
            return $this->defaultViewModel('album/album-doctrine/delete', [
                'album' => $album,
            ]);
        }

        /** @var string $del */
        $del = $this->params()->fromPost('del', 'No');

        if ('Yes' === $del) {
            $dem->remove($album);
            $dem->flush();
            $this->flashMessenger()->addMessage('Your album was deleted successfully');
            return $this->redirect()->toRoute('album-doctrine');
        }

        $this->flashMessenger()->addErrorMessage('Deleting of album was rejected');
        return $this->redirect()->toRoute('album-doctrine');
    }

    /**
     * @return ViewModel
     */
    public function defaultViewModel($template, $data = null)
    {
        /** @var ViewModel $viewModel */
        $viewModel = new ViewModel($data);
        $viewModel->setTemplate($template);
        return $viewModel;
    }
}
