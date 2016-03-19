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

  public static function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
  }

  public function getRateForNumber($number) {
    $found = false;
    $match = array(
      'prefix' => null,
      'rate' => null,
    );
    foreach ($this->price_list as $prefix => $rate) {
      $prefix_str = (string)$prefix;
      if ($this->startsWith($number, $prefix_str)) {
        if (strlen($prefix_str) > strlen($match['prefix'])) {
          $match['prefix'] = $prefix_str;
          $match['rate'] = $rate;
        }
      }
    }

    return $match;
  }

}

?>
