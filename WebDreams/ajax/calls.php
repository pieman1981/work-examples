<?php
require_once("../includes/common.php");
switch ($_GET['type'])
{
	//get quote form
	case 'getquote':
		$t_aPost = $_POST;
		$t_aNames = array('name','email','phone','description');
		foreach ($t_aNames as $value)
		{
			if (empty($t_aPost[$value]))
			{
				echo '<span class="error">Form not submitted - Please enter your ' .$value.'</span>';
				exit();
			}
			if ($value == 'email')
			{
				if (!checkEmail($t_aPost[$value]))
				{
					echo  '<span class="error">Form not submitted - ' . $value.' is in the wrong format</span><br />';
					exit();
				}
			}	
		}
		//no errors then send email
		$subject = 'Enquiry From Website Quote Form';
		$msg = "Hi \n";
		$msg .= "You have recieved an enquiry from the web-dreams quote form \n";
		foreach ($t_aPost as $key => $val)
		{
			$msg .= $key . ': ' .cleanQuery($val) . "\n";
		}
		$msg .= "Kind Regards";
		
		if ($t_bSend)
			mail(EMAIL, $subject, $msg, 'From:' . $t_aPost['email']);
		echo '<span class="success">Form submitted - We will be in contact with you shortly</span>';
		break;
		
	//get quote form
	case 'contactus':
		$t_aPost = $_POST;
		$t_aNames = array('name'=>'name2','email'=>'email2','phone'=>'phone2','comments'=>'comments');
		foreach ($t_aNames as $key => $value)
		{
			if (empty($t_aPost[$value]))
			{
				echo '<span class="error">Form not submitted - Please enter your ' .$key.'</span>';
				exit();
			}
			if ($value == 'email')
			{
				if (!checkEmail($t_aPost[$value]))
				{
					echo  '<span class="error">Form not submitted - ' . $value.' is in the wrong format</span><br />';
					exit();
				}
			}	
		}
		//no errors then send email
		$subject = 'Enquiry From Website Contact Form';
		$msg = "Hi \n";
		$msg .= "You have recieved an enquiry from the web-dreams contact form \n";
		foreach ($t_aPost as $key => $val)
		{
			$msg .= $key . ': ' . cleanQuery($val) . "\n";
		}
		$msg .= "Kind Regards";
		
		if ($t_bSend)
			mail(EMAIL, $subject, $msg, 'From:' . $t_aPost['email']);
		echo '<span class="success">Form submitted - We will be in contact with you shortly</span>';
		break;
	
	//help button content
	case 'help':
		switch ($_GET['section'])
		{
			case 'type':
				echo 'A web application is an application that is run on the web that performs a specfic task.';
			break;
			case 'pages':
				echo 'A 1-3 page site would normally include a home page, about us page and a contact us page. A 4-10 page site would have more pages about your company, and a 10+ page site would typically be required if you have multiple products / services that would have a page for each.';
			break;
			case 'cms':
				echo 'A content management system is a secure part of your site where you are able to log into and control the content of the pages on your site. This might be to update existing pages or create new ones. This would be useful if you constantly add new products to the site.';
			break;
			case 'ecom':
				echo 'This is called an ecommerce site and allows customers to purchase your items online.';
			break;
			case 'bespoke':
				echo 'One of our talented designers will collaborate with you and create a custom design related to the branding of your business - unique to the web. A cheaper option is to use one of our template designs and change the colours to match your brand';
			break;
			case 'logo':
				echo 'Do you require a fresher, more modern logo to go with your brand new website / web application.';
			break;
			case 'google':
				echo 'Ia it important for your site to appear high on Google when a potential customer types in key words relating to your business.';
			break;
			case 'images':
				echo 'Do you have images that we can use to make the site, or do you what us to supply images for you.';
			break;
			case 'url':
				echo 'Have you purchased the URL that you want the site to be found on eg. mysite.com. If not, we can purchase this for you. To see if the URL is available visit <a href="http://www.godaddy.com/domains/search.aspx" target="_blank">GoDaddy\'s Domain Search</a> Page';
			break;
			case 'hosting':
				echo 'The files for your site have to be hosted on an external Linux server. If you have not purchased this, we can do it for you.';
			break;
		}
	
		break;
	//instant quote ajax call
	case 'quote':
		$t_aPost = $_POST;
		$t_iQuote = 300;
		
		switch($t_aPost['service'])
		{
			case 1:
				$t_iQuote += 0;
				break;
			
			case 2:
				$t_iQuote += 200;
				break;
		}
		
		switch($t_aPost['page'])
		{
			case 1:
				$t_iQuote += 0;
				break;
			
			case 2:
				$t_iQuote += 150;
				break;
				
			case 3:
				$t_iQuote += 250;
				break;
		}
		
		switch($t_aPost['cms'])
		{
			case 'n':
				$t_iQuote += 0;
				break;
			
			case 'y':
				$t_iQuote += 250;
				break;
		}
		
		switch($t_aPost['ecomm'])
		{
			case 'n':
				$t_iQuote += 0;
				break;
			
			case 'y':
				$t_iQuote += 750;
				break;
		}
		
		switch($t_aPost['bespoke'])
		{
			case 'n':
				$t_iQuote += 0;
				break;
			
			case 'y':
				$t_iQuote += 150;
				break;
		}
		
		switch($t_aPost['logo'])
		{
			case 'n':
				$t_iQuote += 0;
				break;
			
			case 'y':
				$t_iQuote += 50;
				break;
		}
		
		switch($t_aPost['google'])
		{
			case 'n':
				$t_iQuote += 0;
				break;
			
			case 'y':
				$t_iQuote += 100;
				break;
		}
		
		switch($t_aPost['images'])
		{
			case 'n':
				$t_iQuote += 0;
				break;
			
			case 'y':
				$t_iQuote += 50;
				break;
		}
		
		switch($t_aPost['url'])
		{
			case 'n':
				$t_iQuote += 0;
				break;
			
			case 'y':
				$t_iQuote += 20;
				break;
		}
		
		switch($t_aPost['host'])
		{
			case 'n':
				$t_iQuote += 0;
				break;
			
			case 'y':
				$t_iQuote += 100;
				break;
		}
		
		
		
		echo $t_iQuote;
	break;


}


?>