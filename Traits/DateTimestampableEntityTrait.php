<?php


namespace HalloVerden\EntityUtilsBundle\Traits;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

trait DateTimestampableEntityTrait {

  #[ORM\Column(name: 'created_at', type: 'datetime', nullable: false)]
  #[Serializer\SerializedName(name: 'createdAt')]
  #[Serializer\Type(name: \DateTimeInterface::class)]
  #[Serializer\Expose]
  #[Serializer\Groups(groups: ["Detail", "List"])]
  protected \DateTimeInterface $createdAt;

  #[ORM\Column(name: 'updated_at', type: 'datetime', nullable: false)]
  protected \DateTimeInterface $updatedAt;

  /**
   * @param \DateTimeInterface $createdAt
   *
   * @return $this
   */
  public function setCreatedAt(\DateTimeInterface $createdAt): self {
    $this->createdAt = $createdAt;

    return $this;
  }

  /**
   * @return \DateTimeInterface
   */
  public function getCreatedAt(): \DateTimeInterface {
    return $this->createdAt;
  }

  /**
   * @param \DateTimeInterface $updatedAt
   *
   * @return $this
   */
  public function setUpdatedAt(\DateTimeInterface $updatedAt): self {
    $this->updatedAt = $updatedAt;

    return $this;
  }

  /**
   * @return \DateTimeInterface
   */
  public function getUpdatedAt(): \DateTimeInterface {
    return $this->updatedAt;
  }

}
