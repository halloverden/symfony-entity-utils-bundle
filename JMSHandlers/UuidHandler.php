<?php


namespace HalloVerden\EntityUtilsBundle\JMSHandlers;


use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\Handler\SymfonyUidHandler;
use JMS\Serializer\JsonDeserializationVisitor;
use JMS\Serializer\JsonSerializationVisitor;
use Symfony\Component\Uid\Uuid;

/**
 * Class UuidHandler
 *
 * @package HalloVerden\EntityUtilsBundle\JMSHandlers
 */
class UuidHandler implements SubscribingHandlerInterface {

  /**
   * @inheritDoc
   */
  public static function getSubscribingMethods(): array {
    return [
      [
        'direction' => GraphNavigatorInterface::DIRECTION_SERIALIZATION,
        'format' => 'json',
        'type' => 'Uuid',
        'method' => 'serializeUuid'
      ],
      [
        'direction' => GraphNavigatorInterface::DIRECTION_DESERIALIZATION,
        'format' => 'json',
        'type' => 'Uuid',
        'method' => 'deserializeUuid'
      ]
    ];
  }

  /**
   * @param JsonSerializationVisitor $visitor
   * @param Uuid                     $uuid
   * @param array                    $type
   * @param Context                  $context
   *
   * @return string
   */
  public function serializeUuid(JsonSerializationVisitor $visitor, Uuid $uuid, array $type, Context $context): string {
    $this->triggerDeprecation();
    return $uuid->jsonSerialize();
  }

  /**
   * @param JsonDeserializationVisitor $visitor
   * @param string                     $uuidAsString
   * @param array                      $type
   * @param Context                    $context
   *
   * @return Uuid
   */
  public function deserializeUuid(JsonDeserializationVisitor $visitor, string $uuidAsString, array $type, Context $context): Uuid {
    $this->triggerDeprecation();
    return Uuid::fromString($uuidAsString);
  }

  /**
   * @return void
   */
  private function triggerDeprecation(): void {
    trigger_deprecation('halloverden/symfony-entity-utils-bundle', '4.0', '"%s" is deprecated, use "%s" instead', self::class, SymfonyUidHandler::class);
  }

}
