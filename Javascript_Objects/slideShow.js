$(function() {
	slideShow = {

		settings		: {
			image_width		: 190,
			image_margin	: 20,
			total_slide		: 210,
			num_images		: parseInt($('.slideshow-section').length),
			clicks			: 0,
			$slide_win		: $('.slideshow-window'),
			speed			: 500,
			view_width		: parseInt($('.slideshow').width()),
			animation		: 0,
			total			: 0,
			action		: false
		},

		init			: function() {
			p = this.settings;

			this.set_window_width();
			this.bindUI();
		},

		bindUI			: function() {
			$('.left-btn').bind('mouseover',function(e) {
				e.stopPropagation();
				if (!p.action)
				{
					p.action = true;
					this.interval = setInterval(function() {
						slideShow.left_click();
					},500);
				}
			}).bind('mouseleave',function(e) {
				e.stopPropagation();
				if (p.action)
				{
					p.action = false;
					clearInterval(this.interval);
				}
			});

			$('.right-btn,.left-btn').on('click',function(e) {
				e.preventDefault();
				
			})

			$('.right-btn').bind('mouseover',function(e) {
				e.stopPropagation();
				if (!p.action)
				{
					p.action = true;
					this.interval = setInterval(function() {
						slideShow.right_click();
					},500);
				}
			}).bind('mouseleave',function(e) {
				e.stopPropagation();
				if (p.action)
				{
					p.action = false;
					clearInterval(this.interval);
				}
			});

			$('.slideshow-section').on('mouseenter',function() {
				$ele = $(this);
				$ele.find('.hover').css({ display : 'block' });
			});

			$('.slideshow-section').on('mouseleave',function() {
				$ele = $(this);
				$ele.find('.hover').css({ display : 'none' });
			});
		},


		set_window_width : function() {
			var images_only = parseInt(p.num_images * p.image_width);
			var margin_only = parseInt(p.num_images * p.image_margin);
			p.total = parseInt(images_only + margin_only);

			p.$slide_win.width(p.total + 'px');

			this.calculate_clicks();

		},

		calculate_clicks : function() {
			
			//this.animation = parseInt(this.clicks * this.total_slide);

			p.animation = parseInt( Math.round( p.view_width - p.total ) );
			p.animation = parseInt( Math.round( p.animation / 2 ) );

			p.$slide_win.css({left : p.animation + 'px'});

			p.clicks = parseInt( Math.round( p.animation / p.total_slide ) );

			p.clicks = (p.clicks < 0 ? p.clicks * -1 : p.clicks );


			this.calulate_max();
		},

		calulate_max : function() {
			p.view_width = parseInt(p.view_width + p.total_slide);

		},

		left_click		: function() {
			
			if (p.clicks >= 0)
			{
				p.clicks--;

				if (p.clicks < 0)
					p.clicks = 0;

				p.animation = parseInt(p.clicks * p.total_slide); 

				p.$slide_win.animate({left : (p.clicks == 0 ? '30px' : '-' + p.animation + 'px')},p.speed);
				
			}

			
		},

		right_click		: function() {
			if (p.clicks < (p.num_images - 6))
			{
				p.clicks++;

				if (p.clicks > (p.number_images - 1))
					p.clicks = p.number_images - 1;

				p.animation = parseInt(p.clicks * p.total_slide);
				
				p.$slide_win.animate({left : '-' + p.animation + 'px'},p.speed);

			}

		}
	}
});