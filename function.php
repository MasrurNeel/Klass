<?php

/*function multiply($variable){//void
    for($start = 1; $start < 10; $start++){
        echo $variable . 'x' . $start . '=' .$variable * $start . '<br/>';
}

}
function sum($num1, $num2 = 5){//void
    echo $num1 * $num2;
}
$user_input = 'multiply';
$user_input(10);

$sum = $function = function($num1, $num2){
    echo $num1 * $num2;
};
$multiply = function($variable)
{
    for ($start = 1; $start < 10; $start++) {
        echo $variable . 'x' . $start . '=' . $variable * $start . '<br/>';
    }
};*/
$compare = function($value1, $value2){
    return ($value1 > $value2)? 1 : -1;
};
$array = [20,50,40];
usort($array, $compare);

route('/sum', $sum);
route('/multiply', $multiply);
var_dump($array);
//$function(20, 20);
/*$variable=5;
multiply($variable);
multiply(1);
multiply(2);
multiply(3);*/
?>
