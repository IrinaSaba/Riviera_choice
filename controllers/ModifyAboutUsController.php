<?php

namespace Controllers;

class ModifyAboutUsController {
    // appeler la Trait SessionController
	use SessionController;

	public function __construct()
	{
		$this -> redirectIfNotAdmin();
	}
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
	  
        $template = 'views/ModifyAboutUs.phtml';
        include 'views/layout_front_rc.phtml';
	}
	//traitement du formulaire
	public function submit()
	{
		//si le formulaire a été soumis
	if (isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['history']) && !empty($_POST['history']))
	{
		//recuperer les données pour les mettre dans la base de données
		$title = htmlspecialchars($_POST['title']);
		$history = htmlspecialchars($_POST['history']);
		$nameImage = htmlspecialchars($_POST['nameImage']);
		if (empty($_FILES['image']['name'])) 
		{
		$image = htmlspecialchars($_POST['imageBdd']);
		} else {
			$image = "asset/img/{$_FILES['image']['name']}";
			move_uploaded_file ($_FILES['image']['tmp_name'], $image );
				}
		//mettre les datas en bdd
		$model = new \Models\ModifyAboutUs();
		$model -> ModifyAboutUs($title, $history, $nameImage, $image);
		header('location:index.php');
			exit;
	} else {
		//revenir sur le meme page	
		header("Location: ".$_SERVER["HTTP_REFERER"]);
		exit;	
		   }
	}	   
}	

    