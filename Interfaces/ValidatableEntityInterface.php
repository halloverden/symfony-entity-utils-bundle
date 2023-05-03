<?php


namespace HalloVerden\EntityUtilsBundle\Interfaces;

use Symfony\Component\Validator\Constraints\GroupSequence;

/**
 * Use on entities that should be validated onFlush
 *
 * @method string|array|GroupSequence|null getValidationGroups()
 */
interface ValidatableEntityInterface {
}
