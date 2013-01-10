//SITEPATH = 'http://localhost/web-dreams/';
//SITEPATH = 'http://www.simonlait.info/clients/web-dreams/';
SITEPATH = 'http://www.web-dreams.co.uk/';
function clear_form_elements(ele) {
 $(ele).find(':input').each(function() {
		switch(this.type) {
			case 'password':
			case 'select-multiple':
			case 'select-one':
			case 'text':
			case 'textarea':
				$(this).val('');
				break;
			case 'checkbox':
			case 'radio':
				this.checked = false;
		}
	});
	 
}

$(function() {
	//home page roll over	   
	$('a.smallImage').hover(function(){
		var name = $(this).attr('name');
		$('.homeRight img').css({bottom:name+'px'});
		return false;							
	});
	
	$('.forms').load(SITEPATH + 'includes/forms.php?' +  Math.random()*99999, function() {
	
	//ajax call for instant quote
	$('input.ajax').live('click', function() {
		$.ajax({
		  url: SITEPATH + 'ajax/calls.php?type=quote',
		  type: 'POST',
		  data: $('form#allForms').serialize(),
		  success: function(data) {
			$('#ajaxResponse').html(data);
			$('#quote').val(data);
		  }
		});
								   
	});
	
	$('#quoteForm').hide();
	$('#followForm').hide();
	$('#contactForm').hide();
	
	$('.topNavHome').click(function()
	{
		$('#quoteForm').toggle('slide',600);
		$('#followForm').hide();
		$('#contactForm').hide();
		
		return false;
	});
	
	$('.topNavOffer').click(function()
	{
		$('#quoteForm').hide();
		$('#followForm').toggle('slide',600);
		$('#contactForm').hide();
		
		return false;
	});
	
	$('.topNavContact').click(function()
	{
		$('#quoteForm').hide();
		$('#followForm').hide();
		$('#contactForm').toggle('slide',600);
		
		return false;
	});
	
	$('.closeForm1').click(function()
	{
		$('#quoteForm').hide("slide", { direction: "left" }, 600);
		return false;
	});
	$('.closeForm2').click(function()
	{
		$('#followForm').hide("slide", { direction: "left" }, 600);
		return false;
	});
	$('.closeForm3').click(function()
	{
		$('#contactForm').hide("slide", { direction: "left" }, 600);
		return false;
	});
	
	//help icons
	$('.help').each(function(){
		var helpText = '';
		var target = $(this);
		var id = $(this).attr('id');
		$.ajax({
			url: SITEPATH + 'ajax/calls.php?type=help&section=' + id,
			success: function (html){
				helpText = html;
				id = id.replace('&', '');
				id = id.replace('=', '');
				target.append('<span style="width:16px;" class="ui-icon ui-icon-info clickableHelp HelpTrigger' + id + '"  rel="' + id + '"></span>');
				$('#mainContainer').after('<div class="DialogHelp' + id + '" title="Help">' + helpText + '</div>');

				$('.DialogHelp' + id).dialog({
					bgiframe: true,	autoOpen: false, modal: true, width: 500, resizable: false,
					buttons: {
						'Close': function() {
							$(this).dialog('close');
						}
					}
				});
				$('.HelpTrigger' + id).unbind('click');
				$('.HelpTrigger' + id).click(function(e){
					$('.DialogHelp' + $(this).attr('rel') + ':first').dialog('open');
				});
			}
		});
	});
	
	//form submitions
	$('#submit1').click(function()
	{
		$.ajax({
			url: SITEPATH + 'ajax/calls.php?type=getquote',
			type: 'POST',
		  	data: $('form#allForms').serialize(),
			success: function (html){
				$('#AjaxContactForm').html(html);
				$.trim(html);
				if (html == '<span class="success">Form submitted - We will be in contact with you shortly</span>')
				{
					clear_form_elements('form#allForms');
				}
			}
		});
		
		return false;
	});
	$('#submit2').click(function()
	{
		$.ajax({
			url: SITEPATH + 'ajax/calls.php?type=contactus',
			type: 'POST',
		  	data: $('form#allForms').serialize(),
			success: function (html){
				$('#AjaxContactForm2').html(html);
				$.trim(html);
				if (html == '<span class="success">Form submitted - We will be in contact with you shortly</span>')
				{
					clear_form_elements('form#allForms');
				}
			}
		});
		
		return false;
	});
	
    });//end ajax load
	
	$('#leftNav').stickyfloat({ duration: 400 });
});