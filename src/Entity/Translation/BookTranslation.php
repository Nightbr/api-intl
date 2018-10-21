<?php
namespace App\Entity\Translation;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractTranslation;
/**
 * @ORM\Table(name="book_translations", indexes={
 *      @ORM\Index(name="book_translation_idx", columns={"locale", "object_class", "field", "foreign_key"})
 * })
 * @ORM\Entity(repositoryClass="Gedmo\Translatable\Entity\Repository\TranslationRepository")
 */
class BookTranslation extends AbstractTranslation
{
    /**
     * All required columns are mapped through inherited superclass
     */
}