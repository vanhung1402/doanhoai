$(document).ready(function() {
	$('#don-hang-tabs-header .nav-item').click(function(event) {
		$('#don-hang-tabs-header .nav-item .nav-link').removeClass('active');
		$(this).find('.nav-link').addClass('active');
		const tab = $(this).find('.nav-link').data('tab');
		console.log(tab)
		$('#don-hang-tabs .tab-pane').removeClass('active show');
		$(`#don-hang-tabs .tab-pane#${tab}`).addClass('active show');
	});
});