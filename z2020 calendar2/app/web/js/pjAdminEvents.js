var jQuery_1_8_2 = $.noConflict();
(function ($, undefined) {
	$(function () {
		var $frmCreateEvent = $("#frmCreateEvent"),
			$frmUpdateEvent = $("#frmUpdateEvent"),
			validate = ($.fn.validate !== undefined),
			datagrid = ($.fn.datagrid !== undefined);
		
		var checkTime = function(){
			var shour = parseInt($('#start_hour').val(), 10), smin = parseInt($('#start_minute').val(), 10);
			var ehour = parseInt($('#end_hour').val(), 10), emin = parseInt($('#end_minute').val(), 10);
			
			if(shour > ehour)
			{
				return false;
			}else if(shour < ehour){
				return true;
			}else{
				if(smin > emin)
				{
					return false;
				}else{
					return true;
				}
			}
		}
		
		if ($frmCreateEvent.length > 0 && validate) {
			
			$frmCreateEvent.validate({
				
				errorPlacement: function (error, element) {
						
					error.insertAfter(element.parent());
				},	
				onkeyup: false,
				errorClass: "err",
				wrapper: "em",
				submitHandler: function(form)
				{
					if ($('#start_time_box').is(':visible') && $('#end_time_box').is(':visible')) {
						if(checkTime.apply(null,[]) == true)
						{
							form.submit();
							return true;
						}else{
							$('#err_time_check').css('display', 'block');
							return false;
						}
					}else{
						form.submit();
						return true;
					}
				}
			});
		}
		if ($frmUpdateEvent.length > 0 && validate) {
			$frmUpdateEvent.validate({
				errorPlacement: function (error, element) {
					error.insertAfter(element.parent());
				},
				onkeyup: false,
				errorClass: "err",
				wrapper: "em",
				submitHandler: function(form)
				{
					if ($('#start_time_box').is(':visible') && $('#end_time_box').is(':visible')) {
						if(checkTime.apply(null,[]) == true)
						{
							form.submit();
							return true;
						}else{
							$('#err_time_check').css('display', 'block');
							return false;
						}
					}else{
						form.submit();
						return true;
					}
				}
			});
			
		}
		
		$('a.time-link').on('click', function(e){
			e.preventDefault();
			var flag = $(this).attr('rev');
			var time_flag = $('#time_flag').val();
			
			if(time_flag == '0')
			{
				$('#start_time_box').css('display','block');
				$('#end_time_box').css('display','block');
				$(this).attr('rev', '1');
				$('#time_flag').val(1);
				$(this).css('display','none');
				$('#time_link_container').css('display','none');
				$('#err_time_check').css('display', 'none');
			}else if(time_flag == '2'){
				$('#start_time_box').css('display','block');
				$(this).attr('rev', '1');
				$('#time_flag').val(1);
				$(this).html(myLabel.add_time);
				$('#time_link').css('display','none');
				$('#time_link_container').css('display','none');
				$('#err_time_check').css('display', 'none');
			}else if(time_flag == '3'){
				$('#end_time_box').css('display','block');
				$(this).attr('rev', '1');
				$('#time_flag').val(1);
				$(this).html(myLabel.add_time);
				$('#time_link').css('display','none');
				$('#time_link_container').css('display','none');
			}
		});
		
		$('a.remove-link').on('click',function(e){
			e.preventDefault();
			var flag = $(this).attr('rev');
			var time_flag = $('#time_flag').val();
			if(flag == 2){
				$('#start_time_box').css('display','none');
				$('#time_link').css('display','block');
				$('#time_link_container').css('display','block');
				if(time_flag == '1')
				{
					$('#time_flag').val(2);
					$('#time_link').attr('rev', '2');
					$('#time_link').html(myLabel.add_start_time);
				}else if(time_flag == '3'){
					$('#time_flag').val(0);
					$('#time_link').attr('rev', '0');
					$('#time_link').html(myLabel.add_time);
				}else{
					
				}
			}else if(flag == 3){
				$('#end_time_box').css('display','none');
				$('#time_link').css('display','block');
				$('#time_link_container').css('display','block');
				if(time_flag == '1')
				{
					$('#time_flag').val(3);
					$('#time_link').attr('rev', '3');
					$('#time_link').html(myLabel.add_end_time);
				}else if(time_flag == '2'){
					$('#time_flag').val(0);
					$('#time_link').attr('rev', '0');
					$('#time_link').html(myLabel.add_time);
				}
			}
		});
		
		$('#repeat-monthly-date').on('change', function(e){
			if($(this).val() == 0)
			{
				$('#repeat-monthly-each').removeAttr('disabled');
				$('#repeat-monthly-day').removeAttr('disabled');
			}else{
				$('#repeat-monthly-each').attr('disabled', 'disabled');
				$('#repeat-monthly-day').attr('disabled', 'disabled');
			}
		});
		
		$('#repeat').on('change', function(e){
			$('p[id^="repeat_"]').css('display','none');
			$('div[id^="repeat_"]').css('display','none');
			$('#repeat_' + $(this).val()).css('display','block');
			if($(this).val() == 'none')
			{
				$('#repeat_box').css('display','none');
			}else{
				$('#repeat_box').css('display','block');
			}
		});
		
		if ($("#grid").length > 0 && datagrid) {
			function formatDefault (str, obj) {
				if (obj.role_id == 3) {
					return '<a href="#" class="pj-status-icon pj-status-' + (str == 'F' ? '0' : '1') + '" style="cursor: ' +  (str == 'F' ? 'pointer' : 'default') + '"></a>';
				} else {
					return '<a href="#" class="pj-status-icon pj-status-1" style="cursor: default"></a>';
				}
			}
			function showTime(str, obj)
			{
				if(obj.start_time != null && obj.end_time != null)
				{	
					return obj.start_time + "<br/>" + obj.end_time;
				}else if(obj.start_time != null && obj.end_time == null){
					return obj.start_time + "<br/>--";
				}else if(obj.start_time == null && obj.end_time != null){
					return "--<br/>" + obj.end_time;
				}else{
					return '';
				}
			}
			var $grid = $("#grid").datagrid({
				buttons: [{type: "edit", url: "index.php?controller=pjAdminEvents&action=pjActionUpdate&id={:id}"},
				          {type: "delete", url: "index.php?controller=pjAdminEvents&action=pjActionDeleteEvent&id={:id}"}
				          ],
				columns: [{text: myLabel.eventdate, type: "date", sortable: true, editable: false, width:80, renderer: $.datagrid._formatDate, dateFormat: pjGrid.jsDateFormat},
				          {text: myLabel.eventtime, type: "text", sortable: true, editable: false, width:70, renderer: showTime},
				          {text: myLabel.eventtitle, type: "text", sortable: true, editable: false, width: 350},
				          {text: myLabel.status, type: "select", sortable: true, editable: true, width:80 ,options: [
				                                                                                     {label: myLabel.active, value: "T"}, 
				                                                                                     {label: myLabel.inactive, value: "F"}
				                                                                                     ], applyClass: "pj-status"}],
				dataUrl: "index.php?controller=pjAdminEvents&action=pjActionGetEvent",
				dataType: "json",
				fields: ['event_date', 'event_title', 'event_title', 'status'],
				paginator: {
					actions: [
					   {text: myLabel.delete_selected, url: "index.php?controller=pjAdminEvents&action=pjActionDeleteEventBulk", render: true, confirmation: myLabel.delete_confirmation},
					   {text: myLabel.revert_status, url: "index.php?controller=pjAdminEvents&action=pjActionStatusEvent", render: true},
					   {text: myLabel.exported, url: "index.php?controller=pjAdminEvents&action=pjActionExportEvent", ajax: false}
					],
					gotoPage: true,
					paginate: true,
					total: true,
					rowCount: true
				},
				saveUrl: "index.php?controller=pjAdminEvents&action=pjActionSaveEvent&id={:id}",
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
			$grid.datagrid("load", "index.php?controller=pjAdminEvents&action=pjActionGetEvent", "event_date", "DESC", content.page, content.rowCount);
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
			$grid.datagrid("load", "index.php?controller=pjAdminEvents&action=pjActionGetEvent", "event_date", "DESC", content.page, content.rowCount);
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
			$.post("index.php?controller=pjAdminEvents&action=pjActionSetActive", {
				id: $(this).closest("tr").data("object")['id']
			}).done(function (data) {
				$grid.datagrid("load", "index.php?controller=pjAdminEvents&action=pjActionGetEvent");
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
			$grid.datagrid("load", "index.php?controller=pjAdminEvents&action=pjActionGetEvent", "event_date", "DESC", content.page, content.rowCount);
			return false;
		}).on("focusin", ".datepick", function (e) {
			var $this = $(this);
			$this.datepicker({
				firstDay: $this.attr("rel"),
				dateFormat: $this.attr("rev"),
				onClose: function (selectedDate) {
					var name = $this.attr("name");
					if (name == "date_from[]") {
						$this.closest("tr").find(".datepick[name='date_to[]']").datepicker("option", "minDate", selectedDate);
					} else if (name == "date_to[]") {
						$this.closest("tr").find(".datepick[name='date_from[]']").datepicker("option", "maxDate", selectedDate);
					}
				}
			});
		}).on("click", ".pj-form-field-icon-date", function (e) {
			var $dp = $(this).parent().siblings("input[type='text']");
			if ($dp.hasClass("hasDatepicker")) {
				$dp.datepicker("show");
			} else {
				$dp.trigger("focusin").datepicker("show");
			}
		});
	});
})(jQuery_1_8_2);