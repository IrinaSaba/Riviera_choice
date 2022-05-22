<?php

namespace Controllers;

Trait SessionController
{
	public function redirectIfNotAdmin()
	{
		if(!isset($_SESSION['admin']))
		{
			header('location:about');
		}
	}

}