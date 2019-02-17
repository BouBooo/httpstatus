<?php

namespace controllers\internals;

use \models\Httpstatus as ModelHttpstatus;

class Httpstatus extends \InternalController
{
    public function __construct (\PDO $pdo)
    {
        $this->model_httpstatus = new ModelHttpstatus($pdo);
    }


    public function log(string $email, string $password)
    {
        $admin = $this->model_httpstatus->connection($email, $password);
        if($admin)
        {
            return $admin;
        }
        else
        {
            return false;
        }
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

    public function get_sites_admin()
    {
        $all = $this->model_httpstatus->admin_dashboard();

        if($all)
        {
            return $all;
        }
        else
        {
            return false;
        }
    }

    public function delete_one_site(int $id)
    {
        $sites = $this->model_httpstatus->delete_site($id);
    }

}