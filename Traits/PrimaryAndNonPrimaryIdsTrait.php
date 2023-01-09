<?php


namespace HalloVerden\EntityUtilsBundle\Traits;

trait PrimaryAndNonPrimaryIdsTrait {
  use PrimaryAutoIncrementTrait;
  use NonPrimaryKeyUuidTrait;
}
