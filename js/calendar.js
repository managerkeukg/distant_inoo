$(document).ready(function(){
	// ---- Календарь -----
	$('#example').attachDatepicker();
	$('#exampleRange').attachDatepicker({
		rangeSelect: true,
		yearRange: '2000:2010',
		firstDay: 1
	});
  // ---- Календарь -----
});