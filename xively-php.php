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
			      'axislabels'	 => $b,
			      'detailedgrid' 	 => $g,
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

	function sendDatapoint($API_KEY,$FEED_ID,$data)
	{
		$url = BASEURL . ENDPOINT . $FEED_ID;
		$header = array("X-ApiKey: " . $API_KEY, "Content-length: " . strlen($data));
	        echo $url."<br/>";
		echo $header."<br/>";
		var_dump($header);	
		$ch = initCurl($url);
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		
		$response = curl_exec($ch);
		$error = curl_error($ch);

		if($error != "")
		{
			$response = $error;
			return $response;
		}

		return $response;
		
	}

	function makeDatastream($API_KEY,$FEED_ID,$data)
	{
		$url = BASEURL . ENDPOINT . $FEED_ID;
                $header = array("X-ApiKey: " . $API_KEY, "Content-length: " . strlen($data));

                $ch = initCurl($url);

                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_VERBOSE, 1);
                curl_setopt($ch, CURLOPT_BINARYTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

                $response = curl_exec($ch);
                $error = curl_error($ch);

                if($error != "")
                {
                        $response = $error;
                        return $response;
                }

                return $response;

	}

	function deleteDatastream($API_KEY,$FEED_ID,$data)
	{

	}

	function initCurl($url)
	{
		$ch = curl_init($url);
		return $ch;
	}

?>
