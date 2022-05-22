<?php

namespace Controllers;

class ModifyServicesController {
    
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
		
		$model = new \Models\Services();
		$services = $model -> FindAllServices();
		/*var_dump($services);*/
		$listservices = $model -> FindAllListServicesByServise();
		/*var_dump($listservices);*/
		$serviceNetwork = $model -> findAllServiceNetwork();
		/*var_dump($serviceNetwork);*/
	  
        $template = 'views/ModifyServices.phtml';
        include 'views/layout_front_rc.phtml';
	}
	
	public function AddNewService()
	{
	if (isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['history']) && !empty($_POST['history'])&& isset($_POST['title_service']) && !empty($_POST['title_service']))
	{	
		/*var_dump($_post);*/
		$title = htmlspecialchars($_POST['title']);
		$descript = htmlspecialchars($_POST['history']);
		$titleService = htmlspecialchars($_POST['title_service']);
		$nameImage = htmlspecialchars($_POST['nameImage']);
		if (empty($_FILES['image']['name'])) 
		{
		$image = htmlspecialchars($_POST['imageBdd']);
		} else {
			$image = "asset/img/{$_FILES['image']['name']}";
			move_uploaded_file ($_FILES['image']['tmp_name'], $image );
		       }
		
		//mettre les datas en bdd
		$model = new \Models\Services();
		$model -> AddNewService($title, $descript, $titleService, $nameImage, $image);
		
		header('location:modifservices');
			exit;
		} else {
			header("Location: ".$_SERVER["HTTP_REFERER"]);
			exit;	
				}
	}	
		
	public function displayAddNewService()
	{
		$model = new \Models\ModifyFooter();
	    $footer = $model -> findFooter();
		$footerNetwork = $model -> findAllFooterNetwork();
		$Networkname = $model ->  findNameNetwork();
		
		$model = new \Models\Services();
		$services = $model -> FindAllServices();
		
		$template = 'views/AddNewService.phtml';
        include 'views/layout_front_rc.phtml';
	}
	
	public function displayAddNewTypeOfService()
	{
		$model = new \Models\ModifyFooter();
	    $footer = $model -> findFooter();
		$footerNetwork = $model -> findAllFooterNetwork();
		
		$model = new \Models\Services();
		$services = $model -> FindAllServices();
		/*var_dump($services);*/
		
		$template = 'views/AddNewTypeOfService.phtml';
        include 'views/layout_front_rc.phtml';
	}
	
	public function AddNewTypeOfService()
	{
	if (isset($_POST['typeService']) && !empty($_POST['typeService']) && !empty( $_POST['list_services']))
	{	
		$typeService = htmlspecialchars($_POST['typeService']);
		$listService = htmlspecialchars($_POST['list_services']);
		
		//mettre les datas en bdd
		$model = new \Models\Services();
		$model -> AddNewTypeOfService($typeService, $listService);
	
	header('location:modifservices');
		exit;
	} else {
		header("Location: ".$_SERVER["HTTP_REFERER"]);
		exit;	
		   }
	}
		
	public function displayAddNewNetworkService()
	{
		$model = new \Models\ModifyFooter();
	    $footer = $model -> findFooter();
		$footerNetwork = $model -> findAllFooterNetwork();
		$Networkname = $model ->  findNameNetwork();
		
		$model = new \Models\Services();
		$services = $model -> FindAllServices();
		/*var_dump($services);*/
		$serviceNetwork = $model -> findAllServiceNetwork();
		/*var_dump($serviceNetwork);*/
		
		$template = 'views/AddNewNetworkService.phtml';
        include 'views/layout_front_rc.phtml';
	}
	
	public function AddNewNetworkService()
		
	{
	if (isset($_POST['Service']) && !empty($_POST['Service']) && !empty( $_POST['nameNetwork']) && !empty( $_POST['network']))
	{	
		$service = htmlspecialchars($_POST['Service']);
		$nameNetwork = htmlspecialchars($_POST['nameNetwork']);
		$network = htmlspecialchars($_POST['network']);
		
		//mettre les datas en bdd
		$model = new \Models\Services();
		$model -> AddNewNetworkService($service, $nameNetwork, $network);
	
		header('location:index.php?page=modifservices');
		exit;
	} else {
		header("Location: ".$_SERVER["HTTP_REFERER"]);
		exit;	
		   }
	}		
	public function deleteService()
	{
		$model = new \Models\Services();
	    $model -> deleteService(htmlspecialchars($_GET['id']));
	 
		header('location:modifservices');
				exit;
	}
	public function displaySubmitService()
	{
		$model = new \Models\ModifyFooter();
	    $footer = $model -> findFooter();
	    $footerNetwork = $model -> findAllFooterNetwork();
	    
	    $model = new \Models\Services();
	    $service = $model ->  FindServiceById(htmlspecialchars($_GET['id']));
	    //var_dump($_GET['id']);
		$listservices = $model -> FindListServicesByIdService(htmlspecialchars($_GET['id']));
		//var_dump($listservices);
		$nameNetworks = $model -> FindNetworkById(htmlspecialchars($_GET['id']));
		//var_dump($nameNetworks);
		
        $template = 'views/ModifyServiceById.phtml';
        include 'views/layout_front_rc.phtml';
	}
	public function deleteListService()
	{
		$model = new \Models\Services();
	    $model -> deleteListService(htmlspecialchars($_GET['id']));
	 
		header("Location: ".$_SERVER["HTTP_REFERER"]);
		exit;
	}
	public function deleteNetworkService()
	{
		$model = new \Models\Services();
	    $model -> deleteNetworkService(htmlspecialchars($_GET['id']));
		var_dump($_GET['id']);
		
		header("Location: ".$_SERVER["HTTP_REFERER"]);
		exit;
	}
	
	public function SubmitService()
	{
	if (isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['description']) && !empty( $_POST['description']) && isset($_POST['title_service']) && !empty( $_POST['title_service']) && isset($_POST['nameImage']) && !empty( $_POST['nameImage']))
	{	
		$title = htmlspecialchars($_POST['title']);
		$descript = htmlspecialchars($_POST['description']);
		$titleService = htmlspecialchars($_POST['title_service']);
		$nameImage = htmlspecialchars($_POST['nameImage']);
		if (empty($_FILES['image']['name'])) 
		{
		$image = htmlspecialchars($_POST['imageBdd']);
		} else {
		$image = "asset/img/{$_FILES['image']['name']}";
		move_uploaded_file ($_FILES['image']['tmp_name'], $image );
	}
		//mettre les datas en bdd
		$model = new \Models\Services();
		$model -> submitServiceCorrect(htmlspecialchars($_GET['id']), $title, $descript, $nameImage, $image, $titleService);
		
		header('location:modifservices');
			exit;
	} else {
		header("Location: ".$_SERVER["HTTP_REFERER"]);
		exit;	
		   }
	}
		
	public function displayListServiceCorrect()
	{
		$model = new \Models\ModifyFooter();
	    $footer = $model -> findFooter();
	    $footerNetwork = $model -> findAllFooterNetwork();
	    
	    $model = new \Models\Services();
	   	$service = $model -> FindOneServiceById(htmlspecialchars($_GET['id']));
		//var_dump($service);
	
        $template = 'views/ModifyTypeOfService.phtml';
        include 'views/layout_front_rc.phtml';
	}
		
	public function SubmitListService()
	{
	if (isset($_POST['list_services']) && !empty($_POST['list_services']))
	{	
		$listService = $_POST['list_services'];
	
		//mettre les datas en bdd
		$model = new \Models\Services();
		$model -> submitListServiceCorrect(htmlspecialchars($_GET['id']), $listService);
		
		header('location:modifservices');
			exit;
	} else {
		header("Location: ".$_SERVER["HTTP_REFERER"]);
		exit;	
		  }
	}
	public function displayNetworkService()
	{
		$model = new \Models\ModifyFooter();
	    $footer = $model -> findFooter();
	    $footerNetwork = $model -> findAllFooterNetwork();
	    
	    $model = new \Models\Services();
	   	$NetworkId = $model -> FindOneNetworkById(htmlspecialchars($_GET['id']));
		//var_dump($NetworkId);
		$Networkname =$model -> FindNameNetwork();
		//var_dump($Networkname);
		
        $template = 'views/ModifNetworkService.phtml';
        include 'views/layout_front_rc.phtml';
	}
	public function SubmitNetworkService()
	{
	if (isset($_POST['nameNetwork']) && !empty($_POST['nameNetwork']) && isset($_POST['networkUrl']) && !empty($_POST['networkUrl']))
	{	
		$networkName = htmlspecialchars($_POST['nameNetwork']);
		$networkUrl = htmlspecialchars($_POST['networkUrl']);
	
		//mettre les datas en bdd
		$model = new \Models\Services();
		$model -> submitNetworkServiceCorrect(htmlspecialchars($_GET['id']), $networkName, $networkUrl);
		
		header('location:modifservices');
		exit;
	} else {
		header("Location: ".$_SERVER["HTTP_REFERER"]);
		exit;	
		  }
	}
}	

    