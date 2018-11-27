<?php
/**
 * @access protected
 * @author Sergiy Zazymko <sergiy.zazymko@gns-it.com>
 */

namespace Blog\Model;
use Blog\Model\PostEntity;

/**
 * Class PostRepository
 * @package Model
 */
class PostRepository implements PostRepositoryInterface
{
    /** @var array $data */
    private $data = [
        1 => [
            'id'    => 1,
            'title' => 'Hello World #1',
            'text'  => 'This is our first blog post!',
        ],
        2 => [
            'id'    => 2,
            'title' => 'Hello World #2',
            'text'  => 'This is our second blog post!',
        ],
        3 => [
            'id'    => 3,
            'title' => 'Hello World #3',
            'text'  => 'This is our third blog post!',
        ],
        4 => [
            'id'    => 4,
            'title' => 'Hello World #4',
            'text'  => 'This is our fourth blog post!',
        ],
        5 => [
            'id'    => 5,
            'title' => 'Hello World #5',
            'text'  => 'This is our fifth blog post!',
        ],
    ];



    /**
     * @return array|mixed
     */
    public function fetchAll()
    {
        return array_map(function($post) {
            return new PostEntity(
                $post['text'],
                $post['title'],
                $post['id']
            );
        }, $this->data);
    }

    /**
     * @param $id
     * @return PostEntity|mixed
     */
    public function fetch($id)
    {
        /** @var int $id */
        $id = (int) $id;
        if (! isset($this->data['id'])) {
            throw new \DomainException(sprintf(
               'Post by id "%d" not found', $id
            ));
        }

        return new PostEntity(
            $this->data[$id]['title'],
            $this->data[$id]['text'],
            $this->data[$id]['id']
        );
    }
}
