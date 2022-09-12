var m="121";
var check_timer = function(){
	if(m==0) {  
		//document.getElementById('send_button').click;
		document.dog.submit();
	}
	else {
	m--;
	document.getElementById('dsec').innerHTML=  m;
	setTimeout(check_timer, 1000); // check_timer again in a second 
	}
}