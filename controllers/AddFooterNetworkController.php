<?php

namespace Controllers;

class AddFooterNetworkController {
	// appeler la Trait SessionController	
	use SessionController;

	public function __construct()
	{
		$this -> redirectIfNotAdmin();
	}
	public function submitNetworkFooter()
	{
		//si le formulaire a été soumis
	if (isset($_POST['networkUrl']) && !empty($_POST['networkUrl']) && (isset( $_POST['nameNetwork']) && !empty( $_POST['nameNetwork'])))
	{
		//préparer les données pour les mettre dans la base de données
		$networkUrl = htmlspecialchars($_POST['networkUrl']);
		$nameNetwork = htmlspecialchars($_POST['nameNetwork']);
		
		//mettre les datas en bdd
		$model = new \Models\ModifyFooter();
		$model -> AddFooterNetwork($networkUrl, $nameNetwork);
		
		header('location:modifyfooter');
		exit;
			
	} else {
		//rester sur le meme page
		header("Location: ".$_SERVER["HTTP_REFERER"]);
		exit;
			}
	}
		
	public function display()
	{
		//appeler le bdd
	    $model = new \Models\ModifyFooter();
	    $footer = $model -> findFooter();
	    $footerNetwork = $model -> findAllFooterNetwork();
	    $Networkname = $model ->  findNameNetwork();
	    
		//afficher le template
        $template = 'views/AddFooterNetwork.phtml';
        include 'views/layout_front_rc.phtml';
	}
}	
