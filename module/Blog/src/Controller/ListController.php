<?php
/**
 * @access protected
 * @author Sergiy Zazymko <sergiy.zazymko@gns-it.com>
 */

namespace Blog\Controller;

use Blog\Model\PostRepositoryInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class ListController
 * @package Blog\Controller
 */
class ListController extends AbstractActionController
{
    /**
     * @var PostRepositoryInterface
     */
    protected $repository;

    /**
     * PostRepository constructor.
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->repository = $postRepository;
    }

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        return new ViewModel([
            'posts' => $this->repository->fetchAll(),
        ]);
    }
}
