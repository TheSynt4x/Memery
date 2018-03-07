$(document)
.on("submit", "#userRegister", function(){
  if(validate2("login")){
		$.post('../../../register.php', $(this).serialize(), function(data){
			var error = document.getElementById('rerrormsg');
			var success = document.getElementById('rsuccessMsg');
			
			if(data === '0') {
				error.innerHTML = 'Unknown Response, please report this to an administrator.';
				$('.register-alert').show();
				if($('#rsuccessMsg').is(':visible')) {
					$('.register-success').hide();
				}
			} else if(data === '1') {
				setTimeout(function(){
				   window.location.reload(1);
				}, 2000);

				success.innerHTML = 'You have been registered';
				$('.register-success').show();
				if($('#rerrormsg').is(':visible')) {
					$('.register-alert').hide();
				}


			} else if(data === '2') {
				error.innerHTML = 'The Username or Email already exists';
				$('.register-alert').show();
				if($('#rsuccessMsg').is(':visible')) {
					$('.register-success').hide();
				}
			} else if(data === '3') {
				error.innerHTML = 'The username\'s length can\'t exceeed 14';
				$('.register-alert').show();
				if($('#rsuccessMsg').is(':visible')) {
					$('.register-success').hide();
				}
			} else if(data === '4') {
				error.innerHTML = 'The username has to contain a minimum of 6 characters';
				$('.register-alert').show();
				if($('#rsuccessMsg').is(':visible')) {
					$('.register-success').hide();
				}
			} else if(data === '5') {
				error.innerHTML = 'The password\'s length can\'t exceed 14';
				$('.register-alert').show();
				if($('#rsuccessMsg').is(':visible')) {
					$('.register-success').hide();
				}
			} else if(data === '6') {
				error.innerHTML = 'The password has to contain a minimum of 6 characters ';
				$('.register-alert').show();
				if($('#rsuccessMsg').is(':visible')) {
					$('.register-success').hide();
				}
			} else if(data === '7') {
				error.innerHTML = 'The characters \'"&%¤# are not allowed in the username.';
				$('.register-alert').show();
				if($('#rsuccessMsg').is(':visible')) {
					$('.register-success').hide();
				}
			}
		});
	}
})
;

function validate2(){
		var error = document.getElementById('rerrormsg');

		if($("#rusername").val() === '') {
			$('.register-alert').show();
			$("#rusername").focus();
			
			error.innerHTML = 'Must provide a username.';

			return false;
		} else if($("#remail").val() === '') {
			$('.register-alert').show();
			$("#remail").focus();
			
			error.innerHTML = 'Must provide an E-Mail.';

			return false;
		} else if($("#rpassword").val() === '') {
			$('.register-alert').show();
			$("#rpassword").focus();

			error.innerHTML = "Must provide a password.";
			
			return false;
		} else if($("#rcpassword").val() === '' || $('#rcpassword').val() !== $('#rpassword').val()) {
			$('.register-alert').show();
			$("#rcpassword").focus();
			
			error.innerHTML = 'Plase confirm your password.';

			return false;
		} else {
			$('.register-alert').hide();
		}

		return true;
}