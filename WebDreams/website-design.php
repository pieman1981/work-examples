<?php require_once("includes/common.php"); 
$t_bShowTwitter = false;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Website Design | Web site Design | Ware | Herts | Web-dreams.co.uk</title>
		
		<meta name="keywords" content="website, design, ware, herts, web-dreams.co.uk, prototype" />
		<meta name="description" content="Web-dreams.co.uk offer website design services in Ware, Herts." />
		<meta name="robot" content="index, follow" />
        
		<meta name="author" content="web-dreams.co.uk" />
		<?php require_once("includes/styles.php"); ?>
        <link rel="canonical" href="<?php echo SITEPATH ?>website-design" />
		
		
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
                    	<h1 class="special">Website Design with web-dreams.co.uk</h1>
                        
                        <ul class="products">
                            <li><a href="<?php echo SITEPATH ?>website-development" title="Website development with web-dreams.co.uk">website development</a></li>
                            <li><a href="<?php echo SITEPATH ?>logo-design" title="Logo design with web-dreams.co.uk">logo design</a></li>
                            <li><a href="<?php echo SITEPATH ?>print-design" title="Print design with web-dreams.co.uk">print design</a></li>
                            <li><a href="<?php echo SITEPATH ?>html-email-development" title="HTML email development with web-dreams.co.uk">HTML email development</a></li>
                            <li><a href="<?php echo SITEPATH ?>web-application-development" title="Web application development with web-dreams.co.uk" class="noborder">web application development</a></li>
                       </ul>
                        
                       	<h2 class="purple">Website Design</h2>
                         <img src="<?php echo SITEPATH ?>images/imgDesign.jpg" alt="Website Design with web-dreams.co.uk" title="Website Design with web-dreams.co.uk" class="rightimagemargin floatright" />
                        <p>The first stage of website construction is coming up with a design prototype.</p>
                        
                        <p>Web-dreams.co.uk’s creative team will carefully listen to your design preferences, make note of other existing site features and designs you admire and get a good sense of your website objectives. Design is very subjective, so the more information you can give us, the more likely our designers will come up with something you love!</p>
                        
                         <p>We will then present you with a bespoke design in .jpg format for you to view. It is unlikely that the first prototype will be exactly to your preferences, so once we have received your feedback we will then make a second prototype.</p>
                        
                        <p>Once the design has been approved, we will commence <a href="<?php echo SITEPATH ?>website-development.php" title="Website development with web-dreams.co.uk">development of the site</a></p>
                        
                        <p><a href="<?php echo SITEPATH ?>contact-us" title="Contact web-dreams.co.uk">Contact web-dreams.co.uk</a> now to discuss your website design requirements.</p>
                        
                        <div class="clearer"></div>
                        
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
                       			 <?php require_once("includes/teaserNews.php"); ?>
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
