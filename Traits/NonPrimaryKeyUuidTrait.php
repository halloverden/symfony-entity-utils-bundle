<?php


namespace HalloVerden\EntityUtilsBundle\Traits;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV4;
use Symfony\Component\Validator\Constraints as Assert;


trait NonPrimaryKeyUuidTrait {

  #[ORM\Column(name: 'uuid', type: 'uuid', unique: true)]
  #[Assert\NotBlank]
  #[Serializer\SerializedName(name: 'uuid')]
  #[Serializer\Type(name: UuidV4::class)]
  #[Serializer\Expose]
  #[Serializer\Groups(groups: ['Detail', 'List'])]
  private ?Uuid $uuid = null;

  /**
   * @return Uuid|null
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
