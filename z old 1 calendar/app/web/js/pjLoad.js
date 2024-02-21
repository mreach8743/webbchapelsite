(function (window, undefined) {
	var document = window.document;
	function PhpEvtCal(options) {
		if (!(this instanceof PhpEvtCal)) {
			return new PhpEvtCal(options);
		}
		this.options = {};
		this.main_content = null;
		this.event_detail = null;
		this.month = null;
		this.year = null;
		this.current_month = null;
		this.current_year = null;
		this.view_mode = null;
		this.category = null;
		this.page = null;
		this.num_events = null;
		this.init(options);
		return this;
	}
	PhpEvtCal.prototype = {
		bindMap: function()
		{
			var self = this;
			var arr = JABB.Utils.getElementsByClass("pec-location", document, "a");
			for (i = 0, len = arr.length; i < len; i++) {
				arr[i].onclick = function (e) {
					if (e && e.preventDefault) {
						e.preventDefault();
					}
					var event_id = this.getAttribute("data-id"),
						lat = parseFloat(this.getAttribute("data-lat")),
						lng = parseFloat(this.getAttribute("data-lng")),
						canvas = document.getElementById('pec_canvas_' + event_id);
					if(canvas != null)
					{
						if(canvas.style.display == 'block')
						{
							canvas.style.display = 'none';
						}else{
							canvas.style.display = 'block';
							var latlng = new google.maps.LatLng(lat, lng);
							var mapOptions = {
								zoom: 12,
								center: latlng,
							};
							var map = new google.maps.Map(document.getElementById('pec_canvas_' + event_id), mapOptions);
							var marker = new google.maps.Marker({
								draggable: false,
								position: latlng,
								map: map
							});
						}
					}
				};
			}
		},
		bindCategory: function()
		{
			var self = this;
			JABB.Utils.addEvent(document.getElementById('phpevtcal_category'), "change", function () {
				var $value = this.value;
				self.category = $value;
				self.loadEvents();
			});
		},
		bindMonthView: function()
		{
			var self = this;
			var arr = JABB.Utils.getElementsByClass("nav-arrow", document.getElementById('phpevtcal_nav_bar'), "a");
			for (i = 0, len = arr.length; i < len; i++) {
				arr[i].onclick = function () {
					var rev = this.getAttribute("rev");
					var m = parseInt(self.month, 10),
						y = parseInt(self.year, 10);
					if(rev == 'next')
					{
						m = m + 1;
						if(m > 12){
							m = 1;
							y = y + 1;
						}
					}else{
						m = m -1;
						if(m < 1){
							m = 12;
							y = y - 1;
						}
					}
					if(m < 10){
						self.month = '0' + m;
					}else{
						self.month = m;
					}
					self.year = y;
					
					self.loadEvents();			
				};
			}
			
			var arr = JABB.Utils.getElementsByClass("short-month", document.getElementById('phpevtcal_month_bar'), "a");
			for (i = 0, len = arr.length; i < len; i++) {
				arr[i].onclick = function () {
					var rev = this.getAttribute("rev"),
						rel = this.getAttribute("rel");
					self.month = rel;
					self.year = rev;
					self.loadEvents();
				};
			}
			
			self.bindMap();
		},
		bindEventDetail: function(){
			var self = this;
			var arr = JABB.Utils.getElementsByClass("phpevtcal-detail-close", self.options.event_detail, "a");
			for (i = 0, len = arr.length; i < len; i++) {
				arr[i].onclick = function () {
					var event_id = this.getAttribute("rev");
					var num_events = self.num_events;
					num_events--;
					self.num_events = num_events;
					if(num_events == 0)
					{
						document.getElementById('phpevtcal_table_calendar').style.display = 'block';
					}
					document.getElementById('phpevtcal_event_box_' + event_id).style.display = 'none';
				};
			}
			
			self.bindMap();
		},
		
		bindCalendarView: function(){
			var self = this;
			var arr = JABB.Utils.getElementsByClass("has-event", document.getElementById('phpevtcal_table_calendar'), "td");
			for (i = 0, len = arr.length; i < len; i++) {
				if(self.options.event_title_position == 'tooltip')
				{
					arr[i].onmouseover = function () {
						var tdPosition = self.getOffset(this);						
						var axis = this.getAttribute("axis");
						var abbr = this.getAttribute("abbr");
						var tooltip = document.getElementById('phpevtcal_tooltip_' + axis);
						var tooltip_height = tooltip.offsetHeight,
							tooltip_width = tooltip.offsetWidth;
						switch (self.options.layout) {
							case 'layout_1':
								tooltip.style.left = tdPosition.curleft+'px';
								tooltip.style.top = (tdPosition.curtop - tooltip_height + 2)+'px';
								break;
	
							case 'layout_2':
								var middle_tooltip = parseInt(tooltip_width / 2, 10);
								tooltip.style.left = (tdPosition.curleft + 48 - middle_tooltip)+'px';
								tooltip.style.top = (tdPosition.curtop - tooltip_height + 2)+'px';
								break;
							case 'layout_3':
								if(abbr != '7')
								{
									tooltip.style.left = (tdPosition.curleft - tooltip_width + 85)+'px';
								}else{
									tooltip.style.left = (tdPosition.curleft - tooltip_width + 88)+'px';
								}
								tooltip.style.top = (tdPosition.curtop + 70)+'px';
								break;
							case 'layout_4':
								tooltip.style.left = (tdPosition.curleft + 20)+'px';
								tooltip.style.top = (tdPosition.curtop - tooltip_height + 16)+'px';
								break;
							case 'layout_5':
								var fa_arr = JABB.Utils.getElementsByClass("fa", tooltip, "i");
								if(fa_arr.length > 0)
								{
									fa_arr[0].style.top = (parseInt(tooltip_height / 2, 10) - 22) + 'px';
								}
								tooltip.style.left = (tdPosition.curleft + 70)+'px';
								tooltip.style.top = (tdPosition.curtop - parseInt(tooltip_height / 2, 10) + 22)+'px';
								break;
						}
						tooltip.style.visibility = 'visible';
					};
					arr[i].onmouseout = function () {
						var axis = this.getAttribute("axis");
						var tooltip = document.getElementById('phpevtcal_tooltip_' + axis);
						tooltip.style.visibility = 'hidden';
					};
				}
				arr[i].onclick = function () {
					var day = parseInt(this.getAttribute("axis"), 10);
					var num_events = parseInt(this.getAttribute("lang"), 10);
					var dt = null;
					if(day < 10){
						dt = self.year + '-' + self.month + '-0' + day;
					}else{
						dt = self.year + '-' + self.month + '-' + day;
					}
					var qs = ["&layout=", self.options.layout, "&cate=", self.category, "&dt=", dt].join("");
					JABB.Ajax.sendRequest(self.options.load_event_detail_url + qs, function (req) {
						self.event_detail.innerHTML = req.responseText;
						if(self.options.display_events == 'replace')
						{
							document.getElementById('phpevtcal_table_calendar').style.display = 'none';
						}
						self.num_events = parseInt(num_events);
						self.bindEventDetail();
					});
				};
			}
			
			var arr = JABB.Utils.getElementsByClass("month-nav", document.getElementById('phpevtcal_table_calendar'), "a");
			for (i = 0, len = arr.length; i < len; i++) {
				arr[i].onclick = function () {
					var rev = this.getAttribute("rev"),
						rel = this.getAttribute("rel");
					self.month = rev;
					self.year = rel;
					self.loadEvents();
				}
			}
		},
		bindMenu: function()
		{
			var self = 	this;
			var arr = JABB.Utils.getElementsByClass("phpevtcal-view-mode", document.getElementById('phpevtcal_menu'), "a");
			
			for (i = 0, len = arr.length; i < len; i++) 
			{
				arr[i].onclick = function () {
					var rev = this.getAttribute("rev");
					var category_ele = document.getElementById('phpevtcal_category');
					self.month = self.current_month;
					self.year = self.current_year;
					self.category = 0;
					self.page = 1;
					self.view_mode = rev;
					if(category_ele != undefined)
					{
						category_ele.value = 0;
					}
					for (j = 0, len = arr.length; j < len; j++) 
					{
						JABB.Utils.removeClass(arr[j], 'focus');
					}
					JABB.Utils.addClass(this, 'focus');
					self.loadEvents();
				};
			}
		},
		bindListView: function()
		{
			var self = 	this;
			var arr = JABB.Utils.getElementsByClass("phpevtcal-paging", document.getElementById('phpevtcal_pagination'), "a");
			for (i = 0, len = arr.length; i < len; i++) {
				arr[i].onclick = function () {
					var page = this.getAttribute("rev");
					self.page = page;
					self.loadEvents();
				};
			}
			self.bindMap();
		},
		loadEvents: function()
		{
			var self = 	this,
						qs = ["&layout=", this.options.layout, "&cate=", this.category, "&month=", this.month, "&year=", this.year, "&view_mode=", this.view_mode, "&page=", this.page].join("");
			JABB.Ajax.sendRequest(this.options.load_events_url + qs, function (req) {
				self.main_content.innerHTML = req.responseText;
				if(self.view_mode == 'monthly')
				{
					self.bindMonthView();
				}else if(self.view_mode == 'calendar'){
					self.event_detail = document.getElementById("phpevtcal_event_detail");
					
					self.bindCalendarView();
				}else if(self.view_mode == 'list'){
					self.bindListView();
				}
			});
		},
		getOffset: function (obj) {
			var obj2 = obj;
			var curtop = 0;
			var curleft = 0;
			if (document.getElementById || document.all) 
			{
				do{
					curleft += obj.offsetLeft-obj.scrollLeft;
					curtop += obj.offsetTop-obj.scrollTop;
					obj = obj.offsetParent;
					obj2 = obj2.parentNode;
					while (obj2!=obj) {
						curleft -= obj2.scrollLeft;
						curtop -= obj2.scrollTop;
						obj2 = obj2.parentNode;
					}
				} while (obj.offsetParent)
			} else if (document.layers) {
				curtop += obj.y;
				curleft += obj.x;
			}
			return {curtop : curtop, curleft: curleft};
		},
		init: function (calObj) {
			var self = this;
			var view_mode = calObj.default_view,
				month = calObj.current_month,
				year = calObj.current_year;
			self.main_content = document.getElementById("phpevtcal_content");
			self.options = calObj;
			self.month = month;
			self.year = year;
			self.current_month = month;
			self.current_year = year;
			self.view_mode = view_mode;
			self.category = 0;
			self.page = 1;
			self.loadEvents();
			if(self.options.show_header == '1')
			{
				if(self.options.enable_categories == 'Yes')
				{
					self.bindCategory();
				}
				if(self.options.enable_monthly_view == 'Yes' || self.options.enable_list_view == 'Yes')
				{	
					self.bindMenu();
				}
			}
		}
	}
	return (window.PhpEvtCal = PhpEvtCal);
})(window);