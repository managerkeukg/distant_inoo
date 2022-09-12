<form  id="form_login" action="student/login.php" method="post" target="_blank">
	<div style="background:#006 url(css/bg_azul.gif)  no-repeat; color: #FFF; font-weight:bold; padding: 5px; margin-bottom: 0;">
		<B>Электронный Образовательный Портал</B>
	</div>
	<div style="background-color: #E9E9E9; padding:3px 10px;">
		<div style="padding:3px 10px; font-size:0.8em;"> <!-- Только для Студентов. -->
			Каждому студенту  предоставляется доступ к учебным материалам в Электронном Образовательном Портале. Для получения логина и пароля необходимо лично обратиться в деканат Института.
		</div>	
		<div>
			Логин<input type="hidden" name="Auth">
		</div>
		<div>
			<input value="введите Логин"  onfocus="this.value=''" onblur="if (this.value=='') this.value='введите Логин'"
				type="text" name="login" id="login" >
			
		</div>
		<div>Пароль</div>
		<div><input type="password" name="password" id="password" value=""></div>
		<div>
			<input type="button" name="password" value="Войти" onclick="this.form.submit()">
		</div>		
	</div>
</form>
<br>