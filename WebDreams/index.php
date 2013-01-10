<?php require_once("includes/common.php");
$t_bShowTwitter = false; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Website Design | Web site Development | Low Cost Quality Websites | Essex | Clacton | Colchester | Web-dreams.co.uk</title>
		
		<meta name="keywords" content="website, design, development, web application, logo, html email, seo, essex, clacton, colchester, essex, clacton-on-sea, low cost, quality, web dreams" />
		<meta name="description" content="Web-dreams.co.uk are a new website design and development company based in Clacton-on-sea, Essex. With years of industry experience, we are committed to devilvering high quality work at great prices." />
		<meta name="robot" content="index, follow" />
		<meta name="author" content="web-dreams.co.uk" />
		<?php require_once("includes/styles.php"); ?>
        <link rel="canonical" href="<?php echo SITEPATH ?>" />
		
		
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
                    	<h1 class="special">Latest Work</h1>
                        
                        <div class="homeLeft">
                        	<p><a href="http://www.ogbit.com" rel="nofollow" class="smallImage" name="546"><span>ogbit.com</span><img src="<?php echo SITEPATH ?>images/imgOgbitSmall.jpg" alt="ogbit.com" title="ogbit.com" /></a></p>
                            
                         	<p><a href="http://www.aspect-support.co.uk" rel="nofollow" class="smallImage" name="273"><span>aspect-support.co.uk</span><img src="<?php echo SITEPATH ?>images/imgAspectSmall.jpg" alt="aspect-support.co.uk" title="aspect-support.co.uk" /></a></p>
                        	<p><a href="http://www.marqueecarpets.com" rel="nofollow" class="smallImage" name="0"><span>marqueecarpets.com</span><img src="<?php echo SITEPATH ?>images/imgMarqueeSmall.jpg" alt="marqueecarpets.com" title="marqueecarpets.com" /></a></p>
                           
                            
                        </div>
                        
                        <div class="homeRight">
                        	<div class="imageTemplate">
                        		<img src="<?php echo SITEPATH ?>images/imgPortfolioSprite.jpg" alt="www.kingandco.co.uk" title="www.kingandco.co.uk" class="bigImage"/>
                            </div>
                        </div>
                        
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
