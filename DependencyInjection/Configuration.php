<?php


namespace HalloVerden\EntityUtilsBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @package HalloVerden\EntityUtilsBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface {

  /**
   * @inheritDoc
   */
  public function getConfigTreeBuilder() {
    $treeBuilder = new TreeBuilder('hallo_verden_entity_utils');

    $treeBuilder->getRootNode()
      ->children()
        ->arrayNode('entity_validator')
          ->children()
            ->arrayNode('validation_groups')
              ->scalarPrototype()->end()
            ->end()
          ->end()
        ->end()
      ->end()
    ;

    return $treeBuilder;
  }

}
