<?php
$birthday=array();
$i=0;
for($k=2000;$k>=1940;$k--){
    $birthday['byear'][$i]=$k;
    $i++;
}
$i=0;
for($k=1;$k<=12;$k++){
    $birthday['bmonth'][$i]=$k;
    $i++;
}
$i=0;
for($k=1;$k<=31;$k++){
    $birthday['bday_31'][$i]=$k;
    $i++;
}
$i=0;
for($k=1;$k<=30;$k++){
    $birthday['bday_30'][$i]=$k;
    $i++;
}

$i=0;
for($k=1;$k<=28;$k++){
    $birthday['bday_28'][$i]=$k;
    $i++;
}

$i=0;
for($k=1;$k<=29;$k++){
    $birthday['bday_29'][$i]=$k;
    $i++;
}
return $birthday;
?>