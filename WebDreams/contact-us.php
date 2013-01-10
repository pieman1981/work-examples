<?php require_once("includes/common.php"); 
$t_bShowTwitter = false;
$t_sError = '';
if (isset($_POST['submit'])) 
{
	$t_aPost = $_POST;
	$t_aCleanPost = array();
	$t_aNames = array('name','email','phone','comments');
	
	foreach ($t_aNames as $value)
	{
		if (empty($t_aPost[$value]))
		{
			$t_sError .=  '<span class="error">Form not submitted - Please enter your ' .$value.'</span><br />';
		}
		if ($value == 'email')
		{
			if (!checkEmail($t_aPost[$value]))
				$t_sError .= '<span class="error">Form not submitted - ' . $value.' is in the wrong format</span><br />';
		}	
	}
	
	if ($t_sError == '')
	{
		foreach ($t_aPost as $key => $value)
		{
			if ($key != 'submit')
				$t_aCleanPost[$key] = cleanQuery($value);
		}
	
		$subject = 'Enquiry From Website Contact Form';
		$msg = '';
		foreach ($t_aCleanPost as $key => $value)
		{
			$msg .= $key . ' : ' . $value . "\n";
		}
		
		if ($t_bSend)
			mail(EMAIL, $subject, $msg, 'From:' . $t_aCleanPost['email']);
			
		unset($t_aPost);
		
		$t_sError .= '<span class="success">Your from has been submitted to us. Thank you for contacting web-dreams.co.uk</span>';
	}

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Contact web-dreams.co.uk</title>
		
		<meta name="keywords" content="web-dreams.co.uk, contact" />
		<meta name="description" content="Contact web-dreams.co.uk now on 07791350267 or enquiries@web-dreams.co.uk to discuss your web site options." />
		<meta name="robot" content="index, follow" />
		<meta name="author" content="web-dreams.co.uk" />
		<?php require_once("includes/styles.php"); ?>
        <link rel="canonical" href="<?php echo SITEPATH ?>contact-us" />
		
		
    </head>
    <body>
    <div id="bodyContainer">
    	<div id="mainContainer">
        	<?php require_once("includes/header.php"); ?>
            <div id="mainContent">
            	<?php require_once("includes/leftNav.php"); ?>
               
               <div id="rightContent">
               		<?php require_once("includes/getQuote.php"); ?>	
                    
                    <div class="mainContent">
                    	<h1 class="special">Contact Web-dreams.co.uk</h1>
                        
                       	<div class="quoteText"><table class="nomargin"><tr><td><img src="<?php SITEPATH ?>images/icoPhone.png" alt="Phone" title="Phone" /></td><td class="con">07791350267</td><td><img src="<?php SITEPATH ?>images/icoNotes.png" alt="Phone" title="Phone" /></td><td class="con">enquires@web-dreams.co.uk</td></tr></table></div>
                        
                        <p>Alternately, fill in <strong>ALL FIELDS</strong> of the form below and we will get back to you if required</p>
                        
                        <p><?php echo $t_sError; ?></p>
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" id="ContactForm" >
                        <div class="row">
                            <div class="input"><label for="name3">Name:</label></div>
                            <div class="label2"><input type="text" class="text" name="name" id="name3" value="<?php if (isset($t_aPost['name'])) echo $t_aPost['name'];?>" /></div>
                            <div class="clearer"></div>
                          
                        </div>
                        <div class="row">
                            <div class="input"><label for="email4">Email:</label></div>
                            
                            <div class="label2"><input type="text" class="text" name="email" id="email4" value="<?php if (isset($t_aPost['email'])) echo $t_aPost['email'];?>"/></div>
                            <div class="clearer"></div>
                          
                        </div>
                        <div class="row">
                            <div class="input"><label for="phone5">Phone:</label></div>
                            
                             <div class="label2"><input type="text" class="text" name="phone" id="phone5" value="<?php if (isset($t_aPost['phone'])) echo $t_aPost['phone'];?>"/></div>
                              <div class="clearer"></div>
                          
                        </div>
                        <div class="row">
                            <div class="input"><label for="comments6">Comments:</label></div>
                            
                            <div class="label2"><textarea name="comments" id="comments6" rows="0" cols="0"><?php if (isset($t_aPost['comments'])) echo $t_aPost['comments'];?></textarea></div>
                             <div class="clearer"></div>
                          
                        </div>
                         <div class="row">
                            <div class="input">&nbsp;</div>
                            <div class="label2"><input type="submit" name="submit" id="submit3" value="Contact Us"  class="submit" /></div>
                             <div class="clearer"></div>
                        </div>
                        </form>   
                    
                    </div>
                    
                    <div class="teaserOuter">
                    	<div class="teaser">
    						<div class="innersmall">
                    			<?php require_once("includes/teaserAbout.php"); ?>
                        	</div>
                        </div>
                        <div class="teaser marginleft">
    						<div class="innersmall">
                       			 <?php require_once("includes/teaserTags.php"); ?>
                        	</div>
                        </div>
                        <div class="teaser marginleft">
    						<div class="innersmall">
                       			 <?php require_once("includes/teaserServices.php"); ?>
                            </div>
                        </div>
                        
                        <div class="clearer"></div>
                    </div>
                    
                    <?php require_once("includes/footer.php"); ?>	
               		
               </div>
               
               <div class="clearer"></div>
               
              
               
               
            </div>
            
        
        </div>
    
    </div>
     <?php require_once("includes/scripts.php"); ?>	
    </body>
</html>
