<?php
namespace Appfiles\Common;

use Illuminate\Container\Container;
use Illuminate\Support\Facades\App;
//Use Exception;

/**
 * Common Functions
 */

class AmazonS3Upload
{
	protected $app;
	protected $s3;

function __construct(Container $app) {
		$this->app=$app;
		$this->makeS3();


	}

	function upload($inputArray){

		if(!is_array($inputArray))
			return false;
		    $inputArray['ACL'] = 'public-read';
		    $inputArray['Bucket']=$_ENV['AWS_BUCKET'];


		   //ADD CATCH EXCEPTION HERE
		  //  	try{ 
			$response=$this->s3->putObject($inputArray); 
			// 	}catch(Exception $e)
			// 	{	
			// 		return false;
			// 	}
			 return $response;
}





	function makeS3(){
		$s3=$this->app->make('aws')->createClient('s3');

		return $this->s3=$s3;
	}

}