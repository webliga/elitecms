<!-- GET JQUERY FROM THE GOOGLE APIS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<!--[if lt IE 9]>
	<script src="/<?php echo Core::app()->getTemplate()->getCurrentTemplatePath(); ?>/lib/js/selectivizr-and-extra-selectors.min.js"></script>
<![endif]-->
<script src="/<?php echo Core::app()->getTemplate()->getCurrentTemplatePath(); ?>/lib/js/respond.min.js"></script>

 <!-- JQUERY KENBURN SLIDER  -->	
<script src="/<?php echo Core::app()->getTemplate()->getCurrentTemplatePath(); ?>/lib/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>			
<script src="/<?php echo Core::app()->getTemplate()->getCurrentTemplatePath(); ?>/lib/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>	
<script src="/<?php echo Core::app()->getTemplate()->getCurrentTemplatePath(); ?>/lib/js/jquery.easing.1.3.js"></script>
<script src="/<?php echo Core::app()->getTemplate()->getCurrentTemplatePath(); ?>/lib/js/jquery.cycle.all.min.js"></script>
<script src="/<?php echo Core::app()->getTemplate()->getCurrentTemplatePath(); ?>/lib/js/mediaelement-and-player.min.js"></script>
<script src="/<?php echo Core::app()->getTemplate()->getCurrentTemplatePath(); ?>/lib/fancybox/jquery.fancybox.pack.js"></script>
<script src="/<?php echo Core::app()->getTemplate()->getCurrentTemplatePath(); ?>/lib/js/custom.js"></script>

<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(["trackPageView"]);
  _paq.push(["enableLinkTracking"]);

  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://html-css.org/";
    _paq.push(["setTrackerUrl", u+"piwik.php"]);
    _paq.push(["setSiteId", "6"]);
    var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
    g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Piwik Code -->

