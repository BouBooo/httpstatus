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


    public function list()
    {
    	$api_key = $this->internal_api->get_api_key();
    	$api = $_GET['api_key'] ?? false;

    	if($api_key == $api)
    	{
    		$sites = $this->internal_api->getSites();
    		$sites_array = [];

    		foreach($sites as $site)
    		{
    			$infos = [
    				'id' => $site['id'],
    				'name' => $site['name'],
    				'url' => $site['url'],
	    			'delete' => 'localhost/api/delete/'.$site['id'],
	    			'status' => 'localhost/api/status/'.$site['id'],
	    			'history' => 'localhost/api/history/'.$site['id'],
    		];
    			array_push($sites_array, $infos);
            }

    		return $this->api_controller->json(array(
    			'version' => 1,
    			'websites' => $sites_array
    		));
    	}
    	else
    	{
    		return $this->api_controller->json(array(
    			'api_key' => 'not valid'
    		));
    	}
    }


    public function status(int $id)
    {
    	$id = $id ?? false;
    	$api_key = $this->internal_api->get_api_key();
    	$api = $_GET['api_key'] ?? false;

    	if($api_key == $api)
    	{
    		$site = $this->internal_api->getOneSite($id);

    		if($site)
    		{
    			$url = $site['url'];
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_HEADER, true);   
				curl_setopt($ch, CURLOPT_NOBODY, true);    
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
				curl_setopt($ch, CURLOPT_TIMEOUT,10);
				$output = curl_exec($ch);
				$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);

    			$infos = [
    				'code' => $httpcode,
    				'at' => $date
    			];


    			return $this->api_controller->json(array(
	    			'id' => $id,
	    			'name' => $site['name'],
	    			'url' => $site['url'],
	    			'status' => $infos
	    		));	
    		}
    		else
    		{
    			return $this->api_controller->json(array(
	    			'success' => false,
	    			'error' => 'Invalid id'
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


    public function check()
    {
    	$api_key = $this->internal_api->get_api_key();
    	$api = $_GET['api_key'] ?? false;

    	if($api_key == $api)
    	{
    		$sites = $this->internal_api->getSites();
    		$sites_array = [];

    		foreach($sites as $site)
    		{
				$url = $site['url'];
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_HEADER, true);   
				curl_setopt($ch, CURLOPT_NOBODY, true);    
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
				curl_setopt($ch, CURLOPT_TIMEOUT,10);
				$output = curl_exec($ch);
				$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);

    			$infos = [
    				'id' => $site['id'],
    				'name' => $site['name'],
    				'url' => $site['url'],
    				'code' => $httpcode
    		];
    			array_push($sites_array, $infos);
            }

    		return $this->api_controller->json(array(
    			'version' => 1,
    			'websites' => $sites_array
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



    public function insert(string $name, string $url)
    {
    	$name = $_GET['name'] ?? false;
    	$url = $_GET['url'] ?? false;
    	$api_key = $this->internal_api->get_api_key();
    	$api = $_GET['api_key'] ?? false;

    	if($api_key == $api)
    	{
    		$insert = $this->internal_api->insertSite($name, $url);

    		if($insert)
    		{
    			return $this->api_controller->json(array(
	    			'success' => true
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
