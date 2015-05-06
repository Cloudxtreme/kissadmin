$(document).ready(function(){
	$('#togglenav').click(function() {
		$('#nav').slideToggle('fast');
	});

	$(window).on('resize', function() {
		if ($(window).width() >= 750) {
			$('#nav').show();
		}
		else {
			$('#nav').hide();
		}
	});
	
	$(document).on('click','.alert-dismissible',function(){
		$(this).parent().fadeTo(300,0,function(){
			  $(this).remove();
		});
	});
	
	$("#checkAll").change(function () {
		$("input:checkbox").prop('checked', $(this).prop("checked"));
	});
});