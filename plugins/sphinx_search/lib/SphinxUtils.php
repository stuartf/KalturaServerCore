<?php

class SphinxUtils
{

	public static function escapeString($str, $iterations = 2)
	{
		// NOTE: it appears that sphinx performs double decoding on SELECT values, so we perform 2 iterations.
		//		iterations should be set to 1 by default, if they fix it in some future release.
		$from = array ('\\',	'(',	')',	'|',	'-',	'@',	'~',	'&',	'/',	'^',	'$',	'=',	'_',	'%', 	'\'',	);
		$to   = array ('\\\\',	'\(',	'\)',	'\|',	'\-',	'\@',	'\~',	'\&',	'\/',	'\^',	'\$',	'\=',	'\_',	'\%',	'\\\'',	);
		for ($iter = 0; $iter < $iterations; $iter++)
		{
			$str = str_replace($from, $to, $str);
		}
		
		// The following characters are escaped only once since we want to enable clients to use them
		//	" - search for exact match, ! - AND NOT
		$from = array ('"',		'!',	);
		$to   = array ('\\"',	'\\!',	);
		$str = str_replace($from, $to, $str);
		return $str;
	}
}
