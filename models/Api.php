<?php


namespace models;

Class Api extends \Model 
{
	public function getApiKey()
	{
		return $this->get_one('admins');
	}

	public function get_sites()
	{
		return $this->get('sites');
	}



	public function add_one_site(string $name, string $url)
	{	
		return $this->insert('sites', [
			'name' => $name,
			'url' => $url
		]);
	}

	public function delete_one_site(int $id)
	{
		return $this->delete('sites', [
			'id' => $id
		]);
	}
}

?>