<?php

namespace Controllers;

class ModifyAdminController {
	
	use SessionController;

	public function __construct()
	{
		$this -> redirectIfNotAdmin();
	}
		public function submitAdminForm()
	{
	if (isset($_POST['pw']) && !empty($_POST['pw']))
	{	
		$pass = password_hash(htmlspecialchars($_POST['pw']), PASSWORD_DEFAULT);

		//mettre les datas en bdd
		$model = new \Models\Admin();
		$model -> ModifyPass($pass);
		
		header('location:modifyadmin');
			exit;
	} else {
		//revenir sur le meme page	
		header("Location: ".$_SERVER["HTTP_REFERER"]);
		exit;	
		   }
	}
	
	public function displayAdminForm()
	{
		$model = new \Models\ModifyFooter();
	    $footer = $model -> findFooter();
	  	$footerNetwork = $model -> findAllFooterNetwork();
	  	
	  	$model = new \Models\Admin();
	    $pass = $model -> getPassAdmin();
	    //var_dump($pass);
	    
		//appeler la vue 
		$template = "views/ModifyAdmin.phtml";
		include 'views/layout_front_rc.phtml';
	}
}	

    