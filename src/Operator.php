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

}

?>
