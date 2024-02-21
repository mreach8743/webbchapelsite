var jQuery_1_8_2 = jQuery_1_8_2 || $.noConflict();
(function ($, undefined) {
	$(function () {
		var $frmCreateGroup = $("#frmCreateGroup"),
			$frmUpdateGroup = $("#frmUpdateGroup"),
			validate = ($.fn.validate !== undefined),
			datagrid = ($.fn.datagrid !== undefined);
		
		if ($frmCreateGroup.length > 0 && validate) {
			$frmCreateGroup.validate({
				rules: {
					"group_title": {
						required: true,
						remote: "index.php?controller=pjAdminGroups&action=pjActionCheckGroupName"
					},
					"subscription_period": {
						required: {
							depends: function(element){
					            return $("#subscription_fee").val() != "";
					        }
						}
					}
				},
				messages:{
					"group_title": {
						remote: myLabel.same_group
					},
					"subscription_period": {
						required: myLabel.period_required
					}
				},
				errorPlacement: function (error, element) {
					if(element.attr('name') == 'subscription_fee')
					{
						error.insertAfter(element.parent().parent());
					}else{
						error.insertAfter(element.parent());
					}
				},
				onkeyup: false,
				errorClass: "err",
				wrapper: "em"
			});
		}
		if ($frmUpdateGroup.length > 0 && validate) {
			
			$frmUpdateGroup.validate({
				rules: {
					"group_title": {
						required: true,
						remote: "index.php?controller=pjAdminGroups&action=pjActionCheckGroupName&id=" + $frmUpdateGroup.find("input[name='id']").val()
					},
					"subscription_period": {
						required: {
							depends: function(element){
					            return $("#subscription_fee").val() != "";
					        }
						}
					}
				},
				messages:{
					"group_title": {
						remote: myLabel.same_group
					},
					"subscription_period": {
						required: myLabel.period_required
					}
				},
				errorPlacement: function (error, element) {
					if(element.attr('name') == 'subscription_fee')
					{
						error.insertAfter(element.parent().parent());
					}else{
						error.insertAfter(element.parent());
					}
				},
				onkeyup: false,
				errorClass: "err",
				wrapper: "em"
			});
		}
		
		if ($("#grid").length > 0 && datagrid) 
		{
			function onBeforeShow (obj) {
				return true;
			}
			function showSubcribers(str, obj){
				if(str == '0')
				{
					return 0;
				}else{
					return '<a href="index.php?controller=pjAdminMembers&action=pjActionIndex&group_id='+obj.id+'">'+str+'</a>';
				}
			}
			
			var $grid = $("#grid").datagrid({
				buttons: [{type: "edit", url: "index.php?controller=pjAdminGroups&action=pjActionUpdate&id={:id}"},
				          {type: "delete", url: "index.php?controller=pjAdminGroups&action=pjActionDeleteGroup&id={:id}", beforeShow: onBeforeShow}],
						  
				columns: [{text: myLabel.group, type: "text", sortable: true, editable: true, width: 190, editableWidth: 180},
				          {text: myLabel.registration_fee, type: "text", sortable: true, editable: false, width: 120},
				          {text: myLabel.subscription_fee, type: "text", sortable: true, editable: false, width: 120},
				          {text: myLabel.members, type: "text", sortable: false, editable: false, width: 70, renderer: showSubcribers},
				          {text: myLabel.status, type: "select", sortable: true, editable: true, options: [
				                                                                                     {label: myLabel.active, value: "T"}, 
				                                                                                     {label: myLabel.inactive, value: "F"}
				                                                                                     ], applyClass: "pj-status"}],
				dataUrl: "index.php?controller=pjAdminGroups&action=pjActionGetGroup",
				dataType: "json",
				fields: ['group_title', 'registration_fee', 'subscription_fee', 'cnt_members', 'status'],
				paginator: {
					actions: [
					   {text: myLabel.delete_selected, url: "index.php?controller=pjAdminGroups&action=pjActionDeleteGroupBulk", render: true, confirmation: myLabel.delete_confirmation},
					   {text: myLabel.revert_status, url: "index.php?controller=pjAdminGroups&action=pjActionStatusGroup", render: true},
					   {text: myLabel.exported, url: "index.php?controller=pjAdminGroups&action=pjActionExportGroup", ajax: false}
					],
					gotoPage: true,
					paginate: true,
					total: true,
					rowCount: true
				},
				saveUrl: "index.php?controller=pjAdminGroups&action=pjActionSaveGroup&id={:id}",
				select: {
					field: "id",
					name: "record[]"
				}
			});
		}
		
		$(document).on("click", ".btn-all", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			$(this).addClass("pj-button-active").siblings(".pj-button").removeClass("pj-button-active");
			var content = $grid.datagrid("option", "content"),
				cache = $grid.datagrid("option", "cache");
			$.extend(cache, {
				status: "",
				q: ""
			});
			$grid.datagrid("option", "cache", cache);
			$grid.datagrid("load", "index.php?controller=pjAdminGroups&action=pjActionGetGroup", "group_title", "ASC", content.page, content.rowCount);
			return false;
		}).on("click", ".btn-filter", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			var $this = $(this),
				content = $grid.datagrid("option", "content"),
				cache = $grid.datagrid("option", "cache"),
				obj = {};
			$this.addClass("pj-button-active").siblings(".pj-button").removeClass("pj-button-active");
			obj.status = "";
			obj[$this.data("column")] = $this.data("value");
			$.extend(cache, obj);
			$grid.datagrid("option", "cache", cache);
			$grid.datagrid("load", "index.php?controller=pjAdminGroups&action=pjActionGetGroup", "group_title", "ASC", content.page, content.rowCount);
			return false;
		}).on("click", ".pj-status-1", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			return false;
		}).on("click", ".pj-status-0", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			$.post("index.php?controller=pjAdminGroups&action=pjActionSetActive", {
				id: $(this).closest("tr").data("object")['id']
			}).done(function (data) {
				$grid.datagrid("load", "index.php?controller=pjAdminGroups&action=pjActionGetGroup");
			});
			return false;
		}).on("submit", ".frm-filter", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			var $this = $(this),
				content = $grid.datagrid("option", "content"),
				cache = $grid.datagrid("option", "cache");
			$.extend(cache, {
				q: $this.find("input[name='q']").val()
			});
			$grid.datagrid("option", "cache", cache);
			$grid.datagrid("load", "index.php?controller=pjAdminGroups&action=pjActionGetGroup", "group_title", "ASC", content.page, content.rowCount);
			return false;
		}).on("keyup", "#subscription_fee", function (e) {
			if($(this).val() == '' || $(this).val() == '0')
			{
				$('#subscription_period').val('');
			}
		});
	});
})(jQuery_1_8_2);