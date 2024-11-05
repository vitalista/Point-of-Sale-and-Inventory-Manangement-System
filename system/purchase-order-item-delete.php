<?php
require 'config/function.php';
$paramResult = checkParamId('index');
if(is_numeric($paramResult)){

$indexValue = validate($paramResult);
if(isset($_SESSION['Items']) && isset($_SESSION['ItemIds'])){

unset ($_SESSION[ 'Items'][$indexValue]);
unset ($_SESSION['ItemIds'][$indexValue]);
redirect('purchase-order-create.php', 'Item Removed');

}else{

redirect('purchase-order-create.php', 'There is no item');

}

}else{
redirect( 'purchase-order-create.php', 'param not numeric');
}
?>