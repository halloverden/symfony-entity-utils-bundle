<?php


namespace HalloVerden\EntityUtilsBundle\EventListener;

use Doctrine\Persistence\Event\LifecycleEventArgs;
use HalloVerden\EntityUtilsBundle\Interfaces\TimestampableEntityInterface;

class TimestampableEntityListener {

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
