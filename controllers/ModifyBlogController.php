<?php

namespace Controllers;

class ModifyBlogController {
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
		
		$model = new \Models\Blog();
	    $articles = $model -> FindAllArticles();
		//var_dump($articles);
	  
        $template = 'views/ModifyBlog.phtml';
        include 'views/layout_front_rc.phtml';
	}
	
	public function AddNewArt()
	{
		//si le formulaire a été soumis
	if ((isset( $_POST['title']) && !empty($_POST['title'])) && isset($_POST['history']) && !empty( $_POST['history']))
	{	
		//préparer les données pour les mettre dans la base de données
		$title = htmlspecialchars($_POST['title']);
		$descript = htmlspecialchars($_POST['history']);
		$nameImage = htmlspecialchars($_POST['nameImage']);
	if (empty($_FILES['image']['name'])) 
	{
		$image = htmlspecialchars($_POST['imageBdd']);
	} else {
		$image = "asset/img/{$_FILES['image']['name']}";
		move_uploaded_file ($_FILES['image']['tmp_name'], $image );
		   }
		//mettre les datas en bdd
		$model = new \Models\Blog();
		$model -> AddNewArt($title, $descript, $nameImage, $image);
		header('location:modifyblog');
			exit;
	} else {
		//revenir sur le meme page	
		header("Location: ".$_SERVER["HTTP_REFERER"]);
		exit;	
		   }
	}	   
	public function displayArt()
	{
		$model = new \Models\ModifyFooter();
	    $footer = $model -> findFooter();
		$footerNetwork = $model -> findAllFooterNetwork();
		
		$model = new \Models\Blog();
	    $articles = $model -> FindAllArticles();
		//var_dump($articles);
		
		$template = 'views/AddNewArt.phtml';
        include 'views/layout_front_rc.phtml';
	}
	
	public function deleteArticle()
	{
		$model = new \Models\Blog();
	    $model -> deleteArticle(htmlspecialchars($_GET['id']));
	 
		header('location:modifyblog');
				exit;
	}	
	
	public function submitArticleCorrection()
	{
	if (isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['descript']) && !empty( $_POST['descript']) && isset($_POST['nameImage']) && !empty( $_POST['nameImage']) && isset($_POST['date']) && !empty( $_POST['date']))
	{	
		$title = htmlspecialchars($_POST['title']);
		$descript = htmlspecialchars($_POST['descript']);
		$nameImage = htmlspecialchars($_POST['nameImage']);
		if (empty($_FILES['image']['name'])) 
		{
			$image = htmlspecialchars($_POST['imageBdd']);
		} else {
			$image = "asset/img/{$_FILES['image']['name']}";
			move_uploaded_file ($_FILES['image']['tmp_name'], $image );
			   }
		$date = $_POST['date'];	
		
			//mettre les datas en bdd
			$model = new \Models\Blog();
			$model -> submitArticleCorrect(htmlspecialchars($_GET['id']), $title, $descript, $nameImage, $image, $date);
			
			header('location:modifyblog');
				exit;
		} else {
			//revenir sur le meme page	
			header("Location: ".$_SERVER["HTTP_REFERER"]);
			exit;	
			 }
	}
		
	public function displayModifyFormArt()
	{
		$model = new \Models\ModifyFooter();
	    $footer = $model -> findFooter();
	    $footerNetwork = $model -> findAllFooterNetwork();
	    
	    $model = new \Models\Blog();
	    $article = $model ->  FindArticleById($_GET['id']);
		//var_dump($article);
        $template = 'views/ModifyArticle.phtml';
        include 'views/layout_front_rc.phtml';
	}
	
	public function displayComments()
	{
		$model = new \Models\ModifyFooter();
	    $footer = $model -> findFooter();
	    $footerNetwork = $model -> findAllFooterNetwork();
	    
	    $model = new \Models\Blog();
	    $article = $model ->  FindArticleById(htmlspecialchars($_GET['id']));
	    $commentes = $model -> FindAllComments(htmlspecialchars($_GET['id']));
	    $commentsnb = $model -> CountAllComments(htmlspecialchars($_GET['id']));
	    //var_dump($commentes);
		//var_dump($article);
        $template = 'views/ModifyComments.phtml';
        include 'views/layout_front_rc.phtml';
	}
	
	public function deleteComment()
	{
		$model = new \Models\Blog();
	    $model -> deleteComment(htmlspecialchars($_GET['id']));
	    
	    header("Location: ".$_SERVER["HTTP_REFERER"]);
		exit;
	}
	
	public function displayAllComments()
	{
		$model = new \Models\ModifyFooter();
	    $footer = $model -> findFooter();
	    $footerNetwork = $model -> findAllFooterNetwork();
	    
	    $model = new \Models\Blog();
	    $allcomments = $model -> FindAllComment();
	    $commentsNb = $model -> FindAllCommentNumber();
	    //var_dump($allcomments);
	    
	    $template = 'views/ShowAllComments.phtml';
        include 'views/layout_front_rc.phtml';
	}
	
	public function AddSliderArt()
		
	{
		if (isset($_POST['nameImage']) && !empty($_POST['nameImage']) && isset($_POST['article']) && !empty($_POST['article']))
		{			
		$nameImage = htmlspecialchars($_POST['nameImage']);
		if (empty($_FILES['image']['name'])) 
		{
		$image = htmlspecialchars($_POST['imageBdd']);
		} else {
			$image = "asset/img/{$_FILES['image']['name']}";
			move_uploaded_file ($_FILES['image']['tmp_name'], $image );
			$nameart = htmlspecialchars($_POST['article']);
			   }
		//mettre les datas en bdd
		$model = new \Models\Blog();
		$model -> addSliderArticle($nameImage, $image, $nameart);
		
			header("Location: ".$_SERVER["HTTP_REFERER"]);
			exit;	
		} else {
			header("Location: ".$_SERVER["HTTP_REFERER"]);
			exit;	
		  }
	}
		
	public function displayFormSliderArt()
	{
		$model = new \Models\ModifyFooter();
	    $footer = $model -> findFooter();
	    $footerNetwork = $model -> findAllFooterNetwork();
	    
	    $model = new \Models\Blog();
	    $articlenames = $model ->  FindAllArticles();
	    //var_dump($articlenames);
	    $articleslider = $model -> FindAllArticleSlider();
	    //var_dump( $articleslider);
	     
        $template = 'views/AddSliderArticle.phtml';
        include 'views/layout_front_rc.phtml';
	}
	
	public function deleteSliderPhoto()
	{
		$model = new \Models\Blog();
	    $model -> deletePhotoSlideArt(htmlspecialchars($_GET['id']));
	    
	    header('location:addnewsliderart');
				exit;
	}
	
	public function ModifySliderPhotoArt()
		
	{
	if (isset($_POST['article']) && !empty($_POST['article']) && isset($_POST['nameImage']) && !empty($_POST['nameImage']) &&isset($_POST['imageBdd']) && !empty($_POST['imageBdd']))
	{	
		$nameart = htmlspecialchars($_POST['article']);		
		$nameImage = htmlspecialchars($_POST['nameImage']);
	if (empty($_FILES['image']['name'])) 
	{
	$image = htmlspecialchars($_POST['imageBdd']);
	} else {
		$image = "asset/img/{$_FILES['image']['name']}";
		move_uploaded_file ($_FILES['image']['tmp_name'], $image );
	       }
		//mettre les datas en bdd
		$model = new \Models\Blog();
		$model -> ModifyPhotoSliderArt(htmlspecialchars($_GET['id']), $nameart, $nameImage, $image);
		
		header("Location: ".$_SERVER["HTTP_REFERER"]);
		exit;
	 } else {
		header("Location: ".$_SERVER["HTTP_REFERER"]);
		exit;	
			 }
	}
		
	public function displayFormSliderArtMod()
	{
		$model = new \Models\ModifyFooter();
	    $footer = $model -> findFooter();
	    $footerNetwork = $model -> findAllFooterNetwork();
	    
	    $model = new \Models\Blog();
	    $articlenames = $model ->  FindAllArticles();
	    //var_dump($articlenames);
	    $articleslider = $model -> FindAllArticleSlider();
	    //var_dump($articleslider);
	    $articlesliderId = $model -> FindSliderArticleByIdPhoto(htmlspecialchars($_GET['id']));
	    //var_dump($articlesliderId);
	   
        $template = 'views/ModifySliderArticle.phtml';
        include 'views/layout_front_rc.phtml';
	}
}	

    