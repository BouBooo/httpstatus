<?php


namespace models;

Class Httpstatus extends \Model 
{
	public function get_all_sites()
	{
		return $this->get('sites');
	}

	public function get_one_site(int $id)
	{
		return $this->get_one('sites', [
			'id' => $id
		]);
	}

	public function add_site(string $name, string $url)
	{
		return $this->insert('sites', [
			'name' => $name,
			'url' => $url
		]);
	}

	

}



?>