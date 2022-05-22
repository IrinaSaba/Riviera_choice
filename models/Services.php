<?php

namespace Models;

class Services extends Database
{
	 public function FindAllServices()
    {
        	return $this->findAll("
        SELECT services.id AS id, title, description, SUBSTR(description,1,30) AS description30, src, alt, title_service, date
        	FROM services
       		ORDER BY date");
    }
     public function FindAllListServicesByServise()
    {
    	return $this->findAll("
        SELECT id_services, services
        	FROM list_services
        	INNER JOIN services ON list_services.id_services=services.id
            WHERE id_services=services.id");
    }
    
    public function findAllServiceNetwork():array
	{
		return $this->findAll("SELECT network_services.id, url, id_network, name_network, id_services
		FROM network_services
		INNER JOIN network ON network.id=network_services.id_network");
	}
	
	public function AddNewService($title, $descript, $titleService, $nameImage, $image) 
	{
		//requêtes sql qui permet l'ajout l'article
		$this -> query("
		INSERT INTO services( title, description, title_service, alt, src, date) 
		VALUES (?,?,?,?,?,NOW())",[$title, $descript, $titleService, $nameImage, $image]);
	}
	
	public function AddNewTypeOfService($listService, $typeService) 
	{
		//requêtes sql qui permet l'ajout l'article
		$this -> query("
		INSERT INTO list_services(id_services, services) 
		VALUES (?,?)",[$listService, $typeService]);
	}
	
	public function AddNewNetworkService($service, $nameNetwork, $network)
	{
		//requêtes sql qui permet l'ajout de Network
		$this -> query("INSERT INTO network_services (id_services,id_network, url) 
		
		VALUES (?,?,?)",[$service, $nameNetwork, $network]);
	}
	
	 public function FindServiceById($id):?array
	{   
	    //requêtes sql qui permet de sélectionner l'arlicle by id 
		return $this -> findOne("
		SELECT services.id, title, description, title_service, src, alt
		FROM services 
		WHERE services.id = ?",[$id]);
	}
	public function FindListServicesByIdService($id):?array
	{   
	    //requêtes sql qui permet de sélectionner l'arlicle by id 
		return $this -> findAll("
		SELECT services, list_services.id 
		FROM list_services 
		INNER JOIN services ON list_services.id_services=services.id
		WHERE services.id = ?",[$id]);
	}
	
	public function deleteService($id)
	{
		//requêtes sql qui delete Article
		$this -> query("DELETE FROM services WHERE id = ? ",[$id]);
	}
	
	public function deleteListService($id)
	{
		$this -> query("DELETE FROM list_services WHERE id = ? ",[$id]);
	}
    public function FindNetworkById($id):?array
	{   
	    //requêtes sql qui permet de sélectionner l'arlicle by id 
		return $this -> findAll("
		SELECT network_services.id, url, network.name_network
		FROM network_services 
		INNER JOIN network ON network_services.id_network=network.id
        WHERE id_services = ?",[$id]);
	}
	public function deleteNetworkService($id)
	{
		$this -> query("DELETE FROM network_services WHERE id = ? ",[$id]);
	}
	
	public function submitServiceCorrect($id, $title, $descript, $nameImage, $image, $titleService)
	{
		//requêtes sql qui permet modifier article
		$this -> query("UPDATE services
		SET title = ?, description = ?, alt = ?, src = ?, title_service = ?
		WHERE services.id = ?",[$title, $descript, $nameImage, $image, $titleService, $id]);
	}
	
	 public function FindOneServiceById($id):?array
	{   
	    //requêtes sql qui permet de sélectionner l'arlicle by id 
		return $this -> findOne("
		SELECT list_services.id, services
		FROM list_services 
		WHERE list_services.id = ?",[$id]);
	}
	
		public function submitListServiceCorrect($id, $listService)
	{
		//requêtes sql qui permet modifier article
		$this -> query("UPDATE list_services
		SET services = ?
		WHERE list_services.id = ?",[$listService, $id]);
	}
	
	 public function FindOneNetworkById($id):?array
	{   
	    //requêtes sql qui permet de sélectionner l'arlicle by id 
		return $this -> findOne("
		SELECT network_services.id, url, name_network
		FROM network_services 
		INNER JOIN network ON network_services.id_network=network.id
		WHERE network_services.id = ?",[$id]);
	}
		public function findNameNetwork():array
	{
		return $this->findAll("SELECT id, name_network FROM network
		");
	}
	public function submitNetworkServiceCorrect($id, $networkName, $networkUrl)
	{
		//requêtes sql qui permet l'ajout de footer network name et url
		$this -> query("UPDATE network_services
		SET id_network = ?, url = ?
		WHERE network_services.id = ?",[$networkName, $networkUrl, $id]);
	}
}
