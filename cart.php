<?php
	session_start();
	$cart=NULL;
	if(isset($_SESSION['cart'])){
		$cart=$_SESSION['cart'];
	}else $cart=[];
	if(!isset($_SESSION['id_account'])) $logined=0;
	else $logined=1;
	require_once('utils.php');
	//nhu the nay ?? 
	//ta se thuc hien theo kieu keyword ???
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript">
		function update(x){
			ele="#quantity"+x.toString();
			c=$(ele).val();
			$.ajax({url:'buyProduct.php',method: 'GET', dataType: 'json', data:{id: x, count:c}}).done(function(data){
				alert('Update successful');
			})
		}
		function delProduct(x,r){
			
			$.ajax({url:'buyProduct.php',method: 'GET',dataType:'json',data:{id:x, count: 0}}).done(function(data){
					
					alert('Delete successful');
					window.location="cart.php";
					
					//window.location="cart.php";
			});
			
		}
		$(document).ready(function(){
			
		});
	</script>
	<title></title>
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
				<a href="documents.php">
					<div>Tài liệu</div>
					<div class="drop-out-content" style="width: 500px; ">
							<ul>
								<li class="sub-title"><a href="#">Toán học</a></li>
								<li class="sub-title"><a href="#">Lập trình</a></li>
								<li class="sub-title"><a href="algorithms.php">Thuật toán</a></li>
								<li class="sub-title"><a href="#">Machine Learning</a></li>
							</ul>
						
					</div>
				</a>
				</div>
			</li>
			<li class="main-title"><a href="#">Liên hệ</a></li>
			<li class="main-title"><a href="#">Forum</a></li>
			<li class="main-title">
				<div class="drop-out">
					<a href="personal.php">
						<div>Cá nhân</div>
						<div class="drop-out-content"  style="width: 410px;">
							<ul>
								<li class="sub-title"><a href="#">Thông tin cá nhân</a></li>
								<li class="sub-title"><a href="#">Quản lý đơn hàng</a></li>	
								<li class="sub-title"><a href="#">Mã giảm giá</a></li>
								<li class="sub-title"><a href="personal.php">Sản phẩm đã xem</a></li>
							</ul>
						</div>
					</a>
				</div>	
			</li>
		</ul>
		<?php if($logined==0){?>
			<div  style="float: right; margin-top: 10px; margin-right: 30px;">
				<span><a class="log" href="login.php">Login</a></span><span style="color:white;"> | </span>
				<span><a class="log" href="register.php">Register</a></span>
			</div>
		<?php }else{ ?>
			<div  style="float: right; margin-top: 10px; margin-right: 30px; color: white;">
				<span>Hello <?php echo $_SESSION['nickname']?> | </span><span><a class="log">Logout</a></span>
			</div>
		<?php }?>
	</div>
	<div id="main" >
		<div id="left">
			<h2 style="margin-top: 10px">Giỏ hàng của bạn</h2>
			<table style="font-size: 18px; width: 760px;" id="tblCart">
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Price</th>
			<th>Count</th>
			<th>Update</th>
			<th>Delete</th>
		</tr>

		<?php foreach($cart as $ind=>$line){?>
			<tr id="row<?php echo $ind ?>">
				<td><img src="<?php echo $line['path_img']?>" width="80px" height="100px"/></td>
				<td><?php echo $line['name']?></td>
				<td><?php echo formatMoney($line['price'])?></td>
				<td>
					<input type="number" value="<?php echo $line['count']?>" id="quantity<?php echo $line['id']?>" style="width: 80px;"/>
				</td>
				<td>
					<button onclick="update(<?php echo $line['id']?>)"
						style="width: 100px; height:40px; background-color: #000022;color: white; border-radius: 50px; border: none;"
						>Update</button>
				</td>
				<td>
					<button style="width: 100px; height:40px; background-color: white;color: red; border-radius: 50px;" id="delbtn<?php echo $line['id']?>"
						onclick="delProduct(<?php echo $line['id']?>,<?php echo $ind?>)" 
					>Delete</button>
				</td>
			</tr>
		<?php }?>
	</table>
		<div>
			<h3 style="margin-right: 30px; float: right;"><a href="order.php"
				style="text-decoration: none; color: #000022;"
				>Tiến hành đặt hàng</a></h3>
		</div>
		</div>
		<div id="right" >
			<div style="background-color: black;color: white;">
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
	</div>
	
	<div id="footer"></div>
</body>
</html>