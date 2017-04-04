<?php namespace Talonon\Jsonizer;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Talonon\Jsonizer\Deserializer\Deserializer;
use Talonon\Jsonizer\Deserializer\DeserializerOptions;

trait JsonizerInput {

  /**
   * @param $into
   * @param DeserializerOptions|null $options
   * @param array $input
   * @return mixed
   */
  protected function jsonizerInput($into, DeserializerOptions $options = null, array $input = null) {
    $options = $options ?: (new DeserializerOptions())->SetDecodeAttributeType(DeserializerOptions::DESERIALIZE_ATTRIBUTE_TYPE_SET);
    $options->SetDecodeAttributeType(request()->isMethod('PATCH') ? DeserializerOptions::DESERIALIZE_ATTRIBUTE_TYPE_PATCH : DeserializerOptions::DESERIALIZE_ATTRIBUTE_TYPE_SET);
    $decoder = new Deserializer($options);
    $input = $input ?: request()->all();
    $result = $decoder->Deserialize($input, $into);
    if ($result === null) {
      throw new BadRequestHttpException("Invalid JSON");
    }
    return $result;
  }

}

