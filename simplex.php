<?php
$matriz = array(
    array(24,22,45,0,0,0,0),
    array(2,1,3.9,1,0,0,42),
    array(2,1,2,0,1,0,40),
    array(1,0.5,1,0,0,1,45)
);
function checkOptimality($mat){ //teste de otimalidade
  for($j = 0; $j < count($mat[0]); $j++){
    if($mat[0][$j] > 0){
      echo "</br>Solução não ótima</br>";
      return false;
    }
  }
  echo "</br>Solução ótima</br>";

  return true;
}
function printMat($mat){ //imprime a matriz
    echo "<br/>";
    $lin = count($mat);
    $col = count($mat[0]);
    for ($i = 0; $i < $lin; $i++) {
        for ($j = 0; $j < $col; $j++) {
          echo round($mat[$i][$j],2)." ";
        }
      echo "</br>";
    }
    echo "</br>";
}
function escalona($mat,$pivot){ //escalona a matriz para transformar o pivo em 1 e os elementos acima e abaixo dele em 0
  $div = $mat[$pivot[0]][$pivot[1]];
  for($i = 0; $i < count($mat[0]); $i++){
    $mat[$pivot[0]][$i] = ($mat[$pivot[0]][$i])/$div; //divide a linha pivo pelo elemento pivo para transforma-lo em 1
  }
  printMat($mat);
  echo '</br>';
  
  for($i = 0; $i < count($mat); $i++){
    $mult = $mat[$i][$pivot[1]];
    if($i != $pivot[0]){
      for($j = 0; $j < count($mat[0]); $j++){
        $temp = $mat[$i][$j] -= $mult * $mat[$pivot[0]][$j]; //zera o elemento acima do pivo e faz a subtração entre as demais colunas
        echo round($mat[$i][$j],2)." -= (".round($mult,2)." * ".round($mat[$pivot[0]][$j],2).") = ".round($temp,2)." </br>";
      }
    }
  }
  return $mat;
}
function findPivot($mat){
  $lin = count($mat);
  $col = count($mat[0]);
  $maxCol = PHP_INT_MIN;
  $pivotCol = 0;
  $maxRow = PHP_INT_MAX;
  $pivotRow = 0;

  for($j = 0; $j < $col; $j++){//encontra a coluna pivo
    if($mat[0][$j] > $maxCol){
      $maxCol = $mat[0][$j];
      $pivotCol = $j;
    }
  }
  echo "Coluna pivo -> ".$pivotCol."<br>";

  for($i = 1; $i < $lin; $i++){//encontra a linha pivo
    if($mat[$i][$pivotCol] != 0){
      echo round($mat[$i][($col-1)],2)." [".$i."][".($col-1)."] / ".round($mat[$i][$pivotCol],2)." [".$i."][".$pivotCol."] = ".round($mat[$i][$col-1],2)/round($mat[$i][$pivotCol],2)." </br>";
      if(($mat[$i][$col-1]/$mat[$i][$pivotCol]) < $maxRow){//teste da razão mínima
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
function maximizeSimplex($mat){ //realiza maximização pelo método simplex tabular
  $it = 0;
  do{
    if($it > 20) break; // para de executar caso efetue mais de 20 iterações
    echo "Iteração: ".($it+1)."</br>";
    printMat($mat);
    $piv = findPivot($mat);
    $mat = escalona($mat, $piv);
    printMat($mat);
    $it++;
  }while(!checkOptimality($mat)); //realiza outra iteração enquanto não encontrar uma solução ótima
}
maximizeSimplex($matriz);


