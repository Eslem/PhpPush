<?php

require 'controllers/pushAPN.php';
require 'controllers/wp8.php';

function pushToIOS($cerification, $cerificationDev, $isDevelop, $data, $UUIDS){
	//Certification & CertificaionDev: Path to pem file
	//isDevelop: boolean check if is develop or production push 
	//data: array of data to send
	//UUIDS array of uuids
	pushAPN($cerification, $cerificationDev, $isDevelop, $data, $UUIDS);
}

function pushToWP8($title, $subtitle, $json, $UUID, $urlnotify=''){
	//title in push alert
	//subtitle:n push alert
	//json: json to parse
	//uuid
	//url: where notify the push status (optional)
	$wpPush = new WindowsPhonePushNotification($urlnotify);
	$wpPush -> push_toast($title, $subtitle, $json, 0, $UUID);
}

function pushToBlackBerry(){
	
}