<?php


namespace HalloVerden\EntityUtilsBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use HalloVerden\EntityUtilsBundle\Interfaces\NonPrimaryKeyUuidPropertyInterface;

class NonPrimaryKeyUuidPropertyListener implements EventSubscriber {
  /**
   * Returns an array of events this subscriber wants to listen to.
   *
   * @return array
   */
  public function getSubscribedEvents() {
    return [
      Events::prePersist
    ];
  }

  public function prePersist( LifecycleEventArgs $args ) {
    $object = $args->getObject();

    if (!($object instanceof NonPrimaryKeyUuidPropertyInterface)) {
      return;
    }

    if (!$object->getUuid()) {
      $object->generateUuid();
    }
  }
}
