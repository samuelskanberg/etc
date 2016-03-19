<?php

require_once __DIR__ . '/../src/OperatorChooser.php';

class OperatorChooserTest extends PHPUnit_Framework_TestCase {
  protected $operatorChooser;

  protected function setUp() {
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

    $this->operatorChooser = new OperatorChooser(array($operatorA, $operatorB));
  }


  public function testBadNumber() {
    $result = $this->operatorChooser->getCheapestOperator('foo');
    $this->assertEquals('fail', $result['status']);

    $result = $this->operatorChooser->getCheapestOperator('1');
    $this->assertEquals('success', $result['status']);
  }

  public function testGetCheapestOperator() {
    $res = $this->operatorChooser->getCheapestOperator('11111111');
    $this->assertEquals(0.9, $res['rate']);
    $this->assertEquals('A', $res['operator']);
    $this->assertTrue($res['found']);

    $res = $this->operatorChooser->getCheapestOperator('11111111');
    $this->assertEquals(0.9, $res['rate']);
    $this->assertEquals('A', $res['operator']);
    $this->assertTrue($res['found']);

    $res = $this->operatorChooser->getCheapestOperator('48111111111');
    $this->assertEquals(1.2, $res['rate']);
    $this->assertEquals('B', $res['operator']);
    $this->assertTrue($res['found']);

    $res = $this->operatorChooser->getCheapestOperator('4673111');
    $this->assertEquals(0.9, $res['rate']);
    $this->assertEquals('A', $res['operator']);
    $this->assertTrue($res['found']);

    $res = $this->operatorChooser->getCheapestOperator('33333333');
    $this->assertEquals(null, $res['rate']);
    $this->assertEquals(null, $res['operator']);
    $this->assertFalse($res['found']);
  }
}
?>
