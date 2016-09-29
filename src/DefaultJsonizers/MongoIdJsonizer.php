<?php namespace Talonon\Jsonizer\DefaultJsonizers;

use Talonon\Jsonizer\BaseIoMapper;
use Talonon\Jsonizer\JsonizesOutputInterface;
use Talonon\Jsonizer\MapsOutput;

class MongoIdJsonizer implements JsonizesOutputInterface  {
  /**
   * @param \MongoId $mongoID
   * @return array
   */
  public function GetAttributes($mongoID) {
    return $mongoID->{'$id'};
  }

  public function GetRelationships($mongoID) {
    return [];
  }

  public function GetResourceType() {
    return 'mongoid';
  }

  public function GetRemovedIncludes() {
    return [];
  }
}
