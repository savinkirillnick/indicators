<?php

/*
* Exponential Moving Average
* array ema ( array $closes , integer $n  )
* 
* $closes is data array and $n is number of period
* example:
* $closes[0]    => earliest value
* $closes[n]    => latest value
* 
*/

function ema($closes, $n)
{
    $m   = count($closes);
    if ($m >= $n) {
        $a   = 2 / ($n + 1);
        $EMA = [];
        $EMA[] = $closes[0];
        for ($i = 1; $i < $m; $i++) {
            $EMA[] = ($a * $closes[$i]) + ((1 - $a) * $EMA[$i - 1]);
        }
        return $EMA;
    } else {
        return false;
    }
}
?>
