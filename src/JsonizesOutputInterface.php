<?php namespace Talonon\Jsonizer;

interface JsonizesOutputInterface {

  public function GetResourceType();

  /**
   * @param $entity
   * @return array
   */
  public function GetAttributes($entity) ;

  /**
   * @param $entity
   * @return array
   */
  public function GetRelationships($entity) ;

  /**
   * @return array
   */
  public function GetRemovedIncludes();
}

