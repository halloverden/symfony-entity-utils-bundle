<?php


namespace HalloVerden\EntityUtilsBundle\Traits;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class TDateTimestampableEntity
 * @package App\Traits
 */
trait TDateTimestampableEntity {
  /**
   * @var \DateTime
   * @ORM\Column(name="created_at", type="datetime", nullable=true)
   * @Serializer\SerializedName("createdAt")
   * @Serializer\Type(name="DateTime")
   * @Serializer\Expose
   * @Serializer\Groups({"Detail", "List"})
   */
  protected $createdAt;

  /**
   * @var \DateTime
   * @ORM\Column(name="updated_at", type="datetime", nullable=true)
   * @Serializer\SerializedName("updatedAt")
   * @Serializer\Type("DateTime")
   */
  protected $updatedAt;

  /**
   * @param  \DateTime $createdAt
   * @return $this
   */
  public function setCreatedAt( \DateTime $createdAt ): self {
    $this->createdAt = $createdAt;

    return $this;
  }

  /**
   * @return \DateTime
   */
  public function getCreatedAt(): \DateTime {
    return $this->createdAt;
  }

  /**
   * @param  \DateTime $updatedAt
   * @return $this
   */
  public function setUpdatedAt( \DateTime $updatedAt ): self {
    $this->updatedAt = $updatedAt;

    return $this;
  }

  /**
   * @return \DateTime
   */
  public function getUpdatedAt(): \DateTime {
    return $this->updatedAt;
  }
}
