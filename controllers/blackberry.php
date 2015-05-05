<?php

	// Source:
	// http://supportforums.blackberry.com/t5/BlackBerry-Push-Development/Push-API-sample-code-needed/m-p/471216#M109

	// create a new cURL resource

function BBPush($messageId, $appId, $password){
	$ch = curl_init();
	$messageid = microtime();
	$appid = $appId; // Your App ID
	$password = $password; // Your Pwd

	$data = '--mPsbVQo0a68eIL3OAxnm'. "\r\n" .
	'Content-Type: application/xml; charset=UTF-8' . "\r\n\r\n" .
	'<?xml version="1.0"?>
	<!DOCTYPE pap PUBLIC "-//WAPFORUM//DTD PAP 2.1//EN" "http://www.openmobilealliance.org/tech/DTD/pap_2.1.dtd">
	<pap>
		<push-message push-id="' . $messageid . '" deliver-before-timestamp="2010-11-09T16:32:44Z" source-reference="'. $appid .'">
		<address address-value="push_all"/>
		<quality-of-service delivery-method="unconfirmed"/>
	</push-message>
</pap>' . "\r\n" .
'--mPsbVQo0a68eIL3OAxnm' . "\r\n" .
'Content-Type: text/plain' . "\r\n" .
'Push-Message-ID: ' . $messageid . "\r\n\r\n" .
'This is a sample message' . "\r\n" .
'--mPsbVQo0a68eIL3OAxnm--' . "\n\r";

	// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, "https://pushapi.eval.blackberry.com/mss/PD_pushRequest");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_USERAGENT, "BlackBerry Push Service SDK/1.0");
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, $appid.':'.$password);
	//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	"Content-Type: multipart/related; boundary=mPsbVQo0a68eIL3OAxnm; type=application/xml",
	"Accept: text/html, *",
	"Connection: Keep-Alive"));

	// grab URL and pass it to the browser
curl_exec($ch);

	// close cURL resource, and free up system resources
curl_close($ch);
}




?>