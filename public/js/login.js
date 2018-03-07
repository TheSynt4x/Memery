$(document)
.on("submit", "#userLogin", function(){
  if(validate("login")){
		$.post('../../../login.php', $(this).serialize(), function(data){
			var success = document.getElementById('successMsg');
			var fail = document.getElementById('errormsg');
			
			if(data === '0'){
				fail.innerHTML = 'Username or password is incorrect. Please check again!';

				$('.alert-danger').show();
				if($('#successMsg').is(':visible')) {
					$('.login-success').hide();
				}
			} else if (data == '1'){
				success.innerHTML = 'You\'ve been logged in!'

				$('.alert-success').show();
				if($('#errormsg').is(':visible')) {
					$('.login-alert').hide();
				}

				setTimeout(function(){
				   window.location.reload(1);
				}, 2000);
			}
		});
	}
})
;

function validate(){
		var error = document.getElementById('errormsg');
		if($("#username").val() === '') {
			$('.login-alert').show();
			$("#username").focus();
			
			error.innerHTML = 'Must provide a username.';

			return false;
		} else if($("#password").val() === '') {
			$('.login-alert').show();
			$("#password").focus();

			error.innerHTML = "Must provide a password.";
			
			return false;
		} else {
			$('.login-alert').hide();
		}

		return true;
}