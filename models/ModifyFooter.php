<?php

namespace Models;

class ModifyFooter extends Database
{
		public function findFooter():array
	{
		return $this->findOne("SELECT title_follow, title_contact, phone, email FROM footer");
	}

		public function ModifyFooter($titleFollow,  $titleContact, $phone, $email)
	{
		//requêtes sql qui permet modifier de la footer
		$this -> query("UPDATE footer SET title_follow = ?, title_contact = ?, phone = ?, email = ?", [$titleFollow, $titleContact, $phone, $email]);
	}
	
	
	public function findAllFooterNetwork():array
	{
		return $this->findAll("SELECT network_url.id, url, id_network, name_network FROM network_url 
		INNER JOIN network ON network.id=network_url.id_network");
	}
	
		public function ModifyFooterNetwork($id, $nameNetwork, $networkUrl)
	{
		//requêtes sql qui permet l'ajout de footer network name et url
		$this -> query("UPDATE network_url
		SET id_network = ?, url = ?
		WHERE network_url.id = ?",[$nameNetwork, $networkUrl, $id]);
	}
	
	public function findNameNetwork():array
	{
		return $this->findAll("SELECT id, name_network FROM network
		");
	}
	
		public function AddFooterNetwork($networkUrl, $nameNetwork)
	{
		//requêtes sql qui permet l'ajout de Network
		$this -> query("INSERT INTO network_url (url, id_network) 
		
		VALUES (?,?)",[$networkUrl, $nameNetwork]);
	}
		
		public function findFooterNetworkById($id):?array
	{
		return $this -> findOne("SELECT network_url.id, url, id_network, name_network
		FROM network_url
		INNER JOIN network ON network.id=network_url.id_network
		WHERE network_url.id = ?",[$id]);
	}
	
		public function deleteNetwork($id)
	{
		//requêtes sql qui delete Network
		$this -> query("DELETE FROM network_url WHERE id = ? ",[$id]);
	}
}
