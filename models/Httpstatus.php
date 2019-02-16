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

	public function add_site(istring $name, string $url)
	{
		return $this->insert('sites', [
			'name' => $name,
			'url' => $url
		]);
	}

	public function connection(int $id)
	{
		return $this->get_one('admins', [
		'id' => $id
		]);
	}

	public function admin_dashboard()
	{
		return $this->get('sites');
	}

	public function delete_site($id)
	{
		return $this->delete('sites',[
			'id' => $id
		]);
	}

}



?>