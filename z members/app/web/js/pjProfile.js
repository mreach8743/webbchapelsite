(function (window, undefined) {
	var d = window.document;
	
	function profileML(options) {
		if (!(this instanceof profileML)) {
			return new profileML(options);
		}
		this.options = {};
		this.error_container = null;
		this.message_container = null;
		this.day = null;
		this.month = null;
		this.year = null;
		this.init(options);
		return this;
	}
	
	profileML.prototype = {
		submitForm: function(post, btn)
		{
			var self = this;
			
			self.error_container.style.display = "none";
			self.message_container.innerHTML = '<label class="message ml-l120 info">' + self.options.message.info + '</label>';
			
			JABB.Ajax.sendRequest(self.options.profile_url, function (req) {
				var code = req.responseText;
				if(code == '100')
				{	
					self.message_container.innerHTML = '<label class="message ml-l120 success">' + self.options.message.success + '</label>';
				}else{
					self.message_container.innerHTML = '<label class="message ml-l120 error">' + self.options.message.error + '</label>';
				}
				btn.disabled = false;
			}, post);
			self.message_container.style.display = "block";
		},
		checkEmail: function(btn)
		{
			var self = this,
				frm = d.forms[self.options.profile_form_name];
			
			JABB.Ajax.sendRequest(self.options.check_email_url + "&id="+frm.id.value+"&email=" + frm.email.value, function (req) {
				var code = req.responseText;
				if(code == '100')
				{
					self.submitForm(JABB.Utils.serialize(frm), btn);
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
				frm = d.forms[self.options.profile_form_name],
				password = frm.password,
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
								if(frm.elements[i].getAttribute("name") != 'new_password')
								{
									message += "<li>" + frm.elements[i].getAttribute("lang") + "</li>";
								}
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
		bindForm: function()
		{
			var self = this,
			frm = d.forms[self.options.profile_form_name],
			day = frm.day,
			month = frm.month,
			year = frm.year;
			
			if (frm && frm[self.options.profile_form_save_name]) {
				JABB.Utils.addEvent(frm[self.options.profile_form_save_name], "click", function (event) {
					var $this = this;
					$this.disabled = true;
					self.validateForm($this);
				});
			}
			var date_arr = JABB.Utils.getElementsByClass("ml-birthday", d.forms[self.options.profile_form_name], "SELECT");
			for (i = 0, len = date_arr.length; i < len; i++) {
				date_arr[i].onchange = function () {
					if(this.getAttribute("name") == 'day')
					{
						if(this.value != '')
						{
							self.day = this.value;
						}else{
							self.day = null
						}
					}
					if(this.getAttribute("name") == 'month')
					{
						if(this.value != '')
						{
							self.month = this.value;
						}else{
							self.month = null
						}
					}
					if(this.getAttribute("name") == 'year')
					{
						if(this.value != '')
						{
							self.year = this.value;
						}else{
							self.year = null
						}
					}
					frm['birthday'].value = self.year + '-' + self.month + '-' + self.day;
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
		init: function (profileObj) {
			if(profileObj.status == '0')
			{
				var self = this,
					error_container = JABB.Utils.getElementsByClass("ml-error-container", d.forms[self.options.registration_form_name], "UL"),
					message_container = JABB.Utils.getElementsByClass("ml-message-container", d.forms[self.options.registration_form_name], "P");
		
				self.options = profileObj;
				self.error_container = error_container[0];
				self.message_container = message_container[0];
				
				self.bindForm();
			}
		}
	}
	return (window.profileML = profileML);
})(window);