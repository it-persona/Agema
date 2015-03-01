<?php

namespace Panch\Agema\AgemaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Iphp\FileStoreBundle\Mapping\Annotation as FileStore;

/**
 * Product
 *
 * @ORM\Table(name="agema_product")
 * @ORM\Entity
 * @FileStore\Uploadable
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Product
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
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      min="5",
     *      max="50",
     *      minMessage="Title must be at least {{ limit }} characters long",
     *      maxMessage="Title cannot be longer than {{ limit }} characters long")
     * @Assert\NotBlank(message="Title should not be blank")
     */
    private $title;

    /**
     * @var ORM\ManyToOne
     *
     * @ORM\ManyToOne(targetEntity="Panch\Agema\AgemaBundle\Entity\Category", inversedBy="product")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * @Assert\NotBlank(message="Category should not be blank")
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="short_description", type="string", length=255)
     * @Assert\Length(
     *      min="5",
     *      max="50",
     *      minMessage="Color correction must be at least {{ limit }} characters long",
     *      maxMessage="Color correction cannot be longer than {{ limit }} characters long")
     * @Assert\NotBlank(message="Description should not be blank")
     */
    private $shortDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="color_correction", type="string", length=255)
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      min="5",
     *      max="50",
     *      minMessage="Color correction must be at least {{ limit }} characters long",
     *      maxMessage="Color correction cannot be longer than {{ limit }} characters long")
     * @Assert\NotBlank(message="Color correction should not be blank")
     */
    private $colorCorrection;

    /**
     * @var string
     *
     * @ORM\Column(name="clear_aperture", type="string", length=255)
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      min="5",
     *      max="50",
     *      minMessage="Clear aperture must be at least {{ limit }} characters long",
     *      maxMessage="Clear aperture cannot be longer than {{ limit }} characters long")
     * @Assert\NotBlank(message="Clear aperture should not be blank")
     */
    private $clearAperture;

    /**
     * @var string
     *
     * @ORM\Column(name="focal_length", type="string", length=255)
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      min="5",
     *      max="50",
     *      minMessage="Focal length must be at least {{ limit }} characters long",
     *      maxMessage="Focal length cannot be longer than {{ limit }} characters long")
     * @Assert\NotBlank(message="Focal length should not be blank")
     */
    private $focalLength;

    /**
     * @var float
     *
     * @ORM\Column(name="resolution", type="float")
     * @Assert\Type(type="float", message="Resolution value {{ value }} is not a valid {{ type }}")
     * @Assert\NotBlank(message="Resolution should not be blank")
     */
    private $resolution;

    /**
     * @var string
     *
     * @ORM\Column(name="magnification_range", type="string", length=255)
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      min="5",
     *      max="50",
     *      minMessage="Magnification range must be at least {{ limit }} characters long",
     *      maxMessage="Magnification range cannot be longer than {{ limit }} characters long")
     * @Assert\NotBlank(message="Magnification range should not be blank")
     */
    private $magnificationRange;

    /**
     * @var float
     *
     * @ORM\Column(name="limit_visual_magnitude", type="float")
     * @Assert\Type(type="float", message="Visual magnitude limit {{ value }} is not a valid {{ type }}")
     * @Assert\NotBlank(message="Visual magnitude limit should not be blank")
     */
    private $limitVisualMagnitude;

    /**
     * @var string
     *
     * @ORM\Column(name="tube", type="text")
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      min="5",
     *      max="255",
     *      minMessage="Tube description must be at least {{ limit }} characters long",
     *      maxMessage="Tube description cannot be longer than {{ limit }} characters long")
     * @Assert\NotBlank(message="Tube description should not be blank")
     */
    private $tube;

    /**
     * @var string
     *
     * @ORM\Column(name="focuser", type="text")
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      min="5",
     *      max="255",
     *      minMessage="Focuser description must be at least {{ limit }} characters long",
     *      maxMessage="Focuser description cannot be longer than {{ limit }} characters long")
     * @Assert\NotBlank(message="Focuser description should not be blank")
     */
    private $focuser;

    /**
     * @var string
     *
     * @ORM\Column(name="field_corrector", type="text")
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      min="5",
     *      max="255",
     *      minMessage="Field corrector description must be at least {{ limit }} characters long",
     *      maxMessage="Field corrector description cannot be longer than {{ limit }} characters long")
     * @Assert\NotBlank(message="Field corrector description should not be blank")
     */
    private $fieldCorrector;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(name="thumbnail_image", type="array")
     * @Assert\File(
     *      maxSize="20M",
     *      maxSizeMessage="File size should not exceed {{ limit }} {{ suffix }}")
     * @FileStore\UploadableField(mapping="thumbnail")
     */
    private $thumbnail;

    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     * @return Product
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @param array $thumbnail
     * @return Product
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * @return array
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

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
     * Set title
     *
     * @param string $title
     * @return Product
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
     * Set category
     *
     * @param $category
     * @return Product
     */
    public function setCategory(Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set shortDescription
     *
     * @param string $shortDescription
     * @return Product
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set colorCorrection
     *
     * @param string $colorCorrection
     * @return Product
     */
    public function setColorCorrection($colorCorrection)
    {
        $this->colorCorrection = $colorCorrection;

        return $this;
    }

    /**
     * Get colorCorrection
     *
     * @return string 
     */
    public function getColorCorrection()
    {
        return $this->colorCorrection;
    }

    /**
     * Set clearAperture
     *
     * @param string $clearAperture
     * @return Product
     */
    public function setClearAperture($clearAperture)
    {
        $this->clearAperture = $clearAperture;

        return $this;
    }

    /**
     * Get clearAperture
     *
     * @return string 
     */
    public function getClearAperture()
    {
        return $this->clearAperture;
    }

    /**
     * Set focalLength
     *
     * @param string $focalLength
     * @return Product
     */
    public function setFocalLength($focalLength)
    {
        $this->focalLength = $focalLength;

        return $this;
    }

    /**
     * Get focalLength
     *
     * @return string 
     */
    public function getFocalLength()
    {
        return $this->focalLength;
    }

    /**
     * Set resolution
     *
     * @param float $resolution
     * @return Product
     */
    public function setResolution($resolution)
    {
        $this->resolution = $resolution;

        return $this;
    }

    /**
     * Get resolution
     *
     * @return float 
     */
    public function getResolution()
    {
        return $this->resolution;
    }

    /**
     * Set magnificationRange
     *
     * @param string $magnificationRange
     * @return Product
     */
    public function setMagnificationRange($magnificationRange)
    {
        $this->magnificationRange = $magnificationRange;

        return $this;
    }

    /**
     * Get magnificationRange
     *
     * @return string 
     */
    public function getMagnificationRange()
    {
        return $this->magnificationRange;
    }

    /**
     * Set limitVisualMagnitude
     *
     * @param float $limitVisualMagnitude
     * @return Product
     */
    public function setLimitVisualMagnitude($limitVisualMagnitude)
    {
        $this->limitVisualMagnitude = $limitVisualMagnitude;

        return $this;
    }

    /**
     * Get limitVisualMagnitude
     *
     * @return float 
     */
    public function getLimitVisualMagnitude()
    {
        return $this->limitVisualMagnitude;
    }

    /**
     * Set tube
     *
     * @param string $tube
     * @return Product
     */
    public function setTube($tube)
    {
        $this->tube = $tube;

        return $this;
    }

    /**
     * Get tube
     *
     * @return string 
     */
    public function getTube()
    {
        return $this->tube;
    }

    /**
     * Set focuser
     *
     * @param string $focuser
     * @return Product
     */
    public function setFocuser($focuser)
    {
        $this->focuser = $focuser;

        return $this;
    }

    /**
     * Get focuser
     *
     * @return string 
     */
    public function getFocuser()
    {
        return $this->focuser;
    }

    /**
     * Set fieldCorrector
     *
     * @param string $fieldCorrector
     * @return Product
     */
    public function setFieldCorrector($fieldCorrector)
    {
        $this->fieldCorrector = $fieldCorrector;

        return $this;
    }

    /**
     * Get fieldCorrector
     *
     * @return string 
     */
    public function getFieldCorrector()
    {
        return $this->fieldCorrector;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Product
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
}
