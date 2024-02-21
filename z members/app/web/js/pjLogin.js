(function (window, undefined) {
	var d = window.document;
	
	function loginML(options) {
		if (!(this instanceof loginML)) {
			return new loginML(options);
		}
		this.options = {};
		this.main_container = null;
		this.error_container = null;
		this.message_container = null;
		this.init(options);
		return this;
	}
	
	loginML.prototype = {
		submitLoginForm: function(post, btn)
		{
			var self = this;
			self.error_container.style.display = "none";			
			JABB.Ajax.postJSON(self.options.login_url, function (json) {
				var code = json.code,
					home_url = json.home_url;
				if(code == '100')
				{	
					if(home_url != '' && home_url != null)
					{
						window.location.href = home_url;
					}else{
						self.message_container.innerHTML = '<label class="message ml-l120 success">' + self.options.message.success + '</label>';
						self.message_container.style.display = "block";
					}
				}else if(code == '101'){
					self.message_container.innerHTML = '<label class="message ml-l120 error">' + self.options.message.error_1 + '</label>';
					self.message_container.style.display = "block";
					btn.disabled = false;
				}else if(code == '102'){
					self.message_container.innerHTML = '<label class="message ml-l120 error">' + self.options.message.error_2 + '</label>';
					self.message_container.style.display = "block";
					btn.disabled = false;
				}else if(code == '103'){
					self.message_container.innerHTML = '<label class="message ml-l120 error">' + self.options.message.error_3 + '</label>';
					self.message_container.style.display = "block";
					btn.disabled = false;
				}
			}, post);
		},
			
		validateLoginForm: function(btn)
		{
			var self = this,
				reg = /([0-9a-zA-Z\.\-\_]+)@([0-9a-zA-Z\.\-\_]+)\.([0-9a-zA-Z\.\-\_]+)/,
				frm = d.forms[self.options.login_form_name],
				email = frm.email,
				password = frm.password,
				message = '';
			
			if (email && email.value == '') {
				message += '<li>' + email.getAttribute("lang") + '</li>';
			}else{
				if(email.value.match(reg) == null)
				{
					message += '<li>' + self.options.validation.error_email_invalid + '</li>';
				}
			}
			if (password && password.value == '') {
				message += '<li>' + password.getAttribute("lang") + '</li>';
			}
			
			if (message != '') {
				self.error_container.innerHTML = message;
				self.message_container.style.display = "none";
				self.error_container.style.display = "block";
				btn.disabled = false;
			}else{
				self.submitLoginForm(JABB.Utils.serialize(frm), btn);
			}
		},
		submitForgotForm: function(post, btn)
		{
			var self = this;
			self.error_container.style.display = "none";			
			JABB.Ajax.postJSON(self.options.forgot_url, function (json) {
				var code = json.code;
				if(code == '100')
				{	
					self.message_container.innerHTML = '<label class="message ml-l120 success">' + self.options.message.forgot_success + '</label>';
					self.message_container.style.display = "block";
				}else if(code == '101'){
					self.message_container.innerHTML = '<label class="message ml-l120 error">' + self.options.message.forgot_error_1 + '</label>';
					self.message_container.style.display = "block";
					btn.disabled = false;
				}
			}, post);
		},
		validateForgotForm: function(btn)
		{
			var self = this,
				reg = /([0-9a-zA-Z\.\-\_]+)@([0-9a-zA-Z\.\-\_]+)\.([0-9a-zA-Z\.\-\_]+)/,
				frm = d.forms[self.options.forgot_form_name],
				email = frm.email,
				message = '';
			
			if (email && email.value == '') {
				message += '<li>' + email.getAttribute("lang") + '</li>';
			}else{
				if(email.value.match(reg) == null)
				{
					message += '<li>' + self.options.validation.error_email_invalid + '</li>';
				}
			}
			
			if (message != '') {
				self.error_container.innerHTML = message;
				self.message_container.style.display = "none";
				self.error_container.style.display = "block";
				btn.disabled = false;
			}else{
				self.submitForgotForm(JABB.Utils.serialize(frm), btn);
			}
		},
		bindForgotForm: function()
		{
			var self = this,
				back_link = JABB.Utils.getElementsByClass("ml-back-link", self.main_container, "A");
			
			if (d.forms[self.options.forgot_form_name] && d.forms[self.options.forgot_form_name][self.options.forgot_form_send_name]) {
				JABB.Utils.addEvent(d.forms[self.options.forgot_form_name][self.options.forgot_form_send_name], "click", function (event) {
					var $this = this;
					$this.disabled = true;
					self.validateForgotForm($this);
				});
			}
			JABB.Utils.addEvent(back_link[0], "click", function (event) {
				self.loadLoginForm();
			});
		},
		loadForgotForm: function()
		{
			var self = this;
			JABB.Ajax.sendRequest(self.options.load_forgot_form_url, function (req) {
				self.main_container.innerHTML = req.responseText;
				
				var error_container = JABB.Utils.getElementsByClass("ml-error-container", d.forms[self.options.login_form_name], "UL"),
					message_container = JABB.Utils.getElementsByClass("ml-message-container", d.forms[self.options.login_form_name], "P");
				
				self.error_container = error_container[0];
				self.message_container = message_container[0];
				self.bindForgotForm();
			});
		},
		bindLoginForm: function()
		{
			var self = this,
				forgot_link = JABB.Utils.getElementsByClass("ml-forgot-password", self.main_container, "A");
			
			if (d.forms[self.options.login_form_name] && d.forms[self.options.login_form_name][self.options.login_form_login_name]) {
				JABB.Utils.addEvent(d.forms[self.options.login_form_name][self.options.login_form_login_name], "click", function (event) {
					var $this = this;
					$this.disabled = true;
					self.validateLoginForm($this);
				});
			}
			JABB.Utils.addEvent(forgot_link[0], "click", function (event) {
				self.loadForgotForm();
			});
		},	
		loadLoginForm: function()
		{
			var self = this;
			JABB.Ajax.sendRequest(self.options.load_login_form_url, function (req) {
				self.main_container.innerHTML = req.responseText;
				
				var error_container = JABB.Utils.getElementsByClass("ml-error-container", d.forms[self.options.login_form_name], "UL"),
					message_container = JABB.Utils.getElementsByClass("ml-message-container", d.forms[self.options.login_form_name], "P");
				
				self.error_container = error_container[0];
				self.message_container = message_container[0];
				self.bindLoginForm();
			});
		},
		init: function (loginObj) {
			var self = this;
					
			self.options = loginObj;
			self.main_container = d.getElementById(self.options.memberlogin_container);
			
			self.loadLoginForm();
		}
	}
	return (window.loginML = loginML);
})(window);