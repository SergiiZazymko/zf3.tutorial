<?php
/**
 * @access protected
 * @author Sergiy Zazymko <sergiy.zazymko@gns-it.com>
 */
namespace Blog\Model;

/**
 * Class PostEntity
 * @package Model
 */
class PostEntity
{
    /** @var string $id */
    private $id;

    /** @var string $text */
    private $text;

    /** @var string $title */
    private $title;

    /**
     * PostEntity constructor.
     * @param string $text
     * @param string $title
     * @param null $id
     */
    public function __construct(string $text, string $title, int $id = null)
    {
        $this->text = $text;
        $this->title = $title;
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}
