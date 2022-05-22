<?php

namespace Models;

class Contact extends Database
{
    	public function ModifyContact($title, $text, $name, $email, $phone, $message, $nameImage, $image)
	{
		//requêtes sql qui permet l'ajout de la contact titles
		$this -> query("UPDATE contactus SET title_contact = ?, text = ?, title_name = ?, title_email = ?, title_phone = ?, title_message = ?, alt = ?, src = ? ",[$title, $text, $name, $email, $phone, $message, $nameImage, $image]);
	}
    
    public function findAllContact()
	{
		return $this->findOne("SELECT title_contact, text, title_name, title_email, title_phone, title_message, src, alt FROM contactus");
	}
}