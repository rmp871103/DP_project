<?php
//需要安裝
/*function check_is_email_real_exist($email_address){
	if ((!filter_var($email_address, FILTER_VALIDATE_EMAIL)===false) and strlen($email_address)<=254){
		$emailxx=explode('@',$email_address);
		$dns_lookup_result=dns_get_record($emailxx[1],DNS_MX);
		if (count($dns_lookup_result)==0){
			return false;
		}else{
			$address=gethostbyname($dns_lookup_result[0]['target']);
			if ($address!=''){
				$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
				if ($socket === false) {
					echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
					return false;
				}
				$result = socket_connect($socket, $address, 25);
				if ($result === false) {
					echo "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
					return false;
				}
				$in = "HELO hi\r\n";
				socket_write($socket, $in, strlen($in));
				if(substr(socket_read($socket, 2048),0,3)=='220'){
					$in = "MAIL FROM:<thisistest@gmail.com>\r\n";
					socket_write($socket, $in, strlen($in));
					if(substr(socket_read($socket, 2048),0,3)=='250'){
						$in = "RCPT TO:<$email_address>\r\n";
						socket_write($socket, $in, strlen($in));
						if(substr(socket_read($socket, 2048),0,3)=='250'){
							$in = "QUIT\r\n";
							socket_write($socket, $in, strlen($in));
							if(substr(socket_read($socket, 2048),0,3)=='250'){
								return true;
							}else{
								return false;
							}
						}else{
							return false;
						}
					}else{
						return false;
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
	}else{
		return false;
	}
}*/
function check_is_email_real_exist($email_address){
	$email_address = filter_var($email_address, FILTER_SANITIZE_EMAIL);
	$email_address = mb_convert_encoding($email_address,"ASCII");
	if(!filter_var($email_address, FILTER_VALIDATE_EMAIL))
		return FALSE;
	return checkdnsrr(array_pop(explode("@",$email_address)),"MX");
	//return checkdnsrr($email_address,"MX");
}
?>