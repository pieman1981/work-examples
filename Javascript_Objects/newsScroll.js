$(function() {
	newsScroll = {

		settings		: {
			current		: 0,
			action		: false,
			interval	: -185,
			$news		: $('#news-scroll'),
			speed		: 10000
		},

		init			: function() {
			s = this.settings;

			
			this.bindUI();
			s.action = false;
			newsScroll.scrollNews();
		},

		bindUI			: function() {
			s.$news.bind('mouseover',function(e) {
				s.$news.stop();
			}).bind('mouseleave',function(e) {
				s.action = false;
				newsScroll.scrollNews();
			});

		},


		scrollNews : function() {
				var obj = this;
				if (!s.action)
				{

					s.$news.animate({top : s.interval + 'px'},s.speed, function() {
						s.$news.css({'top' : '220px'});
						s.current = 220;
						s.speed = 20000;
						obj.scrollNews();
					});

					
				}
		}
	}

		
});