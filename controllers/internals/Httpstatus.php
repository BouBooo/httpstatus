<?php

namespace controllers\internals;

use \models\Httpstatus as ModelHttpstatus;

class Httpstatus extends \InternalController
{
    public function __construct (\PDO $pdo)
    {
        $this->model_httpstatus = new ModelHttpstatus($pdo);
    }

    public function getAllSites()
    {
    	$all = $this->model_httpstatus->get_all_sites();

    	if($all)
    	{
    		return $all;
    	}
    	else
    	{
    		return false;
    	}
    }

}