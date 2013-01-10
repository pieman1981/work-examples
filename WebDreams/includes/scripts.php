<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo SITEPATH ?>scripts/jquery-ui-1.8.12.custom.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo SITEPATH ?>scripts/sticky-float.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo SITEPATH ?>scripts/smooth-scroll.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo SITEPATH ?>scripts/base.js" type="text/javascript" charset="utf-8"></script>
<?php
	if ($t_bShowTwitter)
	{ 
?>
<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/webdreamscouk.json?callback=twitterCallback2&amp;count=1"></script>
<?php } ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-4556251-12']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>