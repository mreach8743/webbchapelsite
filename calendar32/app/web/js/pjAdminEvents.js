var jQuery_1_8_2 = jQuery_1_8_2 || $.noConflict();
(function ($, undefined) {
	$(function () {
		var $frmCreateEvent = $("#frmCreateEvent"),
			$frmUpdateEvent = $("#frmUpdateEvent"),
			$frmExportEvents = $("#frmExportEvents"),
			$dialogMapLocation = $('#dialogMapLocation'),
			location = null,
			map = null,
			dialog = ($.fn.dialog !== undefined),
			validate = ($.fn.validate !== undefined),
			datagrid = ($.fn.datagrid !== undefined);
		
		var checkTime = function(){
			var shour = parseInt($('#start_hour').val(), 10), smin = parseInt($('#start_minute').val(), 10),
				ehour = parseInt($('#end_hour').val(), 10), emin = parseInt($('#end_minute').val(), 10),
				time_ampm = $('#time_ampm').val();
			
			if(time_ampm == '0')
			{
				if(shour > ehour)
				{
					return false;
				}else if(shour < ehour){
					return true;
				}else{
					if(smin >= emin)
					{
						return false;
					}else{
						return true;
					}
				}
			}else if(time_ampm == '1'){
				var start_ampm = $('#start_ampm').val(),
					end_ampm = $('#end_ampm').val();
				
				if(start_ampm == 'am' && end_ampm == 'pm')
				{
					return true;
				}else if(start_ampm == 'pm' && end_ampm == 'am'){
					return false;
				}else{
					if(shour == 12){shour = 0;}
					if(ehour == 12){ehour = 0;}
					if(shour > ehour)
					{
						return false;
					}else if(shour < ehour){
						return true;
					}else{
						if(smin >= emin)
						{
							return false;
						}else{
							return true;
						}
					}
				}
			}else if(time_ampm == '2'){
				var start_ampm = $('#start_ampm').val(),
					end_ampm = $('#end_ampm').val();
				
				if(start_ampm == 'AM' && end_ampm == 'PM')
				{
					return true;
				}else if(start_ampm == 'PM' && end_ampm == 'AM'){
					return false;
				}else{
					if(shour == 12){shour = 0;}
					if(ehour == 12){ehour = 0;}
					if(shour > ehour)
					{
						return false;
					}else if(shour < ehour){
						return true;
					}else{
						if(smin >= emin)
						{
							return false;
						}else{
							return true;
						}
					}
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
			if($('#lat').val() != '' && $('#lng').val() != '' && $('#location').val() != '')
			{
				location = $('#location').val();
			}
		}
		if ($frmExportEvents.length > 0 && validate) {
			$frmExportEvents.validate({
				rules: {
					"password": {
						required: function(){
							if($('#feed').is(':checked'))
							{
								return true;
							}else{
								return false;
							}
						}
					}
				},
				errorPlacement: function (error, element) {
					error.insertAfter(element.parent());
				},
				onkeyup: false,
				errorClass: "err",
				wrapper: "em",
				ignore: ".ignore"
			});
		}
		if ($frmUpdateEvent.length > 0 || $frmCreateEvent.length > 0) 
		{
			tinymce.init({
			    selector: "textarea#description",
			    theme: "modern",
			    width: 550,
			    plugins: [
			         "advlist autolink link lists charmap",
			         "save directionality paste textcolor code"
			   ],
			   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons"
			 }); 
			
		}
		function initGMap(lat, lng)
		{
			var latlng = new google.maps.LatLng(lat, lng);
			var mapOptions = {
					  center: latlng,
					  zoom: 12,
					  mapTypeId: google.maps.MapTypeId.ROADMAP
					};
			var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
			var marker = new google.maps.Marker({
								draggable: true,
								position: latlng,
								map: map
							});
			google.maps.event.addListener(marker, 'dragend', function (event) {
			    $('#tmp_lat').val(this.getPosition().lat());
			    $('#tmp_lng').val(this.getPosition().lng());
			});
		}
		
		
		if ($dialogMapLocation.length > 0 && dialog) {
			$dialogMapLocation.dialog({
				modal: true,
				width: 480,
				resizable: false,
				draggable: false,
				autoOpen: false,
				open: function () {
					if($dialogMapLocation.data('lat') != '' && $dialogMapLocation.data('lng') != '')
					{
						initGMap(parseFloat($dialogMapLocation.data('lat')), parseFloat($dialogMapLocation.data('lng')));
					}
				},
				buttons: {
					"Cancel": function () {
						$dialogMapLocation.dialog("close");
					},
					"Save": function () {
						$('#lat').val($('#tmp_lat').val());
						$('#lng').val($('#tmp_lng').val());
						$dialogMapLocation.dialog("close");
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
				columns: [{text: myLabel.eventdate, type: "date", sortable: true, editable: false, width:100, renderer: $.datagrid._formatDate, dateFormat: pjGrid.jsDateFormat},
				          {text: myLabel.eventtime, type: "text", sortable: true, editable: false, width:70, renderer: showTime},
				          {text: myLabel.eventtitle, type: "text", sortable: true, editable: false, width: 330},
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
			$('#category_id').val('');
			var content = $grid.datagrid("option", "content"),
				cache = $grid.datagrid("option", "cache");
			$.extend(cache, {
				status: "",
				q: "",
				category_id: "",
				keyword: "",
				from_date: "",
				to_date: ""
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
			$grid.datagrid("load", "index.php?controller=pjAdminEvents&action=pjActionGetEvent", "event_date", "DESC", content.page, content.rowCount);
			return false;
		}).on("reset", ".frm-filter-advanced", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			$(".pj-button-detailed").trigger("click");
			
			$('#category_id').val('');
			$('#keyword').val('');
			$('#from_date').val('');
			$('#to_date').val('');
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
				q: $this.find("input[name='q']").val(),
				category_id: "",
				keyword: "",
				from_date: "",
				to_date: ""
			});
			$grid.datagrid("option", "cache", cache);
			$grid.datagrid("load", "index.php?controller=pjAdminEvents&action=pjActionGetEvent", "event_date", "DESC", content.page, content.rowCount);
			return false;
		}).on("focusin", ".datepick", function (e) {
			var $this = $(this);
			$this.datepicker({
				firstDay: $this.attr("rel"),
				dateFormat: $this.attr("rev"),
				dayNames: ($this.data("day")).split(","),
			    monthNames: ($this.data("months")).split(","),
			    monthNamesShort: ($this.data("shortmonths")).split(","),
			    dayNamesMin: ($this.data("daymin")).split(","),
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
		}).on("click", ".pecMapIcon", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			if($('#location').val() != '')
			{
				if(location != $('#location').val())
				{					
					$.get("index.php?controller=pjAdminEvents&action=pjActionGetGeocode&location=" + $('#location').val()).done(function (data) {
						if (data.code !== undefined && data.code == 200) {
							$("#lat").val(data.lat);
							$("#lng").val(data.lng);
							$("#tmp_lat").val(data.lat);
							$("#tmp_lng").val(data.lng);
							$dialogMapLocation.data('lat', data.lat).data('lng', data.lng);
						}else{
							$("#tmp_lat").val("");
							$("#tmp_lng").val("");
							$('#map_canvas').html(myLabel.location_not_found);
						}
						$dialogMapLocation.dialog("open");
					});
					location = $('#location').val();
				}else{
					$dialogMapLocation.data('lat', $("#lat").val()).data('lng', $("#lng").val());
					$dialogMapLocation.dialog("open");
				}
			}else{
				$('#location_validation_message').parent().css('display', 'block');
			}			
		}).on("change", "#export_period", function (e) {
			var period = $(this).val();
			if(period == 'last')
			{
				$('#last_label').show();
				$('#next_label').hide();
			}else{
				$('#last_label').hide();
				$('#next_label').show();
			}
		}).on("click", "#file", function (e) {
			$('#phpevtcalSubmitButton').val(myLabel.btn_export);
			$('.phpevtcalFeedContainer').hide();
			$('.phpevtcalPassowrdContainer').hide();
		}).on("click", "#feed", function (e) {
			$('.phpevtcalPassowrdContainer').show();
			$('#phpevtcalSubmitButton').val(myLabel.btn_get_url);
		}).on("focus", "#events_feed", function (e) {
			$(this).select();
		});
		
		$(document).ready(function(){
			if($('.pj-button-detailed').length > 0)
			{
				if(pjGrid.find == 'true')
				{
					$('.pj-button-detailed').trigger('click');
				}
			}
		});
	});
})(jQuery_1_8_2);