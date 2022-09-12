function check_empty_value()
{
	if (document.myForm.msg_theme.value  =='')
		{
			alert ("Заполните тему сообщения!");
			return false;	
		}
		
	if (document.myForm.msg.value  =='')
		{
			alert ("Заполните текст сообщения!");
			return false;	
		}
	
	return true;   
}