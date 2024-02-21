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
		},
		bindCalendarView: function(){
			var self = this;
			var arr = JABB.Utils.getElementsByClass("has-event", document.getElementById('phpevtcal_table_calendar'), "td");
			for (i = 0, len = arr.length; i < len; i++) {
				if(self.options.event_title_position == 'tooltip')
				{
					arr[i].onmouseover = function () {
						var axis = this.getAttribute("axis");
						var tooltip = document.getElementById('phpevtcal_tooltip_' + axis);
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
			
			for (i = 0, len = arr.length; i < len; i++) {
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