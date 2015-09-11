<!-- page-signup.php -->
<?php
/*
	Template Name: Signup Test Page
*/


?>

<html>
<head></head>
<body>
	<h1>Signup Test</h1>
	
	<form method="post">

		<input type="submit" name="submit" value="Send" />

	</form>

	<?php
		
		function post_to_url($url, $data) {
		   $fields = '';
		   foreach($data as $key => $value) { 
			  $fields .= $key . '=' . $value . '&'; 
		   }
		   rtrim($fields, '&');

		   $post = curl_init();

		   if($post === false)
			{
				die('Failed to create curl object');
			}

		   curl_setopt($post, CURLOPT_URL, $url);
		   curl_setopt($post, CURLOPT_POST, count($data));
		   curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
		   curl_setopt($post, CURLOPT_RETURNTRANSFER, true);

		   $response = curl_exec($post);
		   
		   $httpCode = curl_getinfo($post, CURLINFO_HTTP_CODE);

			if ( $httpCode != 200 ){
				echo "Return code is {$httpCode} \n"
					.curl_error($post);
			} else {
				echo "<pre>".htmlspecialchars($response)."</pre>";
			}

		   curl_close($post);
		   
		   echo $response;
		}

		$data = array(
		   "firstname" => "Jessica",
		   "lastname" => "Oei",
		   "zip" => "02446",
		   "email" => "jessica.oei@gmail.com"
		);

		post_to_url("http://mcan.bsd.net/page/sapi/test-signup", $data);
	?>

</body>
</html>