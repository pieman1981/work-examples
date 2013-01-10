<?php require_once("includes/common.php"); 
$t_bShowTwitter = false;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Website Design | Web site Development | Web Application Development | Print Design | Graphic Design | HTML Email | Ware | Herts | Web-dreams.co.uk</title>
		
		<meta name="keywords" content="website, design, development, web application, print, graphic, html email, ware, herts, web dreams" />
		<meta name="description" content="Web-dreams.co.uk offer services such as website design, website development, web application development, print design, graphic design and html email development in Ware, Herts." />
		<meta name="robot" content="index, follow" />
        
		<meta name="author" content="web-dreams.co.uk" />
		<?php require_once("includes/styles.php"); ?>
        <link rel="canonical" href="<?php echo SITEPATH ?>services" />
		
		
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
                    	<h1 class="special">Services Web-dreams.co.uk Can Offer</h1>
                        
                        <ul class="products">
                            <li><a href="#WD">website design and development</a></li>
                            <li><a href="#WA">web application development</a></li>
                            <li><a href="#PD">print design</a></li>
                            <li><a href="#HTML" class="noborder">HTML email design and development</a></li>
                       </ul>
                        
                       	<h2 id="WD" class="purple">Website Design and Development</h2>
                         <img src="<?php echo SITEPATH ?>images/imgWebsites.jpg" alt="Website Design and Website Development" title="Website Design and Website Development" class="rightimagemargin floatright" />
                        <p>Like many companies your website is often the first point of contact between you and potential clients, so you want to make sure yours looks great, with a modern high-quality design, and feels great for the visitor, with effortless, almost intuitive navigation.</p>
                        <p>Web-dreams.co.uk team of talented designers will give your company a professional custom-made online identity, finely-tuned to meet your specific needs and the needs of your customers, without breaking the bank.</p>

						<p>First, we'll ask you to think carefully about which type of website is right for you. Some of the preliminary questions will include:</p>

						<p><span class="strong">Would you like the ability to add new pages and edit existing pages long after the initial development ends?</span> If so, we can build you a secure Content Mangement System (CMS) behind your site, that allows your website administrator to login and manage the content on your site at any time.</p>

						<p><span class="strong">Is it important that your site ranks well in Google searches for certain key terms?</span> No problem. We will use the latest Search Engine Optimisation (SEO) techniques to give your website the best possible change of appearing on the first page of results for your chosen search term.</p>

 						<p><span class="strong">Do you intend to sell products on your site?</span> Why not? We can build you an e-commerce site that will link to PayPal and/or accept all major types of card.</p>
                        
                        <h2 id="WA" class="purple">Web Application Development</h2>
                        <p>A web application is a computer software application that is hosted in a browser-controlled environment. Many companies are now starting to use web applications to replace existing paper-based processes.</p>

						<p>It's a great way to de-clutter your desk of all that looseleaf paper, and instead, store important data in a safe, backed-up environment. And speaking of the environment, it’s a greener solution too!</p>

						<p>Web-dreams.co.uk has a combined decade of experience developing easy to use, robust web-based applications that can help make business, and your life, a lot easier.</p>
                        
                        <h2 id="PD" class="purple">Print Design</h2>
                         <img src="<?php echo SITEPATH ?>images/imgPrint.jpg" alt="Print Design" title="Print Design" class="rightimagemargin floatright" />
                        <p>Our team of talented designers are not only experts in web-based products but also design for print.</p>
                        <p>Whether it's custom-made letterheads, business cards, or even wedding invitations to rival the Royal couple's, your print design will be of the highest quality at the most reasonable cost.</p>
                        
                        <h2 id="HTML" class="purple">HTML Email Design and Development</h2>
                        <p>Many companies have recognized the benefits of HTML email marketing or campaigns. Cheaper than the price of a stamp, an email is sent directly to potential customers, the results of which can be tracked. (i.e. Which links in the email did this customer click on?) What's more, if you have a lengthy customer contact list, email marketing can be an effective tool for brand building and customer retention, not to mention an organized way to update your clients on special announcements and industry news.</p>

						<p>HTML emails can be notoriously difficult to make, with many people claiming to build them, but very few managing it effectively. At web-dreams.co.uk we guarantee your emails will be compatible with all the major email providers, including Outlook, Gmail, Hotmail, Yahoo. This way the highest possible number of clients on your mailing list will be able to view and interact with your content.</p>
                        <div class="clearer"></div>
                        
                        <ul class="products">
                            <li><a href="#WD">website design and development</a></li>
                            <li><a href="#WA">web application development</a></li>
                            <li><a href="#PD">print design</a></li>
                            <li><a href="#HTML" class="noborder">HTML email design and development</a></li>
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
