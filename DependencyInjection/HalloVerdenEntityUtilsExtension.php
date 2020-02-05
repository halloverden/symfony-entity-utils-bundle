<?php


namespace HalloVerden\EntityUtilsBundle\DependencyInjection;


use HalloVerden\EntityUtilsBundle\EventListener\EntityValidatorListener;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class HalloVerdenEntityUtilsExtension extends Extension {

  /**
   * @inheritDoc
   * @throws \Exception
   */
  public function load(array $configs, ContainerBuilder $container) {
    $configuration = new Configuration();
    $config = $this->processConfiguration($configuration, $configs);

    $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
    $loader->load('services.yaml');

    if (isset($config['entity_validator']['validation_groups'])) {
      $entityValidatorListener = $container->getDefinition(EntityValidatorListener::class);
      $entityValidatorListener->setArgument('$validationGroups', $config['entity_validator']['validation_groups']);
    }
  }

}
