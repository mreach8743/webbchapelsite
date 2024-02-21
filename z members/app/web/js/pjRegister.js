(function (window, undefined) {
	var d = window.document;
	
	function registerML(options) {
		if (!(this instanceof registerML)) {
			return new registerML(options);
		}
		this.options = {};
		this.error_container = null;
		this.message_container = null;
		this.fee_container = null;
		this.payment_container = null;
		this.day = null;
		this.month = null;
		this.year = null;
		this.init(options);
		return this;
	}
	
	registerML.prototype = {
		loadPaymentForm: function(id)
		{
			var self = this,
				frm = d.forms[self.options.registration_form_name];
			JABB.Ajax.sendRequest(self.options.get_payment_form_url + "&id=" + id, function (req) {
				self.payment_container.innerHTML = req.responseText;
				var payment_form = d.forms[self.options.paypal_form_name];
				if (typeof payment_form != 'undefined') {
					payment_form.submit();
				} else {
					window.location.href = self.options.thankyou_page;
				}
			});
		},
			
		submitForm: function(post, btn)
		{
			var self = this;
			self.error_container.style.display = "none";
			self.message_container.innerHTML = '<label class="message ml-l120 info">' + self.options.message.info + '</label>';
			JABB.Ajax.postJSON(self.options.registration_url, function (json) {
				var code = json.code;
				if(code == '100')
				{	
					window.location.href = self.options.thankyou_page;
				}else if(code == '200'){
					self.message_container.innerHTML = '<label class="message ml-l120 info">' + self.options.message.load + '</label>';
					self.loadPaymentForm(json.id);
				}else{
					self.message_container.innerHTML = '<label class="message ml-l120 error">' + self.options.message.error + '</label>';
					btn.disabled = false;
				}
			}, post);
			self.message_container.style.display = "block";
		},
			
		checkCaptcha: function(btn)
		{
			var self = this,
				frm = d.forms[self.options.registration_form_name],
				captcha = frm.captcha.value;
			
			JABB.Ajax.sendRequest(self.options.check_captcha_url + "&captcha=" + captcha, function (req) {
				var code = req.responseText;
				if(code == '100')
				{
					self.submitForm(JABB.Utils.serialize(frm), btn);
				}else{
					self.error_container.innerHTML = '<li>' + self.options.validation.error_captcha_incorrect + '</li>';
					self.error_container.style.display = "block";
					btn.disabled = false;
				}
			});
		},
			
		checkEmail: function(btn)
		{
			var self = this,
				frm = d.forms[self.options.registration_form_name],
				email = frm.email.value;
			
			JABB.Ajax.sendRequest(self.options.check_email_url + "&email=" + email, function (req) {
				var code = req.responseText;
				if(code == '100')
				{
					self.checkCaptcha(btn);
				}else{
					self.error_container.innerHTML = '<li>' + self.options.validation.error_email_used + '</li>';
					self.error_container.style.display = "block";
					btn.disabled = false;
				}
			});
		},
			
		validateForm: function(btn)
		{
			var self = this,
				re = /([0-9a-zA-Z\.\-\_]+)@([0-9a-zA-Z\.\-\_]+)\.([0-9a-zA-Z\.\-\_]+)/,
				message = "",
				frm = d.forms[self.options.registration_form_name],
				day = frm.day,
				month = frm.month,
				year = frm.year;
			
			for (var i = 0, len = frm.elements.length; i < len; i++) 
			{
				var cls = frm.elements[i].className;
				if (cls.indexOf("ml-required") !== -1 && frm.elements[i].disabled === false) {
					switch (frm.elements[i].nodeName) {
					case "INPUT":
						switch (frm.elements[i].type) {
						case "checkbox":
						case "radio":
							if (!frm.elements[i].checked && frm.elements[i].getAttribute("lang")) {
								message += "<li>" + frm.elements[i].getAttribute("lang") + "</li>"; 
							}
							break;
						default:
							if (frm.elements[i].value.length === 0 && frm.elements[i].getAttribute("lang")) {
								message += "<li>" + frm.elements[i].getAttribute("lang") + "</li>";
							}else{
								if(frm.elements[i].getAttribute("name") == 'birthday')
								{
									if (self.year == null || self.month == null && self.day == null)
									{
										message += '<li>' + self.options.validation.error_birthday_invalid + '</li>';
									}
								}
							}
							break;
						}
						break;
					case "TEXTAREA":
						if (frm.elements[i].value.length === 0 && frm.elements[i].getAttribute("lang")) {						
							message += "<li>" + frm.elements[i].getAttribute("lang") + "</li>";
						}
						break;
					case "SELECT":
						switch (frm.elements[i].type) {
						case 'select-one':
							if (frm.elements[i].value.length === 0 && frm.elements[i].getAttribute("lang")) {
								message += "<li>" + frm.elements[i].getAttribute("lang") + "</li>"; 
							}
							break;
						case 'select-multiple':
							var has = false;
							for (j = frm.elements[i].options.length - 1; j >= 0; j = j - 1) {
								if (frm.elements[i].options[j].selected) {
									has = true;
									break;
								}
							}
							if (!has && frm.elements[i].getAttribute("lang")) {
								message += "<li>" + frm.elements[i].getAttribute("lang") + "</li>";
							}
							break;
						}
						break;
					default:
						break;
					}
				}
				if (cls.indexOf("email") !== -1) {
					if (frm.elements[i].nodeName === "INPUT" && frm.elements[i].value.length > 0 && frm.elements[i].value.match(re) == null) {
						message += "<li>" + self.options.validation.error_email_invalid + "</li>";
					}
				}
			}

			if (message != '') {
				self.error_container.innerHTML = message;
				self.error_container.style.display = "block";
				btn.disabled = false;
			}else{
				self.checkEmail(btn);
			}
		},
		
		loadFee: function()
		{
			var self = this,
				frm = d.forms[self.options.registration_form_name],
				registration_fee_container = d.getElementById("ml_registration_fee"),
				subscription_fee_container = d.getElementById("ml_subscription_fee");
			
			var group_id = frm['group_id'].value;
			
			JABB.Ajax.getJSON(self.options.get_fee_url + "&id=" + group_id, function (json) {	
				if(json.id != null)
				{
					if(json.registration_fee != '')
					{
						registration_fee_container.innerHTML = json.registration_fee;
						registration_fee_container.parentNode.style.display = "block";
					}else{
						registration_fee_container.parentNode.style.display = "none";
					}
					if(json.subscription_fee != '')
					{
						subscription_fee_container.innerHTML = json.subscription_fee;
						subscription_fee_container.parentNode.style.display = "block";
					}else{
						subscription_fee_container.parentNode.style.display = "none";
					}
					self.fee_container.style.display = "block";
				}else{
					self.fee_container.style.display = "none";
				}
			});
		},
		
		bindForm: function()
		{
			var self = this,
				frm = d.forms[self.options.registration_form_name],
				day = frm.day,
				month = frm.month,
				year = frm.year,
				group = frm.group_id;
							
			self.fee_container.style.display = "none";
			
			if (frm && frm[self.options.registration_form_register_name]) {
				JABB.Utils.addEvent(frm[self.options.registration_form_register_name], "click", function (event) {
					var $this = this;
					$this.disabled = true;
					self.validateForm($this);
				});
			}
			
			if(group)
			{
				group.onchange = function () {
					self.loadFee();
				}
			}
			
			self.loadFee();
			
			var date_arr = JABB.Utils.getElementsByClass("ml-birthday", d.forms[self.options.registration_form_name], "SELECT");
			for (i = 0, len = date_arr.length; i < len; i++) {
				date_arr[i].onchange = function () {
					if(this.getAttribute("name") == 'day')
					{
						self.day = this.value;
					}
					if(this.getAttribute("name") == 'month')
					{
						self.month = this.value;
					}
					if(this.getAttribute("name") == 'year')
					{
						self.year = this.value;
					}
					d.forms[self.options.registration_form_name]['birthday'].value = self.year + '-' + self.month + '-' + self.day;
				};
			}
			if (day && day.value != '')
			{
				self.day = day.value;
			}
			if (month && month.value != '')
			{
				self.month = month.value;
			}
			if (year && year.value != '')
			{
				self.year = year.value;
			}
			
			
		},
		init: function (registerObj) {
			var self = this,
				error_container = JABB.Utils.getElementsByClass("ml-error-container", d.forms[self.options.registration_form_name], "UL"),
				message_container = JABB.Utils.getElementsByClass("ml-message-container", d.forms[self.options.registration_form_name], "P");
			
			self.options = registerObj;
			self.error_container = error_container[0];
			self.message_container = message_container[0];
			self.fee_container = d.getElementById("ml_fee_container");
			self.payment_container = d.getElementById("ml_payment_container");
			
			self.bindForm();
		}
	}
	return (window.registerML = registerML);
})(window);