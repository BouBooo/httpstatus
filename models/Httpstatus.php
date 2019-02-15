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
			'id' => $_GET['id']
		]);
	}

	public function add_site(string $name, string $url)
	{
		return $this->insert('sites', [
			'name' => $name,
			'url' => $url
		]);
	}

	public function connection(string $name, string $password)
	{
		return $this->login('admins', [
			'username' => $username,
			'password' => $password
		]);
	}

}



?>