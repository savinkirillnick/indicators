<?php

/*
* Commodity Channel Index
* array cci ( array $highs , array $lows , array $closes , integer $n  )
* 
* $highs, $lows, $closes are data array and $n is number of period
* example:
* $closes[0]    => earliest value
* $closes[n]    => latest value
* 
*/

function cci($highs, $lows, $closes, $n)
{
	$m = count($closes);
	if ($m >= $n){
		$CCI = [];
		for ($i = $n; $i < $m; $i++) {
			$TP = [];
			$MD = [];
			for ($j = ($i - $n); $j < $i; $j++) {
				$TP[] = ($highs[$j] + $lows[$j] + $closes[$j]) / 3;
			}
			$SMA_TP = array_reduce($TP,function ($var1,$var2){return $var1+$var2;})/$n;
			for ($j = 0; $j < $n; $j++) {
				$MD[] = abs($SMA_TP - $TP[$j]);
			}
			$SMA_MD = array_reduce($MD,function ($var1,$var2){return $var1+$var2;})/$n;
			$CCI[] = (array_pop($TP) - $SMA_TP) / (0.015 * $SMA_MD);
		}
		return $CCI;
	} else {
		return false;
	}
}
?>
