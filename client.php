<?php

$url = 'http://example.com/xmlrpc.php';
$username = 'admin';
$password = 'admin';

$result = wp_xml_rpc_request( $url, $username,$password );

if( $result ) {
	echo $result;
} else {
	echo 'failed';
}

function wp_xml_rpc_request ( $url, $username, $password ) {
	$request = xmlrpc_encode_request( 'metaWeblog.newPost', array(
		0,
		$username,
		$password,
		array (
			'title' => 'Hello World!',
			'description' => 'Welcome to the WordPress.',
			'post_type'=>'post',
			'post_status'=>'publish',
		),
		true
	) );

	$ch = curl_init();

	curl_setopt( $ch, CURLOPT_POSTFIELDS, $request );
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $ch, CURLOPT_TIMEOUT, 1 );

	$results = curl_exec( $ch );
	curl_close( $ch );

	return $results;
}
