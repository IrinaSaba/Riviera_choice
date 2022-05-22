<?php

namespace Controllers;

class ContactController {
	
	public function display()
	{
		//appeler la bdd
		$model = new \Models\ModifyFooter();
	    $footer = $model -> findFooter();
	  	$footerNetwork = $model -> findAllFooterNetwork();
	  
	  	$model = new \Models\Contact();
	    $contactus = $model -> findAllContact();
	  	
		//appeler la vue 
		$template = "views/contact.phtml";
		include 'views/layout_front_rc.phtml';
	}
	// function pour reenvoyer message du client sur email de propriotaire
	public function SubmitFormContact() 
	{
		$post = (!empty($_POST)) ? true : false;

	if($post)
	{
		$name = htmlspecialchars($_POST['name']);
		$email = trim(htmlspecialchars($_POST['email']));
		$email = htmlspecialchars($_POST['email']);
		$message = htmlspecialchars($_POST['message']);
		$tel = htmlspecialchars($_POST["phone"]);
		$error = '';
		//var_dump($name);
	//si il y a une erreur
	if(!$name)
	{
		$error .= 'Pls enter Your name </br>';
	}
	// Verification de numero
	function ValidateTel($valueTel)
	{
		$regexTel = "/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/";
	if($valueTel == "") 
	{
	return false;
	} else {
		$string = preg_replace($regexTel, "", $valueTel);
			}
	return empty($string) ? true : false;
	}
	//si il n'a pas d'email
	if(!$email)
	{
		$error .= "Pls enter Your email";
	}
	//si email et numero ont correct
	if($email && !ValidateTel($email))
	{
		$error .= "Pls enter right email";
	}
	if(!$error)
	
	//Verification de message
	if(!$message || strlen($message) < 1)
	{
		$error .= "Pls enter Your message";
	}
	if(!$error)
	{
		//preparation d'information pour envoyer
		$name_tema = "=?utf-8?b?". base64_encode($name) ."?=";
	
		$subject ="New request from Riverchoice.com";
		$subject1 = "=?utf-8?b?". base64_encode($subject) ."?=";
	
		$message1 ="\n\nName: ".$name."\n\nPhone: " .$tel."\n\nE-mail: " .$email."\n\nMessage: ".$message."\n\n";	
	
		$header = "Content-Type: text/plain; charset=utf-8\n";
	
		$header .= "From: New request <sabaliauskieneirina@gmail.com>\n\n";	
		$mail = @mail("sabaliauskieneirina@gmail.com", $subject1, iconv ('utf-8', 'windows-1251', $message1), iconv ('utf-8', 'windows-1251', $header));
	
	if($mail)
	{
	echo 'OK';
	}
	
	} else {
		echo '<div class="notification_error">'.$error.'</div>';
			}		
		
	}
	}

}