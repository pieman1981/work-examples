<?php require_once("includes/common.php"); 
$t_bShowTwitter = true;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Web-dreams.co.uk Sitemap</title>
		
		
		<meta name="author" content="web-dreams.co.uk" />
		<?php require_once("includes/styles.php"); ?>
        <link rel="canonical" href="<?php echo SITEPATH ?>sitemap" />
		
		
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
                    	<h1 class="special">Web-dreams.co.uk Sitemap</h1>
                        
                        <ul class="specialList">
                        	<li><a href="<?php echo SITEPATH ?>">Home</a></li>
                            <li><a href="<?php echo SITEPATH ?>about-us">About Us</a></li>
                            <li><a href="<?php echo SITEPATH ?>portfolio">Portfolio</a></li>
                            <li><a href="<?php echo SITEPATH ?>services">Services</a></li>
                        	<li class="nobg"><ul class="specialList">
                            		<li><a href="<?php echo SITEPATH ?>website-design">Website Design</a></li>
                                    <li><a href="<?php echo SITEPATH ?>website-development">Website Development</a></li>
                                    <li><a href="<?php echo SITEPATH ?>logo-design">Logo Design</a></li>
                                    <li><a href="<?php echo SITEPATH ?>print-design">Print Design</a></li>
                                    <li><a href="<?php echo SITEPATH ?>html-email-development">HTML Email Development</a></li>
                                    <li><a href="<?php echo SITEPATH ?>web-application-development">Web Application Development</a></li>
                            </ul></li>
                            <li><a href="<?php echo SITEPATH ?>partners">Partners</a></li>
                            <li><a href="<?php echo SITEPATH ?>contact-us">Contact Us</a></li>
                            <li><a href="<?php echo SITEPATH ?>latest-news">Latest News</a></li>
                            <li><a href="<?php echo SITEPATH ?>terms-conditions">Terms &amp; Conditions</a></li>
                            <li><a href="<?php echo SITEPATH ?>privacy-policy">Privacy Policy</a></li>
                            <li><a href="<?php echo SITEPATH ?>site-map">Site Map</a></li>
                      	</ul>
                    
                    </div>
                    
                    <div class="teaserOuter">
                    	<div class="teaser">
    						<div class="innersmall">
                    			 <?php require_once("includes/teaserServices.php"); ?>
                        	</div>
                        </div>
                        <div class="teaser marginleft">
    						<div class="innersmall">
                       			 <?php require_once("includes/teaserTags.php"); ?>
                        	</div>
                        </div>
                        <div class="teaser marginleft">
    						<div class="innersmall">
                            	<?php require_once("includes/teaserTwitter.php"); ?>
                       			
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
