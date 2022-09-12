// <![CDATA[
var glbInc, glbDec;
 
function decreaseSizeImage(image) // will get back to its normal default size
{
	var id = image;
	if(glbInc != null) {clearTimeout(glbInc); glbInc = null;};
	if (document.getElementById(id).height > 11)
	{
		//document.getElementById(id).height -= 30;
		document.getElementById(id).width -= 2;
		glbDec = setTimeout("decreaseSizeImage('"+id+"')", 32);
	};
}
 
function increaseSizeImage(image)
{
	var id = image;
	if(glbDec != null) {clearTimeout(glbDec); glbDec = null;};
	if (document.getElementById(id).height < 15)
	{
		//document.getElementById(id).height += 30;
		document.getElementById(id).width += 2;
		glbInc = setTimeout("increaseSizeImage('"+id+"')", 32);
	};
}
// ]]>