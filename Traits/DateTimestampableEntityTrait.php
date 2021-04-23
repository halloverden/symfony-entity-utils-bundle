<?php


namespace HalloVerden\EntityUtilsBundle\Traits;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Trait TDateTimestampableEntity
 *
 * @package HalloVerden\EntityUtilsBundle\Traits
 */
trait DateTimestampableEntityTrait {

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="created_at", type="datetime", nullable=true)
   *
   * @Serializer\SerializedName("createdAt")
   * @Serializer\Type(name="DateTime")
   * @Serializer\Expose
   * @Serializer\Groups({"Detail", "List"})
   */
  protected \DateTimeInterface $createdAt;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="updated_at", type="datetime", nullable=true)
   *
   * @Serializer\SerializedName("updatedAt")
   * @Serializer\Type("DateTime")
   */
  protected \DateTimeInterface $updatedAt;

  /**
   * @param  \DateTimeInterface $createdAt
   * @return $this
   */
  public function setCreatedAt( \DateTimeInterface $createdAt ): self {
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
   * @param  \DateTimeInterface $updatedAt
   * @return $this
   */
  public function setUpdatedAt( \DateTimeInterface $updatedAt ): self {
    $this->updatedAt = $updatedAt;

    return $this;
  }

  /**
   * @return \DateTime
   */
  public function getUpdatedAt(): \DateTimeInterface {
    return $this->updatedAt;
  }

}
