/*!
 * PHP Event Calendar v3.2
 * http://www.phpjabbers.com/php-event-calendar/
 * 
 * Copyright 2015, StivaSoft Ltd.
 * 
 */
(function (window, undefined){
	"use strict";
	
	pjQ.$.ajaxSetup({
		xhrFields: {
			withCredentials: true
		}
	});
	
	var document = window.document,
		routes = [];
	
	function log() {
		if (window.console && window.console.log) {
			for (var x in arguments) {
				if (arguments.hasOwnProperty(x)) {
					window.console.log(arguments[x]);
				}
			}
		}
	}
	
	function assert() {
		if (window && window.console && window.console.assert) {
			window.console.assert.apply(window.console, arguments);
		}
	}
	
	function hashBang(value) {
		if (value !== undefined && value.match(/^#!\//) !== null) {
			if (window.location.hash == value) {
				return false;
			}
			window.location.hash = value;
			return true;
		}
		
		return false;
	}
	
	function onHashChange() {
		var i, iCnt, m;
		for (i = 0, iCnt = routes.length; i < iCnt; i++) {
			m = window.location.hash.match(routes[i].pattern);
			if (m !== null) {
				pjQ.$(window).trigger(routes[i].eventName, m.slice(1));
				break;
			}
		}
		if (m === null) {
			pjQ.$(window).trigger("loadEvents");
		}
	}
	function res() {
		var _td = pjQ.$(".pjIcCalendarTable td");
		var td_width = _td.width();
		_td.height(td_width);
    }
	pjQ.$(window).on("hashchange", function (e) {
    	onHashChange.call(null);
    });
	
	function PHPEventCalendar(opts) {
		if (!(this instanceof PHPEventCalendar)) {
			return new PHPEventCalendar(opts);
		}
				
		this.reset.call(this);
		this.init.call(this, opts);
		
		return this;
	}
	
	PHPEventCalendar.inObject = function (val, obj) {
		var key;
		for (key in obj) {
			if (obj.hasOwnProperty(key)) {
				if (obj[key] == val) {
					return true;
				}
			}
		}
		return false;
	};
	
	PHPEventCalendar.size = function(obj) {
		var key,
			size = 0;
		for (key in obj) {
			if (obj.hasOwnProperty(key)) {
				size += 1;
			}
		}
		return size;
	};
	
	PHPEventCalendar.prototype = {
		reset: function () {
			this.$container = null;
			this.container = null;
			this.opts = {};
			
			this.month = null;
			this.year = null;
			this.current_month = null;
			this.current_year = null;
			this.view_mode = null;
			this.category = 0;
			this.page = 1;
			this.num_events = null;
			return this;
		},
		disableButtons: function () {
			var $el;
			this.$container.find(".pjCpbSelectorButton").each(function (i, el) {
				$el = pjQ.$(el).attr("disabled", "disabled");
			});
		},
		enableButtons: function () {
			this.$container.find(".pjCpbSelectorButton").removeAttr("disabled");
		},
		
		init: function (opts) {
			var self = this;
			this.opts = opts;
			this.month = this.opts.current_month;
			this.year = this.opts.current_year;
			this.view_mode = this.opts.default_view;
			this.current_month = this.opts.current_month;
			this.current_year = this.opts.current_year;
			this.container = document.getElementById("pjPecContainer_" + this.opts.index);
			this.$container = pjQ.$(this.container);
			
			this.$container.on('click.pec', '.pjPecMonthlyNav', function(e){
				if (e && e.preventDefault) {
					e.preventDefault();
				}
				var direction = pjQ.$(this).attr('data-direction');
				var m = parseInt(self.month, 10),
					y = parseInt(self.year, 10);
				if(direction == 'next')
				{
					m = m + 1;
					if(m > 12)
					{
						m = 1;
						y = y + 1;
					}
				}else{
					m = m -1;
					if(m < 1)
					{
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
				self.loadEvents.call(self);
			}).on('click.pec', '.pjPecMonthName', function(e){
				if (e && e.preventDefault) {
					e.preventDefault();
				}
				self.month = pjQ.$(this).attr('data-month');
				self.year = pjQ.$(this).attr('data-year');
				self.loadEvents.call(self);
			}).on('click.pec', '.pjPecEventLocation', function(e){
				if (e && e.preventDefault) {
					e.preventDefault();
				}
				var event_id = pjQ.$(this).attr("data-id"),
					lat = parseFloat(pjQ.$(this).attr("data-lat")),
					lng = parseFloat(pjQ.$(this).attr("data-lng")),
					canvas = document.getElementById('pjPecMapCanvas_' + event_id);
				
				pjQ.$(canvas).toggle('slow', function(){
					var latlng = new google.maps.LatLng(lat, lng);
					var mapOptions = {
						zoom: 12,
						center: latlng,
					};
					var map = new google.maps.Map(document.getElementById('pjPecMapCanvas_' + event_id), mapOptions);
					var marker = new google.maps.Marker({
						draggable: false,
						position: latlng,
						map: map
					});
				});
			}).on('click.pec', '.pjPecPaging', function(e){
				if (e && e.preventDefault) {
					e.preventDefault();
				}
				self.page = pjQ.$(this).attr('data-page');
				self.loadEvents.call(self);
			}).on('click.pec', '.pjPecCalendarNav', function(e){
				if (e && e.preventDefault) {
					e.preventDefault();
				}
				self.month = pjQ.$(this).attr('data-month');
				self.year = pjQ.$(this).attr('data-year');
				self.loadEvents.call(self);
			}).on('click.pec', '.pjPecDayHasEvents', function(e){
				if (e && e.preventDefault) {
					e.preventDefault();
				}
				var day = parseInt(pjQ.$(this).attr('data-day'), 10),
					num_events = parseInt(pjQ.$(this).attr('data-events'), 10),
					dt = null;
				if(day < 10){
					dt = self.year + '-' + self.month + '-0' + day;
				}else{
					dt = self.year + '-' + self.month + '-' + day;
				}
				var params = 	{
						"index": self.opts.index,
						"cate": self.category,
						"dt": dt
					};
				pjQ.$.get([self.opts.folder, "index.php?controller=pjFront&action=pjActionLoadEventDetail"].join(""), params).done(function (data) {
					pjQ.$('#pjPecEventList_' + self.opts.index).html(data);
					if(self.opts.display_events == 'replace')
					{
						pjQ.$('#pjPecCalendar_' + self.opts.index).hide();
					}
					self.num_events = parseInt(num_events);
				}).fail(function () {
					
				});
			}).on('click.pec', '.pjPecCloseEvent', function(e){
				if (e && e.preventDefault) {
					e.preventDefault();
				}
				var id = pjQ.$(this).attr('data-id'),
					num_events = self.num_events;
				num_events--;
				self.num_events = num_events;
				if(num_events == 0)
				{
					pjQ.$('#pjPecCalendar_' + self.opts.index).show();
				}
				pjQ.$('#pjPecEventBox_' + id).remove();
			});
			
			pjQ.$('.pjPecCategory').click(function(e){
				if (e && e.preventDefault) {
					e.preventDefault();
				}
				pjQ.$('#pjPecDropDown_' + self.opts.index).html(pjQ.$(this).text());
				self.category = pjQ.$(this).attr('data-id');
				self.loadEvents.call(self);
			});
			
			pjQ.$('.pjPecViewMode').click(function(e){
				if (e && e.preventDefault) {
					e.preventDefault();
				}
				pjQ.$('.pjPecViewMode').removeClass('active');
				pjQ.$(this).addClass('active');
				self.view_mode = pjQ.$(this).attr('data-mode');
				self.loadEvents.call(self);
			});
			
			pjQ.$(window).on("loadEvents", this.container, function (e) {
				self.loadEvents.call(self);
			});
			
			if (window.location.hash.length === 0) {
				this.loadEvents.call(this);
			} else {
				onHashChange.call(null);
			}
		},
		
		loadEvents: function () {
			var self = this,
				index = this.opts.index,
				params = 	{
								"index": this.opts.index,
								"cate": self.category,
								"month": self.month,
								"year": self.year,
								"view_mode": self.view_mode,
								"page": self.page
							};
			pjQ.$.get([this.opts.folder, "index.php?controller=pjFront&action=pjActionLoadEvents"].join(""), params).done(function (data) {
				self.$container.html(data);
				self.bindMap.call(self);
				
	        	pjQ.$(window).resize(res).trigger("resize");
	        	pjQ.$('.pjTooltipster').tooltipster({
	        		contentAsHTML: true
	        	});
		        	
			}).fail(function () {
				self.enableButtons.call(self);
			});
		},
		bindMap: function()
		{
			if (typeof window.initializeFD == "undefined") 
			{
				window.initializeFD = function () 
				{};
				pjQ.$.getScript("http://maps.googleapis.com/maps/api/js?sensor=false&callback=initializeFD");
			}
		}
	};
	
	window.PHPEventCalendar = PHPEventCalendar;	
})(window);