<?php

namespace Models;

class ModifyAboutUs extends Database
{

		public function ModifyAboutUs($title, $history, $nameImage, $image)
	{
		//requêtes sql qui permet l'ajout de la catégorie
		$this -> query("UPDATE aboutus SET title = ?, history = ?, alt = ?, src = ? ",[$title, $history, $nameImage, $image]);
	}
		public function findAllAboutUs()
	{
		return $this->findOne("SELECT title, history, src, alt FROM aboutus");
	}
	
	public function findSliderAbout()
	{
		return $this->findAll("SELECT id, src, alt FROM slideraboutus");
	}
	
	public function AddNewSliderAbout($nameImage, $image) 
	{
		//requêtes sql qui permet l'ajout photo to slider sur premiere page
		$this -> query("INSERT INTO slideraboutus (alt, src) 
		VALUES (?,?)",[$nameImage, $image]);
	}
	
	public function deletePhotoAbout($id)
	{
		//requêtes sql qui delete Article
		$this -> query("DELETE FROM slideraboutus WHERE id = ? ",[$id]);
	}
	
	public function ModifySliderAbout($id,$nameImage, $image)
	{
		//requêtes sql qui permet modifier article
		$this -> query("UPDATE slideraboutus
		SET alt = ?, src = ?
		WHERE id = ?",[$nameImage, $image, $id]);
	}
	 public function findSliderAboutById($id):?array
	{   
	    //requêtes sql qui permet de sélectionner un plat
		return $this -> findOne("
		SELECT id, src, alt
		FROM slideraboutus 
		
		WHERE id = ?",[$id]);
	}
}
	