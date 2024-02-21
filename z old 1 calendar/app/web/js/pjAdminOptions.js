var jQuery_1_8_2 = jQuery_1_8_2 || $.noConflict();
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
			var theme = $('#theme').val();
			var view = $('#install_view').val();
			var icons = $('#hide_icons').val();
			var cats = $('#hide_categories').val();
			
			step_1 = step_1.replace('{THEME}', theme);
			step_1 = step_1.replace('{THEME}', theme);
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
		}).on('change', '#theme', function(e){
			setCustom();
		}).on('click', '.pj-install-preview', function(e){
			e.preventDefault();
			var view = $('#install_view').val();
			var icons = $('#hide_icons').val();
			var cats = $('#hide_categories').val();
			var file_name = $('#css_file').val();
			var layout = $('#layout').val();
			window.open('index.php?controller=pjAdminOptions&action=pjActionPreview&layout=' + layout + '&cssfile=' + file_name + '&view=' + view + '&icons=' + icons + '&cats=' + cats);
		}).on("click", ".pj-use-theme", function (e) {
			var theme = $(this).attr('data-theme');
			$('.pj-loader').css('display', 'block');
			$.ajax({
				type: "GET",
				async: false,
				url: 'index.php?controller=pjAdminOptions&action=pjActionUpdateTheme&theme=' + theme,
				success: function (data) {
					$('.theme-holder').html(data);
					$('.pj-loader').css('display', 'none');
				}
			});
		}).on('click', '.pjPecPreviewButton', function(e){
			var theme = $('#theme').val();
			var view = $('#install_view').val();
			var icons = $('#hide_icons').val();
			var cats = $('#hide_categories').val();
			
			window.open('preview.php?theme=' + theme + '&view=' + view + '&icons=' + icons + '&cats=' + cats, '_blank');
		});
		
	});
})(jQuery_1_8_2);