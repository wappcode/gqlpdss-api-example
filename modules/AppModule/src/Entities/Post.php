<?php

namespace AppModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use AppModule\Entities\Author;
use GPDCore\Entities\AbstractEntityModel;

/**
 * @ORM\Entity
 * @ORM\Table(name="posts")
 */
class Post extends AbstractEntityModel
{
    /**
     *
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $body;
    /**
     * @ORM\ManyToOne(targetEntity="\AppModule\Entities\Author", inversedBy="posts")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", nullable=false)
     * @var Author
     */
    private $author;


    /**
     * Get the value of title
     *
     * @return  string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param  string  $title
     *
     * @return  self
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of body
     *
     * @return  string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set the value of body
     *
     * @param  string  $body
     *
     * @return  self
     */
    public function setBody(string $body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get the value of author
     *
     * @return  Author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @param  Author  $author
     *
     * @return  self
     */
    public function setAuthor(Author $author)
    {
        $this->author = $author;

        return $this;
    }
}
