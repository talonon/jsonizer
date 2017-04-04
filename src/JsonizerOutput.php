<?php namespace Talonon\Jsonizer;

use Symfony\Component\HttpFoundation\Response;
use Talonon\Jsonizer\Serializer\Serializer;

trait JsonizerOutput {

  /**
   * @param $data
   * @param array $includes
   * @return mixed
   */
  protected function jsonizerOutput($data, array $includes = []) {
    $include = request()->get('include', []);
    $include = is_array($include) ? $include : explode(',', $include);
    $serializer = new Serializer(array_merge($include, $includes));
    $data = $serializer->Serialize($data, request()->get('meta', false));

    return response($data)
      ->header('content-type', 'application/json')
      ->setStatusCode(Response::HTTP_OK);
  }

}

