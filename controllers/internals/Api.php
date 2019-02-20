<?php

namespace controllers\internals;

use \models\Api as ModelApi;

class Api extends \InternalController
{
	public function __construct (\PDO $pdo)
    {
        $this->model_api = new ModelApi($pdo);
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

}