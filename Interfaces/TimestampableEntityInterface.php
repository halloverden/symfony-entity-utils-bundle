<?php


namespace HalloVerden\EntityUtilsBundle\Interfaces;


interface TimestampableEntityInterface {
  function setCreatedAt( \DateTime $createdAt );
  function getCreatedAt(): \DateTime;
  function setUpdatedAt( \DateTime $updatedAt );
  function getUpdatedAt(): ?\DateTime;
}
