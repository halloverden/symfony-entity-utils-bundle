<?php

namespace HalloVerden\EntityUtilsBundle\JMSHandlers;

use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\JsonDeserializationVisitor;
use JMS\Serializer\JsonSerializationVisitor;

enum EnumHandler implements SubscribingHandlerInterface {

  /**
   * @inheritDoc
   */
  public static function getSubscribingMethods(): array {
    return [
      [
        'direction' => GraphNavigatorInterface::DIRECTION_SERIALIZATION,
        'format' => 'json',
        'type' => 'Enum',
        'method' => 'serializeEnumToJson'
      ],
      [
        'direction' => GraphNavigatorInterface::DIRECTION_DESERIALIZATION,
        'format' => 'json',
        'type' => 'Enum',
        'method' => 'deserializeEnumFromJson'
      ]
    ];
  }

  public function serializeEnumToJson(JsonSerializationVisitor $visitor, \BackedEnum $data, array $type, Context $context): string|int {
    return $data->value;
  }

  /**
   * @template T
   *
   * @param array{params: array<array-key, array{name: class-string<T>}>} $type
   *
   * @return \BackedEnum|T
   */
  public function deserializeEnumFromJson(JsonDeserializationVisitor $visitor, mixed $data, array $type, Context $context) {
    /** @var ?class-string<T> $type */
    $type = $type['params'][0]['name'] ?? null;
    if (null === $type || !is_a($type, \BackedEnum::class, true)) {
      throw new \LogicException(\sprintf('"%s" is not a "%s"', \get_debug_type($type), \BackedEnum::class));
    }

    return $type::from($data);
  }

}
