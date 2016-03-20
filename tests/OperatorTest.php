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

    $this->operator = new Operator('A', $pricelist);
  }

  public function testGetName() {
    $this->assertEquals('A', $this->operator->getName());
  }

  public function testStartsWith() {
    $this->assertTrue(Operator::startsWith('a', 'a'));
    $this->assertTrue(Operator::startsWith('abc', 'a'));
    $this->assertTrue(Operator::startsWith('abc', ''));
    $this->assertFalse(Operator::startsWith('abc', 'b'));
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
  }
}
?>
