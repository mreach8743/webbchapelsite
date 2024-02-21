var jQuery_1_8_2 = $.noConflict();
(function ($, undefined) {
	$(function () {
		var tabs = ($.fn.tabs !== undefined),
			$tabs = $("#tabs");
		
		if ($tabs.length > 0 && tabs) {
			$tabs.tabs();
		}
		
		$(".field-int").spinner({
			min: 0
		});
		
		setCustom = function()
		{
			var step_1 = $('#clone_step_1').text();
			var layout = $('#layout').val();
			var view = $('#install_view').val();
			var icons = $('#hide_icons').val();
			var cats = $('#hide_categories').val();
			var file_name = $('#css_file').val();
			if(file_name == '')
			{
				step_1 = step_1.replace('{CSSFile}', '');
			}else{
				step_1 = step_1.replace('{CSSFile}', '&cssfile=' + file_name);
			}
			step_1 = step_1.replace('{LAYOUT}', layout);
			step_1 = step_1.replace('{VIEW}', view);
			step_1 = step_1.replace('{ICONS}', icons);
			step_1 = step_1.replace('{CATS}', cats);
			
			$('#install_step_1').val(step_1);
		};
		
		if($('#install_step_1').length > 0)
		{
			setCustom();
			var clone_explanation = $('#clone_explanation').html();
			var layout = $('#layout').val();
			clone_explanation = clone_explanation.replace('{DefaultCSS}', 'front_' + layout + '.css');
			$('#install_css_explanation').html(clone_explanation);
		}
		
		$("#content").on("focusin", ".textarea_install", function (e) {
			$(this).select();
		}).on('keyup', '#css_file', function(e){
			setCustom();
		}).on('change', '#install_view', function(e){
			setCustom();
		}).on('change', '#hide_icons', function(e){
			setCustom();
		}).on('change', '#hide_categories', function(e){
			setCustom();
		}).on('change', '#layout', function(e){
			var layout = $(this).val();
			var clone_explanation = $('#clone_explanation').html();
			clone_explanation = clone_explanation.replace('{DefaultCSS}', 'front_' + layout + '.css');
			$('#install_css_explanation').html(clone_explanation);
			$('#css_file').val('front_' + layout + '.css');
			setCustom();
		}).on('click', '.pj-install-preview', function(e){
			e.preventDefault();
			var view = $('#install_view').val();
			var icons = $('#hide_icons').val();
			var cats = $('#hide_categories').val();
			var file_name = $('#css_file').val();
			var layout = $('#layout').val();
			window.open('index.php?controller=pjAdminOptions&action=pjActionPreview&layout=' + layout + '&cssfile=' + file_name + '&view=' + view + '&icons=' + icons + '&cats=' + cats);
		});
		
	});
})(jQuery_1_8_2);