<?php


namespace HalloVerden\EntityUtilsBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;
use HalloVerden\EntityUtilsBundle\Interfaces\ValidatableEntityInterface;
use HalloVerden\HttpExceptions\Utility\ValidationException;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class EntityValidatorListener
 *
 * @package HalloVerden\EntityUtilsBundle\EventListener
 */
class EntityValidatorListener implements EventSubscriber {

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
   * @inheritDoc
   */
  public function getSubscribedEvents(): array {
    return [
      Events::onFlush
    ];
  }

  /**
   * @param OnFlushEventArgs $eventArgs
   */
  public function onFlush(OnFlushEventArgs $eventArgs): void {
    $uow = $eventArgs->getEntityManager()->getUnitOfWork();

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
    if ($changeSet === null) {
      $violations = $this->validator->validate($entity, null, $this->validationGroups);
    } else {
      $violations = new ConstraintViolationList();

      foreach (array_keys($changeSet) as $property) {
        $violations->addAll($this->validator->validateProperty($entity, $property, $this->validationGroups));
      }
    }

    if (count($violations) > 0) {
      throw new ValidationException($violations);
    }
  }

}
