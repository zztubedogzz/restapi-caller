<?php
class api{
	//create base url reference, if not set use localhost
	private $BASE_URL;
	private $debug;
	//first strip the "/" from the end
	function __construct($url = "localhost", $verbose = false){
		if (substr($url, -1)=="/") {
			$url = substr($url, 0, -1);
		}
		if ($verbose) {
			$this->debug = true;
		}
		$this->BASE_URL = $url;
	}

	//this function deals with the basic curl http calls
	function curlBase($entrypoint,$method = "GET",$postfields = null {
		$call = $this->fixEntrypoint($entrypoint);
		$curl = curl_init();
		if (isset($header)) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, array($header));
		}
		if ($method == "POST" || $method == "PUT" || $method == "PATCH") {
			if ($postfields==null) {
				die("No post data!");
			}
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postfields));
		}
		curl_setopt($curl, CURLOPT_URL, $call);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
	}

	//if user entered entrypoint without leading "/" insert it.
	function fixEntrypoint($entrypoint){
		if (substr($entrypoint, 0)!=="/") {
			$return = $this->BASE_URL."/".$entrypoint;
		} else {
			$return = $this->BASE_URL.$entrypoint;
		}
		if ($this->debug) {
			echo "[DEBUG]BASE_URL = ".$this->BASE_URL."\n";
			echo "[DEBUG]ENTRYPOINT = ".$entrypoint."\n";
			echo "[DEBUG]CALL = ".$return."\n";
		}
		return $return;
	}

	//get raw data from BASE_URL/$entrypoint in prettyfied json, if $raw is true then it returns raw response.
	function get($entrypoint, $method = "GET", $postfields = array(), $raw = true) {
		curlBase($entrypoint);
		if ($raw) {
			return json_decode($output);
		} else {
			return $output
		}
	}
}

?>