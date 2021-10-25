<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$title}</title>
<style type="text/css">
	*{
		margin:0;
		padding:0;
	}
	body{
		font-family: "Times New Roman", Times, serif;
		font-size: 12pt;
	}
	#container{
		width: 210mm;
		margin: 0px auto;
		padding: 10px;
		
	}
	#header{
		position: relative;
		width: 100%;
		display: flex;
		align-items: center;
		height: 16mm;
	}
	#left-header, #right-header{
		display: inline-block;
		width: 50%;
		float: left;
		text-align: center;
	}
	#title{
		display: flex;
		align-items: center;
		justify-content: center;
		flex-wrap: wrap;
		width: 100%;
		height: 20mm;
		margin: 0px;
	}
	#title h2, #title h3{
		padding: 0;
		margin: 0;
	}
	#title div{
		width: 100%;
		display: flex;
		align-items: center;
		justify-content: center;
	}
	#tieude{
		position: relative;
		display: block;
		width: 100%;
		height: 40mm;
		margin: 0px;
		font-size: 12pt;
		font-weight: bold;
	}
	#tieude .row{
		padding: 5px 0;
	}

	.chantrang{
		font-size: 12pt;
		display: flex;
		align-items: center;
		justify-content: center;
		position: absolute;
		bottom: -20px;
		width: 100%;
	}
	#giaovu{
		padding-top: 5mm;
		display: block;
		width: 100%;
		height: 80mm;
		position: relative;
	}
	#giaovu .row{
		padding: 5px 0;
	}
	.page{
		page-break-after: always;
		width: 100%;
		height: 295mm;
		display: block;
		position: relative;
	}
	.page:not(:first-child){
		margin-top: 60px;
	}
	@media print {
		@page{
			margin: 0.25in 0.2in;
		}
		.page:not(:first-child){
			margin-top: 20px;
		}
	}
	p{
		text-align:justify;
	}
	table{
		font-size: 11pt;
	}
	table tr td{
		padding: 3px;
		border-bottom: 1px dotted #000000;
		border-top: none;
		text-align: center;
	}
	table tr:last-child td{
		border-bottom: none;
	}
	th{
		padding:3px;
		border-bottom:1px solid #000000;
	}
	td {
		height: 23px;
		line-height: 23px;
	}

	.text-center{
		text-align: center;
	}
	.row{
	  display: flex;
	  flex-wrap: wrap;
	}
	.col-1 {
	  flex: 0 0 8.333333%;
	  max-width: 8.333333%;
	}

	.col-2 {
	  flex: 0 0 16.666667%;
	  max-width: 16.666667%;
	}

	.col-3 {
	  flex: 0 0 25%;
	  max-width: 25%;
	}

	.col-4 {
	  flex: 0 0 33.333333%;
	  max-width: 33.333333%;
	}

	.col-5 {
	  flex: 0 0 41.666667%;
	  max-width: 41.666667%;
	}

	.col-5-5 {
	  flex: 0 0 50%;
	  max-width: 50%;
	}

	.col-7 {
	  flex: 0 0 58.333333%;
	  max-width: 58.333333%;
	}

	.col-8 {
	  flex: 0 0 66.666667%;
	  max-width: 66.666667%;
	}

	.col-9 {
	  flex: 0 0 75%;
	  max-width: 75%;
	}

	.col-10 {
	  flex: 0 0 83.333333%;
	  max-width: 83.333333%;
	}

	.col-11 {
	  flex: 0 0 91.666667%;
	  max-width: 91.666667%;
	}

	.col-12 {
	  flex: 0 0 100%;
	  max-width: 100%;
	}
	.col-5-5{
	  flex: 0 0 45.833333%;
	  max-width: 45.833333%;

	}
	.col-2-5{
	  flex: 0 0 20.833333%;
	  max-width: 20.833333%;

	}
	.rong{
		text-align: center;
		color: red;
	}
	.dong-kep{
		height: 9.5mm;
	}
	.dong-kep .kep{
		padding-right: 10px;
	}
	.hodem{
		border-right: none;
		text-align: left;
	}
	.ten{
		border-left: none;
		text-align: left;
	}
	table tr:not(:last-child) td{
		border-bottom: 1px dotted #000;
	}
</style>

</head>

<body>
	<div id="container">
		{$stt = 1}
		{foreach $listpage as $k => $page}
		<div class="page">
			{if $page.loai == 'before'}
			<div id="header">
	        	<div id="left-header">
	        		<span>BỘ GIÁO DỤC VÀ ĐÀO TẠO</span>
	        		<br />
	        		<b><u>TRƯỜNG ĐẠI HỌC MỞ HÀ NỘI</u></b>
	            </div>
	            <div id="right-header">
	            	<b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</b>
	            	<br />
	            	<b><u>Độc lập - Tự do - Hạnh phúc</u></b>
	            </div>
	        </div>
	        <div id="title">
	        	<div><h2>DANH SÁCH SINH VIÊN THI KẾT THÚC HỌC PHẦN</h2></div>
	        	<div><h3>Hình thức đào tạo: Từ xa kết hợp</h3></div>
	        </div>
		    <div id="tieude">
		    	<div class="row">
		        	<div class="col-5">
		        		<p>Tên học phần: {$tenmh}</p>
		        	</div>
		        	<div class="col-7">
		        		<p class="kep">Địa điểm thi: {$lop.ten_donvi}</p>
		        	</div>
		        </div>
		        <div class="row">
		        	<div class="col-5">
		        		<p>Mã học phần: {$hocphan}</p>
		        	</div>
		        	<div class="col-3">
		        		<p>Ngày thi: {$dssv[0].ngaythi}</p>
		        	</div>
		        </div>
		    	<div class="row">
		        	<div class="col-5">
		        		<p>Ngành học: {$lop.ten_nganh}</p>
		        	</div>
		        	<div class="col-4">
		        		<p>Ca thi: .................</p>
		        	</div>
		        	<div class="col-3">
		        		<p>Lần thi: lần {$lanthi}</p>
		        	</div>
		        </div>
		    	<div class="row">
		        	<div class="col-5">
		        		<p>Lớp: {$lop.ten_lop}</p>
		        	</div>
		        	<div class="col-4">
		        		<p>Phòng thi: .................</p>
		        	</div>
		        	<div class="col-3">
		        		<p>Mã danh sách: .................</p>
		        	</div>
		        </div>
		    </div>
		    <main>
			{/if}
		    	<table border="1px" cellpadding="5" cellspacing="0" width="100%">
		    		<thead>
		    			<tr>
		    				<th rowspan="2">TT</th>
		    				<th rowspan="2">Số BD</th>
		    				<th rowspan="2" colspan="2">Họ và tên</th>
		    				<th rowspan="2">Ngày sinh</th>
		    				<th rowspan="2">Số đề / Mã đề</th>
		    				<th rowspan="2">Số tờ</th>
		    				<th colspan="3">Điểm</th>
		    				<th rowspan="2">Chữ ký SV</th>
		    				<th rowspan="2">Ghi chú</th>
		    			</tr>
		    			<tr>
		    				<th>Điểm chuyên cần</th>
		    				<th>Điểm giữa kỳ</th>
		    				<th>Điểm thi</th>
		    			</tr>
		    		</thead>
		    		<tbody>
		    			{foreach $page.data as $key => $sv}
		    			<tr>
		    				<td width="5%">{$stt++}</td>
		    				<td width="7%">{$sv.sbd}</td>
		    				<td width="19%" class="hodem">{$sv.hodem}</td>
		    				<td width="7%" class="ten">{$sv.ten_sv}</td>
		    				<td width="10%">{$sv.ngaysinh_sv}</td>
		    				<td width="8%"></td>
		    				<td width="5%"></td>
		    				<td width="8%">{$sv.diemchuyencan}</td>
		    				<td width="8%">{$sv.diemquatrinh}</td>
		    				<td width="6%">{$sv.diemthi}</td>
		    				<td width="10%"></td>
		    				<td></td>
		    			</tr>
		    			{/foreach}
		    		</tbody>
		    	</table>
			
				<div class="chantrang">
		    		Trang {$k + 1} / {sizeof($listpage)} - 
		    		{$lop.ten_lop} - {$lop.ten_nganh} - {$tenmh}
		    	</div>
		    {if sizeof($listpage) == 1 || $page.loai == 'after'}
		    	<div id="giaovu">
		    		<div class="row">
			    		<div class="col-4">
			    			<p>Danh sánh sinh viên có: {$stt - 1} SV</p>
			    			<p>&nbsp;</p>
			    			<p class="text-center">........, ngày .... tháng .... năm 20....</p>
			    			<p class="text-center"><b>KHOA ĐÀO TẠO TỪ XA</b></p>
			    			<p class="text-center">(Ký, họ và tên)</p>
			    		</div>
			    		<div class="col-4">
			    			<p>Số sinh viên dự thi: .........................</p>
			    			<p>Số bài thi: ........................................</p>
			    			<p>Số tờ giấy thi: ..................................</p>
			    			<p>&nbsp;</p>
			    			<p><b>Cán bộ coi thi</b></p>
			    			<p>(Ký, họ và tên)</p>
			    			<p><b>Số 1:</b> ................................................</p>
			    			<p><b>Số 2:</b> ................................................</p>
			    		</div>
			    		<div class="col-4">
			    			<p>Số điểm sửa (nếu có): .......................</p>
			    			<p><b>Cán bộ ghép phách và lên điểm thi</b></p>
			    			<p>(Ký, họ và tên)</p>
			    			<p><b>1:</b> ................................................</p>
			    			<p><b>2:</b> ................................................</p>
			    			<p>&nbsp;</p>
			    			<p>&nbsp;</p>
			    			<p>Hà Nội, ngày .... tháng .... năm 20....</p>
			    			<p><b>PHÒNG KT & QLCL</b></p>
			    			<p>(Ký, họ và tên)</p>
			    		</div>
			    	</div>
		    	</div>
		    {else }

		    {/if}
		</div>
		{/foreach}
   		
	    </main>
	    
    </div>
</body>
</html>
