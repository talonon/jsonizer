<?php namespace Talonon\Jsonizer\DefaultJsonizers;

use Carbon\Carbon;
use Talonon\Jsonizer\JsonizesOutputInterface;

class CarbonJsonizer implements JsonizesOutputInterface {

  /**
   * @var \DateTimeZone
   */
  private static $_timezone;

  private static $_format = 'Y-m-d H:i:s';

  /**
   * @param \DateTimeZone $timeZone
   */
  public static function SetTimeZone(\DateTimeZone $timeZone) {
    self::$_timezone = $timeZone;
  }

  /**
   * @param \DateTimeZone $timeZone
   */
  public static function SetFormat(string $format) {
    self::$_format = $format;
  }

  /**
   * @return \DateTimeZone
   */
  private static function _getTimeZone() {
    return self::$_timezone ?: (new \DateTimeZone('UTC'));
  }

  /**
   * @param Carbon $date
   * @return string
   */
  public function GetAttributes($date) {
    return $date->setTimezone(self::_getTimeZone())->format(self::$_format);
  }

  public function GetRelationships($date) {
    return [];
  }

  public function GetRemovedIncludes() {
    return [];
  }

  public function GetResourceType() {
    return 'carbon';
  }
}
