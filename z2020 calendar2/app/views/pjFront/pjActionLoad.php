<?php
$default_view = 'monthly';
$show_header = 1;
$show_icons = 1;
$show_cats = 1;
if($tpl['option_arr']['o_enable_monthly_view'] == 'No' && $tpl['option_arr']['o_enable_list_view'] == 'No' && $tpl['option_arr']['o_enable_categories'] == 'No')
{
	$show_header = 0;
	$default_view = 'calendar';
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
	$show_cats = 0;
}
if(isset($_GET['cats'])){
	if($_GET['cats'] == 'T')
	{
		$show_cats = 0;
	}else{
		$show_cats = 1;
	}
}
if($show_icons == 0 && $show_cats == 0)
{
	$show_header = 0;
}

switch ($_GET['layout']) {
	case 'layout_1':
		include_once PJ_VIEWS_PATH . 'pjFront/elements/layout_1/index.php';
		break;
	case 'layout_2':
		include_once PJ_VIEWS_PATH . 'pjFront/elements/layout_2/index.php';
		break;
	case 'layout_3':
		include_once PJ_VIEWS_PATH . 'pjFront/elements/layout_3/index.php';
		break;
	case 'layout_4':
		include_once PJ_VIEWS_PATH . 'pjFront/elements/layout_4/index.php';
		break;
	case 'layout_5':
		include_once PJ_VIEWS_PATH . 'pjFront/elements/layout_5/index.php';
		break;
	default:
		include_once PJ_VIEWS_PATH . 'pjFront/elements/layout_1/index.php';
		break;
}
?>

<script type="text/javascript">
var phpevtcalOpj = new PhpEvtCal({
	layout: "<?php echo $_GET['layout']; ?>",
	default_view: "<?php echo $default_view; ?>",
	enable_categories: "<?php echo $show_cats == 1 ? 'Yes' : 'No'; ?>",
	enable_monthly_view: "<?php echo $tpl['option_arr']['o_enable_monthly_view']; ?>",
	enable_list_view: "<?php echo $tpl['option_arr']['o_enable_list_view']; ?>",
	show_header: "<?php echo $show_header;?>",
	display_events: "<?php echo $tpl['option_arr']['o_display_events'];?>",
	event_title_position: "<?php echo $tpl['option_arr']['o_event_title_position'];?>",
	
	load_events_url: "<?php echo PJ_INSTALL_FOLDER; ?>index.php?controller=pjFront&action=pjActionLoadEvents",
	load_event_detail_url: "<?php echo PJ_INSTALL_FOLDER; ?>index.php?controller=pjFront&action=pjActionLoadEventDetail",

	current_month: "<?php echo date('m');?>",
	current_year: "<?php echo date('Y');?>"
});
</script>