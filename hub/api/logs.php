<?php
	
	$con = mysqli_connect("localhost", "logging", "ygXXihtt7lpyDIOl", "vertex_servers");

	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
	
	$serverid = mysqli_real_escape_string($con, $_GET['serverid']);
	
	if ($result = mysqli_query($con, "SELECT secret_key FROM `servers` WHERE id = '$serverid';"))
	{
		$secret_key = mysqli_real_escape_string($con, $_GET['secret_key']);
		$row = mysqli_fetch_row($result);
		
		if (strcmp($secret_key, $row[0]) != 0)
		{
			http_response_code(403);
			$response['response_code'] = 403;
			$response['response_desc'] = "Access Denied: Invalid Secret Key";
			
			$json_response = json_encode($response);
			echo $json_response;
			return;
		}
		
		mysqli_free_result($result);
	}
	else
	{
		http_response_code(500);
		$response['response_code'] = 500;
		$response['response_desc'] = "Error";
		
		$json_response = json_encode($response);
		echo $json_response;
		return;
	}
	
	$log = mysqli_real_escape_string($con, $_GET['log']);
	
	if (mysqli_query($con, "INSERT INTO `logs` (`serverid`, `log`, `timestamp`) VALUES ('$serverid', '$log', NOW());"))
	{
		http_response_code(200);
		$response['response_code'] = 200;
		$response['response_desc'] = "Success";
				
		$json_response = json_encode($response);
		echo $json_response;
	}
	else
	{
		http_response_code(500);
		$response['response_code'] = 500;
		$response['response_desc'] = "Error";
		
		$json_response = json_encode($response);
		echo $json_response;
	}
	
	mysqli_close($con);
?>