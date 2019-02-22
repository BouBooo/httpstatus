<?php

    //$pdo = new PDO('mysql:host=localhost;dbname=nicolas_lecossec;charset=UTF-8, root, bernardbernard');
namespace models;

Class Api extends \Model 
{

	public function new_query()
	{
		return $this->connect('localhost', 'nicolas_lecossec', 'root', 'bernardbernard');
	}
	public function getApiKey()
	{
		return $this->get_one('admins');
	}

	public function get_sites()
	{
		return $this->get('sites');
	}

	public function get_one_site(int $id)
	{
		return $this->get_one('sites', [
			'id' => $id
		]);
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

	public function check_status()
	{
		return $this->get('sites');
	}


	public function get_history(int $id)
	{
		return $this->run_query("SELECT * FROM sites JOIN status ON sites.id = status.site_id WHERE status.site_id = 'id' ORDER BY status.id DESC LIMIT 30", [
			'id' => $id
			]);
	}
}

?>