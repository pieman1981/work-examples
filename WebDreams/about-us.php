<?php require_once("includes/common.php"); 
$t_bShowTwitter = true;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Website Design | Web site Development | Low Cost Quality Websites | Ware | Herts | About Web-dreams.co.uk</title>
		
		<meta name="keywords" content="website, design, development, web application, browser support, about, products, services, low cost, quality, web dreams, web-dreams.co.uk" />
		<meta name="description" content="Web-dreams.co.uk are a new website design and development company based in Ware, Herts. Offering low cost, quality websites supported by all major browsers. Email info@web-dreams.co.uk now to speak to an advisor." />
		<meta name="robot" content="index, follow" />
		<meta name="author" content="web-dreams.co.uk" />
		<?php require_once("includes/styles.php"); ?>
        <link rel="canonical" href="<?php echo SITEPATH ?>about-us" />
		
		
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
                    	<h1 class="special">About web-dreams.co.uk</h1>
                        
                        <p>Web-dreams.co.uk is a newly-formed website and web application design and development company based in Ware, Hertfordshire.</p>

						<p>With a combined decade of industry experience, we are committed to delivering custom made products with guaranteed "minimum fuss" for our clients. With our development experts working in conjunction with our design team, we will deliver to you a custom-made website that complements your business and meets the needs of your clients.</p>

						<h2 class="purple">Major Browser Support</h2>
						<img src="<?php echo SITEPATH ?>images/imgMajorBrowsers.jpg" alt="Major Browser Support" title="Major Browser Support" class="rightimagemargin floatright" />
						<p>While other agencies rely on programmes like Dreamweaver, all of our work is hand-coded to meet your specific needs. We also test our work against major browsers (Firefox, IE 7-9, Chrome, Opera and Safari) to make sure it is compatable, so that your site receives its highest potential of visitors.</p>

						<p>From the website's first conception to its exciting implementation, Web-dreams.co.uk will work with you to create your dream website. We believe strongly in open and honest communication so that both web-dreams.co.uk and our clients are never surprised with the end result, unless it's in the form of optimal delight!</p>

						<p>There are no irreproachable "I.T. nerds" here! We will keep you regularly updated on the progress of our work and make sure you go away a happy customer telling your clients and industry partners how great web-dreams.co.uk are!</p>
                        
                        <h2 class="purple">Products and Services</h2>
                        
                        <p>Some of the products / services we are able to offer include:</p>
                        <ul class="specialList">
                            <li>Website Design and Development</li>
                            <li>Web Application Design and Development</li>
                            <li>HTML Email Design and Development</li>
                            <li>Wordpress Theme Development</li>
                            <li>Search Engine Optimisation</li>
                            <li>Logo Design</li>
                            <li>Print / Graphic Design</li>
                        </ul>
                        <p>To get an idea of prices, get an instant quote by clicking the <strong>Instant Quote</strong> link above. If you have any other question, then please visit our <a href="<?php echo SITEPATH ?>contact-us" title="Contact web-dreams.co.uk">contact page</a> or call us on 07791350267.</p>
                    
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
