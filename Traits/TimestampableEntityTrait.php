<?php


namespace HalloVerden\EntityUtilsBundle\Traits;

use JMS\Serializer\Annotation as Serializer;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait TimestampableEntityTrait
 *
 * @package HalloVerden\EntityUtilsBundle\Traits
 */
trait TimestampableEntityTrait {

  /**
   * @var \DateTimeInterface
   *
   * @ORM\Column(name="created_at", type="datetime", nullable=false)
   *
   * @Assert\NotBlank()
   * @Assert\Type(type="DateTime")
   *
   * @Serializer\SerializedName("createdAt")
   * @Serializer\Type(name="UnixTime")
   * @Serializer\Expose()
   * @Serializer\Groups({"Detail", "List"})
   */
  protected \DateTimeInterface $createdAt;

  /**
   * @var \DateTimeInterface
   *
   * @ORM\Column(name="updated_at", type="datetime", nullable=false)
   *
   * @Assert\NotBlank()
   * @Assert\Type(type="DateTime")
   *
   * @Serializer\SerializedName("updatedAt")
   * @Serializer\Type("UnixTime")
   */
  protected \DateTimeInterface $updatedAt;

  /**
   * @return \DateTimeInterface
   */
  public function getCreatedAt(): \DateTimeInterface {
    return $this->createdAt;
  }

  /**
   * @param  \DateTimeInterface $createdAt
   * @return $this
   */
  public function setCreatedAt(\DateTimeInterface $createdAt): self {
    $this->createdAt = $createdAt;

    return $this;
  }

  /**
   * @return \DateTimeInterface
   */
  public function getUpdatedAt(): ?\DateTimeInterface {
    return $this->updatedAt;
  }

  /**
   * @param  \DateTimeInterface $updatedAt
   * @return $this
   */
  public function setUpdatedAt(\DateTimeInterface $updatedAt): self {
    $this->updatedAt = $updatedAt;

    return $this;
  }

}
