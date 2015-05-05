# PhpPush
ServerSide push example in php (Wp8, IOs, BB)

## Functions
```php
    //Certification & CertificaionDev: Path to pem file
	//isDevelop: boolean check if is develop or production push 
	//data: array of data to send
	//UUIDS array of uuids
pushToIOS($cerification, $cerificationDev, $isDevelop, $data, $UUIDS)

	//title in push alert
	//subtitle:n push alert
	//json: json to parse
	//uuid
	//url: where notify the push status (optional)
pushToWP8($title, $subtitle, $json, $UUID, $urlnotify='');

```
