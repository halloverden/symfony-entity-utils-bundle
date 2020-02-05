<?php


namespace HalloVerden\EntityUtilsBundle\Interfaces;


use Ramsey\Uuid\UuidInterface;

interface NonPrimaryKeyUuidPropertyInterface {
  function generateUuid(): void;
  function getUuid(): ?UuidInterface;
}
