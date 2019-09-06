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
	function cci_sma($prices, $n)
	{
		$temp = 0;
		for ($i = 0; $i < $n; $i++) {
			$temp += $prices[$i];
		}
		$SMA = $temp / $n;
		return $SMA;
	}
	$m = count($closes);
	if ($m >= $n){
		$CCI = [];
		for ($i = $n; $i < $m; $i++) {
			$TP = [];
			$MD = [];
			for ($j = ($i - $n); $j < $i; $j++) {
				$TP[] = ($highs[$j] + $lows[$j] + $closes[$j]) / 3;
			}
			$SMA_TP = cci_sma($TP,$n);
			for ($j = 0; $j < $n; $j++) {
				$MD[] = abs($SMA_TP - $TP[$j]);
			}
			$SMA_MD = cci_sma($MD,$n);
			$CCI[] = (array_pop($TP) - $SMA_TP) / (0.015 * $SMA_MD);
		}
		return $CCI;
	} else {
		return false;
	}
}
?>
