<?php


namespace HalloVerden\EntityUtilsBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use HalloVerden\EntityUtilsBundle\Interfaces\TimestampableEntityInterface;

class TimestampableEntityListener implements EventSubscriber {
  /**
   * Returns an array of events this subscriber wants to listen to.
   *
   * @return array
   */
  public function getSubscribedEvents() {
    return [
      Events::prePersist,
      Events::preUpdate
    ];
  }

  /**
   * @param LifecycleEventArgs $args
   * @throws \Exception
   */
  public function prePersist(LifecycleEventArgs $args ) {
    $object = $args->getObject();

    if (!($object instanceof TimestampableEntityInterface)) {
      return;
    }

    $object->setCreatedAt(new \DateTime());
    $object->setUpdatedAt(new \DateTime());
  }

  /**
   * @param LifecycleEventArgs $args
   * @throws \Exception
   */
  public function preUpdate(LifecycleEventArgs $args ) {
    $object = $args->getObject();

    if (!($object instanceof TimestampableEntityInterface)) {
      return;
    }

    $object->setUpdatedAt(new \DateTime());
  }
}
