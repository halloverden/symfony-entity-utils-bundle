<?php


namespace HalloVerden\EntityUtilsBundle\EventListener;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use HalloVerden\EntityUtilsBundle\Interfaces\NonPrimaryKeyUuidPropertyInterface;

#[AsDoctrineListener(event: Events::prePersist)]
class NonPrimaryKeyUuidPropertyListener {

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
