$('.material-icons').click(function(){
	if ($(this).text()=='check_box'){
		$(this).text('check_box_outline_blank');
	}
	else{
		$(this).text('check_box');
	}
	
})