<?php


//API Url
		$url = 'http://10.10.11.14:8002/dukcapil/get_json/dikaper_dinkes/call_nik';
		
		//Initiate cURL
		$ch = curl_init($url);
				
		//The JSON data.
		$jsonData = array(
			'user_id' => 'dikaper',
            		'password' => 'Dikaper!123',
            		'nik' => '3271042003010015',
	    		'ip_user' => '172.16.3.30',
		);

		//Encode the array into JSON.
		$jsonDataEncode = json_encode($jsonData);

//Tell cURL that we want to send a POST request.
		curl_setopt($ch, CURLOPT_POST, 1);

		//Attach our encode JSON string to the POST fields.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncode);

		//set the content type to application/json
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		//Execute request
		$response = curl_exec($ch);		
		
		if(curl_errno($ch))
		{
			echo "Error: ". curl_errno($ch);
		}		
		
		curl_close($ch);

		echo  $response ;

		
