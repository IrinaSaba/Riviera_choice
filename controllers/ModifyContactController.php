<?php

namespace Controllers;

class ModifyContactController {
	// appeler la Trait SessionController
	use SessionController;

	public function __construct()
	{
		$this -> redirectIfNotAdmin();
	}
	public function submitContactCorrection()
	{
	if (isset($_POST['title']) && !empty($_POST['title']) && 
		isset($_POST['text']) && !empty($_POST['text']) && 
		isset($_POST['titleName']) && !empty($_POST['titleName']) && 
		isset($_POST['email']) && !empty($_POST['email']) && 
		isset($_POST['phone']) && !empty($_POST['phone']) &&
		isset($_POST['message']) && !empty($_POST['message']))
	{	
		$title = htmlspecialchars($_POST['title']);
		$text = htmlspecialchars($_POST['text']);
		$name = htmlspecialchars($_POST['titleName']);
		$email = htmlspecialchars($_POST['email']);
		$phone = htmlspecialchars($_POST['phone']);
		$message = htmlspecialchars($_POST['message']);
		$nameImage = htmlspecialchars($_POST['nameImage']);
	if (empty($_FILES['image']['name'])) 
	{
		$image = htmlspecialchars($_POST['imageBdd']);
	} else {
		$image = "asset/img/{$_FILES['image']['name']}";
		move_uploaded_file ($_FILES['image']['tmp_name'], $image );
	       }
		//mettre les datas en bdd
		$model = new \Models\Contact();
		$model -> ModifyContact($title, $text, $name, $email, $phone, $message, $nameImage, $image);
		
		header('location:contact');
			exit;
	} else {
		//revenir sur le meme page	
		header("Location: ".$_SERVER["HTTP_REFERER"]);
		exit;	
		   }	
	}
	
	public function displayForm()
	{
		$model = new \Models\ModifyFooter();
	    $footer = $model -> findFooter();
	  	$footerNetwork = $model -> findAllFooterNetwork();
	  	
	  	$model = new \Models\Contact();
	    $contactus = $model -> findAllContact();
	    
		//appeler la vue 
		$template = "views/ModifyContact.phtml";
		include 'views/layout_front_rc.phtml';
	}
	
}	

    