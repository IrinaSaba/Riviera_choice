<?php

namespace Models;

class Admin extends Database
{

	public function getAdminByLogin(string $login):?array
	{
	
		return $this -> findOne("SELECT login, password, name FROM admin WHERE login = ?", [$login]);
		
	}
		public function getPassAdmin():?array
	{
	
		return $this -> findOne("SELECT password FROM admin ");
		
	}
		public function ModifyPass($pass)
	{
		//requêtes sql qui permet modifier password
		$this -> query("UPDATE admin
		SET password = ?",[$pass]);
	}
}
