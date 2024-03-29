<?php


namespace HalloVerden\EntityUtilsBundle\Interfaces;


use Symfony\Component\Uid\Uuid;

/**
 * Interface NonPrimaryKeyUuidPropertyInterface
 *
 * @package HalloVerden\EntityUtilsBundle\Interfaces
 */
interface NonPrimaryKeyUuidPropertyInterface {

  /**
   * Generates Uuid
   */
  function generateUuid(): void;

  /**
   * @return Uuid|null
   */
  function getUuid(): ?Uuid;

}
