<?php


namespace HalloVerden\EntityUtilsBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use HalloVerden\EntityUtilsBundle\Interfaces\NonPrimaryKeyUuidPropertyInterface;

/**
 * Class NonPrimaryKeyUuidPropertyListener
 *
 * @package HalloVerden\EntityUtilsBundle\EventListener
 */
class NonPrimaryKeyUuidPropertyListener implements EventSubscriber {

  /**
   * @inheritDoc
   */
  public function getSubscribedEvents(): array {
    return [
      Events::prePersist
    ];
  }

  /**
   * @param LifecycleEventArgs $args
   */
  public function prePersist( LifecycleEventArgs $args ): void {
    $object = $args->getObject();

    if (!($object instanceof NonPrimaryKeyUuidPropertyInterface)) {
      return;
    }

    if (!$object->getUuid()) {
      $object->generateUuid();
    }
  }

}
