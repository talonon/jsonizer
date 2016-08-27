<?php namespace Talonon\Jsonizer\Deserializer;

class DeserializerOptions {
  public function __construct($allowMultiple = true) {
    $this->_allowMultiple = $allowMultiple;
  }

  const DESERIALIZE_ATTRIBUTE_TYPE_SET = 'set';
  const DESERIALIZE_ATTRIBUTE_TYPE_PATCH = 'patch';

  private $_decodeAttributeType = self::DESERIALIZE_ATTRIBUTE_TYPE_SET;

  private $_allowMultiple = true;
  private $_rootKey;

  /**
   * @return mixed
   */
  public function GetRootKey() {
    return $this->_rootKey;
  }

  /**
   * @param mixed $rootKey
   * @return DeserializerOptions
   */
  public function SetRootKey($rootKey) {
    $this->_rootKey = $rootKey;
    return $this;
  }

  /**
   * @return string
   */
  public function GetDecodeAttributeType() {
    return $this->_decodeAttributeType;
  }

  /**
   * @param string $decodeAttributeType
   * @return DeserializerOptions
   */
  public function SetDecodeAttributeType($decodeAttributeType) {
    $this->_decodeAttributeType = $decodeAttributeType;
    return $this;
  }

  /**
   * @return bool
   */
  public function GetAllowMultiple() {
    return $this->_allowMultiple;
  }

  /**
   * @param bool $allowMultiple
   * @return DeserializerOptions
   */
  public function SetAllowMultiple($allowMultiple) {
    $this->_allowMultiple = $allowMultiple;
    return $this;
  }
}

