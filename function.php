<?php 

	function ara($baslangic, $son, $cekilmek_istenen)
	{
	@preg_match_all('/' . preg_quote($baslangic, '/') .
	'(.*?)'. preg_quote($son, '/').'/i', $cekilmek_istenen, $m);
	return @$m[1];
	}

 ?>