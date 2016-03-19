<?php

require_once 'src/Operator.php';
require_once 'src/OperatorChooser.php';
require_once 'src/OperatorData.php';

$operatorChooser = new OperatorChooser($operatorList);

if (!isset($_GET['number'])) {
  $result = array(
    'status' => 'fail',
    'message' => 'Variable not set',
  );
} else {
  $result = $operatorChooser->getCheapestOperator($_GET['number']);
}

header('Content-Type: application/json');
print(json_encode($result));

?>
