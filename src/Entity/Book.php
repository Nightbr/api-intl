<?php
namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * A book.
 *
 * @see http://schema.org/Book Documentation on Schema.org
 *
 * @ApiResource(
 *     iri="http://schema.org/Book",
 *     normalizationContext={"groups": {"book:read"}}
 * )
 * @ApiFilter(PropertyFilter::class)
 * 
 * @ORM\Entity
 * @Gedmo\TranslationEntity(class="App\Entity\Translation\BookTranslation")
 */
class Book
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string The title of the book
     *
     * @Assert\NotBlank
     * @ORM\Column
     * @Groups({"book:read", "review:read"})
     * @ApiProperty(iri="http://schema.org/name")
     * @Gedmo\Translatable
     */
    public $title;
    /**
     * @var string A description of the item
     *
     * @Assert\NotBlank
     * @ORM\Column(type="text")
     * @Groups("book:read")
     * @ApiProperty(iri="http://schema.org/description")
     * @Gedmo\Translatable
     */
    public $description;

    /**
     * @var Locale
     *
     * @Gedmo\Locale
     */
    private $locale;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }

}