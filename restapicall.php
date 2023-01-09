<?php
class api{
	//create base url reference, if not set use localhost
	private $BASE_URL;
	private $debug;
	function __construct($url = "localhost", $verbose = false){
		if (substr($url, -1)=="/") {
			$url = substr($url, 0, -1);
		}
		if ($verbose) {
			$this->debug = true;
		}
		$this->BASE_URL = $url;
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

	//get raw data from BASE_URL/$entrypoint
	function getRaw($entrypoint) {
		$call = $this->fixEntrypoint($entrypoint);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $call);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
	}

	//get json data from BASE_URL/$entrypoint
	function get($entrypoint) {
		$call = $this->fixEntrypoint($entrypoint);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $call);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($curl);
		curl_close($curl);
		return json_decode($output);
	}
}

?>