<?php


namespace HalloVerden\EntityUtilsBundle\Interfaces;


use Symfony\Component\Uid\Uuid;

interface NonPrimaryKeyUuidPropertyInterface {
  function generateUuid(): void;
  function getUuid(): ?Uuid;
}
