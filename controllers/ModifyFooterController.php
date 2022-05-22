<?php

namespace Controllers;

class ModifyFooterController {
		
	use SessionController;

	public function __construct()
	{
		$this -> redirectIfNotAdmin();
	}
	//traitement du formulaire
	public function submitFooter()
	{
		//si le formulaire a été soumis
	if ((isset( $_POST['titleFollow']) && !empty($_POST['titleFollow'])) && isset($_POST['titleContact']) && !empty( $_POST['titleContact']) && (isset( $_POST['phone']) && !empty($_POST['phone'])) && (isset( $_POST['email']) && !empty($_POST['email'])))
	{		
		//préparer les données pour les mettre dans la base de données
		$titleFollow = htmlspecialchars($_POST['titleFollow']);
		$titleContact = htmlspecialchars($_POST['titleContact']);
		$phone = htmlspecialchars($_POST['phone']);
		$email = htmlspecialchars($_POST['email']);
	
		//mettre les datas en bdd
		$model = new \Models\ModifyFooter();
		$model -> ModifyFooter(	$titleFollow, $titleContact, $phone, $email);
		
		header('location:modifyfooter');
		exit;
	} else {
		//revenir sur le meme page	
		header("Location: ".$_SERVER["HTTP_REFERER"]);
		exit;	
		   }
	}	   
		public function display()
	{
	    $model = new \Models\ModifyFooter();
	    $footer = $model -> findFooter();
	    $footerNetwork = $model -> findAllFooterNetwork();
	 
        $template = 'views/ModifyFooter.phtml';
        include 'views/layout_front_rc.phtml';
	}
	
	//delete article
	public function delete()
	{
		$model = new \Models\ModifyFooter();
	    $model -> deleteNetwork(htmlspecialchars($_GET['id']));
	    
	    header('location:modifyfooter');
		exit;
	}	
		
}	

    