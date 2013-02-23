<?php

include('class.Database.php');
include('class.User.php');

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

		$t_oUser = new User();

		$t_oUser->setUsername($json->username);
		$t_oUser->setPassword($json->password);
		$t_oUser->setAdmin(isset($json->admin) ? $json->admin : 0);
		$t_oUser->save();

		echo $t_oUser->getJson();

        break;

    case 'GET':
		 // get item
		if (isset($_GET['id']))
		{
			$t_aUsers = $g_oDatabase->selectDatabase(array('*'),'users','id = ' . $_GET['id'], true);

			echo json_encode($t_aUsers);
		}
		//get all items
		else
		{
			$t_aUsers = $g_oDatabase->selectDatabase(array('*'),'users','1');
			echo json_encode($t_aUsers);
		}

        break;

    case 'PUT':
		// update item
		$jsonraw = file_get_contents("php://input");

		$json = json_decode($jsonraw,true);

		if (isset($_GET['id']))
		{
			$t_oUser = new User($json['id']);
			$t_oUser->setUsername($json['username']);
			$t_oUser->setPassword($json['password']);
			$t_oUser->setAdmin(isset($json['admin']) ? $json['admin'] : 0);

			$t_oUser->save();

			echo $t_oUser->getJson();
		}

        break;

    case 'DELETE':
		// delete item

		if (isset($_GET['id']))
		{
			$t_oUser = new User($_GET['id']);

			$t_oUser->destroy();

			$t_aUsers = $g_oDatabase->selectDatabase(array('*'),'users','1');
			echo json_encode($t_aUsers);
		}
        break;
}

?>