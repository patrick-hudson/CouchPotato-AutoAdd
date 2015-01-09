<?php
//Edit the following two lines for your couchpotato URL and your API Key (Settings -> General). Make sure to enable Advanced Settings.
$couchpotatourl = "http://127.0.0.1/couchpotato/api";
$apikey = "abc123";
$file_handle = fopen("imdbid.txt", "r");
//$line = fgets($file_handle);
while (($line = fgets($file_handle)) !== false) {
	$curl_handle=curl_init();
	curl_setopt($curl_handle,CURLOPT_URL,"$url/$api/movie.add/?identifier=$line");
	#Uncomment if you have CP Authentication Setup
	//curl_setopt($curl_handle, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	//curl_setopt($curl_handle, CURLOPT_USERPWD, "user:pass");  
	curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
	curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
	$buffer = curl_exec($curl_handle);
	curl_close($curl_handle);
	$result = json_decode($buffer, true);
	//var_dump($result);
	echo "[Title]: ".$result['movie']['title'] . " [Status]: " . $result['success']. "\n";

}
fclose($file_handle);
?>