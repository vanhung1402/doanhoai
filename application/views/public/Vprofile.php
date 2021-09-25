<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{$url}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Profile</li>
	</ol>
</nav>
<div class="profile container">

	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="home-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
		</li>
		<li class="nav-item active" role="presentation">
			<a class="nav-link" id="products-tab" data-toggle="tab" href="#products" role="tab" aria-controls="products" aria-selected="false">Danh sách sản phẩm</a>
		</li>
	</ul>
	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="home-tab">Thông tin cá nhân</div>
		<div class="tab-pane fade show active" id="products" role="tabpanel" aria-labelledby="products-tab">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>Mã sản phẩm</th>
						<th>Tên sản phẩm</th>
						<th>Danh mục</th>
						<th>Thương hiệu</th>
						<th>Tình trạng</th>
						<th>Tác vụ</th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>
	</div>
</div>