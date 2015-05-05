<?php
$payload = array();
$apns_url = NULL;
$apns_cert = NULL;
$apns_port = 2195;
$device_tokens = array();

function pushAPN($path, $pathDev, $isDevelop, $array, $uuids){
	$payload = json_encode($array);
	setCertifications($path, $pathDev);
	$device_tokens = $uuids;
	sendPushAPN();
}

function setCertifications($path, $pathDev, $isDevelop){
	if($isDevelop)
	{
		$apns_url = 'gateway.sandbox.push.apple.com';
		$apns_cert = $pathDev;
	}
	else
	{
		$apns_url = 'gateway.push.apple.com';
		$apns_cert = $path;
	}

}


function sendPushAPN(){
	$stream_context = stream_context_create();
	stream_context_set_option($stream_context, 'ssl', 'local_cert', $apns_cert);

	$apns = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context);
	foreach($device_tokens as $device_token)
	{
		$apns_message = chr(0) . chr(0) . chr(32) . pack('H*', str_replace(' ', '', $device_token)) . chr(0) . chr(strlen($payload)) . $payload;
		fwrite($apns, $apns_message);
	}

	@socket_close($apns);
	@fclose($apns);
}