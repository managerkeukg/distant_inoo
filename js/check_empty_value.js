function check_empty_value()
{
	if (document.myForm.msg_theme.value  =='')
		{
			alert ("��������� ���� ���������!");
			return false;	
		}
		
	if (document.myForm.msg.value  =='')
		{
			alert ("��������� ����� ���������!");
			return false;	
		}
	
	return true;   
}