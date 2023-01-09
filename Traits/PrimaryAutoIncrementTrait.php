<?php


namespace HalloVerden\EntityUtilsBundle\Traits;

use Doctrine\ORM\Mapping as ORM;


trait PrimaryAutoIncrementTrait {

  #[ORM\Column(name: 'id', type: 'integer')]
  #[ORM\Id]
  #[ORM\GeneratedValue(strategy: 'AUTO')]
  protected int $id;

  /**
   * @return int
   */
  public function getId(): int {
    return $this->id;
  }

}
