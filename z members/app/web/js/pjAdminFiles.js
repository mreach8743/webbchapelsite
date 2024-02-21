var jQuery_1_8_2 = jQuery_1_8_2 || $.noConflict();
(function ($, undefined) {
	$(function () {
		var $frmCreateFile = $("#frmCreateFile"),
			$frmUpdateFile = $("#frmUpdateFile"),
			chosen = ($.fn.chosen !== undefined),
			validate = ($.fn.validate !== undefined),
			datagrid = ($.fn.datagrid !== undefined);
		
		if ($frmCreateFile.length > 0 && validate) {
			
			$frmCreateFile.validate({
				rules: {
					"title": {
						required: true,
						remote: "index.php?controller=pjAdminFiles&action=pjActionCheckFileTitle"
					},
					"file":{
						extension: "doc|docx|xls|xlsx|ppt|pdf|csv|zip|rar|png|jpg|jpeg|gif"
					}
				},
				messages:{
					"title": {
						remote: myLabel.same_title
					},
					"file":{
						extension: "File with extension is not allowed to upload."
					}
				},
				errorPlacement: function (error, element) {
					error.insertAfter(element.parent());
				},
				onkeyup: false,
				errorClass: "err",
				wrapper: "em"
			});
		}
		if ($frmUpdateFile.length > 0 && validate) {
			$frmUpdateFile.validate({
				rules: {
					"title": {
						required: true,
						remote: "index.php?controller=pjAdminFiles&action=pjActionCheckFileTitle&id=" + $frmUpdateFile.find("input[name='id']").val()
					},
					"file":{
						extension: "doc|docx|xls|xlsx|ppt|pdf|csv|zip|rar|png|jpg|jpeg|gif"
					}
				},
				messages:{
					"title": {
						remote: myLabel.same_title
					},
					"file":{
						extension: "File with extension is not allowed to upload."
					}
				},
				errorPlacement: function (error, element) {
					error.insertAfter(element.parent());
				},
				onkeyup: false,
				errorClass: "err",
				wrapper: "em"
			});
		}
		if (chosen) {
			$("#group_id").chosen();
			$("#member_id").chosen();
		}
		
		if ($("#grid").length > 0 && datagrid) 
		{
			function onBeforeShow (obj) {
				return true;
			}
			
			var $grid = $("#grid").datagrid({
				buttons: [{type: "edit", url: "index.php?controller=pjAdminFiles&action=pjActionUpdate&id={:id}"},
				          {type: "delete", url: "index.php?controller=pjAdminFiles&action=pjActionDeleteFile&id={:id}", beforeShow: onBeforeShow}],
						  
				columns: [{text: myLabel.title, type: "text", sortable: true, editable: true},
				          {text: myLabel.file_name, type: "text", sortable: false, editable: true},
				          {text: myLabel.uploaded, type: "text", sortable: false, editable: false},
				          {text: myLabel.status, type: "select", sortable: true, editable: true, options: [
				                                                                                     {label: myLabel.active, value: "T"}, 
				                                                                                     {label: myLabel.inactive, value: "F"}
				                                                                                     ], applyClass: "pj-status"}],
				dataUrl: "index.php?controller=pjAdminFiles&action=pjActionGetFile",
				dataType: "json",
				fields: ['title', 'file_name', 'created', 'status'],
				paginator: {
					actions: [
					   {text: myLabel.delete_selected, url: "index.php?controller=pjAdminFiles&action=pjActionDeleteFileBulk", render: true, confirmation: myLabel.delete_confirmation},
					   {text: myLabel.revert_status, url: "index.php?controller=pjAdminFiles&action=pjActionStatusFile", render: true},
					   {text: myLabel.exported, url: "index.php?controller=pjAdminFiles&action=pjActionExportFile", ajax: false}
					],
					gotoPage: true,
					paginate: true,
					total: true,
					rowCount: true
				},
				saveUrl: "index.php?controller=pjAdminFiles&action=pjActionSaveFile&id={:id}",
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
			$grid.datagrid("load", "index.php?controller=pjAdminFiles&action=pjActionGetFile", "title", "ASC", content.page, content.rowCount);
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
			$grid.datagrid("load", "index.php?controller=pjAdminFiles&action=pjActionGetFile", "title", "ASC", content.page, content.rowCount);
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
			$.post("index.php?controller=pjAdminFiles&action=pjActionSetActive", {
				id: $(this).closest("tr").data("object")['id']
			}).done(function (data) {
				$grid.datagrid("load", "index.php?controller=pjAdminFiles&action=pjActionGetFile");
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
			$grid.datagrid("load", "index.php?controller=pjAdminFiles&action=pjActionGetFile", "title", "ASC", content.page, content.rowCount);
			return false;
		});
	});
})(jQuery_1_8_2);