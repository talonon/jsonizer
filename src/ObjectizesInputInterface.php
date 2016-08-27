<?php namespace Talonon\Jsonizer;

interface ObjectizesInputInterface {

  public function GetResourceType();

  public function SetAttributes($model, array $attributes);

  public function SetID($model, $id);

  public function PatchAttributes($model, array $attributes);

  public function SetRelationships($model, $name, \Closure $itemHydrator);

}

