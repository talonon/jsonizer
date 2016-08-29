<?php namespace Talonon\Jsonizer;
use Carbon\Carbon;
use Talonon\Jsonizer\DefaultJsonizers\CarbonJsonizer;

class Jsonizer {

  public function __construct() {
    $this->Map(Carbon::class, CarbonJsonizer::class);
  }

  /**
   * @var \Closure
   */
  private $_customLoaderWrapper;

  public function Map($class, $jsonizerClassName = null) {
    if (is_array($class)) {
      foreach ($class as $name => $jsonizer) {
        $this->Map($name, $jsonizer);
      }
      return;
    }

    if (app()->resolved('jsonizer.' . $class)) {
      return;
    }
    app()->singleton(
      'jsonizer.' . $class, function () use ($jsonizerClassName) {
      return new $jsonizerClassName();
    });
  }

  public function Get($className) {
    return app('jsonizer.' . $className);
  }

  public function Load(\Closure $loader) {
    if ($this->_customLoaderWrapper === null) {
      return $loader();
    } else {
      $customLoader = $this->_customLoaderWrapper;
      return $customLoader($loader);
    }
  }

  public function SetCustomLoader(\Closure $customLoader = null) {
    $this->_customLoaderWrapper = $customLoader;
  }

}