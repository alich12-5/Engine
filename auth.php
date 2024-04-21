<?php 
session_start();
define('CONSUMER_KEY', 'H7ggzgE4rNubSq09SKQJGw');
define('CONSUMER_SECRET', 'zUrMVznhHvrMEKBE5LhipfvRODLlPsvEJLvYiaf4yqE');
define('OAUTH_CALLBACK', 'http://192.168.10.112/wp/forums/?test=twitter&get=info');

// library
require_once TEMPLATEPATH . '/includes/twitteroauth/twitteroauth.php';
	echo '<pre>';

if ( $_GET['get'] == 'info' ){
	if ( isset($_SESSION['request_token']) && isset($_SESSION['request_token_secret']) ){
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['request_token'], $_SESSION['request_token_secret']);

		$token_credentials = $connection->getAccessToken($_REQUEST['oauth_verifier']);

		if ( $token_credentials ){	
			$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $token_credentials['oauth_token'],
				$token_credentials['oauth_token_secret']);

		    $account = $connection->get('account/verify_credentials');
		}
		var_dump( $_SESSION['oauth_token'] );
		var_dump( $_SESSION['request_token'] );
		var_dump( $_SESSION['request_token_secret'] );
		var_dump($account);
	}
} else {
	// unset( $_SESSION['oauth_token'] );
	// unset( $_SESSION['oauth_token_secret'] );
	//if ( isset($_SESSION['oauth_token']) ) wp_redirect( 'http://192.168.10.112/wp/forums/?test=twitter&get=info' );

	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

	$request_token = $connection->getRequestToken(OAUTH_CALLBACK);

	// echo '<pre>';
	// var_dump($request_token);
	// exit;

	if( $request_token)
	{
	    $token = $request_token['oauth_token'];
	    $_SESSION['request_token'] = $token ;
	    $_SESSION['request_token_secret'] = $request_token['oauth_token_secret'];

	 //    var_dump( $request_token );
		// var_dump( $_SESSION['request_token'] );
		// var_dump( $_SESSION['request_token_secret'] );
		// exit;
	 
	    switch ($connection->http_code) 
	    {
	        case 200:
	            $url = $connection->getAuthorizeURL($request_token);
	            //redirect to Twitter .
	            header('Location: ' . $url); 
	            break;
	        default:
	            echo "Connection with Twitter failed!";
	            break;
	    }
	 
	}
	else //error receiving request token
	{
	    echo "Error Receiving Request Token";
	}
}


?>