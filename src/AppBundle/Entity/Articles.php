<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Articles
 *
 * @ORM\Table(name="articles", indexes={@ORM\Index(name="articles_ibfk_1", columns={"categories_id"}), @ORM\Index(name="articles_users", columns={"users_id"})})
 * @ORM\Entity
 */
class Articles
{
    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", length=65535, nullable=false)
     */
    private $text;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Categories
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Categories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categories_id", referencedColumnName="id")
     * })
     */
    private $categories;

    /**
     * @var \AppBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="users_id", referencedColumnName="id")
     * })
     */
    private $users;


    /**
 * Set id
 *
 * @param string $id
 *
 * @return Articles
*/
public function setId($id)
{
  $this->id = $id;

  return $this;
}

/**
 * Get id
 *
 * @return string
*/
public function getId()
{
  return $this->id;
}


/**
 * Set categories_id
 *
 * @param string $categories_id
 *
 * @return Articles
*/
public function setCategories_id($categories_id)
{
  $this->categories = $categories_id;

  return $this;
}

/**
 * Get categories_id
 *
 * @return string
*/
public function getCategories_id()
{
  return $this->categories;
}



/**
 * Set text
 *
 * @param string $text
 *
 * @return Articles
*/
public function setText($text)
{
  $this->text = $text;

  return $this;
}

/**
 * Get text
 *
 * @return string
*/
public function getText()
{
  return $this->text;
}



/**
 * Set title
 *
 * @param string $title
 *
 * @return Articles
*/
public function setTitle($title)
{
  $this->title = $title;

  return $this;
}

/**
 * Get title
 *
 * @return string
*/
public function getTitle()
{
  return $this->title;
}



/**
 * Set users_id
 *
 * @param string $users_id
 *
 * @return Articles
*/
public function setUsers_id($users_id)
{
  $this->users = $users_id;

  return $this;
}

/**
 * Get users_id
 *
 * @return string
*/
public function getUsers_id()
{
  return $this->users;
}



}
