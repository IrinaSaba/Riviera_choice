<?php

namespace Controllers;

class DashBoardController
{
		// appeler la Trait SessionController
		use SessionController;
	
		public function __construct()
	{
		$this -> redirectIfNotAdmin();
	}

	public function display()
	{
		$model = new \Models\ModifyFooter();
	    $footer = $model -> findFooter();
		$footerNetwork = $model -> findAllFooterNetwork();
		
		//appeler la vue 
		$template = "views/dashboard.phtml";
		include 'views/layout_front_rc.phtml';
	}
}