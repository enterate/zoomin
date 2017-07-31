jQuery(document).ready(function($){
//////////////////////////////////////////////////////////////////////////////////////////////////////////////						   

	$(".stylechanger li a").click(function() { 
		$("#skin-css").attr("href",$(this).attr('rel'));
		return false;
	});
	
	
	$(".openpanel").click(function(){$(".demo-panel").toggle("slow");$(this).toggleClass("active");return false});	
});