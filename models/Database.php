<?php

namespace Models;
//classe mère de tous les models

abstract class Database
{
	protected $bdd;
	
	public function __construct()
	{
		$this -> bdd = new \PDO('mysql:host=db.3wa.io;dbname=irinasabaliauskiene_riviera_choice;charset=utf8','irinasabaliauskiene','71931c57591db0cc1c070b8409ca0f06');

	}
	
	public function findAll(string $req,array $params = []):array
	{
		$query = $this -> bdd -> prepare($req);
		$query -> execute($params);
		return $query -> fetchAll(\PDO::FETCH_ASSOC);
	}
	
	
	public function findOne(string $req,array $params = []):?array
	{
		$query = $this -> bdd -> prepare($req);
		$query -> execute($params);
		$result = $query -> fetch(\PDO::FETCH_ASSOC);
			if($result==false){
				return null;
			}
			else {
				return $result;
			}
	}
		public function query(string $req,array $params = [])
	{
		$query = $this -> bdd -> prepare($req);
		$query -> execute($params);
	}
	
}