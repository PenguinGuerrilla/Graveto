<?php
$it = 0;
$matriz = array(
    array(-3,2,0,0,0,0),
    array(1,0,1,0,0,4),
    array(0,2,0,1,0,12),
    array(3,2,0,0,1,18)
);
function printMat($mat){
    $lin = count($mat);
    $col = count($mat[0]);
    for ($i = 0; $i < $lin; $i++) {
        for ($j = 0; $j < $col; $j++) {
          echo $mat[$i][$j]."  ";
        }
      echo "</br>";
    }
}

printMat($matriz);


