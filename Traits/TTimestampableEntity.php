<?php


namespace HalloVerden\EntityUtilsBundle\Traits;

use JMS\Serializer\Annotation as Serializer;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait TTimestampableEntity {
  /**
   * @var \DateTime
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
  protected $createdAt;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="updated_at", type="datetime", nullable=false)
   *
   * @Assert\NotBlank()
   * @Assert\Type(type="DateTime")
   *
   * @Serializer\SerializedName("updatedAt")
   * @Serializer\Type("UnixTime")
   */
  protected $updatedAt;

  /**
   * @return \DateTime
   */
  public function getCreatedAt(): \DateTime {
    return $this->createdAt;
  }

  /**
   * @param  \DateTime $createdAt
   * @return $this
   */
  public function setCreatedAt(\DateTime $createdAt) {
    $this->createdAt = $createdAt;

    return $this;
  }

  /**
   * @return \DateTime
   */
  public function getUpdatedAt(): ?\DateTime {
    return $this->updatedAt;
  }

  /**
   * @param  \DateTime $updatedAt
   * @return $this
   */
  public function setUpdatedAt(\DateTime $updatedAt) {
    $this->updatedAt = $updatedAt;

    return $this;
  }
}
