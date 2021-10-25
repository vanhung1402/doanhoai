<script>
	$('document').ready(function(){
		{if isset($status)}
			{if $status=='t'}
				var pftitle = 'Thành công';
				var pftext = 'Đã cập nhật thông tin danh sách';
				var pftype = 'success';
			{else if $status=='f'}
				var pftitle = 'Thất bại';
				var pftext = 'Chưa cập nhật được thông tin danh sách';
				var pftype = 'error';
			{else if $status=='e'}
				var pftitle = 'Thất bại';
				var pftext = 'Thiếu thông tin danh sách';
				var pftype = 'error';
			{else if $status=='-1'}
				var pftitle = 'Thất bại';
				var pftext = 'Chưa có sinh viên nào được cập nhật điểm';
				var pftype = 'error';
			{else if $status=='-d'}
				var pftitle = 'Thất bại';
				var pftext = 'Sinh viên chưa được xóa khỏi danh sách';
				var pftype = 'error';
			{else if $status=='d'}
				var pftitle = 'Thành công';
				var pftext = 'Đã xóa sinh viên khỏi danh sách';
				var pftype = 'success';
			{else}
				var pftitle = 'Thành công';
				var pftext = 'Đã cập nhật điểm cho {$status} sinh viên';
				var pftype = 'success';
			{/if}
			var notice = $.pnotify({
							   pnotify_title: pftitle,
							   pnotify_text: pftext,
							   type: pftype,
							   icon: 'glyphicon glyphicon-info-sign',
							   addclass: 'snotify',
							   pnotify_closer: true,
							   pnotify_delay: 5000
							});
		{/if}
		var baseUrl = '{$url}';
		
		function appendLoading(f){
			if(f){
				$('#ntl-dt').css("opacity", "0.5");
				$('#loading-image').show();
				
			} else {
				$('#ntl-dt').css("opacity", "1");
				$('#loading-image').hide();
			}
		}
	
		$(document).on('keydown', '.ntl-cc, .ntl-dk, .ntl-tong', function(e){
			
			t = $(this);
			id = parseInt(t.attr('data-id'));
			if(t.hasClass('ntl-cc')){
				if (t['0'].id=='ntl-cc'+id)
					switch(e.keyCode){
						case 37: return false;
						case 38: arrowMove('#ntl-cc'+(id-1)); break;
						case 39: arrowMove('#ntl-dk'+id); break;
						case 40: arrowMove('#ntl-cc'+(id+1)); break;
					}
				else
					switch(e.keyCode){
						case 37: arrowMove('#ntl-cc'+id); break;
						case 38: arrowMove('#ntl-dk'+(id-1)); break;
						case 39: arrowMove('#ntl-thi'+id); break;
						case 40: arrowMove('#ntl-dk'+(id+1)); break;
					}
			}
			else if(t.hasClass('ntl-dk')){
				switch(e.keyCode){
					case 37: arrowMove('#ntl-dk'+id); break;
					case 38: arrowMove('#ntl-thi'+(id-1)); break;
					case 39: arrowMove('#ntl-tong'+id); break;
					case 40: arrowMove('#ntl-thi'+(id+1)); break;
				}
			}
			else if(t.hasClass('ntl-tong')){
				switch(e.keyCode){
					case 37: arrowMove('#ntl-thi'+id); break;
					case 38: arrowMove('#ntl-tong'+(id-1)); break;
					case 39: arrowMove('#ntl-cc'+(id+1)); break;
					case 40: arrowMove('#ntl-tong'+(id+1)); break;
				}
			}
		});
	
		$(document).on('keydown', '.ntle-cc, .ntle-dk, .ntle-thi, .ntle-tong', function(e){
			
			t = $(this);
			id = parseInt(t.attr('data-id'));
			if(t.hasClass('ntle-cc')){
				switch(e.keyCode){
					case 37: return false;
					case 38: arrowMove('#ntle-cc'+(id-1)); break;
					case 39: arrowMove('#ntle-dk'+id); break;
					case 40: arrowMove('#ntle-cc'+(id+1)); break;
				}				
			}
			else if(t.hasClass('ntle-dk')){
				switch(e.keyCode){
					case 37: arrowMove('#ntle-cc'+id); break;
					case 38: arrowMove('#ntle-dk'+(id-1)); break;
					case 39: arrowMove('#ntle-thi'+id); break;
					case 40: arrowMove('#ntle-dk'+(id+1)); break;
				}				
			}
			else if(t.hasClass('ntle-thi')){
				switch(e.keyCode){
					case 37: arrowMove('#ntle-dk'+id); break;
					case 38: arrowMove('#ntle-thi'+(id-1)); break;
					case 39: arrowMove('#ntle-tong'+id); break;
					case 40: arrowMove('#ntle-thi'+(id+1)); break;
				}				
			} else if(t.hasClass('ntle-tong')){
				switch(e.keyCode){
					case 37: arrowMove('#ntle-thi'+id); break;
					case 38: arrowMove('#ntle-tong'+(id-1)); break;
					case 39: arrowMove('#ntle-cc'+(id+1)); break;
					case 40: arrowMove('#ntle-tong'+(id+1)); break;
				}				
			}
		});
	
		function arrowMove(id){
			
			//if($(id).length>0 && $(id).prop('disabled')==false){
				$(id).focus();
			//}
		}
	
		function kiemtradiem(el, val){
			if(!(($.isNumeric(val) && val>=0 && val<=10) || val.toLowerCase()=='m' || val.toLowerCase()=='k'|| val.toLowerCase()=='n')){
				alert("Điểm phải là số và trong khoảng 0-10");
				el.addClass('input-error');
				el.val('');
				return false;
			} else {
				el.removeClass('input-error');
			}
		}
	
		$('.chuyencan-ck').change(function(){
			success = true;
			lop = $('#lop').val();
			masv = $(this).attr('data-id');
			if($(this).prop('checked')==false)
			{
				action = 'del';
			}
			else
			{
				action = 'add';
			}
			
			$.post(baseUrl+'nhapdiemtheolop_new/capnhatchuyencan', { 'masv': masv, 'malop': lop, 'act': action })
			.success(function(response){
				if(response!='success')
				{
					success = false;
					jQuery.showMessage('error', 'Chưa cập nhật được');
				}
				else
				{
					jQuery.showMessage('success', 'Đã cập nhật thành công');
				}
			})
			.error(function(){
				success = false;
				jQuery.showMessage('error', 'Chưa cập nhật được');
			});
			return success;
		});
	
		$('.ndtl-lop').change(function(){
			$malop = $(this).val();
			$.ajax({
				type: 'GET',
				url: baseUrl+'nhapdiemtheolop_new/montheolop/'+$malop,
				success: function(response){
					if(response.length>0){
						monhocArr = JSON.parse(response);
						htmlOption = '';
						$.each(monhocArr, function(k, v){
							htmlOption+='<option value="'+v['ma_mon_ctdt']+'">'+v['ten_mh']+'</option>';
						});
						$('#ndtl-mon').html(htmlOption).select2();;
					}
				}
			});
		});
		
		$(document).on('change', '.ntl-cc, .ntl-dk', function(){
			var tong;
			val = $(this).val();
			if(val.length>0){
				if($.isNumeric(val)){
					$(this).val(parseFloat(val));
				} else if(val=='k' || val=='m'|| val=='n'){
					$(this).val(val.toUpperCase());
				}
				kiemtradiem($(this), val);
			}
			id = $(this).attr('data-id');
			cc = $('#ntl-cc'+id).val();
			dk = $('#ntl-dk'+id).val();
			thi = $('#ntl-thi'+id).val();
			if(thi.length>0 && dk.length==0 && $('#ad3070').is(':checked')==false){
				$('#ntl-dk'+id).val('K');
				dk = 'K';
			}
			
			if(dk=='K' && $.isNumeric(thi)){
				tong = parseFloat(thi);
			} else if(cc=='M' || dk=='M' || thi=='M'){
				$('#ntl-cc'+id).val('');
				$('#ntl-dk'+id).val('');
				$('#ntl-thi'+id).val('M');
				tong = 'M';
			} else if(cc=='N' || dk=='N' || thi=='N'){
				$('#ntl-cc'+id).val('');
				$('#ntl-dk'+id).val('');
				$('#ntl-thi'+id).val('N');
				tong = 'N';
			}else if(cc=='K' || dk=='K' || thi=='K'){
				$('#ntl-cc'+id).val('');
				$('#ntl-dk'+id).val('');
				$('#ntl-thi'+id).val('K');
				tong = 'K';
			} else if($.isNumeric(dk) && $.isNumeric(thi) && $.isNumeric(cc)){
				if(!$.isNumeric(cc)) cc =0;
				if(!$.isNumeric(dk)) dk =0;
				if(!$.isNumeric(thi)) thi =0;
				tong = Math.round(parseFloat(cc)+(parseFloat(dk)*2)+(parseFloat(thi)*7));
				tong /= 10;
			}
			else if($.isNumeric(dk) || $.isNumeric(thi) || $.isNumeric(cc)){
				tong = 0;
			}			
			else {
				tong = '';
			}
			if ($.isNumeric(tong)){
				$('#ntl-tong'+id).val(tong.toFixed(1)).trigger('change');
			}
			else{
				$('#ntl-tong'+id).val(tong).trigger('change');
			}
		});
		
		$(document).on('change', '.ntl-tong', function(){
			val = $(this).val();
			if(val!==''){
				kiemtradiem($(this), val);
				id = $(this).attr('data-id');
				pre = $(this).attr('data-msv');
				cc = $('#ntl-cc'+id).val();
				dk = $('#ntl-dk'+id).val();
				thi = $('#ntl-thi'+id).val();
				$('#ntl-data'+id).val(pre+cc+','+dk+','+thi+','+val);
			}
		});
		
		
		$(document).on('change', '.ntle-dk, .ntle-thi, .ntle-cc', function(){
			var tong;
			val = $(this).val();
			if(val.length>0){
				if($.isNumeric(val)){
					$(this).val(parseFloat(val));
				} else if(val=='k' || val=='m'|| val=='n'){
					$(this).val(val.toUpperCase());
				}
				kiemtradiem($(this), val);
			}
			id = $(this).attr('data-id');
			cc = $('#ntle-cc'+id).val();
			dk = $('#ntle-dk'+id).val();
			thi = $('#ntle-thi'+id).val();
			if(thi.length>0 && dk.length==0 && $('#ad3070').is(':checked')==false){
				$('#ntl-dk'+id).val('K');
				dk = 'K';
			}
			if(dk=='K' && $.isNumeric(thi)){
				tong = parseFloat(thi);
			} else if(cc=='M' || dk=='M' || thi=='M'){
				$('#ntle-cc'+id).val('');
				$('#ntle-dk'+id).val('');
				$('#ntle-thi'+id).val('M');
				tong = 'M';
			} else if(cc=='N' || dk=='N' || thi=='N'){
				$('#ntle-cc'+id).val('');
				$('#ntle-dk'+id).val('');
				$('#ntle-thi'+id).val('N');
				tong = 'N';
			} else if(cc=='K' || dk=='K' || thi=='K'){
				$('#ntle-cc'+id).val('');
				$('#ntle-dk'+id).val('');
				$('#ntle-thi'+id).val('K');
				tong = 'K';
			} else if($.isNumeric(dk) && $.isNumeric(thi) && $.isNumeric(cc)){
				if(!$.isNumeric(cc)) cc =0;
				if(!$.isNumeric(dk)) dk =0;
				if(!$.isNumeric(thi)) thi =0;
				tong = Math.round(parseFloat(cc)+(parseFloat(dk)*2)+(parseFloat(thi)*7));
				tong /= 10;
			}
			else if($.isNumeric(dk) || $.isNumeric(thi) || $.isNumeric(cc)){
				tong = 0;
			}
			else {
				tong = '';
			}
			if ($.isNumeric(tong)){
				$('#ntle-tong'+id).val(tong.toFixed(1)).trigger('change');
			}
			else{
				$('#ntle-tong'+id).val(tong).trigger('change');
			}
			// $('#ntle-tong'+id).val(tong.toFixed(1)).trigger('change');
		});
		
		$(document).on('change', '.ntle-tong', function(){
			val = $(this).val();
			if(val!==''){
				kiemtradiem($(this), val);
				id = $(this).attr('data-id');
				pre = $('#ntle-data'+id).attr('data-id');
				if(val=='m') {
					val = 'M';
					$(this).val('M');
				}
				oldcc = $('#ntle-cc'+id).attr('data-value');
				olddk = $('#ntle-dk'+id).attr('data-value');
				oldthi = $('#ntle-thi'+id).attr('data-value');
				cc = $('#ntle-cc'+id).val();
				dk = $('#ntle-dk'+id).val();
				thi = $('#ntle-thi'+id).val();
				if(oldcc!=cc || olddk!=dk || oldthi!=thi){
					$('#ntle-data'+id).val(pre+','+cc+','+dk+','+thi+','+val);
				} else {
					$('#ntle-data'+id).val('');
				}
			}
		});
		/*$('.ntl-editable').click(function(){
			$(this).find('.ntl-tong').prop('disabled', false).focus();
		});	*/
		
		/*$('.ntl-editable .ntl-tong').blur(function(){
			if($(this).val() == $(this).attr('data-value')){
				$(this).prop('disabled', true);
			} else {
				sibs = $(this).siblings('.editable-data')
				id = sibs.attr('data-id');
				sibs.val(id+','+$(this).val());
			}
		});*/
		
		$(document).scroll(function() {
			if($('#updatebtn').offset().top - $(window).scrollTop()<0){
				$('.backtotop').show();
			} else {
				$('.backtotop').hide();
			}
		});
		
		$('#ntl-filter').change(function(){
			val = $(this).val();
			
			var mn = $('#nhomdanhsach').val();
			
			if(val=='0'){
					$('body #gf .sv-item').show();
					$('#mf .sv-item').each(function(){
						if($(this).attr('data-group')!=mn){
							$(this).show();
						}
					});
			} else {
				$('table #gf .sv-item').each(function(){
					fid = $(this).attr('data-filter');
					if(fid!=val){
						$(this).hide();
					} else {
						$(this).show();
					}
				});
				
				$('#mf .sv-item').each(function(){
					fid = $(this).attr('data-filter');
					if(fid!=val){
						$(this).hide();
					} else {
						if($(this).attr('data-group')!=mn){
							$(this).show();
						}
					}
				});
			}
			reCount();
		});
		
		function reCount(){
			var stt = 1;
			$('body .sv-item').each(function(){
				if($(this).is(':visible')==true){
					$(this).find('.stt').text(stt);
					stt++;
				}
			});
		}
		
		$(document).on('change','#nhomdanhsach',function(){
			appendLoading(true);
			var lt = $(this).find('option:selected').attr('data-lt');
			var nt = $(this).find('option:selected').attr('data-nt');
			var sds = $(this).find('option:selected').attr('data-sds');
			var sbd_giuaky = $(this).find('option:selected').attr('data-sbdgk');
			var mn = $(this).val();
			
			setTimeout(function() {
				if(lt==null){
					$('#lanthi option:first').prop("selected", true);
				} else {
					$('#lanthi option[value="'+lt+'"]').prop("selected", true);
				}

				$('#lanthicu').val(lt);
				$('#ngaythicu').val(nt);
				$('#ngaythi').val(nt);
				$('#sodanhsach').val(sds);
				$('#gf').remove();
				
					htmlGf = '<tbody id="gf">';
					$('.sv-item').each(function(){
						if($(this).attr('data-group')==mn){
							clone = $(this).clone().wrap('<p>').parent();
							htmlGf+=clone.html();
							$(this).find('input').prop('disabled', true);
							$(this).hide();
						} else {
							if($(this).is(":visible")==false){
								$(this).find('input').prop('disabled', false);
								$(this).show();
							}
						}
					});
					htmlGf += '<tr><td colspan="8"></td></tr></tbody>';
					if(mn.length>0){
						$(htmlGf).insertAfter('thead');
						//$('#ntl-dt #gf .ntl-cc, #ntl-dt #gf .ntl-dk').prop('readonly', true);
						//$('#ntl-dt #gf .ntle-dk, #ntl-dt #gf .ntle-thi').prop('readonly', false);
					}
					$('#ntl-filter option[value="0"]').prop("selected", true);
					$('#ntl-filter').trigger('change');
					
					$('#lanthi').trigger('change');
					reCount();
					appendLoading(false);
			}, 200);
			

			var malop = $('#lop').val();
			var manhom = $('#nhomdanhsach').val();
			$('#sbd_giuaky').val(sbd_giuaky);
			var sbd_giuaky = $('#sbd_giuaky').val();

			$('#ingiuaky').attr('href', baseUrl + 'dsthigiuaky?action=in&lop=' + malop + '&nhom=' + manhom + '&sbd=' + sbd_giuaky);
			$('#ingiuakyonline').attr('href', baseUrl + 'dsthigiuaky?action=in-online&lop=' + malop + '&nhom=' + manhom + '&sbd=' + sbd_giuaky);
			$('#xuatgiuaky').attr('href', baseUrl + 'dsthigiuaky?action=xuat&lop=' + malop + '&nhom=' + manhom + '&sbd=' + sbd_giuaky);
			$('#xuatgiuakyonline').attr('href', baseUrl + 'dsthigiuaky?action=xuat-online&lop=' + malop + '&nhom=' + manhom + '&sbd=' + sbd_giuaky);
		});

		$(document).on('change', '#sbd_giuaky', function(){
			var malop = $('#lop').val();
			var manhom = $('#nhomdanhsach').val();
			var sbd_giuaky = $('#sbd_giuaky').val();
			$('#ingiuaky').attr('href', baseUrl + 'dsthigiuaky?action=in&lop=' + malop + '&nhom=' + manhom + '&sbd=' + sbd_giuaky);
			$('#ingiuakyonline').attr('href', baseUrl + 'dsthigiuaky?action=in-online&lop=' + malop + '&nhom=' + manhom + '&sbd=' + sbd_giuaky);
			$('#xuatgiuaky').attr('href', baseUrl + 'dsthigiuaky?action=xuat&lop=' + malop + '&nhom=' + manhom + '&sbd=' + sbd_giuaky);
			$('#xuatgiuakyonline').attr('href', baseUrl + 'dsthigiuaky?action=xuat-online&lop=' + malop + '&nhom=' + manhom + '&sbd=' + sbd_giuaky);
		})
		
		$(document).on('change', '#lanthi', function(){
			nhom = $('#nhomdanhsach').val();
			lt	= $('#nhomdanhsach option:selected').attr('data-lt');
			val = $(this).val();
			$('#ntl-dt input[type="hidden"], #ntl-dt input[type="text"]').val('');
			$('#ntl-dt .ntle-cc, #ntl-dt .ntle-dk, #ntl-dt .ntle-thi, #ntl-dt .ntle-tong').each(function(){
				$(this).val($(this).attr('data-value'));
			});
			$('#ntl-dt input[type="text"]').prop('readonly', true);
			$('.ntl-xoa').hide();
			if(!isDate($('#ngaythi').val()) && val!=null){
				$('#lanthi option:first').prop('selected', true);
				var notice = $.pnotify({
							   pnotify_title: 'Lỗi',
							   pnotify_text: 'Vui lòng chọn ngày thi hợp lệ',
							   type: 'error',
							   icon: 'glyphicon glyphicon-warning-sign',
							   addclass: 'snotify',
							   pnotify_closer: true,
							   pnotify_delay: 5000
							});
				return false;				
			} else if(isDate($('#ngaythi').val()) && val!=null) {				
				if(lt==val || lt==null){
					$('#ntl-dt #mf .ntl-cc,#ntl-dt #mf .ntl-dk').prop('readonly', false);
					if(nhom.length>0){
						$('#ntl-dt #gf .ntle-dk,#ntl-dt #gf .ntle-thi,#ntl-dt #gf .ntle-cc').prop('readonly', false);
						$('#ntl-dt #gf .ntl-huy input').prop('readonly', true);
						$('#ntl-dt #gf .ntl-xoa').show();
					}
				}
			}
		});
		{literal}
		function isDate(txtDate)
		{
		  var currVal = txtDate;
		  if(currVal == '')
			return false;
		  
		  //Declare Regex  
		  var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/; 
		  var dtArray = currVal.match(rxDatePattern); // is format OK?

		  if (dtArray == null)
			 return false;
		 
		  //Checks for mm/dd/yyyy format.
		  dtMonth = dtArray[3];
		  dtDay= dtArray[1];
		  dtYear = dtArray[5];

		  if (dtMonth < 1 || dtMonth > 12)
			  return false;
		  else if (dtDay < 1 || dtDay> 31)
			  return false;
		  else if ((dtMonth==4 || dtMonth==6 || dtMonth==9 || dtMonth==11) && dtDay ==31)
			  return false;
		  else if (dtMonth == 2)
		  {
			 var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
			 if (dtDay> 29 || (dtDay ==29 && !isleap))
				  return false;
		  }
		  return true;
		}
		{/literal} //
		$('#updatebtn').click(function(){
			ngaythi = $('#ngaythi').val();
			if(!isDate(ngaythi)){
				var notice = $.pnotify({
							   pnotify_title: 'Lỗi',
							   pnotify_text: 'Ngày thi không hợp lệ',
							   type: 'error',
							   icon: 'glyphicon glyphicon-warning-sign',
							   addclass: 'snotify',
							   pnotify_closer: true,
							   pnotify_delay: 5000
							});
				return false;
			}
			
		});
		
		function showMessage(){
			var notice = $.pnotify({
						   pnotify_title: 'Lỗi',
						   pnotify_text: 'Vui lòng chọn danh sách',
						   type: 'error',
						   icon: 'glyphicon glyphicon-warning-sign',
						   addclass: 'snotify',
						   pnotify_closer: true,
						   pnotify_delay: 5000
						});
			return false;
		}
		$(document).on('click','#indanhsach',function(){
		// $('#indanhsach').click(function(){
			malop = $('#lop').val();
			manhom = $('#nhomdanhsach').val();
			if(manhom!=''){
				window.open(baseUrl+'in_diemthi_new?lop='+malop+'&nhom='+manhom, '_blank');
			} else {
				showMessage();
			}
			
		});
		$(document).on('click','#xuatdanhsach',function(){
		// $('#indanhsach').click(function(){
			malop = $('#lop').val();
			manhom = $('#nhomdanhsach').val();
			if(manhom!=''){
				window.open(baseUrl+'xuat_diemthi_new?lop='+malop+'&nhom='+manhom, '_blank');
			} else {
				showMessage();
			}
			
		});
		
		$('#indanhsachnopbai').click(function(){
			malop = $('#lop').val();
			manhom = $('#nhomdanhsach').val();
			if(manhom!=''){
				window.open(baseUrl+'in_diemthi_new?lop='+malop+'&nhom='+manhom+'&ds=nth', '_newhtml2');
			} else {
				showMessage();
			}
		});

		$(document).on('click','#indanhsachtuluan',function(){
			malop = $('#lop').val();
			manhom = $('#nhomdanhsach').val();
			if(manhom!=''){
				window.open(baseUrl+'in_diemthi_new?lop='+malop+'&nhom='+manhom+'&ds=nth&loai=tuluan', '_newhtml2');
			} else {
				showMessage();
			}
		});

		$(document).on('click','#indanhsachtracnghiem',function(){
			malop = $('#lop').val();
			manhom = $('#nhomdanhsach').val();
			if(manhom!=''){
				window.open(baseUrl+'in_diemthi_new?lop='+malop+'&nhom='+manhom+'&ds=nth&loai=tracnghiem', '_newhtml2');
			} else {
				showMessage();
			}
		});
		
		$('#huybtn').click(function(){
			lop = $('#lop').val();
			nhom = $('#nhomdanhsach').val();
			mon = $('#mon').val();
			if(nhom!=''){
				window.location.href = baseUrl+'huydiemtheolop_new?lop='+lop+'&mon='+mon+'&nhom='+nhom;
			} else {
				showMessage();
			}
		});
		
		$(document).on('focus', '#gf input', function(){
			$(this).parents('tr').addClass('highlight');
			
		}).on('blur', function(){
			
			$(this).parents('tr').removeClass('highlight');
		});
		$(document).on('focus','#ntl-dt input',function(){
			var tr = $(this).parents('tr');
			if(tr.hasClass('success')){
				tr.removeClass('success');
				tr.addClass('chk');
			}
			if(tr.hasClass('danger')){
				tr.removeClass('danger');
				tr.addClass('dag');	
			}	
			tr.addClass('highlight');
		});
		$(document).on('blur','#ntl-dt input',function(){				
			var tr=$(this).parents('tr');
			if(tr.hasClass('chk')){
				tr.addClass('success');
			}
			if(tr.hasClass('dag')){
				tr.addClass('danger');
			}
			
			$(this).parents('tr').removeClass('highlight');
		});
		
		$(document).on('click', '#ntl-dt #gf .ntl-xoa', function(){
			return confirm('Xóa sinh viên khỏi danh sách?');
		});
		
		$(document).on('click', '#export', function(){
			nhom = $('#nhomdanhsach').val();
			if (nhom=='')
			{
				showMessage();	
				return false;
			}else{
				return true;	
			}
		});
		{if !empty($time)}
			$('select[name="nhomdanhsach"]').val({$time}).change();
		{/if} //

		$(document).on('click','.chuyendiem',function(){
			var diem1 = $(this).parent('td').parent('tr').find('input:eq(7)').val();
			var diem2 = $(this).parent('td').parent('tr').find('input:eq(8)').val();
			$(this).parent('td').parent('tr').find('input:eq(1)').val(diem1);
			$(this).parent('td').parent('tr').find('input:eq(2)').val(diem2);
		});

		$('input').attr('autocomplete', 'off');
	});

</script>
<style>
.backtotop{
	position: fixed;
	bottom: 10px;
	right: 20px;
	outline:none;
	display:none;
}
.fr{
	float:right;
}
.fl{
	float: left;
}
.input-error {
border-color: #a94442;
-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
}
.input-error:focus{ 
border-color:#843534;
-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 6px #ce8483;
box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 6px #ce8483;
}
#ntl-dt .highlight {
	background: rgb(193, 202, 248) !important;
}
.td-40 {
    width: 44.3px !important;
}
.m-r{
	margin-right: 10px;
}
</style>
<a href="#top"><button class="btn btn-default btn-lg backtotop"><span class="glyphicon glyphicon-chevron-up"></span></button></a>
<div class="panel panel-default">
<div class="panel-heading">
		<h3 class="panel-title"><b>{$info}</b></h3>
</div>
<div class="panel-body">
	{if $page==1}
    <form name="frm" action="{$url}nhapdiemtheolop_new/lop" method="get" target="_blank">
        <div class="row1">
			<div class="col-sm-4">
                <div class="input-group">
                    <span class="input-group-addon">Đơn vị</span>
                    <select id="xtn-dv" class="form-control ssl2">
                    <option disabled selected>Chọn đơn vị</option>
                    {foreach from=$dsdonvi item=dv}
                    <option value="{$dv.ma_donvi}">{$dv.ten_donvi}</option>
                    {/foreach}
                    </select>
                </div>
            </div>
			<div class="col-sm-4">
                <div class="input-group">
                    <span class="input-group-addon">Ngành</span>
                    <select id="xtn-nganh" class="form-control">                  
                        <option selected>Chọn ngành</option>
                    </select>
                </div>
            </div>
			<div class="col-sm-4">
                <div class="input-group">
                    <span class="input-group-addon">Khóa học</span>
                    <select id="xtn-kh" class="form-control">
                    </select>
                </div>
            </div>
		</div>
		<div class="row">
			<div class="col-sm-4">
                <div class="input-group">
                    <span class="input-group-addon">Lớp</span>
                    <select name="lop" id="xtn-lop" class="ndtl-lop form-control">
                        <option disabled selected>Chọn lớp</option>

                    </select>
                </div>
            </div>
			<div class="col-sm-4">
                <div class="input-group">
                    <span class="input-group-addon">Môn học</span>
                    <select name="mon" id="ndtl-mon" class="form-control">
                        <option disabled selected>Chọn môn học</option>

                    </select>
                </div>
            </div>
			<div class="col-sm-4">
                <div class="input-group">
					<input type="submit" class="btn btn-primary" value="Xem danh sách" />
				</div>
			</div>
        </div>
	</form>
	
	{else if $page==2}
	<form action="{$url}nhapdiemtheolop_new/lop" method="post">
	<br/>
	<div class="row1">
		<div class="col-xs-12">
			<div class="bs-callout bs-callout-info"><label>Lớp: <font color="green">{$thongtinlop.ten_lop}</font> - Đơn vị: <font color="green">{$tendonvi}</font> - Môn: <font color="green">{$tenmonhoc}</font> (Áp dụng 30-70: <input type="checkbox" checked id="ad3070" />)</label></div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="col-xs-12">
               	<input type="submit" id="export" name="#export" class="btn btn-primary hidden" value="Xuất Excell" />
				<select id="ntl-filter" class="fl form-control td-150" style="margin-right:10px;">
					<option value="0" selected>Tất cả sinh viên</option>
					<option value="1">Chưa có điểm</option>
					<option value="2">Đỗ</option>
					<option value="3">Trượt</option>
				</select>

				<select id="nhomdanhsach" name="nhomdanhsach" class="fl form-control td-180" style="margin-right:10px;">
                    <option value="">Tạo danh sách mới</option>
					{foreach $nhomdanhsach AS $danhsach}
						<option value="{$danhsach.manhom}" data-sds="{$danhsach.sodanhsach}" data-nt="{$danhsach.ngaythi}" data-lt="{$danhsach.lanthi}" data-sbdgk="{$danhsach.sbd_giuaky}">{$danhsach.ngaythi} - lần {$danhsach.lanthi}-{$danhsach.sodanhsach}</option>
					{/foreach}
				</select>

				<input type="text" placeholder="Ngày thi" autocomplete="off" class="fl form-control td-130 date" id="ngaythi" name="ngaythi" style="margin-right:10px;" />

				<select id="lanthi" name="lanthi" class="fl form-control td-100" style="margin-right:10px;">
					<option >Lần thi</option>
					<option value="1">Lần 1</option>
					<option value="2">Lần 2</option>
				</select>

				<input type="submit" name="capnhatdiem" id="updatebtn" class="btn btn-primary fl" value="Cập nhật" style="margin-right:10px;" />
				
				<input type="button" id="huybtn" class="btn btn-primary fl" value="Hủy kết quả" style="margin-right:10px;" />
				
				<input type="button" id="indanhsach" class="btn btn-info fl" style="margin-right:10px;" value="In điểm" />
				<input type="button" id="xuatdanhsach" class="btn btn-success fl" style="margin-right:10px;" value="Xuất điểm" />
				<input type="button" id="#indanhsachnopbai" class="btn btn-primary fl hidden" style="margin-right:10px;" value="In danh sách" />
				
				
			</div>
			<div class="col-xs-12" style="margin-top: 10px;">
				<input type="text" placeholder="Nhập SBD thi hết học phần" class="form-control" name="sbd" style="display: inline-block;">
				<input type="button" id="indanhsachtuluan" class="btn btn-primary fl m-r" value="In danh sách tự luận">
				<input type="button" id="indanhsachtracnghiem" class="btn btn-primary fl m-r" value="In danh sách trắc nghiệm">
				<input type="submit" id="exporttl" name="exporttl" class="btn btn-primary fl m-r" value="Xuất danh sách tự luận">
				<input type="submit" id="exporttn" name="exporttn" class="btn btn-primary fl m-r" value="Xuất danh sách trắc nghiệm">
				
				<input type="hidden" id="ngaythicu" name="ngaythicu" />
				<input type="hidden" id="lanthicu" name="lanthicu" />
				<input type="hidden" id="sodanhsach" name="sodanhsach" />
				<input type="hidden" name="mon" id="mon" value="{$mctdt}" />
				<input type="hidden" name="lop" id="lop" value="{$malop}" />
			</div>
			<div class="col-xs-12" style="margin-top: 10px;">
				<a target="_blank" href="{$url}dsthigiuaky" class="btn btn-info fl m-r" type="submit" name="action" value="ingiuakyonline" id="ingiuakyonline">
					<span class="glyphicon glyphicon-print m-r"></span>
					In DS thi online
				</a>
				<a target="_blank" href="{$url}dsthigiuaky" class="btn btn-success fl m-r" type="submit" name="action" value="xuatgiuakyonline" id="xuatgiuakyonline">
					<span class="glyphicon glyphicon-print m-r"></span>
					Xuất DS thi online
				</a>
				<a target="_blank" href="{$url}dsthigiuaky" class="btn btn-info fl m-r" type="submit" name="action" value="ingiuaky" id="ingiuaky">
					<span class="glyphicon glyphicon-print m-r"></span>
					In DS thi giữa kỳ
				</a>
				<a target="_blank" href="{$url}dsthigiuaky" class="btn btn-success fl m-r" type="submit" name="action" value="xuatgiuaky" id="xuatgiuaky">
					<span class="glyphicon glyphicon-print m-r"></span>
					Xuất DS thi giữa kỳ
				</a>
				<input type="text" placeholder="Nhập SBD thi giữa kỳ" class="form-control" name="sbd_giuaky" id="sbd_giuaky" style="display: inline-block;">
			</div>
		</div> 
	</div><br/>
	<div class="row1">
		<div class="col-xs-12" style="padding: 0px;">
		<div id="loading-image" style="width:100%; position:absolute; z-index:999;opacity: 0.7; top:150px;text-align:center;display:none;"><img width="80" src="{$url}bootstrap/wait.png" /><p style="margin-top: 10px;">Đang tải dữ liệu...</p></div>
		<table class="table table-bordered" id="ntl-dt" style="font-size:120%!important;">
			<thead>
				<tr>
					<th class="td-30 cangiua">STT</th>
					<th class="cangiua">KCC</th>
					<th>Mã sinh viên</th>
					<th>Họ tên</th>
					<th>Ngày sinh</th>
					<th class="cangiua">CC</th>
					<th class="cangiua">ĐK</th>
					<th class="cangiua">Thi</th>
					<th class="cangiua">Tổng</th>
					<th>Ghi chú</th>
					<th></th>
				</tr>
			</thead>
		<tbody id="mf">
		{$i=1}
		{if isset($danhsachsinhvien.chuaco)}
		{foreach $danhsachsinhvien.chuaco AS $sinhvien}
			<tr data-filter="1" class="sv-item chuaco">
				<td class="cangiua stt">{$i}</td>
				<td class="cangiua"><input type="checkbox" class="chuyencan-ck" data-id="{$sinhvien.ma_sv}" /></td>
				<td>{$sinhvien.ma_svtx}</td>
				<td>{$sinhvien.hoten_sv}</td>
				<td>{$sinhvien.ngaysinh_sv}</td>
				<td class="cangiua"><input readonly autocomplete="off" style="display:inline;" type="text" class="form-control td-40 diem ntl-cc" id="ntl-cc{$i}" data-id="{$i}" /></td>
				<td class="cangiua"><input readonly autocomplete="off" style="display:inline;" type="text" class="form-control td-40 diem ntl-cc" id="ntl-dk{$i}" data-id="{$i}" /></td>
				<td class="cangiua"><input readonly autocomplete="off" style="display:inline;" type="text" class="form-control td-40 diem ntl-dk" id="ntl-thi{$i}" data-id="{$i}" /></td>
				<td class="cangiua">
					<input readonly autocomplete="off" style="display:inline;" type="text" class="form-control td-40 diem ntl-tong" id="ntl-tong{$i}" data-msv="{$sinhvien.ma_sv},1," data-id="{$i}" />
					<input type="hidden" name="updatedata[]" id="ntl-data{$i}" />
				</td>
				<td>Chưa có điểm</td>
				<td></td>
			</tr>
			{$i=$i+1}
		{/foreach}
		{/if}
		
		{if isset($danhsachsinhvien.truot)}
			{foreach $danhsachsinhvien.truot AS $sinhvien}
				<tr class="danger sv-item {if $sinhvien.lanthi=='1'}truot1{else}truot2{/if}" data-filter="3" data-group="{$sinhvien.manhom}">
					<td class="cangiua stt">{$i}</td>
					<td class="cangiua"><input type="checkbox" class="chuyencan-ck" data-id="{$sinhvien.ma_sv}" /></td>
					<td>{$sinhvien.ma_svtx}</td>
					<td>{$sinhvien.hoten_sv}</td>
					<td>{$sinhvien.ngaysinh_sv}</td>
					<td class="cangiua"><input readonly autocomplete="off" style="display:inline;" type="text" class="form-control td-40 ntl-cc" id="ntl-cc{$i}" data-id="{$i}" /></td>
					<td class="cangiua"><input readonly autocomplete="off" style="display:inline;" type="text" class="form-control td-40 ntl-cc" id="ntl-dk{$i}" data-id="{$i}" /></td>
					<td class="cangiua"><input readonly autocomplete="off" style="display:inline;" type="text" class="form-control td-40 ntl-dk" id="ntl-thi{$i}" data-id="{$i}" /></td>
					<td class="cangiua">
						<input readonly autocomplete="off" type="text" style="display:inline;" class="form-control td-40 ntl-tong" data-msv="{$sinhvien.ma_sv},{$danhsachsinhvien.truot[$sinhvien.ma_sv].lanthi+1}," id="ntl-tong{$i}" data-id="{$i}" />
						<input type="hidden" name="updatedata[]" id="ntl-data{$i}" />
					</td>
					<td{if $sinhvien.diemhuy!=''} class="ntl-huy"{/if}>
						Điểm lần {$sinhvien.lanthi}
						<input type="hidden" name="updatedata2[]" id="ntle-data{$i}" data-id="{$sinhvien.sv_diem_dvhv}" value="" />
						<input readonly autocomplete="off" type="text" value="{$sinhvien.diemchuyencan}" class="form-control td-40 ntle-cc" data-id="{$i}" id="ntle-cc{$i}" data-value="{$sinhvien.diemchuyencan}" style="display:inline;" />
						<input readonly autocomplete="off" type="text" value="{$sinhvien.diemquatrinh}" class="form-control td-40 ntle-dk" data-id="{$i}" id="ntle-dk{$i}" data-value="{$sinhvien.diemquatrinh}" style="display:inline;" />
						<input readonly autocomplete="off" type="text" value="{$sinhvien.diemthi}" class="form-control td-40 ntle-thi" data-id="{$i}" id="ntle-thi{$i}" data-value="{$sinhvien.diemthi}" style="display:inline;" />
						<input readonly autocomplete="off" type="text" value="{$sinhvien.diem}" class="form-control td-40 ntle-tong" data-id="{$i}" id="ntle-tong{$i}" data-value="{$sinhvien.diem}" style="display:inline;" />
						{if $sinhvien.diemhuy!=''}
							(Đã hủy)
						{/if}
					</td>
					<td class="text-center">
					<button class="btn btn-sm btn-success chuyendiem" type="button"><span class="glyphicon glyphicon-arrow-left"></span></button>
					<a class="ntl-xoa btn btn-sm btn-danger" style="display:none;" href="{$url}nhapdiemtheolop_new/xoa?lop={$malop}&mon={$mctdt}&id={$sinhvien.sv_diem_dvhv}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
				</tr>
				{$i=$i+1}
			{/foreach}
		{/if}
		{if isset($danhsachsinhvien.do)}
		{foreach $danhsachsinhvien.do AS $sinhvien}
			<tr class="success sv-item" data-filter="2" {if $sinhvien.ma_ttdiemdvhv=='TT'}data-group="{$sinhvien.manhom}"{/if}>
				<td class="cangiua stt">{$i}</td>
				<td class="cangiua"><input type="checkbox" class="chuyencan-ck" data-id="{$sinhvien.ma_sv}" /></td>
				<td>{$sinhvien.ma_svtx}</td>
				<td>{$sinhvien.hoten_sv}</td>
				<td>{$sinhvien.ngaysinh_sv}</td>
				<td class="cangiua"><input readonly autocomplete="off" style="display:inline;" type="text" class="form-control td-40 ntl-cc" id="ntl-cc{$i}" data-id="{$i}" /></td>
				<td class="cangiua"><input readonly autocomplete="off" style="display:inline;" type="text" class="form-control td-40 ntl-cc" id="ntl-dk{$i}" data-id="{$i}" /></td>
				<td class="cangiua"><input readonly autocomplete="off" style="display:inline;" type="text" class="form-control td-40 ntl-dk" id="ntl-thi{$i}" data-id="{$i}" /></td>
				<td class="cangiua">
					<input readonly autocomplete="off" type="text" style="display:inline;" class="form-control td-40 ntl-tong" data-msv="{$sinhvien.ma_sv},{$danhsachsinhvien.do[$sinhvien.ma_sv].lanthi+1}," id="ntl-tong{$i}" data-id="{$i}" />
					<input type="hidden" name="updatedata[]" id="ntl-data{$i}" />
				</td>
				<td>
					Đỗ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="hidden" name="updatedata2[]" id="ntle-data{$i}" data-id="{$sinhvien.sv_diem_dvhv}" value="" />
					<input readonly autocomplete="off" type="text" value="{$sinhvien.diemchuyencan}" class="form-control td-40 ntle-cc" data-id="{$i}" id="ntle-cc{$i}" data-value="{$sinhvien.diemchuyencan}" style="display:inline;" />
					<input readonly autocomplete="off" type="text" value="{$sinhvien.diemquatrinh}" class="form-control td-40 ntle-dk" data-id="{$i}" id="ntle-dk{$i}" data-value="{$sinhvien.diemquatrinh}" style="display:inline;" />
					<input readonly autocomplete="off" type="text" value="{$sinhvien.diemthi}" class="form-control td-40 ntle-thi" data-id="{$i}" id="ntle-thi{$i}" data-value="{$sinhvien.diemthi}" style="display:inline;" />
					<input readonly autocomplete="off" type="text" value="{$sinhvien.diem}" class="form-control td-40 ntle-tong" data-id="{$i}" id="ntle-tong{$i}" data-value="{$sinhvien.diem}" style="display:inline;" />
				</td>
				<td><a class="ntl-xoa btn btn-danger" style="display:none;" href="{$url}nhapdiemtheolop_new/xoa?lop={$malop}&mon={$mctdt}&id={$sinhvien.sv_diem_dvhv}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
			</tr>
			{$i=$i+1}
		{/foreach}
		{/if}
		
		<!--danh sach khong chuyen can -->
		{if count($danhsachsinhvienkcc)>0}
			{if isset($danhsachsinhvienkcc.chuaco)}
			{foreach $danhsachsinhvienkcc.chuaco AS $sinhvien}
				<tr data-filter="1" class="sv-item chuaco">
					<td class="cangiua stt">{$i}</td>
					<td class="cangiua"><input type="checkbox" class="chuyencan-ck" data-id="{$sinhvien.ma_sv}" checked /></td>
					<td>{$sinhvien.ma_svtx}</td>
					<td>{$sinhvien.hoten_sv}</td>
					<td>{$sinhvien.ngaysinh_sv}</td>
					<td class="cangiua"><input readonly autocomplete="off" style="display:inline;" type="text" class="form-control td-40 diem ntl-cc" id="ntl-cc{$i}" data-id="{$i}" /></td>
					<td class="cangiua"><input readonly autocomplete="off" style="display:inline;" type="text" class="form-control td-40 diem ntl-cc" id="ntl-dk{$i}" data-id="{$i}" /></td>
					<td class="cangiua"><input readonly autocomplete="off" style="display:inline;" type="text" class="form-control td-40 diem ntl-dk" id="ntl-thi{$i}" data-id="{$i}" /></td>
					<td class="cangiua">
						<input readonly autocomplete="off" style="display:inline;" type="text" class="form-control td-40 diem ntl-tong" id="ntl-tong{$i}" data-msv="{$sinhvien.ma_sv},1," data-id="{$i}" />
						<input type="hidden" name="updatedata[]" id="ntl-data{$i}" />
					</td>
					<td>Chưa có điểm</td>
					<td></td>
				</tr>
				{$i=$i+1}
			{/foreach}
			{/if}
			
			{if isset($danhsachsinhvienkcc.truot)}
				{foreach $danhsachsinhvienkcc.truot AS $sinhvien}
					<tr class="danger sv-item {if $sinhvien.lanthi=='1'}truot1{else}truot2{/if}" data-filter="3" data-group="{$sinhvien.manhom}">
						<td class="cangiua stt">{$i}</td>
						<td class="cangiua"><input type="checkbox" class="chuyencan-ck" data-id="{$sinhvien.ma_sv}" checked /></td>
						<td>{$sinhvien.ma_svtx}</td>
						<td>{$sinhvien.hoten_sv}</td>
						<td>{$sinhvien.ngaysinh_sv}</td>
						<td class="cangiua"><input readonly autocomplete="off" style="display:inline;" type="text" class="form-control td-40 ntl-cc" id="ntl-cc{$i}" data-id="{$i}" /></td>
						<td class="cangiua"><input readonly autocomplete="off" style="display:inline;" type="text" class="form-control td-40 ntl-cc" id="ntl-dk{$i}" data-id="{$i}" /></td>
						<td class="cangiua"><input readonly autocomplete="off" style="display:inline;" type="text" class="form-control td-40 ntl-dk" id="ntl-thi{$i}" data-id="{$i}" /></td>
						<td class="cangiua">
							<input readonly autocomplete="off" type="text" style="display:inline;" class="form-control td-40 ntl-tong" data-msv="{$sinhvien.ma_sv},{$danhsachsinhvienkcc.truot[$sinhvien.ma_sv].lanthi+1}," id="ntl-tong{$i}" data-id="{$i}" />
							<input type="hidden" name="updatedata[]" id="ntl-data{$i}" />
						</td>
						<td{if $sinhvien.diemhuy!=''} class="ntl-huy"{/if}>
							Điểm lần {$sinhvien.lanthi}
							<input type="hidden" name="updatedata2[]" id="ntle-data{$i}" data-id="{$sinhvien.sv_diem_dvhv}" value="" />
							<input readonly autocomplete="off" type="text" value="{$sinhvien.diemchuyencan}" class="form-control td-40 ntle-cc" data-id="{$i}" id="ntle-cc{$i}" data-value="{$sinhvien.diemchuyencan}" style="display:inline;" />
							<input readonly autocomplete="off" type="text" value="{$sinhvien.diemquatrinh}" class="form-control td-40 ntle-dk" data-id="{$i}" id="ntle-dk{$i}" data-value="{$sinhvien.diemquatrinh}" style="display:inline;" />
							<input readonly autocomplete="off" type="text" value="{$sinhvien.diemthi}" class="form-control td-40 ntle-thi" data-id="{$i}" id="ntle-thi{$i}" data-value="{$sinhvien.diemthi}" style="display:inline;" />
							<input readonly autocomplete="off" type="text" value="{$sinhvien.diem}" class="form-control td-40 ntle-tong" data-id="{$i}" id="ntle-tong{$i}" data-value="{$sinhvien.diem}" style="display:inline;" />
							{if $sinhvien.diemhuy!=''}
								(Đã hủy)
							{/if}
						</td>
						<td><a class="ntl-xoa btn btn-danger" style="display:none;" href="{$url}nhapdiemtheolop_new/xoa?lop={$malop}&mon={$mctdt}&id={$sinhvien.sv_diem_dvhv}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
					</tr>
					{$i=$i+1}
				{/foreach}
			{/if}
			{if isset($danhsachsinhvienkcc.do)}
			{foreach $danhsachsinhvienkcc.do AS $sinhvien}
				<tr class="success sv-item" data-filter="2" {if $sinhvien.ma_ttdiemdvhv=='TT'}data-group="{$sinhvien.manhom}"{/if}>
					<td class="cangiua stt">{$i}</td>
					<td class="cangiua"><input type="checkbox" class="chuyencan-ck" data-id="{$sinhvien.ma_sv}" checked /></td>
					<td>{$sinhvien.ma_svtx}</td>
					<td>{$sinhvien.hoten_sv}</td>
					<td>{$sinhvien.ngaysinh_sv}</td>
					<td class="cangiua"><input readonly autocomplete="off" style="display:inline;" type="text" class="form-control td-40 ntl-cc" id="ntl-cc{$i}" data-id="{$i}" /></td>
					<td class="cangiua"><input readonly autocomplete="off" style="display:inline;" type="text" class="form-control td-40 ntl-cc" id="ntl-dk{$i}" data-id="{$i}" /></td>
					<td class="cangiua"><input readonly autocomplete="off" style="display:inline;" type="text" class="form-control td-40 ntl-dk" id="ntl-thi{$i}" data-id="{$i}" /></td>
					<td class="cangiua">
						<input readonly autocomplete="off" type="text" style="display:inline;" class="form-control td-40 ntl-tong" data-msv="{$sinhvien.ma_sv},{$danhsachsinhvienkcc.do[$sinhvien.ma_sv].lanthi+1}," id="ntl-tong{$i}" data-id="{$i}" />
						<input type="hidden" name="updatedata[]" id="ntl-data{$i}" />
					</td>
					<td>
						Đỗ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="hidden" name="updatedata2[]" id="ntle-data{$i}" data-id="{$sinhvien.sv_diem_dvhv}" value="" />
						<input readonly autocomplete="off" type="text" value="{$sinhvien.diemchuyencan}" class="form-control td-40 ntle-cc" data-id="{$i}" id="ntle-cc{$i}" data-value="{$sinhvien.diemchuyencan}" style="display:inline;" />
						<input readonly autocomplete="off" type="text" value="{$sinhvien.diemquatrinh}" class="form-control td-40 ntle-dk" data-id="{$i}" id="ntle-dk{$i}" data-value="{$sinhvien.diemquatrinh}" style="display:inline;" />
						<input readonly autocomplete="off" type="text" value="{$sinhvien.diemthi}" class="form-control td-40 ntle-thi" data-id="{$i}" id="ntle-thi{$i}" data-value="{$sinhvien.diemthi}" style="display:inline;" />
						<input readonly autocomplete="off" type="text" value="{$sinhvien.diem}" class="form-control td-40 ntle-tong" data-id="{$i}" id="ntle-tong{$i}" data-value="{$sinhvien.diem}" style="display:inline;" />
					</td>
					<td><a class="ntl-xoa btn btn-danger" style="display:none;" href="{$url}nhapdiemtheolop_new/xoa?lop={$malop}&mon={$mctdt}&id={$sinhvien.sv_diem_dvhv}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
				</tr>
				{$i=$i+1}
			{/foreach}
			{/if}
		{/if}
		<!-- end danh sach ko chuyen can -->
		</tbody>
		</table>
		</div>
		</div>
	<input type="hidden" name="{$csrf_token_name}" value="{$csrf_token}" />
	</form>
	{/if}
	
</div>
