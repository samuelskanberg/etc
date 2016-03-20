<?php

class Operator {
  private $name;
  private $price_list;

  public function __construct($name, $price_list) {
    $this->name = $name;
    $this->price_list = $price_list;
  }

  public function getName() {
    return $this->name;
  }

  public function getRateForNumber($number) {
    $no_match = array(
      'prefix' => null,
      'rate' => null,
    );

    if (is_null($number) || !is_numeric($number) || $number <= 0) {
      return $no_match;
    }
    $prefix = intval($number);

    while ($prefix > 0) {
      if (isset($this->price_list[$prefix])) {
        return array(
          'prefix' => $prefix,
          'rate' => $this->price_list[$prefix],
        );
      }
      $prefix = $prefix / 10;
    }

    return $no_match;
  }
}

?>
