<?php namespace Talonon\Jsonizer;
use Illuminate\Support\Facades\Facade;

class JsonizerFacade extends Facade  {

  protected static function getFacadeAccessor()
  {
    return 'jsonizer';
  }

}