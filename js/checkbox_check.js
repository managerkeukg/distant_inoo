function enable()
{
	var inputs = document.getElementsByTagName('input');
    var checkboxes = new Array();
	var checked_count = 0;
    for (var i = 0; i < inputs.length; i++) {
			if (inputs[i].type == 'checkbox') {
				checkboxes[i] = new Array(inputs[i].name);
			}
        }
    for (var i = 0; i < checkboxes.length; i++) { 
		if (document.getElementById('id_context_'+checkboxes[i]).checked) 
		{
			checked_count++;
		}		 
	}
    if (checked_count == 0) { 
		document.getElementById('btn_UnCheckAll').disabled=true; 
	} 
	else { 
		document.getElementById('bt_submit').disabled=false; 
		document.getElementById('btn_UnCheckAll').disabled=false;
	}
}

function checkAll()
{
	var inputs = document.getElementsByTagName('input');
	var checkboxes = [];
	for (var i = 0; i < inputs.length; i++) {
		if (inputs[i].type == 'checkbox') {
			inputs[i].checked =true;
		}
	}
	enable();
}

function UncheckAll()
{
	var inputs = document.getElementsByTagName('input');
	var checkboxes = [];
	for (var i = 0; i < inputs.length; i++) {
		if (inputs[i].type == 'checkbox') {
			inputs[i].checked =false;
		}
	}
	enable();
}
