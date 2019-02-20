<?php


namespace models;

Class Api extends \Model 
{
	public function getApiKey()
	{
		return $this->get_one('admins');
	}

	public function delete_one_site(int $id)
	{
		return $this->delete('sites', [
			'id' => $id
		]);
	}
}

?>