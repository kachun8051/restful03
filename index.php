<?php
header('Access-Control-Allow-Origin: *');


// http://localhost/rest/index.php/student/211234/atwd/49

class Controller {
	private $urlSegments;
	private $serviceProvider;
	
	function __construct() {
		if (!isset($_SERVER['PATH_INFO']) or $_SERVER['PATH_INFO']=='/' ) {
			echo 'please provide parameters';
			exit;
		}
		
		//parameters received
		$this->urlSegments = explode('/', $_SERVER['PATH_INFO']);
		array_shift($this->urlSegments);
		
		$resource = array_shift($this->urlSegments);
		$resource = ucfirst($resource);
		$serviceName = $resource.'Service';
		$serviceFilename = $resource.'Service'.'.php';
		
		if (file_exists($serviceFilename)) {
			require_once $serviceFilename;
			$this->serviceProvider = new $serviceName;
		} else {
			echo 'no such resource';
		}
	}
	
	function run() {
		$httpMethod = $_SERVER['REQUEST_METHOD'];
		$httpMethod = ucfirst(strtolower($httpMethod));
		$functionName = 'rest'.$httpMethod;
		
		$this->serviceProvider->$functionName($this->urlSegments);	
	}
}


$con = new Controller();
$con->run();


