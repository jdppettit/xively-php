<?php
	
	define(ENDPOINT, "/v2/feeds/");
	define(BASEURL,"https://api.xively.com");
	
	function getGraph($API_KEY,$FEED_ID,$DATASTREAM_ID,
	$width,$height,$color,$title,$legend,$strokesize,
	$axislabels,$detailedgrid,$scale,$min,$max,$timezone)
	{
		$graph_url = BASEURL . ENDPOINT . $FEED_ID . "/datastreams/" . $DATASTREAM_ID . ".png?";
		
		$args = array('width' 		 => $w,
					  'height' 		 => $h,
					  'color' 		 => $c,
					  'title' 		 => $t,
					  'legend' 		 => $l,
					  'stroke' 		 => $s,
					  'axislabels'   => $b,
					  'detailedgrid' => $g,
					  'scale' 		 => $scale,
					  'min' 		 => $min,
					  'max' 		 => $max,
					  'timezone' 	 => $timzezone);
					  
		foreach($args as $key => $arg)
		{
			if(isset($arg) && $arg != "")
			{
				$graph_url .= $key."=".$arg;
			}
		}
		
		$html_encoded = '<img src="'.$graph_url.'" alt="'.$args['title'].'"/>';
		return $html_encoded;
	}

	function send($API_KEY,$FEED_ID,$data)
	{

	}

	function make($API_KEY,$FEED_ID,$data)
	{

	}

	function initCurl($url)
	{
		$ch = curl_init($url);
		return $ch;
	}
?>
