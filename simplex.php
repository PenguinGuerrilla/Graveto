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
          echo round($mat[$i][$j],2)." ";
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
    $mult = $mat[$i][$pivot[1]];
    if($i != $pivot[0]){
      for($j = 0; $j < count($mat[0]); $j++){
        if($mat[$i][$j]!= 0){
          
        }
        $temp = $mat[$i][$j] -= $mult * $mat[$pivot[0]][$j];
        echo $mat[$i][$j]." -= (".$mult." * ".$mat[$pivot[0]][$j].") = ".$temp." </br>";

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
    if($mat[0][$j] > $maxCol){
      $maxCol = $mat[0][$j];
      $pivotCol = $j;
    }
  }
  echo "Coluna pivo -> ".$pivotCol."<br>";

  for($i = 1; $i < $lin; $i++){
    if($mat[$i][$pivotCol] != 0){
      echo $mat[$i][($col-1)]." [".$i."][".($col-1)."] / ".$mat[$i][$pivotCol]." [".$i."][".$pivotCol."] = ".$mat[$i][$col-1]/$mat[$i][$pivotCol]." </br>";
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
$piv2= findPivot($m);
$m2 = escalona($m,$piv2);
printMat($m2);

