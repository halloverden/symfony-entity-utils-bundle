<?php


namespace HalloVerden\EntityUtilsBundle\DependencyInjection;


use HalloVerden\EntityUtilsBundle\EventListener\EntityValidatorListener;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

/**
 * Class HalloVerdenEntityUtilsExtension
 *
 * @package HalloVerden\EntityUtilsBundle\DependencyInjection
 */
class HalloVerdenEntityUtilsExtension extends ConfigurableExtension {

  /**
   * @inheritDoc
   */
  protected function loadInternal(array $mergedConfig, ContainerBuilder $container) {
    $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
    $loader->load('services.yaml');

    if (isset($mergedConfig['entity_validator']['validation_groups'])) {
      $entityValidatorListener = $container->getDefinition(EntityValidatorListener::class);
      $entityValidatorListener->setArgument('$validationGroups', $mergedConfig['entity_validator']['validation_groups']);
    }
  }

}
