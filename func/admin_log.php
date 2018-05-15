<?php 
//admin stuff
//------------------------------------------------//
// 				Nikola Nejedlý - 2017/18		  //
//------------------------------------------------//

function readlog($lines)
{
	$log_addr = "./admin/log.txt";
	$data = explode("\n",file_get_contents($log_addr),$lines+1);
	if($lines == 0 || $lines == -1)
		$data = explode("\n",file_get_contents($log_addr));

	$out  = "";
	$i = 1;
	foreach($data as $d)
	if(!empty($d))
	{
		if($i < $lines+1)
			$out .= sprintf("%02d",$i)."> $d <br/>\n";
		else
		if($i == $lines+1)
			$out .= "(log limit = ".$lines.") ... <br/>\n";
		$i++;
	}
	
	return $out;
}

function savetolog($string_add)
{
    date_default_timezone_set('Europe/Prague');
	$date = date('d.m.Y');
	$time = date('H:i:s');
	$string_out = "$date | $time | ".$string_add."\n";
	$log_addr = "./admin/log.txt";
	
	$old_data = file_get_contents($log_addr);
	$log_op = fopen($log_addr, "w");
		fwrite($log_op, $string_out);
		fwrite($log_op, $old_data);
	fclose($log_op);	
}

?>