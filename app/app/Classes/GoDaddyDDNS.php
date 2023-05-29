<?php
    
namespace App\Classes;
    class GoDaddyDDNS {

		public $godaddy_api 		= 	'https://api.godaddy.com/v1/domains/';
		public $domain				=	false;
		public $key					=	false;
		public $secret				=	false;
		public $answer				=	false;

		public function __construct ( $domain , $key , $secret ) {

			$this -> domain				=	$domain;
			$this -> key				=	$key;
			$this -> secret				=	$secret;

		}

		public function updateRecord ( $type , $name , $data , $ttl ) {
			
			$curl						=	curl_init();
			curl_setopt( $curl , CURLOPT_URL , $this -> godaddy_api . $this-> domain . '/records/' . $type . '/' . $name );
			curl_setopt( $curl , CURLOPT_CUSTOMREQUEST , 'PUT' );
			curl_setopt( $curl , CURLOPT_HTTPHEADER , array( 'Content-Type: application/json' , 'Authorization: sso-key ' . $this -> key . ':' . $this -> secret ) );
			curl_setopt( $curl , CURLOPT_POSTFIELDS , '[{"type":"' . $type . '","name":"' . $name . '","data":"' . $data . '","ttl":' . $ttl . '}]' );
			curl_setopt( $curl , CURLOPT_FOLLOWLOCATION , 1 );
			curl_setopt( $curl , CURLOPT_RETURNTRANSFER , 1 );
			curl_setopt( $curl , CURLOPT_TIMEOUT , 15 );

			$this -> answer 			= 	curl_exec( $curl );

			if ( !curl_errno( $curl ) ) $http_code = curl_getinfo( $curl , CURLINFO_HTTP_CODE );
			
			curl_close( $curl );
			
			return $http_code;

		}

		public function getAnswer () {
			
			return $this -> answer;

		}

	}

?>