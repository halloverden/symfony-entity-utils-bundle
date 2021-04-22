<?php


namespace HalloVerden\EntityUtilsBundle\Traits;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Trait NonPrimaryKeyUuidTrait
 *
 * @package HalloVerden\EntityUtilsBundle\Traits
 */
trait NonPrimaryKeyUuidTrait {

  /**
   * @var Uuid
   *
   * @ORM\Column(name="uuid", type="uuid", unique=true)
   *
   * @Assert\NotBlank()
   * @Assert\Type(type="Symfony\Component\Uid\Uuid")
   *
   * @Serializer\SerializedName("uuid")
   * @Serializer\Type(name="Uuid")
   * @Serializer\Expose()
   * @Serializer\Groups({"Detail", "List"})
   */
  private ?Uuid $uuid = null;

  /**
   * @return Uuid
   */
  public function getUuid(): ?Uuid {
    return $this->uuid;
  }

  /**
   * Generates a new UUID v4
   *
   * @throws \Exception
   */
  public function generateUuid(): void {
    $this->uuid = Uuid::v4();
  }

}
