<?php

namespace controllers\internals;

use \models\Api as ModelApi;

class Api extends \InternalController
{
	public function __construct (\PDO $pdo)
    {
        $this->model_api = new ModelApi($pdo);
    }

    public function newQuery()
    {
    	$newQuery = $this->model_api->new_query();

    	if($newQuery)
		{
			return $newQuery;
		}
		else
		{
			return false;
		}

    }

	public function get_api_key()
	{
		$api_key = $this->model_api->getApiKey();

		if($api_key)
		{
			return $api_key['api_key'];
		}
		else
		{
			return false;
		}
	}


	public function getSites()
	{
		$sites = $this->model_api->get_sites();
		return $sites;
	}

	public function getOneSite(int $id)
	{
		$site = $this->model_api->get_one_site($id);
		return $site;
	}



	public function insertSite(string $name, string $url)
	{
		$insert = $this->model_api->add_on_site($name, $url);

		if($insert)
		{
			return $insert;
		}
		else
		{
			return false;
		}
	}


	public function deleteSite(int $id)
	{
		$delete = $this->model_api->delete_one_site($id);

		if($delete)
		{
			return $delete;
		}
		else
		{
			return false;
		}
	}

	public function checkStatus()
	{
		$status = $this->model_api->check_status();

		if($status)
		{
			return $status;
		}
		else
		{
			return false;
		}

	}

}