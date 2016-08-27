<?php namespace Talonon\Jsonizer;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class JsonizedResponse implements Arrayable, Jsonable, \JsonSerializable {

  public function __construct($data = null, array $meta = null, array $pagination = null) {
    $data && $this->SetData($data);
    $meta && $this->SetMeta($meta);
    $pagination && $this->SetPagination($pagination);
  }

  private $_data;
  private $_pagination;
  private $_meta;
  private $_includeMeta = false;
  private $_includeDefaultMeta = false;
  private $_includes = [];

  /**
   * @return boolean
   */
  public function GetIncludeDefaultMeta() {
    return $this->_includeDefaultMeta;
  }

  /**
   * @param boolean $includeDefaultMeta
   * @return JsonizedResponse
   */
  public function SetIncludeDefaultMeta($includeDefaultMeta) {
    $this->_includeDefaultMeta = $includeDefaultMeta;
    return $this;
  }

  /**
   * @return array
   */
  public function GetIncludes() {
    return $this->_includes;
  }

  /**
   * @param array $includes
   * @return JsonizedResponse
   */
  public function SetIncludes(array $includes = null) {
    $this->_includes = $includes;
    return $this;
  }

  /**
   * @return boolean
   */
  public function GetIncludeMeta() {
    return $this->_includeMeta;
  }

  /**
   * @param boolean $includeMeta
   * @return JsonizedResponse
   */
  public function SetIncludeMeta($includeMeta) {
    $this->_includeMeta = $includeMeta;
    return $this;
  }

  /**
   * @return mixed
   */
  public function GetData() {
    return $this->_data;
  }

  /**
   * @param mixed $data
   * @return JsonizedResponse
   */
  public function SetData($data = null) {
    $this->_data = $data;
    return $this;
  }

  /**
   * @return mixed
   */
  public function GetPagination() {
    return $this->_pagination;
  }

  /**
   * @param mixed $pagination
   * @return JsonizedResponse
   */
  public function SetPagination(array $pagination = null) {
    $this->_pagination = $pagination;
    return $this;
  }

  /**
   * @return mixed
   */
  public function GetMeta() {
    return $this->_meta;
  }

  /**
   * @param mixed $meta
   * @return JsonizedResponse
   */
  public function SetMeta(array $meta = null) {
    $this->_meta = $meta;
    return $this;
  }

  public function toArray() {
    return array_filter(
      [
        'result' => $this->GetData(),
        'meta'   => $this->_includeMeta ? array_filter($this->GetMeta()) : null,
        'page'   => $this->GetPagination()
      ], function ($value) {
      return $value !== null;
    });
  }

  public function toJson($options = 0) {
    return json_encode($this->toArray(), $options);
  }

  public function jsonSerialize() {
    return $this->toArray();
  }
}

