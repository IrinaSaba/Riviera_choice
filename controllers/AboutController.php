<?php

namespace Controllers;

class AboutController
{

	public function display()
	{
		$model = new \Models\ModifyAboutUs();
	    $aboutus = $model -> findAllAboutUs();
	    
	    $model = new \Models\ModifyAboutUs();
	    $aboutSlider = $model -> findSliderAbout();
	    //var_dump($aboutSlider);
	    
	    $model = new \Models\ModifyFooter();
	    $footer = $model -> findFooter();
	    $footerNetwork = $model -> findAllFooterNetwork();
	   
	    
		//appeler la vue 
		$template = "views/about.phtml";
		include 'views/layout_front_rc.phtml';



	}
}