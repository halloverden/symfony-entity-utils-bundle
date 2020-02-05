<?php


namespace HalloVerden\EntityUtilsBundle\Traits;


trait TPrimaryAndNonPrimaryIds {
  use TPrimaryAutoIncrement;
  use TNonPrimaryKeyUuid;
}
