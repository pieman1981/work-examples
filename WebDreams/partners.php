<?php require_once("includes/common.php"); 
$t_bShowTwitter = true;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Industry Partners of Web-dreams.co.uk | Quality Low Cost Websites | Ware | Herts | Web-dream.co.uk</title>
		
		<meta name="keywords" content="industry partners, ogbit.com, kiss my pixels, kiss my image, web-dreams.co.uk" />
		<meta name="description" content="Industry partners of web-dreams.co.uk" />
		<meta name="robot" content="index, follow" />
		<meta name="author" content="web-dreams.co.uk" />
		<?php require_once("includes/styles.php"); ?>
        <link rel="canonical" href="<?php echo SITEPATH ?>partners" />
		
		
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
                    	<h1 class="special">industry partners of web-dreams.co.uk</h1>
                        
                        <p>Web-dreams have teamed with leading design and SEO specialists to help tick all the boxes when it comes to developing your perfect website.</p>

						<table>
                        <tr><td><a href="http://www.ogbit.com"><img src="<?php echo SITEPATH ?>images/imgOgbit.gif" alt="OgBit.com Business to Business Directory" title="OgBit.com Business to Business Directory" /></a></td><td><a href="http://www.kissmyimage.co.uk"><img src="<?php echo SITEPATH ?>images/imgKissMyImage.gif" alt="Kiss My Image Photo Retouching Specialists" title="Kiss My Image Photo Retouching Specialists" /></a></td></tr>
                        <tr><td><a href="http://www.kissmypixels.co.uk"><img src="<?php echo SITEPATH ?>images/imgKissMyPixels.gif" alt="Kiss My Pixels" title="Kiss My Pixels" /></a></td><td></td></tr>
                        </table>
                    
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
