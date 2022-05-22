<?php

namespace Controllers;

class BlogArticleDetailController
{
	public function display()
	{
	    $model = new \Models\ModifyFooter();
	    $footer = $model -> findFooter();
	    $footerNetwork = $model -> findAllFooterNetwork();
	    
	    //chercher les info sur le bdd pour exact id
	    $model = new \Models\Blog();
		$articl = $model -> FindArticleById(htmlspecialchars($_GET['id']));
		$commentes = $model -> FindAllComments(htmlspecialchars($_GET['id']));
		$commentsnb = $model -> CountAllComments(htmlspecialchars($_GET['id']));
		$sliderarticle = $model -> FindSliderArticle(htmlspecialchars($_GET['id']));
		//var_dump($sliderarticle);
		//appeler la vue 
		$template = "views/blogArticleDetail.phtml";
		include 'views/layout_front_rc.phtml';

	}
	public function AddComment()
	{
		//si le formulaire a été soumis
	if ((isset( $_POST['nameUser']) && !empty($_POST['nameUser'])) && !empty( $_POST['commentaire']))
	{	
		//préparer les données pour les mettre dans la base de données
		$nameUser = htmlspecialchars($_POST['nameUser']);
		$commentaire = htmlspecialchars($_POST['commentaire']);
		
		//mettre les datas en bdd
		$model = new \Models\Blog();
		$model -> addComment(htmlspecialchars($_GET['id']), $nameUser, $commentaire);
			
		//revenir sur le meme page	
		header("Location: ".$_SERVER["HTTP_REFERER"]);
		exit;
	} else {
		//revenir sur le meme page	
		header("Location: ".$_SERVER["HTTP_REFERER"]);
		exit;	
		   }
	}  

}