<?php namespace Talonon\Jsonizer\DefaultJsonizers;

use Carbon\Carbon;
use Talonon\Jsonizer\JsonizesOutputInterface;

class CarbonJsonizer implements JsonizesOutputInterface  {
  /**
   * @param Carbon $date
   * @return string
   */
  public function GetAttributes($date) {
    return $date->toDateTimeString();
  }

  public function GetRelationships($date) {
    return [];
  }

  public function GetResourceType() {
    return 'carbon';
  }

  public function GetRemovedIncludes() {
    return [];
  }
}
