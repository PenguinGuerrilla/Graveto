<?php
$it = 0;
$matriz = array(
    array(3,5,0,0,0,0),
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
function escalona($mat,$pivot){
  $div = $mat[$pivot[0]][$pivot[1]];
  for($i = 0; $i < count($mat[0]); $i++){
    $mat[$pivot[0]][$i] = ($mat[$pivot[0]][$i])/$div;
  }
  printMat($mat);
  echo '</br>';
  for($i = 0; $i < count($mat); $i++){
    if($i != $pivot[0]){
      for($j = 0; $j < count($mat[0]); $j++){
        $mat[$i][$j] = $mat[$i][$j] - ($mat[$i][$j] * $mat[$pivot[0]][$pivot[$j]]);
      }
    }
  }
  return $mat;
}
function findPivot($mat){
  $lin = count($mat);
  $col = count($mat[0]);
  $maxCol = -9999;
  $pivotCol = 0;
  $maxRow = 9999;
  $pivotRow = 0;

  for($j = 0; $j < $col; $j++){
    if(abs($mat[0][$j]) > $maxCol){
      $maxCol = $mat[0][$j];
      $pivotCol = $j;
    }
  }
  echo "Coluna pivo -> ".$pivotCol."<br>";

  for($i = 1; $i < $lin; $i++){
    if($mat[$i][$pivotCol] != 0){
      echo "[".$i."][".($col-1)."] / [".$i."][".$pivotCol."] = ".$mat[$i][$col-1]/$mat[$i][$pivotCol]." </br>";
      if(($mat[$i][$col-1]/$mat[$i][$pivotCol]) < $maxRow){
        $maxRow = ($mat[$i][$col-1]/$mat[$i][$pivotCol]);

        $pivotRow = $i;
      }
    }
    
  }
  echo "Linha pivo -> ".$pivotRow."<br>";

  echo "pivo = [".$pivotRow."][".$pivotCol."] -> ".$mat[$pivotRow][$pivotCol]."<br>";
  echo '</br>';
  $pivot = array($pivotRow,$pivotCol);
  return $pivot;
}
printMat($matriz);
$piv = findPivot($matriz);
$m = escalona($matriz,$piv);
printMat($m); 

