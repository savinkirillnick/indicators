<?

/*
* Average True Range
* array atr ( array $highs , array $lows , array $closes , integer $n  )
* 
* $highs, $lows, $closes are data array and $n is number of period
* example:
* $closes[0]    => earliest value
* $closes[n]    => latest value
* 
*/

function atr($highs, $lows, $closes, $n)
{
	$m = count($closes);
	if ($m >= $n){
		$ATR = [];
		for ($i = $n;$i < $m; $i++) {
			$TR = [];
			for ($j = ($i - $n); $j < $i; $j++) {
				if (!$j) {
					$TR[] = $highs[0] - $lows[0];
				} else {
					$TR[] = max(($highs[$j] - $lows[$j]),($highs[$j] - $closes[$j-1]),($closes[$j-1] - $lows[$j]));
				}
			}
			$ATR[] = array_reduce($TR, function ($var1,$var2){return $var1+$var2;})/$n;
		}
		return $ATR;
	} else {
		return false;
	}
}
?>
