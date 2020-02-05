<?php


namespace HalloVerden\EntityUtilsBundle\Traits;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Trait TNonPrimaryKeyUuid
 * @package App\Traits
 */
trait TNonPrimaryKeyUuid {
  /**
   * @var UuidInterface
   *
   * @ORM\Column(name="uuid", type="uuid_binary", unique=true)
   *
   * @Assert\NotBlank()
   * @Assert\Type(type="Ramsey\Uuid\UuidInterface")
   *
   * @Serializer\SerializedName("uuid")
   * @Serializer\Type(name="string")
   * @Serializer\Expose
   * @Serializer\Groups({"Detail", "List"})
   */
  private $uuid;

  /**
   * @return null|UuidInterface
   */
  public function getUuid(): ?UuidInterface {
    return $this->uuid;
  }

  /**
   * Generates a new UUID v4
   *
   * @throws \Exception
   */
  public function generateUuid(): void {
    $this->uuid = Uuid::uuid4();
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
