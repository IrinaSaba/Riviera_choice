<?php

//démarrer le système de session
session_start();

//autoloader
spl_autoload_register(function($class){
	
	include str_replace('\\','/',lcfirst($class)).".php";
});

//vérifier si j'ai un paramètre page
if(!isset($_GET['page']))
{
	//lancer la page about
	$controller = new Controllers\AboutController();
	$controller -> display();
}
else
{
	//tester les valeurs possibles pour le paramètre
	switch($_GET['page'])
	{
		case 'about':
			//lancer la page about
			$controller = new Controllers\AboutController();
			$controller -> display();
		break;
		case 'admin':
			//include 'controllers/AdminController.php';
			$controller = new Controllers\AdminController();
			$controller -> display();
		break;
		case 'blog':
			//lancer la page blog
			$controller = new Controllers\BlogController();
			$controller -> display();
			break;
		case 'article':
			//lancer la page blog
			$controller = new Controllers\BlogArticleDetailController();
			if(!empty($_POST))
			{
				$controller -> AddComment();
			}
			else {
					$controller -> display();	
			     }
		break;	
		case 'dashboard':
			//lancer la page dashboard
			$controller = new Controllers\DashBoardController();
			$controller -> display();
		break;
		case 'services':
			//lancer la page services
			$controller = new Controllers\ServicesController();
			$controller -> display();
		break;
		case 'contact':
			$controller = new Controllers\ContactController();
			if(!empty($_POST))
			{
				$controller -> SubmitFormContact();
			}
			else {
					$controller -> display();	
				 }
		break;
		case 'modifyaboutus':
			//lancer la page modifyaboutus
			$controller = new Controllers\ModifyAboutUsController();
			if(!empty($_POST))
			{
				$controller ->submit();
			}
			else {
					$controller -> display();	
				 }
		break;
		case 'addsliderabout':
			//lancer la page blog
			$controller = new Controllers\ModifySliderAboutUsController();
			if(!empty($_POST))
			{
				$controller -> AddSlider();
			}
			else {
					$controller -> display();	
				 }
		break;	
		case 'deleteslider':
			$controller = new Controllers\ModifySliderAboutUsController();
			$controller -> deleteSliderPhotoAbout();
		break;
		case 'modifyslider':
			$controller = new Controllers\ModifySliderAboutUsController();
			if(!empty($_POST))
			{
				$controller -> submitSliderAbout();
			}
			else {
				$controller -> displayModifySliderForm();	
				 }
		break;		
		case 'modifyfooter':
			//lancer la page modifyfooter
			$controller = new Controllers\ModifyFooterController();
			if(!empty($_POST))
			{
				$controller -> submitFooter();
			}
			else {
					$controller -> display();	
				 }
		break;
		case 'modifynetwork':
				$controller = new Controllers\ModifyFooterNetworkController();
			if(!empty($_POST))
			{
				$controller -> submitNetworkFooterMod();
			}
			else {
					$controller -> display();	
				 }
		break;	
		case 'deletenetwork':
			$controller = new Controllers\ModifyFooterController();
			$controller -> delete();
		break;
		case 'createnetwork':
			$controller = new Controllers\AddFooterNetworkController();
			if(!empty($_POST))
			{
				$controller -> submitNetworkFooter();
			}
			else {
					$controller -> display();	
				 }
		break;
		case 'modifyblog':
			//lancer la page modifyblog
			$controller = new Controllers\ModifyBlogController();
			$controller -> display();
		break;
		case 'addnewart':
			//lancer la page addnewart
			$controller = new Controllers\ModifyBlogController();
			if(!empty($_POST))
			{
				$controller ->  AddNewArt();
			}	
			else {
				    $controller -> displayArt();
				 }
		break;
		case 'deletearticle':
			$controller = new Controllers\ModifyBlogController();
			$controller -> deleteArticle();
		break;
		case 'modifyarticle':
			$controller = new Controllers\ModifyBlogController();
			if(!empty($_POST))
			{
				$controller -> submitArticleCorrection();
			}
			else {
					$controller -> displayModifyFormArt();
				 }
		break;	
		case 'modifycomments':
			$controller = new Controllers\ModifyBlogController();
			$controller -> displayComments();
		break;	
		case 'deletecomments':
			$controller = new Controllers\ModifyBlogController();
			$controller -> deleteComment();
		break;		
		case 'showallcomments':
			$controller = new Controllers\ModifyBlogController();
			$controller -> displayAllComments();
		break;
		case 'modifycontact':
		$controller = new Controllers\ModifyContactController();
			if(!empty($_POST))
			{
				$controller -> submitContactCorrection();
			}
			else {
					$controller -> displayForm();	
				 }
		break;			
		case 'addnewsliderart':
				$controller = new Controllers\ModifyBlogController();
			if(!empty($_POST))
			{
				$controller -> AddSliderArt();
			}
			else {
				   $controller -> displayFormSliderArt();
				 }
		break;			
		case 'deletephotoarticleslider':
			$controller = new Controllers\ModifyBlogController();
			$controller -> deleteSliderPhoto();
		break;	
		case 'modifyphotoarticleslider':
						$controller = new Controllers\ModifyBlogController();
			if(!empty($_POST))
			{
				$controller -> ModifySliderPhotoArt();
			}
			else {
				   $controller -> displayFormSliderArtMod();
				 }
		break;
		case 'modifservices':
			$controller = new Controllers\ModifyServicesController();
			$controller -> display();	
		break;	
		case 'addnewservice':
			$controller = new Controllers\ModifyServicesController();
			if(!empty($_POST))
			{
				$controller -> AddNewService();
			}
			else {
					$controller -> displayAddNewService();
				 }
		break;		 
		case 'addnewtypeofservice':
			$controller = new Controllers\ModifyServicesController();
			if(!empty($_POST))
			{
				$controller -> AddNewTypeOfService();
			}
			else {
					$controller -> displayAddNewTypeOfService();	
				 }
		break;		 
		case 'addnewnetwork':
			$controller = new Controllers\ModifyServicesController();
			if(!empty($_POST))
			{
				$controller -> AddNewNetworkService();
			}
			else {
					$controller -> displayAddNewNetworkService();	
				 }
		break;		 
		case 'deleteservice':
			$controller = new Controllers\ModifyServicesController();
			$controller -> deleteService();
		break;
		case 'modifyservice':
			$controller = new Controllers\ModifyServicesController();
			if(!empty($_POST))
			{
				$controller -> SubmitService();
			}
			else {
					$controller -> displaySubmitService();
				 }
		break;	
		case 'deleteservicebyid':
			$controller = new Controllers\ModifyServicesController();
			$controller -> deleteListService();
		break;
		case 'deletenetworkbyid':
			$controller = new Controllers\ModifyServicesController();
			$controller -> deleteNetworkService();
		break;	
		case 'modifyservicebyid':
			$controller = new Controllers\ModifyServicesController();
			if(!empty($_POST))
			{
				$controller -> SubmitListService();
			}
			else {
					$controller -> displayListServiceCorrect();
				 }
		break;	
		case 'modifynetworkbyid':
			$controller = new Controllers\ModifyServicesController();
			if(!empty($_POST))
			{
				$controller -> SubmitNetworkService();
			}
			else {
					$controller -> displayNetworkService();
				 }
		break;
		case 'modifyadmin':
		$controller = new Controllers\ModifyAdminController();
			if(!empty($_POST))
			{
				$controller -> submitAdminForm();
			}
			else {
					$controller -> displayAdminForm();
				 }
		break;			
	}
}
