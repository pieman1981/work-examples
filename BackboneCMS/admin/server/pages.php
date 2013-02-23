<?php

include('class.Database.php');
include('class.Page.php');

//database connection
$g_sHost = 'localhost';
$g_sUsername = 'root';
$g_sPassword = 'Arsenal81';
$g_sDatabase = 'backboneCMS';

$g_oDatabase = new Database($g_sHost, $g_sUsername, $g_sPassword, $g_sDatabase);




switch($_SERVER['REQUEST_METHOD']){
    case 'POST':
        // create new item
		$jsonraw = file_get_contents("php://input");

		$json = json_decode($jsonraw);

		$t_oPage = new Page();

		$t_oPage->setHeader($json->header);
		$t_oPage->setContent($json->content);
		$t_oPage->setName($json->name);
		$t_oPage->setMetaKeywords($json->meta_keywords);
		$t_oPage->setMetaDescription($json->meta_description);
		$t_oPage->save();

		echo $t_oPage->getJson();

        break;

    case 'GET':
		 // get item
		if (isset($_GET['id']))
		{
			$t_aPages = $g_oDatabase->selectDatabase(array('*'),'pages','id = ' . $_GET['id'], true);

			echo json_encode($t_aPages);
		}
		//get all items
		else
		{
			$t_aPages = $g_oDatabase->selectDatabase(array('*'),'pages','1');
			echo json_encode($t_aPages);
		}

        break;

    case 'PUT':
		// update item
		$jsonraw = file_get_contents("php://input");

		$json = json_decode($jsonraw,true);

		if (isset($_GET['id']))
		{
			$t_oPage = new Page($json['id']);
			$t_oPage->setHeader($json['header']);
			$t_oPage->setContent($json['content']);
			$t_oPage->setName($json['name']);
			$t_oPage->setMetaKeywords($json['meta-keywords']);
			$t_oPage->setMetaDescription($json['meta-description']);

			$t_oPage->save();

			echo $t_oPage->getJson();
		}

        break;

    case 'DELETE':
		// delete item

		if (isset($_GET['id']))
		{
			$t_oPage = new Page($_GET['id']);

			$t_oPage->destroy();

			$t_aPages = $g_oDatabase->selectDatabase(array('*'),'pages','1');
			echo json_encode($t_aPages);

			

		}
        break;
}

?>