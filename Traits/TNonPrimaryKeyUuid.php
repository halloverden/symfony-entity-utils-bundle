<?php


namespace HalloVerden\EntityUtilsBundle\Traits;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Trait TNonPrimaryKeyUuid
 * @package App\Traits
 */
trait TNonPrimaryKeyUuid {
  /**
   * @var Uuid
   *
   * @ORM\Column(name="uuid", type="uuid", unique=true)
   *
   * @Assert\NotBlank()
   * @Assert\Type(type="Symfony\Component\Uid\Uuid")
   *
   * @Serializer\SerializedName("uuid")
   * @Serializer\Type(name="string")
   * @Serializer\Expose
   * @Serializer\Groups({"Detail", "List"})
   */
  private $uuid;

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

  /**
   * @Serializer\PostDeserialize()
   */
  public function ensureUuidIsAnObject() {
    if (is_string($this->uuid)) {
      $this->uuid = Uuid::fromString($this->uuid);
    }
  }
}
