<?php
namespace controllers\publics;

use \controllers\internals\Api as InternalApi;
use \ApiController as ApiController;

class Api extends \Controller
{	
	public function __construct (\PDO $pdo)
    {
        parent::__construct($pdo);
        $this->internal_api = new InternalApi($pdo);
        $this->api_controller = new ApiController($pdo);
    }

    public function home()
    {
    	$api_key = $this->internal_api->get_api_key();
    	$api = $_GET['api_key'] ?? false;

    	if($api_key == $api)
    	{
    		return $this->api_controller->json(array(
    			'version' => 1,
    			'list' => $_SERVER['SERVER_NAME'].'/httpstatus/api/list/'
    		));
    	}
    	else
    	{
    		return $this->api_controller->json(array(
    			'api_key' => 'not valid'
    		));
    	}

    }


    public function delete(int $id)
    {
    	$api_key = $this->internal_api->get_api_key();
    	$api = $_GET['api_key'] ?? false;

    	if($api_key == $api)
    	{
    		$delete = $this->internal_api->deleteSite($id);

    		if($delete)
    		{
    			return $this->api_controller->json(array(
	    			'success' => true,
	    			'id' => $id
	    		));	
    		}
    		else
    		{
    			return $this->api_controller->json(array(
	    			'success' => false
	    		));
    		}

    	}
    	else
    	{
    		return $this->api_controller->json(array(
    			'api_key' => 'not valid'
    		));
    	}
    }
}
