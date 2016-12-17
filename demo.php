<html xmlns="http://www.w3.org/1999/xhtml"><head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="chrome=1">

		<title>The Wilderness Downtown</title>

		<meta name="description" content="An interactive short film by Chris Milk. Featuring &quot;We Used To Wait&quot; from Arcade Fire.">
		<meta name="keywords" content="Arcade Fire, Chris Milk, Chrome, Chrome Experiment, HTML5, Javascript">

		<meta property="og:title" content="The Wilderness Downtown">
		<meta property="og:site_name" content="The Wilderness Downtown">
		<meta property="og:description" content="Check out Arcade Fire's new interactive HTML5 music experience, “The Wilderness Downtown”.">
		<meta property="og:type" content="website">
		<meta property="og:url" content="http://www.thewildernessdowntown.com/">
		<meta property="og:image" content="http://www.thewildernessdowntown.com/img/we-used-to-wait.jpg">

		<link rel="stylesheet" href="css/styles.css" type="text/css" media="screen">
	<script type="text/javascript" charset="UTF-8" src="http://maps.google.com/maps-api-v3/api/js/27/5/intl/zh_cn/common.js"></script><script type="text/javascript" charset="UTF-8" src="http://maps.google.com/maps-api-v3/api/js/27/5/intl/zh_cn/util.js"></script><script type="text/javascript" charset="UTF-8" src="http://maps.google.com/maps-api-v3/api/js/27/5/intl/zh_cn/geocoder.js"></script><script type="text/javascript" charset="UTF-8" src="http://maps.google.com/maps-api-v3/api/js/27/5/intl/zh_cn/stats.js"></script></head>
	<body onload="checkPopupBlocker()">
		<div id="birdsCanvas">
			<img src="img/sun.png" width="36" height="36" alt="" class="sun">
			<div id="bg" style="left: 0px;"><canvas width="1362" height="901" style="position: absolute; left: 0px; top: 0px;"></canvas></div>
		</div>

		<div id="bottom">
			<div class="chrome-badge">
				<a href="http://www.chromeexperiments.com/" onclick="sendStat('/Click-on-Chrome-Experiment')" target="_blank" id="ce-link"><img src="img/chrome.png" width="107" height="55" alt="A Chrome Experiment"></a>
			</div>
			<div class="badge-sep"></div>
			<div class="google-badge">
				<a href="http://www.google.com/" onclick="sendStat('/Click-on-Made-with-Google')" target="_blank" id="google-link"><img src="img/google.png" width="91" height="60" alt="Made with some friends from Google"></a>
			</div>
			<div class="credits">
				<div class="credits-inside"><span class="kiosk-hide"><a href="#" onclick="openTheWildernessMachine()">The Wilderness Machine</a> | </span><a href="https://www.google.com/policies/">Terms &amp; Privacy</a> | <a href="#" onclick="openCredits()">Credits</a><span class="kiosk-hide"> | Share &nbsp;<a href="http://www.facebook.com/sharer.php?u=http://www.thewildernessdowntown.com" onclick="sendStat('/Click-on-Share-on-Facebook')" target="_blank"><img src="img/facebook.png" width="20" height="20" alt="Facebook page"></a> <a href="http://twitter.com/share?text=Check out Arcade Fire's new interactive HTML5 music experience, “The Wilderness Downtown” &amp;url=http://www.thewildernessdowntown.com" onclick="sendStat('/Click-on-Share-on-Twitter')" target="_blank"><img src="img/twitter.png" width="20" height="20" alt="Tweet me!"></a></span></div>
			</div>
		</div>

		<div id="top" style="top: 100px;">
			<div id="writer">
				<div class="subtitle">
					<div class="subtitle-inside" id="sub-text">An interactive film by Chris Milk <br>Featuring "We Used To Wait" <br>Built in HTML5</div>
				</div>
			</div>

			<div id="buttons-area"><div id="search-form"><input type="text" id="aSearch" autocomplete="off"><img width="77" height="20" src="img/search.png" id="search-img"><span style="cursor: pointer;"><b>[?]</b></span><div id="warning-block"></div></div></div>
		</div>

		<img src="img/tree.png" alt="" width="385" height="387" class="topleft">

		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
		<script type="text/javascript" src="http://gmapsver.appspot.com/"></script>

		<script src="js/app.js"></script><div id="blocker"></div><audio preload="auto"><source src="files/wutw.ogg" type="audio/ogg; codecs=vorbis"><source src="files/wutw.mp3" type="audio/mpeg"></audio>

		<script type="text/javascript">
			var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
			document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script><script src="http://www.google-analytics.com/ga.js" type="text/javascript"></script>
		<script type="text/javascript">
			var pageTracker = _gat._getTracker("UA-18017745-1");
			pageTracker._trackPageview();
		</script>

		<!--
		Start of DoubleClick Floodlight Tag: Please do not remove
		Activity name of this tag: Chrome - LP - Wilderness
		URL of the webpage where the tag is expected to be placed: http://thewildernessdowntown.com
		This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
		Creation Date: 08/19/2010
		-->
		<script type="text/javascript">
            try {
                var axel = Math.random() + '';
                var a = axel * 10000000000000;
                document.write('<iframe src="http://fls.doubleclick.net/activityi;src=2542116;type=clien612;cat=chrom975;ord=' + a + '?" width="1" height="1" frameborder="0"></iframe>');
            } catch (error) {}
		</script><iframe src="http://fls.doubleclick.net/activityi;src=2542116;type=clien612;cat=chrom975;ord=9463361515468.316?" width="1" height="1" frameborder="0"></iframe>
		<noscript>
			&lt;iframe src="http://fls.doubleclick.net/activityi;src=2542116;type=clien612;cat=chrom975;ord=1?" width="1" height="1" frameborder="0"&gt;&lt;/iframe&gt;
		</noscript>
		<!-- End of DoubleClick Floodlight Tag: Please do not remove -->

		<!-- popup warning (Dec 2012 update) -->
		<div id="popup-warning" style="top: 0px;">This film requires pop-ups. Click the <img width="25" height="21" src="img/popup.png" style=""> icon in the address bar. Select "Always allow pop-ups from wildernessdowntown.com."</div>
	
</body></html>