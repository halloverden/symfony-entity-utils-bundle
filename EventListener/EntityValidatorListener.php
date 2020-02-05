<?php


namespace HalloVerden\EntityUtilsBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\UnitOfWork;
use HalloVerden\EntityUtilsBundle\Interfaces\ValidatableEntityInterface;
use HalloVerden\HttpExceptions\Utility\ValidationException;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class EntityValidatorListener implements EventSubscriber {

  /**
   * @var ValidatorInterface
   */
  private $validator;

  /**
   * @var SerializerInterface
   */
  private $serializer;

  /**
   * @var string
   */
  private $validationGroups = ['EntityValidation'];

  /**
   * EntityValidatorSubscriber constructor.
   *
   * @param ValidatorInterface $validator
   * @param SerializerInterface $serializer
   * @param string[] $validationGroups
   */
  public function __construct(ValidatorInterface $validator, SerializerInterface $serializer, array $validationGroups = null) {
    $this->validator = $validator;
    $this->serializer = $serializer;

    if ($validationGroups) {
      $this->validationGroups = $validationGroups;
    }
  }


  /**
   * Returns an array of events this subscriber wants to listen to.
   *
   * @return string[]
   */
  public function getSubscribedEvents() {
    return [
      Events::onFlush
    ];
  }

  /**
   * @param OnFlushEventArgs $eventArgs
   */
  public function onFlush(OnFlushEventArgs $eventArgs) {
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
   * @param UnitOfWork         $uow
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
