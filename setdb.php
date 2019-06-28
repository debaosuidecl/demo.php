<?php
// $conn = mysqli_connect('localhost', 'root', '', 'mrziad');
//check connection
$conn = mysqli_connect('r42ii9gualwp7i1y.chr7pe7iynqr.eu-west-1.rds.amazonaws.com', 'pif7yquy2rprrawz', 'w31rgodyjxza96ys', 'rymmy2sz9p65xc6f');

if(!$conn){


	var_dump(http_response_code(503));

	return;
}	