<?php
namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * Locale
 *
 * @ApiResource(
 * itemOperations={
 *      "get"={"method"="GET"},
 *      "put"={"method"="PUT", "access_control"="is_granted('ROLE_ADMIN')"},
 *      "delete"={"method"="DELETE", "access_control"="is_granted('ROLE_ADMIN')"}
 * },
 * collectionOperations = {
 *  "get"={"method"="GET"},
 *  "post"={"method"="POST","access_control"="is_granted('ROLE_ADMIN')"},
 * },
 * )
 * @ORM\Table(name="locale")
 * @ORM\Entity()
 */
class Locale
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"out"})
     */
    private $id;
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 1,
     *      max = 7,
     *      minMessage = "Locale code must be at least {{ limit }} characters long",
     *      maxMessage = "Locale code cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(name="code", type="string", length=7)
     * @Groups({"out"})
     */
    private $code;
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 1,
     *      max = 45,
     *      minMessage = "Locale name must be at least {{ limit }} characters long",
     *      maxMessage = "Locale name cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(name="name", type="string", length=45)
     * @Groups({"out"})
     */
    private $name;
    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     * @Groups({"out"})
     */
    private $isDefault = false;
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set code
     *
     * @param string $code
     *
     * @return Locale
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }
    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
    /**
     * Set name
     *
     * @param string $name
     *
     * @return Locale
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @return int
     */
    public function getIsDefault()
    {
        return $this->isDefault;
    }
    /**
     * @param bool $default
     */
    public function setIsDefault($default = false)
    {
        $this->isDefault = $default;
    }
}