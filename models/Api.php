<?php


namespace models;

Class Api extends \Model 
{
	public function getApiKey()
	{
		return $this->get_one('admins');
	}
}

?>