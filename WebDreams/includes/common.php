<?php
//define('SITEPATH','http://localhost/web-dreams/');
define('SITEPATH','http://www.web-dreams.co.uk/');
//define('SITEPATH','http://www.simonlait.info/clients/web-dreams/');
define('EMAIL','enquires@web-dreams.co.uk');
$t_bSend = true;
function cleanQuery($string)
{
  if(get_magic_quotes_gpc())  // prevents duplicate backslashes
  {
    $string = stripslashes($string);
  }
  $string = strip_tags($string);
 
  return $string;
}

function checkEmail($email) {
  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  	return false;
  else 
   	return true;
}

?>