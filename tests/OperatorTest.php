<?php

require_once __DIR__ . '/../src/Operator.php';

class OperatorTest extends PHPUnit_Framework_TestCase {
    public function testGetName() {
      $operator = new Operator('A', array());
      $this->assertEquals('A', $operator->getName());
    }
}
?>
