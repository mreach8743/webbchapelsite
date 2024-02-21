var jQuery_1_8_2 = jQuery_1_8_2 || $.noConflict();
(function ($, undefined) {
	$(function () {
		var $frmCreateMember = $("#frmCreateMember"),
			$frmUpdateMember = $("#frmUpdateMember"),
			$frmImportMember = $("#frmImportMember"),
			datepicker = ($.fn.datepicker !== undefined),
			chosen = ($.fn.chosen !== undefined),
			validate = ($.fn.validate !== undefined),
			datagrid = ($.fn.datagrid !== undefined);
		
		if ($frmImportMember.length > 0 && validate) {
			
			$frmImportMember.validate({
				rules: {
					csv:{
						extension: "csv"
					}
				},
				messages: {
					csv:{
						extension: myLabel.csv_allowed
					}
				},
				errorPlacement: function (error, element) {
					error.insertAfter(element.parent());
				},
				onkeyup: false,
				errorClass: "err",
				wrapper: "em",
				ignore: ''
			});
		}

		if ($frmCreateMember.length > 0 && validate) {
			$frmCreateMember.validate({
				rules: {
					"email": {
						required: true,
						email: true,
						remote: "index.php?controller=pjAdminMembers&action=pjActionCheckEmail"
					}
				},
				messages: {
					"email": {
						remote: myLabel.email_taken
					}
				},
				errorPlacement: function (error, element) {
					error.insertAfter(element.parent());
				},
				onkeyup: false,
				errorClass: "err",
				wrapper: "em",
				ignore: ''
			});
		}
		if ($frmUpdateMember.length > 0 && validate) {
			$frmUpdateMember.validate({
				rules: {
					"email": {
						required: true,
						email: true,
						remote: "index.php?controller=pjAdminMembers&action=pjActionCheckEmail&id=" + $frmUpdateMember.find("input[name='id']").val()
					}
				},
				messages: {
					"email": {
						remote: myLabel.email_taken
					}
				},
				errorPlacement: function (error, element) {
					error.insertAfter(element.parent());
				},
				onkeyup: false,
				errorClass: "err",
				wrapper: "em",
				ignore: ''
			});
		}
		
		if (chosen) {
			$("#group_id").chosen();
			$("#country_id").chosen();
		}
		$(".field-int").spinner({
			min: 0
		});
		
		if ($("#grid").length > 0 && datagrid) 
		{
			function onBeforeShow (obj) {
				return true;
			}
			
			var $grid = $("#grid").datagrid({
				buttons: [{type: "edit", url: "index.php?controller=pjAdminMembers&action=pjActionUpdate&id={:id}"},
				          {type: "delete", url: "index.php?controller=pjAdminMembers&action=pjActionDeleteMember&id={:id}", beforeShow: onBeforeShow}],
						  
				columns: [{text: myLabel.first_name, type: "text", sortable: true, editable: true, width: 90, editableWidth: 90},
				          {text: myLabel.last_name, type: "text", sortable: true, editable: true, width: 90, editableWidth: 90},
				          {text: myLabel.email, type: "text", sortable: true, editable: true},
				          {text: myLabel.group, type: "text", sortable: false, editable: false, width: 90},
				          {text: myLabel.status, type: "select", sortable: true, editable: true, width: 90, options: [
				                                                                                     {label: myLabel.active, value: "T"}, 
				                                                                                     {label: myLabel.inactive, value: "F"}
				                                                                                     ], applyClass: "pj-status"}],
				dataUrl: "index.php?controller=pjAdminMembers&action=pjActionGetMember" + pjGrid.queryString,
				dataType: "json",
				fields: ['first_name', 'last_name', 'email', 'group_title', 'status'],
				paginator: {
					actions: [
					   {text: myLabel.delete_selected, url: "index.php?controller=pjAdminMembers&action=pjActionDeleteMemberBulk", render: true, confirmation: myLabel.delete_confirmation},
					   {text: myLabel.revert_status, url: "index.php?controller=pjAdminMembers&action=pjActionStatusMember", render: true},
					   {text: myLabel.exported, url: "index.php?controller=pjAdminMembers&action=pjActionExportMember", ajax: false}
					],
					gotoPage: true,
					paginate: true,
					total: true,
					rowCount: true
				},
				saveUrl: "index.php?controller=pjAdminMembers&action=pjActionSaveMember&id={:id}",
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
				q: "",
				first_name: "",
				last_name: "",
				email: "",
				last_login: "",
				age_from: "",
				age_to: "",
				group_id: "",
				country_id: "",
				status: "",
				gender: ""
			});
			$grid.datagrid("option", "cache", cache);
			$grid.datagrid("load", "index.php?controller=pjAdminMembers&action=pjActionGetMember", "first_name", "ASC", content.page, content.rowCount);
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
			$grid.datagrid("load", "index.php?controller=pjAdminMembers&action=pjActionGetMember", "first_name", "ASC", content.page, content.rowCount);
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
			$.post("index.php?controller=pjAdminMembers&action=pjActionSetActive", {
				id: $(this).closest("tr").data("object")['id']
			}).done(function (data) {
				$grid.datagrid("load", "index.php?controller=pjAdminMembers&action=pjActionGetMember");
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
				q: $this.find("input[name='q']").val(),
				first_name: "",
				last_name: "",
				email: "",
				last_login: "",
				age_from: "",
				age_to: "",
				group_id: "",
				country_id: "",
				status: "",
				gender: ""
			});
			$grid.datagrid("option", "cache", cache);
			$grid.datagrid("load", "index.php?controller=pjAdminMembers&action=pjActionGetMember", "first_name", "ASC", content.page, content.rowCount);
			return false;
		}).on("click", ".pj-form-field-icon-date", function (e) {
			var $dp = $(this).parent().siblings("input[type='text']");
			if ($dp.hasClass("hasDatepicker")) {
				$dp.datepicker("show");
			} else {
				$dp.trigger("focusin").datepicker("show");
			}
		}).on("focusin", ".datepick-birthday", function (e) {
			var $this = $(this),
				custom = {},
				o = {
					firstDay: $this.attr("rel"),
					dateFormat: $this.attr("rev"),
					changeMonth: true,
					changeYear: true,
					yearRange: '1900:'+myLabel.current_year
			};
			$this.not('.hasDatepicker').datepicker($.extend(o, custom));
		}).on("click", ".pj-button-detailed, .pj-button-detailed-arrow", function (e) {
			e.stopPropagation();
			$(".pj-form-filter-advanced").toggle();
		}).on("submit", ".frm-filter-advanced", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			var obj = {},
				$this = $(this),
				arr = $this.serializeArray(),
				content = $grid.datagrid("option", "content"),
				cache = $grid.datagrid("option", "cache");
			for (var i = 0, iCnt = arr.length; i < iCnt; i++) {
				obj[arr[i].name] = arr[i].value;
			}
			$.extend(cache, obj);
			$grid.datagrid("option", "cache", cache);
			$grid.datagrid("load", "index.php?controller=pjAdminMembers&action=pjActionGetMember", "first_name", "ASC", content.page, content.rowCount);
			return false;
		}).on("reset", ".frm-filter-advanced", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			$(".pj-button-detailed").trigger("click");
			if (chosen) {
				$("#country_id").val('').trigger("liszt:updated");
				$("#group_id").val('').trigger("liszt:updated");
			}
			$('#first_name').val('');
			$('#last_name').val('');
			$('#email').val('');
			$('#last_login').val('');
			$('#age_from').val('');
			$('#age_to').val('');
			$('.datepick-search').val('');
			$('#status').val('');
			$('#gender').val('');
			$('#subscribed').val('');
			$('#chk_subscribed').prop('checked', false);
		}).on("click", "input[name='chk_subscribed']", function (e) {
			if($(this).is(':checked'))
			{
				$('#subscribed').val('T');
			}else{
				$('#subscribed').val('F');
			}
		});
	});
})(jQuery_1_8_2);