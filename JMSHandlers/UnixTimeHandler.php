<?php


namespace HalloVerden\EntityUtilsBundle\JMSHandlers;


use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\JsonDeserializationVisitor;
use JMS\Serializer\JsonSerializationVisitor;

/**
 * Class UnixTimeHandler
 *
 * @package HalloVerden\EntityUtilsBundle\JMSHandlers
 */
class UnixTimeHandler implements SubscribingHandlerInterface {
  public const TYPE = 'UnixTime';

  /**
   * @inheritDoc
   */
  public static function getSubscribingMethods(): array {
    return [
      [
        'direction' => GraphNavigatorInterface::DIRECTION_SERIALIZATION,
        'format' => 'json',
        'type' => self::TYPE,
        'method' => 'serializeDatetimeToJson'
      ],
      [
        'direction' => GraphNavigatorInterface::DIRECTION_DESERIALIZATION,
        'format' => 'json',
        'type' => self::TYPE,
        'method' => 'deserializeUnixTimeToDateTime'
      ]
    ];
  }

  /**
   * @param JsonSerializationVisitor $visitor
   * @param \DateTime                $date
   * @param array                    $type
   * @param Context                  $context
   *
   * @return int
   */
  public function serializeDatetimeToJson(JsonSerializationVisitor $visitor, \DateTime $date, array $type, Context $context): int {
    return $date->getTimestamp();
  }

  /**
   * @param JsonDeserializationVisitor $visitor
   * @param                            $dateAsInt
   * @param array                      $type
   * @param Context                    $context
   *
   * @return \DateTime
   * @throws \Exception
   */
  public function deserializeUnixTimeToDateTime(JsonDeserializationVisitor $visitor, $dateAsInt, array $type, Context $context): \DateTimeInterface {
    return new \DateTime('@' . $dateAsInt);
  }

}
