<?php
//built in function
$array =[100, 30, 40, 60, 50, 100, 50];
$new_array = array_unique($array);
print_r($new_array);
//$temp = [];
//echo array_sum($array);
//$sum = 0;
//foreach($array as $value)
//{
//$sum += $value;//}
//echo $sum;

//stack
//array_pop();
//array_push();

//queue
//array_shift();
//array_unshift();

echo "<br/>";
$array =['A','B'];
$array[0] = $array[1];
$array[1]= null;
$array[count($array)]= 'C';
$array[count($array)]= 'D';
var_dump($array);

//debug functions
/*var_dump();
print_r();
die();
exit();*/

//date function
//profile_photo function
//mysql function
?>