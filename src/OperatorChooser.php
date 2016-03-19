<?php

class OperatorChooser {
  private $operators;

  public function __construct($operators) {
    $this->operators = $operators;
  }

  public function getCheapestOperator($number) {
    if (!isset($number)) {
      return array(
        'status' => 'fail',
        'message' => 'Variable not set',
      );
    }
    if (!is_numeric($number)) {
      return array(
        'status' => 'fail',
        'message' => 'Must supply a number',
      );
    }

    $match = array(
      'operator' => null,
      'rate'     => null,
    );
    foreach ($this->operators as $operator) {
      $result = $operator->getRateForNumber($number);

      if (!is_null($result['rate']) && is_null($match['rate']) ||
        $result['rate'] < $match['rate']) {
        $match['operator'] = $operator->getName();
        $match['rate'] = $result['rate'];
      }
    }

    $found = !is_null($match['operator']);

    return array(
      'status' => 'success',
      'found' => $found,
      'operator' => $match['operator'],
      'rate' => $match['rate'],
    );
  }
}

?>
