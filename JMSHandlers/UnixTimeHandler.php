<?php


namespace HalloVerden\EntityUtilsBundle\JMSHandlers;


use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\JsonDeserializationVisitor;
use JMS\Serializer\JsonSerializationVisitor;

class UnixTimeHandler implements SubscribingHandlerInterface {

  /**
   * Return format:
   *
   *      array(
   *          array(
   *              'direction' => GraphNavigatorInterface::DIRECTION_SERIALIZATION,
   *              'format' => 'json',
   *              'type' => 'DateTime',
   *              'method' => 'serializeDateTimeToJson',
   *          ),
   *      )
   *
   * The direction and method keys can be omitted.
   *
   * @return array
   *
   * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingReturnTypeHint
   */
  public static function getSubscribingMethods() {
    return [
      [
        'direction' => GraphNavigatorInterface::DIRECTION_SERIALIZATION,
        'format' => 'json',
        'type' => 'UnixTime',
        'method' => 'serializeDatetimeToJson'
      ],
      [
        'direction' => GraphNavigatorInterface::DIRECTION_DESERIALIZATION,
        'format' => 'json',
        'type' => 'UnixTime',
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
  public function serializeDatetimeToJson(JsonSerializationVisitor $visitor, \DateTime $date, array $type, Context $context) {
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
  public function deserializeUnixTimeToDateTime(JsonDeserializationVisitor $visitor, $dateAsInt, array $type, Context $context) {
    return new \DateTime('@' . $dateAsInt);
  }
}
