<?php

namespace Models;

class Blog extends Database
{
    public function FindAllArticles()
    {
        	return $this->findAll("
        SELECT blog.id, title, SUBSTR(description,1,100) AS description100, SUBSTR(description,1,30) AS description30, src, alt, date, COUNT(comment) AS nb
        	FROM blog
        	LEFT JOIN comments ON blog.id=comments.id_article
          	GROUP BY blog.id
        	ORDER BY date DESC");
    }
    
    public function FindArticleById($id):?array
	{   
	    //requêtes sql qui permet de sélectionner l'arlicle by id 
		return $this -> findOne("
		SELECT blog.id, title, description, src, alt, date
		FROM blog 
		
		WHERE blog.id = ?",[$id]);
	}
	
	public function AddNewArt($title, $descript, $nameImage, $image) 
	{
		//requêtes sql qui permet l'ajout l'article
		$this -> query("INSERT INTO blog( title, description, alt, src, date) 
		VALUES (?,?,?,?,NOW())",[$title, $descript, $nameImage, $image]);
	}
	
		public function deleteArticle($id)
	{
		//requêtes sql qui delete Article
		$this -> query("DELETE FROM blog WHERE id = ? ",[$id]);
	}
	public function submitArticleCorrect($id, $title, $descript, $nameImage, $image, $date)
	{
		//requêtes sql qui permet modifier article
		$this -> query("UPDATE blog
		SET title = ?, description = ?, alt = ?, src = ?, date = ?
		WHERE blog.id = ?",[$title, $descript, $nameImage, $image, $date, $id]);
	}
	
	public function FindAllComment()
    {
        	return $this->findAll("
        	SELECT comments.id, name, comment, id_article, date_comment, blog.title AS title
            FROM comments
            INNER JOIN blog ON blog.id = comments.id_article
            ORDER BY date_comment");
    }
	
    public function FindAllComments($id)
    {
        	return $this->findAll("
        	SELECT comments.id, name, comment, id_article, date_comment
            FROM comments
            INNER JOIN blog ON blog.id = comments.id_article
            WHERE blog.id = ?
            ORDER BY date_comment DESC LIMIT 4"
            ,[$id]);
    }

     public function CountAllComments($id)
    {
        	return $this->findOne("
        	SELECT COUNT(comment) AS nb 
        	FROM comments 
            INNER JOIN blog ON comments.id_article=blog.id
        	WHERE blog.id = ?",[$id]);
    }
     public function CountCommentsArticle()
    {
        	return $this->findOne("
        	SELECT COUNT(comment) AS nb, blog.id
            FROM comments 
            INNER JOIN blog ON comments.id_article=blog.id
            WHERE blog.id = id_article
            GROUP BY blog.id");
    }
    public function FindAllCommentNumber()
    {
        	return $this->findOne("
        	SELECT COUNT(comment) AS nb
            FROM comments");
    }
    
    public function addComment($id, $nameUser, $commentaire)
	{
		//requêtes sql qui permet l'ajout de comment sur exacte article
		$this -> query("INSERT INTO comments( id_article, name, comment, date_comment) 
		VALUES (?,?,?,NOW())",[$id, $nameUser, $commentaire]);
	}
	
	public function deleteComment($id)
	{
		//requêtes sql qui delete exacte commentaire
		$this -> query("DELETE FROM comments WHERE id = ? ",[$id]);
	}
	
		public function FindSliderArticle($id)
    {
        	return $this->findAll("
        	SELECT sliderarticle.id, sliderarticle.src AS srcs, sliderarticle.alt AS alts, id_article, blog.title AS titles
            FROM sliderarticle
            INNER JOIN blog ON blog.id = sliderarticle.id_article
            WHERE blog.id = ?"
            ,[$id]);
    }
	public function FindAllArticleSlider()
    {
        	return $this->findAll("
        	SELECT sliderarticle.id, blog.title AS title, sliderarticle.src AS srcs, sliderarticle.alt AS alts, id_article, blog.date
            FROM sliderarticle
            INNER JOIN blog ON blog.id = sliderarticle.id_article
        	ORDER BY date DESC");
    }
    
    	public function FindSliderArticleByIdPhoto($id)
    {
        	return $this->findOne("
        	SELECT sliderarticle.id, sliderarticle.src AS srcs, sliderarticle.alt AS alts, id_article, blog.title AS titles, blog.id, blog.date AS dates
            FROM sliderarticle
            INNER JOIN blog ON blog.id = sliderarticle.id_article
            WHERE sliderarticle.id = ?"
            ,[$id]);
    }
    
     public function addSliderArticle($nameImage, $image, $nameart)
	{
		//requêtes sql qui permet l'ajout la photo sur exacte article
		$this -> query("INSERT INTO sliderarticle (alt, src, id_article) 
		VALUES (?,?,?)",[$nameImage, $image, $nameart]);
	}
    
    	public function deletePhotoSlideArt($id)
	{
		//requêtes sql qui delete Network
		$this -> query("DELETE FROM sliderarticle WHERE id = ? ",[$id]);
	}
	
	public function ModifyPhotoSliderArt($id, $nameart, $nameImage, $image)
	{
		//requêtes sql qui permet modifier article
		$this -> query("UPDATE sliderarticle
		SET id_article = ?, alt = ?, src = ?
		WHERE id = ?",[$nameart, $nameImage, $image, $id]);
	}
}