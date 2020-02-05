<?php


namespace HalloVerden\EntityUtilsBundle\Traits;

use Doctrine\ORM\Mapping as ORM;


/**
 * Trait TPrimaryAutoIncrement
 * @package App\Traits
 */
trait TPrimaryAutoIncrement {
  /**
   * @var integer
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @return int
   */
  public function getId(): int {
    return $this->id;
  }
}
