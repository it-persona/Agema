<?php

namespace Panch\Agema\AgemaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Category
 *
 * @ORM\Table("agema_category")
 * @ORM\Entity
 */
class Category
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      min="5",
     *      max="25",
     *      minMessage="Category name must be at least {{ limit }} characters long",
     *      maxMessage="Category name cannot be longer than {{ limit }} characters long")
     * @Assert\NotBlank(message="Category name should not be blank")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Panch\Agema\AgemaBundle\Entity\Product", mappedBy="category", cascade={"persist"})
     */
    protected $product;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set product category name
     *
     * @param string $name
     * @return self
     */
    public function setCategoryName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get product category name
     *
     * @return string
     */
    public function getCategoryName()
    {
        return $this->name;
    }

    /**
     * Set product category name
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get product category name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set product
     *
     * @param \Panch\Agema\AgemaBundle\Entity\Product $product
     * @return Category
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Panch\Agema\AgemaBundle\Entity\Category
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Category
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getCategoryName();
    }
}
