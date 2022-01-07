<?php
//while
/*$start = 11;
while($start <= 10){
   echo '2x' . $start. ' = '. 2 * $start.'<br/>';
   $start++;
}

//do while
do{
    echo '2x' . $start. ' = '. 2 * $start.'<br/>';
    $start++;
}while($start <= 10);*/

//for loop
/*for($start=1; $start <= 10;$start+=2){
    echo '2x' . $start. ' = '. 2 * $start.'<br/>';
}*/
//$array=['mas',20,30,'gas',50];
$array=['first_name' => 'sumon',
    'last_name' => 'Selin',
    'age'=>25,
    'location' => [
        'city' =>'dhaka',
        'country'=>'bangladesh',
    ]];
/*$start = 0;
while($start <= 4){
    echo $array[$start]. '<br/>';
    $start++;
}*/
/*for($start=0;$start<=4;$start++){
    echo $array[$start].'<br/>';
}*/

//foreach loop
foreach($array as $key => $value){
    if(is_array($value)){
        foreach($value as $key => $value)
        {
            echo $key. ' :'. $value . '<br/>';
        }
    }
    else {
        echo $key . ' :' . $value . '<br/>';
    }
    //var_dump($array);
    //print_r($array);
}
?>