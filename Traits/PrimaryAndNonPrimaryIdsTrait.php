<?php


namespace HalloVerden\EntityUtilsBundle\Traits;

/**
 * Trait TPrimaryAndNonPrimaryIds
 *
 * @package HalloVerden\EntityUtilsBundle\Traits
 */
trait PrimaryAndNonPrimaryIdsTrait {
  use PrimaryAutoIncrementTrait;
  use NonPrimaryKeyUuidTrait;
}
