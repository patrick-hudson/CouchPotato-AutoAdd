<?php
//Supply a list of Movie Titles in movielist.txt. One PER LINE.
$file_handle = fopen("movielist.txt", "r");
$imdbid = array();
//$line = fgets($file_handle);
while (($line = fgets($file_handle)) !== false) {
    $urlline = urlencode($line);
	$curl_handle=curl_init();
	curl_setopt($curl_handle,CURLOPT_URL,"http://www.omdbapi.com/?t=$urlline");
	curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
	curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
	$buffer = curl_exec($curl_handle);
	curl_close($curl_handle);
	$result = json_decode($buffer, true);
	//var_dump($result);
	$imdbid[] = $result['imdbID'];
	$file = 'imdbid.txt';
	file_put_contents($file, $result['imdbID']."\n", FILE_APPEND);
}
fclose($file_handle);
var_dump($imdbid)
?>