<?php

require_once __DIR__ . '/../src/Operator.php';

/**
 * @group backend
 */
class OperatorTest extends PHPUnit_Framework_TestCase {
  protected $operator;

  protected function setUp() {
    $pricelist = array(
      1     => 0.9,
      268   => 5.1,
      46    => 0.17,
      4620  => 0.0,
      468   => 0.15,
      4631  => 0.15,
      4673  => 0.9,
      46732 => 1.1,
    );

    for ($i = 50000; $i < 59999; $i++) {
      $pricelist[$i] = 6.0;
    }

    $this->operator = new Operator('A', $pricelist);
  }

  public function testGetName() {
    $this->assertEquals('A', $this->operator->getName());
  }

  public function testGetRateForNumber() {
    $rateResult = $this->operator->getRateForNumber('123');
    $this->assertEquals(0.9, $rateResult['rate']);

    $rateResult = $this->operator->getRateForNumber('46');
    $this->assertEquals(0.17, $rateResult['rate']);

    $rateResult = $this->operator->getRateForNumber('468');
    $this->assertEquals(0.15, $rateResult['rate']);

    $rateResult = $this->operator->getRateForNumber('468123');
    $this->assertEquals(0.15, $rateResult['rate']);

    $rateResult = $this->operator->getRateForNumber('22222222');
    $this->assertEquals(null, $rateResult['rate']);

    $rateResult = $this->operator->getRateForNumber('333');
    $this->assertEquals(null, $rateResult['rate']);

    $rateResult = $this->operator->getRateForNumber('dsa');
    $this->assertEquals(null, $rateResult['rate']);

    $rateResult = $this->operator->getRateForNumber('-46');
    $this->assertEquals(null, $rateResult['rate']);
  }
}
?>
