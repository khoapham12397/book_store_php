<?php
	$conn=new PDO('mysql:host=localhost;dbname=book_store','root','');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	
</head>
<body>
	<div id="banner-top">
		<img src="http://sachtoan24h.com/wp-content/uploads/2018/11/banner.png" width="1000px" height="180px" />
	</div>

	<div id="menu-top">
		<ul>
			<li class="main-title"><a href="index1.php" >Trang chủ</a></li>
			<li class="main-title"><a href="#" >Giới thiệu</a></li>
			<li class="main-title">
				<div class="drop-out">
				<a href="#">
					<div>Tai lieu</div>
					<div class="drop-out-content" style="width: 300px; ">
						
							<ul>
								<li class="sub-title"><a href="#">Đại số</a></li>
								<li class="sub-title"><a href="#" >Hình học</a></li>
								<li class="sub-title"><a href="#" >Số học</a></li>
								<li class="sub-title"><a href="#">Tổ hợp</a></li>
							</ul>
						
					</div>
				</a>
				</div>
			</li>
			<li class="main-title"><a href="#">Liên hệ</a></li>
			<li class="main-title"><a href="#">Forum</a></li>
			<li class="main-title"><a href="cart.php">Giỏ hàng</a></li>
		</ul>
		
	</div>
	<div id="main">
		<div id="left">
			<h2>Tuyển tập đề thi VMO</h2>
			<ul>
				<?php for($i=5;$i<=9;$i++){?>
					<li class="doc-item">
						<a href="https://kmmp123.000webhostapp.com/vmo-201<?php echo $i?>.pdf">
							<div id="contain-docs">
								<img src="https://kienthuc24h.com/wp-content/uploads/2017/08/ogimage-730x390.png"/>
								<h3> Đề thi và lời giải VMO 201<?php echo $i ?> </h3>
							</div>
							
							
						</a>
					</li>
				<?php }?>
			</ul>
			<h2 style="clear: left; padding-top: 20px; border-top: 1px solid #ccc;">Chuyên đề toán học</h2>
			<ul style="margin-left: 20px;">
				<li class="item-list-style">
					<a href="#">Trường đông toán học miền nam 2017</a>
				</li>
				<li class="item-list-style">
					<a href=#>Trường đông toán học miền nam 2016</a>
				</li>
				<li class="item-list-style"><a href="#">Kỷ yếu hậu gặp gỡ toán học 2016</a></li>
				<li class="item-list-style"><a href=#>Chuyên đề toán học số 10 PTNK</a></li>
				<li class="item-list-style"><a href="#">Tuyển chọn bài thi chọn đội tuyển toán các tỉnh thành phố 2016-2017</a></li>
			</ul>
			<h2 style="clear: left; padding-top: 20px; border-top: 1px solid #ccc;">Tài liệu tin học</h2>
		</div>
		<div id="right">
			<h3>Danh mục sản phẩm</h3>
			<div class="drop-out" style="border-bottom: 1px solid white;">
				<a href="#" style="text-decoration: none;">
					<div id="catego">Toán Olympic</div>
					<div class="drop-out-content">
						<ul>
							<li><a href="#">Đại số</a></li>
							<li><a href="#">Hình học</a></li>
							<li><a href="#">Số học</a></li>
							<li><a href="#">Tổ hợp</a></li>
						</ul>
					</div>
				</a>
			</div>
			<div class="drop-out" style="border-bottom: 1px solid white;">
				<a href="#" style="text-decoration: none;">
					<div id="catego">Toán THPT Quốc gia</div>
					<div class="drop-out-content">
						<ul>
							<li><a href="#">Đại số</a></li>
							<li><a href="#">Hình học</a></li>
							<li><a href="#">Số học</a></li>
							<li><a href="#">Tổ hợp</a></li>
						</ul>
					</div>
				</a>
			</div>

			<div class="drop-out" style="border-bottom: 1px solid white;">
				<a href="#" style="text-decoration: none;">
					<div id="catego">Toán Cao cấp</div>
					<div class="drop-out-content">
						<ul>
							<li><a href="#">Đại số</a></li>
							<li><a href="#">Hình học</a></li>
							<li><a href="#">Số học</a></li>
							<li><a href="#">Tổ hợp</a></li>
						</ul>
					</div>
				</a>
			</div>
			<div class="drop-out" style="border-bottom: 1px solid white;">
				<a href="#" style="text-decoration: none;">
					<div id="catego">Toán Ứng dụng</div>
					<div class="drop-out-content">
						<ul>
							<li><a href="#">Đại số</a></li>
							<li><a href="#">Hình học</a></li>
							<li><a href="#">Số học</a></li>
							<li><a href="#">Tổ hợp</a></li>
						</ul>
					</div>
				</a>
			</div>
			<div class="drop-out" style="border-bottom: 1px solid white;">
				<a href="#" style="text-decoration: none;">
					<div id="catego">Toán THPT</div>
					<div class="drop-out-content">
						<ul>
							<li><a href="#">Đại số</a></li>
							<li><a href="#">Hình học</a></li>
							<li><a href="#">Số học</a></li>
							<li><a href="#">Tổ hợp</a></li>
						</ul>
					</div>
				</a>
			</div>
			<div class="drop-out" style="border-bottom: 1px solid white;">
				<a href="#" style="text-decoration: none;">
					<div id="catego">Toán THCS</div>
					<div class="drop-out-content">
						<ul>
							<li><a href="#">Đại số</a></li>
							<li><a href="#">Hình học</a></li>
							<li><a href="#">Số học</a></li>
							<li><a href="#">Tổ hợp</a></li>
						</ul>
					</div>
				</a>
			</div>
			<div class="drop-out" style="border-bottom: 1px solid white;">
				<a href="#" style="text-decoration: none;">
					<div id="catego">Toán tiểu học</div>
					<div class="drop-out-content">
						<ul>
							<li><a href="#">Đại số</a></li>
							<li><a href="#">Hình học</a></li>
							<li><a href="#">Số học</a></li>
							<li><a href="#">Tổ hợp</a></li>
						</ul>
					</div>
				</a>
			</div>
			<div class="drop-out" style="border-bottom: 1px solid white;">
				<a href="#" style="text-decoration: none;">
					<div id="catego">Câu chuyện toán học</div>
					<div class="drop-out-content">
						<ul>
							<li><a href="#">Đại số</a></li>
							<li><a href="#">Hình học</a></li>
							<li><a href="#">Số học</a></li>
							<li><a href="#">Tổ hợp</a></li>
						</ul>
					</div>
				</a>
			</div>

		</div>
	</div>
	<div id="footer"></div>
</body>
</html>