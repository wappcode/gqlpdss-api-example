<?php

namespace AppModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use GPDCore\Entities\AbstractEntityModel;
use Doctrine\Common\Collections\Collection;
use GraphQL\Doctrine\Annotation as API;

/**
 * @ORM\Entity
 * @ORM\Table(name="authors")
 */
class Author extends AbstractEntityModel
{


    /**
     * 
     * @ORM\Column(type="string", length=255, nullable=false, name="first_name")
     * @var string
     */
    private $firstName;


    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="last_name")
     *
     * @var ?string
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255, nullable=false, name="email")
     *
     * @var string
     */
    private $email;


    /**
     * 
     * @ORM\OneToMany(targetEntity="\AppModule\Entities\Post", mappedBy="author")
     * @var Collection
     */
    private $posts;

    /**
     * Gets the value de fullname
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->firstName . " " . $this->lastName ?? '';
    }

    /**
     * Get the value of firstName
     *
     * @return  string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @param  string  $firstName
     *
     * @return  self
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of lastName
     *
     * @return  ?string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @param  ?string  $lastName
     *
     * @return  self
     */
    public function setLastName(?string $lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @return  string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string  $email
     *
     * @return  self
     */
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }



    /**
     * Get the value of posts
     *
     * @return  Collection
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    /**
     * Set the value of posts
     *
     * @API\Exclude
     * @param  Collection  $posts
     *
     * @return  self
     */
    public function setPosts(Collection $posts)
    {
        $this->posts = $posts;

        return $this;
    }
}
