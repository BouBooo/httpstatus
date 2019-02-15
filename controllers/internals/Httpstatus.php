<?php

namespace controllers\internals;

use \models\Httpstatus as ModelHttpstatus;

class Httpstatus extends \InternalController
{
    public function __construct (\PDO $pdo)
    {
        $this->model_httpstatus = new ModelHttpstatus($pdo);
    }


    public function log(string $username, string $password)
    {
        $member = $this->model_httpstatus->connection($username, $password);
        return $username & $password;
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


    public function getOneSite(int $id)
    {
        $site = $this->model_httpstatus->get_one_site($id);
        return $site;
    }


    public function insertSite(string $name, string $url)
    {
        $insert = $this->model_httpstatus->add_site($name, $url);

        if($insert)
        {
            return $insert;
        }
        else
        {
            return false;
        }
    }

}