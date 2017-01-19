
$(document).ready(function(){
	$("#button").click(function(){
		var date = new Date();
		var utc = date.getTimezoneOffset();
		$("#utcdiff").val(utc);
	});
});