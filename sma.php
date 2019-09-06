<?php
/*
* Simple Moving Average
* array sma ( array $closes , integer $n  )
* 
* $closes is data array and $n is number of period
* example:
* $closes[0]    => earliest value
* $closes[n]    => latest value
* 
*/

function sma($closes, $n)
{
    $m   = count($closes);
    $SMA = [];
	if ($m > $n){
		for ($i = $n; $i < $m; $i++) {
			$temp = 0;
			for ($j = ($i - $n); $j < $i; $j++) {
				$temp += $closes[$j];
			}
			$SMA[] = $temp / $n;
		}
		return $SMA;
	} else {
		return false;
	}
}
?>
