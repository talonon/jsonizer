<?php namespace Talonon\Jsonizer;

use Illuminate\Support\ServiceProvider;

class JsonizerProvider extends ServiceProvider {

  public function Register() {
    $this->app->singleton(
      'jsonizer', function () {
      return new Jsonizer();
    });
  }

}