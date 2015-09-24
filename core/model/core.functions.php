<?php
	function format_date($format, $date) 
{ 
	list($fh, $tm) = explode(' ',$date); 
	list($dd, $mm, $yyyy) = explode('/',$date); 
	$date = date($format, mktime(0,0,0,$mm,$dd,$yyyy)); 
	return trim($date." ".$tm); 
} 
?>