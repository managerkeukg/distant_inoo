<?php
function toTimestamp($milliseconds)
{
	$seconds = $milliseconds / 1000;
	$remainder = round($seconds - ($seconds >> 0), 3) * 1000;
	return date('Y:m:d H:i:s.', $seconds).$remainder;
}
?>