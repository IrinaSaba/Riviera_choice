<?php

namespace Controllers;

class BlogController
{
	public function display()
	{
		//appeler le bdd
	    $model = new \Models\ModifyFooter();
	    $footer = $model -> findFooter();
	    $footerNetwork = $model -> findAllFooterNetwork();
	    
	    $model = new \Models\Blog();
		$articles = $model -> FindAllArticles();
		$commentArticleNb = $model -> CountCommentsArticle();

		//appeler la vue 
		$template = "views/blog.phtml";
		include 'views/layout_front_rc.phtml';
	}
}