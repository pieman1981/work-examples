<?php

$t_aReturn = array();

switch($_GET['type'])
{
	case 'gallery' :

		switch ($_GET['page'])
		{
			case 'la-fortuna':
				$t_sDirect = '../images/Fortuna';
				break;

			case 'monteverde':
				$t_sDirect = '../images/MonteVerde';
				break;

			case 'manual-antonio':
				$t_sDirect = '../images/ManuelAntonio';
				break;

			case 'best-rest':
				$t_sDirect = '../images/Other';
				break;

		}

		if ($handle = opendir($t_sDirect))
		{
			while (false !== ($file = readdir($handle))) 
			{
				if ($file != "." && $file != "..")
					$t_aReturn[] = $t_sDirect . '/' . $file;
			}
	
			closedir($handle);
		}

		break;
}

echo json_encode($t_aReturn);
























?>