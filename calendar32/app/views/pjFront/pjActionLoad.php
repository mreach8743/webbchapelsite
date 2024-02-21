<?php
$default_view = 'calendar';
$show_header = 1;
$show_icons = 1;
$show_categories = 1;
if($tpl['option_arr']['o_enable_monthly_view'] == 'No' && $tpl['option_arr']['o_enable_list_view'] == 'No' && $tpl['option_arr']['o_enable_categories'] == 'No')
{
	$show_header = 0;
	$default_view = 'calendar';
}
if(($tpl['option_arr']['o_enable_monthly_view'] == 'No' && $tpl['option_arr']['o_enable_list_view'] == 'No' && $tpl['option_arr']['o_enable_categories'] == 'Yes')
	|| ($tpl['option_arr']['o_enable_monthly_view'] == 'No' && $tpl['option_arr']['o_enable_list_view'] == 'Yes' && $tpl['option_arr']['o_enable_categories'] == 'No')
	|| ($tpl['option_arr']['o_enable_monthly_view'] == 'Yes' && $tpl['option_arr']['o_enable_list_view'] == 'No' && $tpl['option_arr']['o_enable_categories'] == 'No'))
{
	$show_icons = 0;
}
if(isset($_GET['view'])){
	$default_view = $_GET['view'];
}
if(isset($_GET['icons'])){
	if($_GET['icons'] == 'T')
	{
		$show_icons = 0;
	}else{
		$show_icons = 1;
	}
}
if($tpl['option_arr']['o_enable_categories'] == 'No')
{
	$show_categories = 0;
}
if(isset($_GET['cats'])){
	if($_GET['cats'] == 'T')
	{
		$show_categories = 0;
	}else{
		$show_categories = 1;
	}
}
if($show_icons == 0 && $show_categories == 0)
{
	$show_header = 0;
}
mt_srand();
$index = mt_rand(1, 9999);
$theme = isset($_GET['theme']) ? $_GET['theme'] : $tpl['option_arr']['o_theme'];
if((int) $theme > 0)
{
	$theme = 'theme' . $theme;
}
?>
<div id="pjWrapperPHPEventCalendar_<?php echo $theme;?>">
	<div class="container-fluid">
		<?php include PJ_VIEWS_PATH . 'pjFront/elements/header.php'; ?>
		<div id="pjPecContainer_<?php echo $index; ?>" class="pjPecContainer"></div>	
	</div><!-- /.container -->
</div><!-- /#pjWrapper -->
<script type="text/javascript">
var pjQ = pjQ || {},
	PHPEventCalendar_<?php echo $index; ?>;
(function () {
	"use strict";
	var isSafari = /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor),

	loadCssHack = function(url, callback){
		var link = document.createElement('link');
		link.type = 'text/css';
		link.rel = 'stylesheet';
		link.href = url;

		document.getElementsByTagName('head')[0].appendChild(link);

		var img = document.createElement('img');
		img.onerror = function(){
			if (callback && typeof callback === "function") {
				callback();
			}
		};
		img.src = url;
	},
	loadRemote = function(url, type, callback) {
		if (type === "css" && isSafari) {
			loadCssHack(url, callback);
			return;
		}
		var _element, _type, _attr, scr, s, element;
		
		switch (type) {
		case 'css':
			_element = "link";
			_type = "text/css";
			_attr = "href";
			break;
		case 'js':
			_element = "script";
			_type = "text/javascript";
			_attr = "src";
			break;
		}
		
		scr = document.getElementsByTagName(_element);
		s = scr[scr.length - 1];
		element = document.createElement(_element);
		element.type = _type;
		if (type == "css") {
			element.rel = "stylesheet";
		}
		if (element.readyState) {
			element.onreadystatechange = function () {
				if (element.readyState == "loaded" || element.readyState == "complete") {
					element.onreadystatechange = null;
					if (callback && typeof callback === "function") {
						callback();
					}
				}
			};
		} else {
			element.onload = function () {
				if (callback && typeof callback === "function") {
					callback();
				}
			};
		}
		element[_attr] = url;
		s.parentNode.insertBefore(element, s.nextSibling);
	},
	loadScript = function (url, callback) {
		loadRemote(url, "js", callback);
	},
	loadCss = function (url, callback) {
		loadRemote(url, "css", callback);
	},
	options = {
		server: "<?php echo PJ_INSTALL_URL; ?>",
		folder: "<?php echo PJ_INSTALL_URL; ?>",
		theme: "<?php echo $theme;?>",
		index: <?php echo $index; ?>,

		display_events: "<?php echo $tpl['option_arr']['o_display_events'];?>",
		event_title_position: "<?php echo $tpl['option_arr']['o_event_title_position'];?>",
		default_view: "<?php echo $default_view; ?>",
		current_month: "<?php echo date('m');?>",
		current_year: "<?php echo date('Y');?>"
	};
	<?php
	$dm = new pjDependencyManager(PJ_INSTALL_PATH, PJ_THIRD_PARTY_PATH);
	$dm->load(PJ_CONFIG_PATH . 'dependencies.php')->resolve();
	$api_key_str = isset($tpl['option_arr']['o_google_map_api']) && !empty($tpl['option_arr']['o_google_map_api']) ? '?key=' . $tpl['option_arr']['o_google_map_api'] : '';
	?>
	loadScript("<?php echo PJ_INSTALL_URL . $dm->getPath('pj_jquery'); ?>pjQuery.min.js", function () {
		loadScript("<?php echo PJ_INSTALL_URL . $dm->getPath('pj_bootstrap'); ?>pjQuery.bootstrap.min.js", function () {
			loadScript("<?php echo PJ_INSTALL_URL . $dm->getPath('pj_tooltipster'); ?>pjQuery.tooltipster.js", function () {
				loadScript("<?php echo PJ_INSTALL_URL . PJ_JS_PATH; ?>pjPHPEventCalendar.js", function () {
					loadScript("//maps.google.com/maps/api/js<?php echo $api_key_str;?>", function () {
						PHPEventCalendar_<?php echo $index; ?> = new PHPEventCalendar(options);
					});
				});
			});	
		});
	});
})();
</script>