<?php

namespace Controllers;

class ModifyFooterNetworkController {
		
	use SessionController;

	public function __construct()
	{
		$this -> redirectIfNotAdmin();
	}
	public function submitNetworkFooterMod()
	{
	if (isset($_POST['nameNetwork']) && !empty($_POST['nameNetwork']) 
		&& !empty( $_POST['networkUrl']))
	{	
		$nameNetwork = htmlspecialchars($_POST['nameNetwork']);
		$networkUrl = htmlspecialchars($_POST['networkUrl']);
		
		//mettre les datas en bdd
		$model = new \Models\ModifyFooter();
		$model -> ModifyFooterNetwork(htmlspecialchars($_GET['id']), $nameNetwork, $networkUrl);
		
		header('location:modifyfooter');
			exit;
	}  else {
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
	    $Networkname = $model ->  findNameNetwork();
	    $NetworkId = $model ->  findFooterNetworkById(htmlspecialchars($_GET['id']));
	
        $template = 'views/ModifyFooterNetwork.phtml';
        include 'views/layout_front_rc.phtml';
	}
	

}	
