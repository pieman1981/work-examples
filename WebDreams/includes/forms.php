<form action="#" method="post" id="allForms">
    <div><input type="hidden" name="quote" id="quote" value="300" /></div>
    <!-- QUOTE FORM -->
    <div id="quoteForm" class="form">
    <a href="#" class="btn closeForm1"><img src="./images/btnClose.png" alt="Close" title="Close" /></a>
    	<p class="strong">Please answer the following questions to give us an idea of what you require.</p>
    	<div class="tableOuter">
        	<div class="row">
            	<div class="label">What service do you require? <span class="help" id="type"></span></div>
                <div class="input"><input type="radio" name="service" class="ajax" value="1" checked="checked"/> Website</div>
                <div class="input"><input type="radio" name="service" class="ajax" value="2" /> Web Application</div>
                <div class="clearer"></div>
            </div>
        	<div class="row">
            	<div class="label">How many pages do you imagine your site to entail? <span class="help" id="pages"></span></div>
                <div class="input"><input type="radio" name="page" class="ajax" value="1" checked="checked" /> 1 - 3</div>
                <div class="input"><input type="radio" name="page" class="ajax" value="2" /> 3 - 10</div>
                <div class="input"><input type="radio" name="page" class="ajax" value="3" /> 10 +</div>
                <div class="clearer"></div>
            </div>
        	<div class="row">
            
            	<div class="label">Do you require a content management system? <span class="help" id="cms"></span></div>
                
                <div class="input"><input type="radio" name="cms" class="ajax" value="y" /> Yes</div>
                <div class="input"><input type="radio" name="cms" class="ajax" value="n" checked="checked"/> No</div>
                <div class="clearer"></div>
            </div>
            <div class="row">
            
            	<div class="label">Do you want to sell items on your site? <span class="help" id="ecom"></span></div>
                
                <div class="input"><input type="radio" name="ecomm" id="ecomm" class="ajax" value="y" /> Yes</div>
                <div class="input"><input type="radio" name="ecomm" class="ajax" value="n" checked="checked"/> No</div>
                <div class="clearer"></div>
            </div>
            <div class="row">
            	<div class="label">Do you require a bespoke design for your site? <span class="help" id="bespoke"></span></div>
                
                <div class="input"><input type="radio" name="bespoke" class="ajax" value="y" /> Yes</div>
                <div class="input"><input type="radio" name="bespoke" class="ajax" value="n" checked="checked" /> No</div>
                <div class="clearer"></div>
            </div>
            <div class="row">
            	<div class="label">Do you require a new logo design? <span class="help" id="logo"></span></div>
               
                <div class="input"><input type="radio" name="logo" class="ajax" value="y" /> Yes</div>
                <div class="input"><input type="radio" name="logo" class="ajax" value="n" checked="checked" /> No</div>
                <div class="clearer"></div>
            </div>
            <div class="row">
            	<div class="label">Do you require the site to perform well on Google? <span class="help" id="google"></span></div>
                
                <div class="input"><input type="radio" name="google" class="ajax" value="y" /> Yes</div>
                <div class="input"><input type="radio" name="google" class="ajax" value="n" checked="checked"/> No</div>
                <div class="clearer"></div>
            </div>
            <div class="row">
            	<div class="label">Do you need us to supply images for the site? <span class="help" id="images"></span></div>
                <div class="input"><input type="radio" name="images" class="ajax" value="y" /> Yes</div>
                <div class="input"><input type="radio" name="images" class="ajax" value="n" checked="checked"/> No</div>
                <div class="clearer"></div>
            </div>
            <div class="row">
            	<div class="label">Do you want us to purchase the URL for the site? <span class="help" id="url"></span></div>
                
                <div class="input"><input type="radio" name="url" class="ajax" value="y" /> Yes</div>
                <div class="input"><input type="radio" name="url" class="ajax" value="n" checked="checked" /> No</div>
                <div class="clearer"></div>
            </div>
            <div class="row">
            	<div class="label">Do you want us to host your website? <span class="help" id="hosting"></span></div>
                
                <div class="input"><input type="radio" name="host" class="ajax" value="y" /> Yes</div>
                <div class="input"><input type="radio" name="host" class="ajax" value="n" checked="checked"/> No</div>
                <div class="clearer"></div>
            </div>
            <div class="row">
            	<div class="label quote">Your Quote:</div>
                
                 <div class="input quote"><span class="price">&pound; <span id="ajaxResponse">300</span></span><br/><span class="small">(this price may be subject to change)</span></div>
                 <div class="clearer"></div>
            </div>
         </div>
         <p><span class="strong">Happy with this price?</span> Now visit the <a href="#" class="topNavOffer">Quote Follow Up</a> page where you can send us more details as to the services you require.</p><p>Alternatively you can call us on 07791350267 to discuss your quote</p> 
    </div>
    <!-- FOLLOW UP FORM -->
    <div id="followForm" class="form">
    <a href="#" class="btn closeForm2"><img src="./images/btnClose.png" alt="Close" title="Close" /></a>
    	<p class="strong">Please send us some additional information that will aid us in giving you a more accurate quote.</p>
       
    	<div class="tableOuter">
        	<div class="row">
            	<div class="input"><label for="name">Name:</label></div>
                
                 <div class="label2"><input type="text" class="text" name="name" id="name"/></div>
                 <div class="clearer"></div>
              
            </div>
            <div class="row">
            	<div class="input"><label for="email">Email:</label></div>
                
                 <div class="label2"><input type="text" class="text" name="email" id="email"/></div>
                 <div class="clearer"></div>
              
            </div>
            <div class="row">
            	<div class="input"><label for="phone">Phone:</label></div>
                
                 <div class="label2"><input type="text" class="text" name="phone" id="phone"/></div>
                 <div class="clearer"></div>
              
            </div>
        </div>
        <p class="strong">Please provide a detailed description about the services you require.</p>
        <div class="tableOuter">
            <div class="row">
            	<div class="input"><label for="name">Description:</label></div>
                
                 <div class="label2"><textarea name="description" id="description" rows="0" cols="0"></textarea></div>
                 <div class="clearer"></div>
              
            </div>
          </div>
          <p class="strong">This section is optional. If you think it will help us, please provide some examples of current sites on the internet that you like / offer a similar service to what you provide. This will help give us an idea of your design tastes</p>
          <div class="tableOuter">
        	<div class="row">
            	<div class="input"><label for="site1">Example 1:</label></div>
                
                 <div class="label2"><input type="text" class="text" name="site1" id="site1"/></div>
                 <div class="clearer"></div>
              
            </div>
            <div class="row">
            	<div class="input"><label for="site2">Example 2:</label></div>
                
                 <div class="label2"><input type="text" class="text" name="site2" id="site2"/></div>
                 <div class="clearer"></div>
              
            </div>
            <div class="row">
            	<div class="input"><label for="site3">Example 3:</label></div>
                
                 <div class="label2"><input type="text" class="text" name="site3" id="site3"/></div>
                 <div class="clearer"></div>
              
            </div>
            <div class="row">
            	<div class="input">&nbsp;</div>
                <div class="label2"><input type="submit" name="submit" id="submit1" value="Submit Form"  class="submit" /></div>
                <div class="clearer"></div>
            </div>
            <p id="AjaxContactForm"></p>
         </div>
    </div>
    
    <!-- CONTACT FORM -->
    <div id="contactForm" class="form">
    <a href="#" class="btn closeForm3"><img src="./images/btnClose.png" alt="Close" title="Close" /></a>
    	<p class="strong">Please fill out the form and we will respond ASAP.</p>
    	<div class="tableOuter">
        	<div class="row">
            	<div class="input"><label for="name2">Name:</label></div>
                <div class="label2"><input type="text" class="text" name="name2" id="name2"/></div>
                <div class="clearer"></div>
              
            </div>
            <div class="row">
            	<div class="input"><label for="email2">Email:</label></div>
                
                <div class="label2"><input type="text" class="text" name="email2" id="email2"/></div>
                <div class="clearer"></div>
              
            </div>
            <div class="row">
            	<div class="input"><label for="phone2">Phone:</label></div>
                
                 <div class="label2"><input type="text" class="text" name="phone2" id="phone2"/></div>
                  <div class="clearer"></div>
              
            </div>
            <div class="row">
            	<div class="input"><label for="comments">Comments:</label></div>
                
                <div class="label2"><textarea name="comments" id="comments" rows="0" cols="0"></textarea></div>
                 <div class="clearer"></div>
              
            </div>
             <div class="row">
            	<div class="input">&nbsp;</div>
                <div class="label2"><input type="submit" name="submit" id="submit2" value="Contact Us"  class="submit" /></div>
                 <div class="clearer"></div>
            </div>
            <p id="AjaxContactForm2"></p>
        </div>
       
    </div>
    </form>