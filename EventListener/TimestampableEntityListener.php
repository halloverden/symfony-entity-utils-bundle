<?php


namespace HalloVerden\EntityUtilsBundle\EventListener;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use HalloVerden\EntityUtilsBundle\Interfaces\TimestampableEntityInterface;

#[AsDoctrineListener(event: Events::prePersist)]
#[AsDoctrineListener(event: Events::preUpdate)]
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
