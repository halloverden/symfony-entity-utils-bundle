<?php


namespace HalloVerden\EntityUtilsBundle\EventListener;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;
use HalloVerden\EntityUtilsBundle\Interfaces\ValidatableEntityInterface;
use HalloVerden\HttpExceptions\Utility\EntityValidationException;
use Symfony\Component\Validator\Constraints\GroupSequence;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsDoctrineListener(event: Events::onFlush)]
class EntityValidatorListener {

  /**
   * @var ValidatorInterface
   */
  private ValidatorInterface $validator;

  /**
   * @var string[]
   */
  private array $validationGroups = ['EntityValidation'];

  /**
   * EntityValidatorSubscriber constructor.
   *
   * @param ValidatorInterface $validator
   * @param string[]           $validationGroups
   */
  public function __construct(ValidatorInterface $validator, ?array $validationGroups = null) {
    $this->validator = $validator;

    if ($validationGroups) {
      $this->validationGroups = $validationGroups;
    }
  }

  /**
   * @param OnFlushEventArgs $eventArgs
   */
  public function onFlush(OnFlushEventArgs $eventArgs): void {
    $uow = $eventArgs->getObjectManager()->getUnitOfWork();

    foreach ($uow->getScheduledEntityInsertions() as $entity) {
      if ($entity instanceof ValidatableEntityInterface) {
        $this->validateEntity($entity);
      }
    }

    foreach ($uow->getScheduledEntityUpdates() as $entity) {
      if ($entity instanceof ValidatableEntityInterface) {
        $this->validateEntity($entity, $uow->getEntityChangeSet($entity));
      }
    }
  }

  /**
   * @param ValidatableEntityInterface $entity
   * @param array|null                 $changeSet
   */
  private function validateEntity(ValidatableEntityInterface $entity, ?array $changeSet = null): void {
    $violations = $this->getViolations($entity, $changeSet);

    if (count($violations) > 0) {
      throw new EntityValidationException($violations);
    }
  }

  /**
   * @param ValidatableEntityInterface $entity
   * @param array|null                 $changeSet
   *
   * @return ConstraintViolationListInterface
   */
  private function getViolations(ValidatableEntityInterface $entity, ?array $changeSet = null): ConstraintViolationListInterface {
    $groups = $this->getValidationGroups($entity);

    if (null === $changeSet) {
      return $this->validator->validate($entity, null, $groups);
    }

    $violations = new ConstraintViolationList();
    foreach (array_keys($changeSet) as $property) {
      $violations->addAll($this->validator->validateProperty($entity, $property, $this->validationGroups));
    }

    return $violations;
  }

  /**
   * @param ValidatableEntityInterface $entity
   *
   * @return string|array|GroupSequence|null
   */
  private function getValidationGroups(ValidatableEntityInterface $entity): string|array|GroupSequence|null {
    if (\method_exists($entity, 'getValidationGroups')) {
      return $entity->getValidationGroups() ?? $this->validationGroups;
    }

    return $this->validationGroups;
  }

}
