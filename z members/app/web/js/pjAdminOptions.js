var jQuery_1_8_2 = $.noConflict();
(function ($, undefined) {
	$(function () {
		var tabs = ($.fn.tabs !== undefined),
			chosen = ($.fn.chosen !== undefined),
			tipsy = ($.fn.tipsy !== undefined),
			$tabs = $("#tabs"),
			tOpt = {
				select: function (event, ui) {
					$(":input[name='tab_id']").val(ui.panel.id);
				}
			};
		
		if ($tabs.length > 0 && tabs) {
			$tabs.tabs(tOpt);
		}
		if (chosen) {
			$("#group_id").chosen();
			$("#protected_group_id").chosen();
		}
		$(".field-int").spinner({
			min: 0
		});
		if (tipsy) {
			$(".listing-tip").tipsy({
				offset: 1,
				opacity: 1,
				html: true,
				gravity: "nw",
				className: "tipsy-listing"
			});
		}
		
		function setInstallRegister()
		{
			var clone_text = $('#install_register_clone').text(),
				group_id = $('#group_id').val(),
				member_select = 'No';
			if ($("input[name='member_select']").is(':checked')) 
			{
				member_select = 'Yes';
			}
			clone_text = clone_text.replace('{MemberSelect}', '&pjSelect=' + member_select);
			if(group_id == '' || group_id == null)
			{
				clone_text = clone_text.replace('{GroupID}', '');
			}else{
				clone_text = clone_text.replace('{GroupID}', '&group_id=' + group_id);
			}
			if(member_select == 'Yes' || group_id != '')
			{
				$('#install_register').val(clone_text);
			}else{
				$('#install_register').val('');
			}
		}
		function setInstallProtected()
		{
			var clone_text = $('#install_protected_clone').text(),
				group_id = $('#protected_group_id').val();
				
			clone_text = clone_text.replace('{GroupID}', '$pjGroup = "' + group_id + '";\n');
			
			$('#install_protected').val(clone_text);
		}
		
		setInstallRegister();
		setInstallProtected();
		
		$("#content").on("focusin", ".textarea_install", function (e) {
			$(this).select();
		}).on("change", "select[name='value-enum-o_send_email']", function (e) {
			switch ($("option:selected", this).val()) {
			case 'mail|smtp::mail':
				$(".boxSmtp").hide();
				break;
			case 'mail|smtp::smtp':
				$(".boxSmtp").show();
				break;
			}
		}).on("change", "#group_id", function (e) {
			setInstallRegister();
		}).on("click", "input[name='member_select']", function (e) {
			setInstallRegister();
		}).on("change", "#protected_group_id", function (e) {
			setInstallProtected();
		}).on("click", ".pj-checkbox", function () {
			var $this = $(this);
			if ($this.find("input[type='checkbox']").is(":checked")) {
				$this.addClass("pj-checkbox-checked");
			} else {
				$this.removeClass("pj-checkbox-checked");
			}
			
			var reg_field_str = $('.registration-fields:checked').map(function(e){
				 return $(this).val();
			}).get();
			var pro_field_str = $('.profile-fields:checked').map(function(e){
				 return $(this).val();
			}).get();
			$('#o_registration_form').val(reg_field_str);
			$('#o_profile_form').val(pro_field_str);
		});
	});
})(jQuery_1_8_2);