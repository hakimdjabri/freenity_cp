
<div class="login_flex">
		<form method="POST">
		    <input class="login_input input_username<?php if($model->error_code == 1) echo ' error'?>" name="LoginForm[username]" placeholder="Login" value="<?php echo $model->username?>" onFocus="$(this).removeClass('error')"/>
				<div class="input_username_logo"></div>
		    <input class="login_input input_password<?php if($model->error_code == 2) echo ' error'?>" name="LoginForm[password]" type="password" placeholder="Password" value="<?php echo $model->password?>" onFocus="$(this).removeClass('error')"/>
				<div class="input_password_logo"></div>
		    <div class="btn login" onclick="$('form').submit()">Log In<?php //echo $model->error_code?></div>
		</form>
</div>
