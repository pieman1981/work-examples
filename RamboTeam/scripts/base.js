$(function() {


	 var view = 
	 {
		people : 
		[
			{
				  name : "Jorge Montero CEO - Our Fearless Leader",
				  image : "chief.jpg",
				  likes : "Answering questions, negotiating pizza prices",
				  dislikes : "All other tours groups except Rambo Team",
				  nationality : 'costarica'
			},
			{
				  name : "Dave Alvarado - Head of Team Communications",
				  image : "dave.jpg",
				  likes : "The effects of moonshine, looking good, skittles, ironed shirts ",
				  dislikes : "Sacrifices for the team involving gay clubs, people who pack light, purple skittles",
				  nationality : 'us'
			},
			{
				  name : "Yolanda Cheung",
				  image : "yolanda.jpg",
				  likes : "Knowing what to wear, getting up close and personal to trees on kayaks",
				  dislikes : "Brusied feet after dancing salsa with Simon, walking up steps while zip-lining",
				  nationality : 'canada'
			},
			{
				  name : "Evelin Herrera",
				  image : "evelin.jpg",
				  likes : "Naming tour groups, eating salads",
				  dislikes : "Taking pictures of ants on night walks in forests",
				  nationality : 'us'
			},
			{
				  name : "Mila Kamalova",
				  image : "mila.jpg",
				  likes : "Early nights, naps during dinner",
				  dislikes : "Fluffy puppies, tarzan rope swings",
				  nationality : 'canada'
			},
			{
				  name : "Simon Lait",
				  image : "simon.jpg",
				  likes : "Teaching salsa, the socks and sandles look, drinks with flair",
				  dislikes : "Sacrifices for the team involving crocodiles, moisturising",
				  nationality : 'uk'
			},
			{
				  name : "Chris Osgoode",
				  image : "chris.jpg",
				  likes : "Nights out in Manual Antonio",
				  dislikes : "Waiting for Dave to get ready",
				  nationality : 'canada'
			},
			{
				  name : "Miha Polanc",
				  image : "miha.jpg",
				  likes : "Middle age hot dog servers",
				  dislikes : "Small meal sizes, getting the worst hotel rooms",
				  nationality : 'slovenia'
			},
			{
				  name : "Jordan Reiser",
				  image : "jordon.jpg",
				  likes : "Pole dancing, looking good on night walks, taking risks",
				  dislikes : "Group thinking, loosing on black jack, wearing rain jackets when its raining",
				  nationality : 'us'
			},
			{
				  name : "Raphaela Stierli",
				  image : "rafaella.jpg",
				  likes : "Keeping reciepts, writing journals about her awful tour group",
				  dislikes : "Getting close to mature (crabs) on mangroves",
				  nationality : 'swiss'
			},
			{
				  name : "Jessica Skipper",
				  image : "jess.jpg",
				  likes : "24 hour coffee / cake shops, petting dirty animals",
				  dislikes : "Anything that is not food",
				  nationality : 'uk'
			},
			{
				  name : "Yoyo Varga",
				  image : "yoyo.jpg",
				  likes : "Finding small insects on night forest walks",
				  dislikes : "Shitty rooms",
				  nationality : 'canada'
			},
			{
				  name : "Carrie Walker",
				  image : "karrie.jpg",
				  likes : "70s themed party buses",
				  dislikes : "Sharing a kayak with Simon, opening birthday journals",
				  nationality : 'us'
			}

	    ]
	 };




	$("#templates").load("templates/index.html #template-team",function(){
	  var template = $('#template-team').html();
	  var output = Mustache.to_html(template, view);
	  $("#person").html(output);
	  $(".section").mCustomScrollbar({set_height:460});
	});

	$("nav").delegate("a", "click", function() {
        window.location.hash = $(this).attr("href");
        return false;
    });

	$(window).bind('hashchange', function(){
    
        newHash = window.location.hash.substring(1);

		if (newHash) 
		{
			console.log('HIDE SECTIONS');

			$('.section,.section2,.gallery,.galleria-image').css({'visibility':'hidden'});

			if (!$('#' + newHash).length)
			{
				console.log('NOT FOUND SO ADD');

				$div = $('<div class="section2 loader" id="' + newHash + '" style="visibility:visible" />');

				$('.inner').append($div);

				console.log('NEW SECTION ADDED');

				$.getJSON('ajax/calls.php?type=gallery',{page : newHash},function(json) {

					console.log('GALLERY RESPONSE');

					switch (newHash)
					{
						case 'la-fortuna' : 
							var title = 'La Fortuna Pictures (02/12/2012 - 03/12/2012)';
							break;

						case 'monteverde' : 
							var title = 'Monteverde Pictures (04/12/2012 - 05/12/2012)';
							break;

						case 'manual-antonio' :
							var title = 'Manual Antonio Pictures (06/12/2012 - 07/12/2012)';
							break;

						case 'best-rest' :
							var title = 'Some other favourites';
							break;
					
					}

					$('#' + newHash).removeClass('loader');

					$content = $('<h1>' + title + '</h1><div class="gallery"></div>');
					$content.appendTo($('#' + newHash));

					$.each(json,function(key,value)
					{
						value = value.replace('..\/','');
						$img = $('<img />').attr('src',value);
						$img.appendTo($('#' + newHash + ' .gallery'));
					});

					//$('.inner').append($div);

					$('#' + newHash + ' .gallery').galleria({
						width:732,
						height:390,
						transition: 'fade',
						debug:false
					});

					//console.log(newHash);
				});
			}
        
			$('#' + newHash + ',#' + newHash + ' .gallery, #' + newHash + ' .gallery .galleria-image').css({'visibility':'visible'});
        }
		else
		{
			$('#home').css({'visibility':'visible'});
		}
	 });

	 $(window).trigger('hashchange');

	


	
});