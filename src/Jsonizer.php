<?php namespace Talonon\Jsonizer;
class Jsonizer {

  public function Map($className, $jsonizerClassName) {
    if (app()->resolved('jsonizer.' . $className)) {
      return;
    }
    app()->singleton(
      'jsonizer.' . $className, function () use ($jsonizerClassName) {
      return new $jsonizerClassName();
    });
  }

  public function Get($className) {
    return app('jsonizer.' . $className);
  }

}