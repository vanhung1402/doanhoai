$(document).ready(function() {
	$('.check-items').click(function(event) {
		const checked = $(this).is(":checked");
		let value = $(this).data('gia');
		value = checked ? Number(value) : Number(`-${value}`);
		total += value;
		(!total) ? $('#thanh-toan').addClass('hidden') : $('#thanh-toan').removeClass('hidden');
		$('#thanh-tien').text(numeral(total).format('0,0'));
		$('#tong-tien').text(numeral(total + 49000).format('0,0'));
	});

	(!total) ? $('#thanh-toan').addClass('hidden') : $('#thanh-toan').removeClass('hidden');
});