<?php

namespace Controllers;

class ModifySliderAboutUsController {
    
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
	  
        $template = 'views/AddSliderAbout.phtml';
        include 'views/layout_front_rc.phtml';
	}
	//traitement du formulaire
	public function AddSlider()
	{
		//préparer les données pour les mettre dans la base de données
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
		$model -> AddNewSliderAbout($nameImage, $image);
		header('location:modifyaboutus');
			exit;
	} 
	public function deleteSliderPhotoAbout()
	{
		$model = new \Models\ModifyAboutUs();
	    $model -> deletePhotoAbout(htmlspecialchars($_GET['id']));
	    
	    header('location:modifyaboutus');
				exit;
	}
	
	public function submitSliderAbout()
	{
		//préparer les données pour les mettre dans la base de données
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
		$model -> ModifySliderAbout(htmlspecialchars($_GET['id']), $nameImage, $image);
		
		header('location:modifyaboutus');
			exit;
			}
				
	public function displayModifySliderForm()
	{
		$model = new \Models\ModifyAboutUs();
	    $aboutPhoto = $model -> findSliderAboutById(htmlspecialchars($_GET['id']));
		
	    $model = new \Models\ModifyFooter();
	    $footer = $model -> findFooter();
		$footerNetwork = $model -> findAllFooterNetwork();
	  
        $template = 'views/ModifySliderAbout.phtml';
        include 'views/layout_front_rc.phtml';
	}		
}	

    