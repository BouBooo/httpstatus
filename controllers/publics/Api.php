<?php
namespace controllers\publics;

use \controllers\internals\Api as InternalApi;
use \ApiController as ApiController;
use \Model as Model;

class Api extends \Controller
{	
	public function __construct (\PDO $pdo)
    {
        parent::__construct($pdo);
        $this->internal_api = new InternalApi($pdo);
        $this->api_controller = new ApiController($pdo);
        $this->model = new Model($pdo);
    }

    public function home()
    {
    	$api_key = $this->internal_api->get_api_key();
    	$api = $_GET['api_key'] ?? false;

    	if($api_key == $api)
    	{
    		return $this->api_controller->json(array(
    			'version' => 1,
    			'list' => 'localhost/httpstatus/api/list/'
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
    	// Check api_key
    	$id = $id ?? false;
    	$api_key = $this->internal_api->get_api_key();
    	$api = $_GET['api_key'] ?? false;

    	if($api_key == $api)
    	{
    		$site = $this->internal_api->getOneSite($id);

    		if($site)
    		{
    			// Get site's httpcode
    			$url = $site['url'];
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_HEADER, true);   
				curl_setopt($ch, CURLOPT_NOBODY, true);    
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
				curl_setopt($ch, CURLOPT_TIMEOUT,10);
				$output = curl_exec($ch);
				$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);
				$date = date('Y-m-d H:i');

    			$infos = [
    				'code' => $httpcode,
    				'at' => $date
    			];


    			// Return infos and last status for this site
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



    public function history(int $id)
    {
    	// Check api_key
    	$id = $id ?? false;
    	$api_key = $this->internal_api->get_api_key();
    	$api = $_GET['api_key'] ?? false;

    	if($api_key == $api)
    	{
    		$site = $this->internal_api->getOneSite($id);
    		$history = $this->internal_api->getHistory($id);
    		$query = $this->internal_api->newQuery();
    		$status = [];

    		if($site['id'] == $id)
    		{
    			// Show 30 last status for the site
    			$history = $query->prepare('SELECT * FROM sites JOIN status ON sites.id = status.site_id WHERE status.site_id = ? ORDER BY status.id DESC LIMIT 30');
    			$history->execute(array($site['id']));
    			$status = [];

    			foreach ($history as $key => $historic) {
    				$infos = [
    					'code' => $historic['code'],
    					'at' => $historic['date_report']
	    		];
	    			array_push($status, $infos);
    			}

				return $this->api_controller->json(array(
	    			'id' => $site['id'],
	    			'name' => $site['name'],
	    			'url' => $site['url'],
	    			'status' => $status
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






    public function check_status()
    {
    	// Check api_key
    	$id = $id ?? false;
    	$api_key = $this->internal_api->get_api_key();
    	$api = $_GET['api_key'] ?? false;

    	if($api_key == $api)
    	{
    		// Connect to database & get sites infos
    		$sites = $this->internal_api->getSites();
    		$query = $this->internal_api->newQuery();
    		$sites_array = [];

    		if($sites)
    		{
    			foreach ($sites as $key => $site) {
    				// Check each site status
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

		    		// Save every httpcode returned
		    		$time = (new \Datetime())->format('Y-m-d H:i:s');
		    		$status = $query->prepare('INSERT INTO status (site_id, code, date_report) VALUES(?,?,?)');
					$status->execute(array($site['id'], $httpcode, $time));
				}

    			return $this->api_controller->json(array(
	    			'status' => $sites_array
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



    public function insert()
    {
    	$name = $_POST['name'] ?? false;
    	$url = $_POST['url'] ?? false;
    	$api_key = $this->internal_api->get_api_key();
    	$api = $_GET['api_key'] ?? false;

    	if($api_key == $api)
    	{
    		$insert = $this->internal_api->insertSite($name, $url);
    		$id = $this->model->last_id();

    		if($insert)
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
