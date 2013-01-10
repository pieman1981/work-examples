<?php require_once("includes/common.php"); 
$t_bShowTwitter = false;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Web-dreams.co.uk Latest News | Special Offer | Websites Half Price | Web-dreams.co.uk</title>
		
		<meta name="keywords" content="latest news, special offer, half price, websites" />
		<meta name="description" content="Web-dreams.co.uk on launch are offering all new website half price. This offering is for a limited time only so hurry!" />
		<meta name="robot" content="index, follow" />
		<meta name="author" content="web-dreams.co.uk" />
		<?php require_once("includes/styles.php"); ?>
        <link rel="canonical" href="<?php echo SITEPATH ?>latest-news" />
		
		
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
                    	<h1 class="special">Latest News From web-dreams.co.uk</h1>

						<h3 class="purple">Site Updates</h3>
                        
                        <p>We have just updated the site with our latest work and new contact details.</p>

						<p>Check out <a href="<?php echo SITEPATH ?>portfolio">our latest work</a>, a wordpress powered CMS site, and s quote engine for a carpet retailers.</p>

						<p>Also check out our latest <a href="<?php echo SITEPATH ?>contact-us">contact information.</a></p>

						<p class="strong">Jan 6th 2013</p>
                    
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
