<?php

namespace Controllers;

class ServicesController
{
	public function display()
	{
	    $model = new \Models\ModifyFooter();
	    $footer = $model -> findFooter();
	    $footerNetwork = $model -> findAllFooterNetwork();
	    
	    $model = new \Models\Services();
		$services = $model -> FindAllServices();
		/*var_dump($services);*/
		$listservices = $model -> FindAllListServicesByServise();
		/*var_dump($listservices);*/
		$serviceNetwork = $model -> findAllServiceNetwork();
		/*var_dump($serviceNetwork);*/
		
		//appeler la vue 
		$template = "views/Services.phtml";
		include 'views/layout_front_rc.phtml';
	}
}