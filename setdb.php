<?php
$conn = mysqli_connect('localhost', 'root', '', 'mrziad');
//check connection

if(!$conn){


	var_dump(http_response_code(503));

	return;
}	