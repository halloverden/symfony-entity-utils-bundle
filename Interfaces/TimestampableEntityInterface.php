<?php


namespace HalloVerden\EntityUtilsBundle\Interfaces;

/**
 * Interface TimestampableEntityInterface
 *
 * @package HalloVerden\EntityUtilsBundle\Interfaces
 */
interface TimestampableEntityInterface {

  /**
   * @param \DateTimeInterface $createdAt
   *
   * @return static
   */
  function setCreatedAt(\DateTimeInterface $createdAt): self;

  /**
   * @return \DateTimeInterface|null
   */
  function getCreatedAt(): ?\DateTimeInterface;

  /**
   * @param \DateTimeInterface $updatedAt
   *
   * @return static
   */
  function setUpdatedAt(\DateTimeInterface $updatedAt): self;

  /**
   * @return \DateTimeInterface|null
   */
  function getUpdatedAt(): ?\DateTimeInterface;

}
