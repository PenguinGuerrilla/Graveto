<?php

function minSimplex() {
  $bigM = 100000;
  $z = [0.4, 0.5, 0, 0, $bigM, $bigM];
  $mat = [
      [0.3, 0.1, 1, 0, 0, 0, 2.7],
      [0.5, 0.5, 0, 0, 0, 1, 6],
      [0.6, 0.4, 0, -1, 1, 0, 6]
  ];
  $c = [0, $bigM, $bigM];
  $zj = [1.1 * $bigM, 0.9 * $bigM, 0, -$bigM, $bigM, $bigM, 12 * $bigM];
  $pesoZj = [0.4 - $zj[0], 0.5 - $zj[1], 0, -$bigM, 0, 0];

  while (true) {
      
    printElements($z,$c,$zj,$pesoZj);
    printMat($mat);  
      // Descobrir coluna pivotal
      $minimoPesoZJ = 0;
      $pivotCol = null;
      for ($i = 0; $i < 4; $i++) {
          if ($pesoZj[$i] < $minimoPesoZJ) {
              $minimoPesoZJ = $pesoZj[$i];
              $pivotCol = $i;
          }
      }
      if ($minimoPesoZJ === 0)
          return $mat;
      
      // Descobrir linha pivotal
      $restPeso = null;
      $pivotLin = null;
      for ($i = 0; $i < count($mat); $i++) {
          if ($mat[$i][$pivotCol] > 0 && $mat[$i][count($mat[$i]) - 1] > 0) {
              if ($restPeso === null || $mat[$i][count($mat[$i]) - 1] / $mat[$i][$pivotCol] < $restPeso) {
                  $restPeso = $mat[$i][count($mat[$i]) - 1] / $mat[$i][$pivotCol];
                  $pivotLin = $i;
              }
          }
      }

      if ($restPeso === null)
          return $mat;

      $pivot = $mat[$pivotLin][$pivotCol];

      // Divide toda linha pivotal pelo elemento pivotal
      if ($pivot != 1) {
          for ($i = 0; $i < count($mat[0]); $i++)
              $mat[$pivotLin][$i] /= $pivot;
      }

      // Escalonamento
      for ($i = 0; $i < count($mat); $i++) {
          if ($i != $pivotLin) {
              $coefficient = $mat[$i][$pivotCol];
              for ($j = 0; $j < count($mat[0]); $j++) {
                  $mat[$i][$j] += -$coefficient * $mat[$pivotLin][$j];
              }
          }
      }

      // Variável referente à coluna pivotal entra na base
      $c[$pivotLin] = $z[$pivotCol];

      // Atualiza vetor Zj
      for ($i = 0; $i < count($mat[0]); $i++) {
          $value = 0;
          $j = 0;

          foreach ($mat as $element) {
              $value += $element[$i] * $c[$j];
              $j++;
              if ($j == count($c))
                  $j = 0;
          }

          $zj[$i] = $value;
      }

      // Atualiza vetor pesoZj
      for ($i = 0; $i < count($z); $i++)
          $pesoZj[$i] = ($z[$i] - $zj[$i]);
      
  }
}
function printElements($z,$c,$zj,$pesoZj){
    echo "Z: ";
    for($i = 0; $i < count($z); $i++){
      echo "| ".$z[$i]." | ";
    }
    echo "<br/>";
    echo "C: ";
    for($i = 0; $i < count($c); $i++){
      echo "| ".$c[$i]." | ";
    }      
    echo "<br/>";
    echo "ZJ:";
    for($i = 0; $i < count($zj); $i++){
      echo "| ".$zj[$i]." | ";
    }
    echo "<br/>";
    echo "Peso ZJ: ";
    for($i = 0; $i < count($pesoZj); $i++){
      echo "| ".$pesoZj[$i]." | ";
    }
    echo "<br/>";
}
function printMat($mat){ //imprime a matriz
  echo "<br/>";
  $lin = count($mat);
  $col = count($mat[0]);
  for ($i = 0; $i < $lin; $i++) {
      for ($j = 0; $j < $col; $j++) {
        echo "| ".round($mat[$i][$j],2)." | ";
      }
    echo "</br>";
  }
  echo "</br>";
}
minSimplex();