<?php

require_once 'src/Operator.php';

$pricelistA = array(
  1     => 0.9,
  268   => 5.1,
  46    => 0.17,
  4620  => 0.0,
  468   => 0.15,
  4631  => 0.15,
  4673  => 0.9,
  46732 => 1.1,
);

$operatorA = new Operator('A', $pricelistA);

$pricelistB = array(
  1   =>  0.92,
  44  =>  0.5,
  46  =>  0.2,
  467 =>  1.0,
  48  =>  1.2,
);

$operatorB = new Operator('B', $pricelistB);

$operatorList = array($operatorA, $operatorB);
