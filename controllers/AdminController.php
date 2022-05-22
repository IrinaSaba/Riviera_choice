<?php

namespace Controllers;

class AdminController
{
	  private $message1;
	  private $message2;
	
	public function __construct()
	{
		$this -> message1 = "";
		$this -> message2 = "";
	//verifier si l'admin est connectee	
		if(!empty($_POST))
		{
		    $this -> submit();
	    }
	    if(isset($_GET['action']) && $_GET['action'] == 'deco')
		{
			$this -> disconnect();
		}
		
	}

	public function display()
	{
		//appeler le base de donne
		$model = new \Models\ModifyFooter();
	    $footer = $model -> findFooter();
	    $footerNetwork = $model -> findAllFooterNetwork();
	
		//afficher le formulaire de connexion
		$template = "views/admin.phtml";
		include 'views/layout_front_rc.phtml';

	}
	public function disconnect()
	{
	    //je déconnecte l'admin
			session_destroy();
			header('location:index.php');
			exit;
	}
	public function submit() 
	{
			$login = htmlspecialchars($_POST['login']);
			$pw = htmlspecialchars($_POST['pw']);
			
			//comparer avec ce que j'ai en bdd
			$model = new \Models\Admin();
			//aller chercher les infos de admin qui essaye de se connecter
			$admin = $model -> getAdminByLogin($login);
				
			//si l'identifiant existe dans la base alors âdmin contiendra les infos de cet admin
			//sinon $admin contiendra false
			
			if(!$admin)
			{
				$this -> message1 = "You made mistake in login";
			}
			else
			{
				//vérifier le mot de passe
				if(password_verify($pw,$admin['password']))
				{
					//le mot de passe correspond
					//connecter l'utilisateur
					$_SESSION['admin'] = $admin['name'];
					//redirige vers la page tableau de bord du backoffice
					header('location:index.php?page=dashboard');
					exit;
				}
				else
				{
					////le mot de passe ne correspond pas
					$this -> message2 = "You made mistake in password";
				}
			}
	}
			
}