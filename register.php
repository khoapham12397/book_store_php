<?php
	
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="css/style.css">
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
			<form action="#" method="POST" id="formRegister">
				<input name="fullname" type="text" placeholder="Fullname" /><br>
				<input name="password" type="password" placeholder="Password"/><br>
				<input name="nickname" type="text" placeholder="Nickname"/><br>
				<input name="birthday" type="date" placeholder="Birthday"/><br>
				<input name="phone" type="text" placeholder="Phone Number"/><br>
				<input name="email" type="text" placeholder="Email"/><br>
				<input name="address" type="text" placeholder="Address"/><br>
				<input type="submit" value="Register"
					style="width: 100px; height: 30px; background-color: #000022;color: white; margin-left: 460px;"
				/><br>
			</form>

		</div>
		<div id="right">
			<h3>Danh mục sản phẩm</h3>
			<ul>
				<li><a href="#">Toán Olympic</a></li>
				<li><a href="#">Toán Ôn thi đại học</a></li>
				<li><a href="#">Toán cao cấp</a></li>
				<li><a href="#">Toán học ứng dụng</a></li>
				<li><a href="#">Toán THPT</a></li>
				<li><a href="#">Toán THCS</a></li>
				<li><a href="#">Toán Tiểu học</a></li>
				<li><a href="#">Toán Mầm non</a></li>
				<li><a href="#">Toán đố</a></li>
				<li><a href="#">Danh nhân toán học</a></li>
			</ul>
		</div>
	</div>
	<div id="footer"></div>
</body>
</html>