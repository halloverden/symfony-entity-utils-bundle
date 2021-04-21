<?php


namespace HalloVerden\EntityUtilsBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\UnitOfWork;
use HalloVerden\EntityUtilsBundle\Interfaces\ValidatableEntityInterface;
use HalloVerden\HttpExceptions\Utility\ValidationException;
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
        $this->validateEntity($entity, $uow);
      }
    }

    foreach ($uow->getScheduledEntityUpdates() as $entity) {
      if ($entity instanceof ValidatableEntityInterface) {
        $this->validateEntity($entity, $uow);
      }
    }
  }

  /**
   * @param ValidatableEntityInterface $entity
   * @param UnitOfWork                 $uow
   */
  private function validateEntity(ValidatableEntityInterface $entity, UnitOfWork $uow): void {
    $violations = $this->validator->validate($entity, null, $this->validationGroups);

    if (count($violations) > 0) {
      // Detach this entity to avoid multiple checks on this entity.
      $uow->clear($entity);

      throw new ValidationException($violations);
    }
  }

}
