<?php namespace Talonon\Jsonizer\Deserializer;

use Illuminate\Support\Collection;
use Talonon\Jsonizer\BaseCoder;
use Talonon\Jsonizer\Jsonizer;
use Talonon\Jsonizer\ObjectizesInputInterface;

class Deserializer {

  public function __construct(DeserializerOptions $options = null) {
    $this->_options = $options ?: new DeserializerOptions();
  }

  /**
   * @var DeserializerOptions|null
   */
  private $_options;

  public function Deserialize(&$data, $into) {
    if ($this->_options->GetRootKey()) {
      $data = array_get($data, $this->_options->GetRootKey(), null);
      if ($data === null) {
        return null;
      }
    }
    return $this->_deserializeData($data, $into, true);
  }

  private function _deserializeData(&$data, $into = false, $isRoot = false) {
    if (is_array($data) && count($data) == 0) {
      return null;
    }
    if ($isRoot && isset($data[0]) && !$this->_options->GetAllowMultiple()) {
      throw new \Exception('Multiple elements are not allowed here.');
    }
    if (isset($data[0])) {
      $results = new Collection();
      for ($x = 0, $c = count($data); $x < $c; $x++) {
        $class = get_class($into);
        $new = new $class;
        $results->push($this->_deserializeItem($data[$x], $new));
      }
      return $results;
    } else {
      return $this->_deserializeItem($data, $into);
    }
  }

  /**
   * @param array $item
   * @param mixed $into
   * @returns mixed
   */
  private function _deserializeItem(array &$item, $into) {
    /** @var Jsonizer $jsonizer */
    $jsonizer = app('jsonizer');
    $mapper = $jsonizer->Get(get_class($into));
    if (!$mapper) {
      return null;
    }

    isset($item['id']) && $mapper->SetID($into, $item['id']);
    if ($this->_options->GetDecodeAttributeType() !== DeserializerOptions::DESERIALIZE_ATTRIBUTE_TYPE_PATCH) {
      $mapper->SetAttributes($into, $item);
    } else {
      $mapper->PatchAttributes($into, $item);
    }
    $this->_Deserializerelationships($mapper, $into, $item);
    return $into;
  }

  private function _Deserializerelationships(ObjectizesInputInterface $mapper, $model, &$item) {
    foreach ($item as $name => $related) {
      if (is_scalar($related)) {
        continue;
      }
      $data = &$item[$name];
      $mapper->SetRelationships(
        $model, $name, function ($class) use ($data) {
        return $data ? $this->_deserializeData($data, new $class) : null;
      });
    }
  }
}

