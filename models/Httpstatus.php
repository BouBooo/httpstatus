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

	public function connection(string $email, string $password)
	{
		return $this->get('admins', [
		'id' => 1,
		'email' => $email,
		'password' => $password	
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

	public function update_site(int $id, string $name, string $url)
	{
		return $this->update('sites', [
			'name' => $name,
			'url' => $url
		],
	    [
            'id' => $id
        ]);
	}

	public function get_sites_status()
	{
		return $this->get('sites');
	}

}



?>