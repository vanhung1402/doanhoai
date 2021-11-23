$(document).ready(function() {
	const getTotalPrice = () => {
		let total = 0;
		$.each($('.check-items'), function(index, val) {
			const checked = $(this).is(":checked");
			const price = Number($(this).data('gia'));
			total += checked ? price : 0;
		});
		$('#thanh-tien').text(numeral(total).format('0,0'));
		$('#tong-tien').text(numeral(total + 49000).format('0,0'));

		(!total) ? $('#thanh-toan').addClass('hidden') : $('#thanh-toan').removeClass('hidden');
	}

	$('.check-items').change(function(event) {
		getTotalPrice();
	});

	$('.check-shop').change(function (e) {
		const checked = $(this).is(":checked");
		$itemChecks = $(this).closest('.shop-container').find('.check-items');
		checked ? $itemChecks.prop('checked', true) : $itemChecks.prop('checked', false);
		$itemChecks.change();
	});
});