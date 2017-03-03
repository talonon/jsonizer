<?php namespace Talonon\Jsonizer\DefaultJsonizers;

use Carbon\Carbon;
use Talonon\Jsonizer\JsonizesOutputInterface;

class CarbonJsonizer implements JsonizesOutputInterface {

  private static $_timezone;

  private static function _getTimeZone() {
    return self::$_timezone ?: (new \DateTimeZone('UTC'));
  }

  public static function SetTimeZone(\DateTimeZone $timeZone) {
    self::$_timezone = $timeZone;
  }

  /**
   * @param Carbon $date
   * @return string
   */
  public function GetAttributes($date) {
    return $date->setTimezone(self::_getTimeZone())->toDateTimeString();
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
