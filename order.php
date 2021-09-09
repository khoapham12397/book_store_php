<?php
	session_start();
	if(!isset($_SESSION['cart'])) header('Location: index.php');
	else{
		if(!isset($_SESSION['id_account'])) {
			$_SESSION['ordering']=1;
			header('Location: login.php');
		}
	
		$cart=$_SESSION['cart'];
		$total=0;
		for($i=0;$i<count($cart);$i++){
			$x= $cart[$i]['price']*$cart[$i]['count'];
			$total+=$x;
			//array_push($cart[$i],"mon"=>$x);
		}
	}
	require_once('utils.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#btnPayment").click(function(){
				alert("Đơn hàng đã tiếp nhận");
				$.ajax({url: 'payment.php' ,method: 'GET',datType: 'json',data:{total: <?php echo $total?>}}).done(function(data){
						alert("Đạt hàng thành công! Vui lòng check mail để theo dõi đơn hàng.");
						window.location="index1.php";
				});
			});
		});
	</script>
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
			<h2 style="margin-top: 10px">Hóa đơn thanh toán</h2>
			<table class="ordinary" style="font-size: 20px; width: 760px;" id="tblInvoice">
				<tr style="text-align: center;">
					<th>ID</th>
					<th>Product</th>
					<th>Price</th>
					<th>Count</th>
					<th>Payment</th>
				</tr>
				<?php foreach($cart as $line){?>
					<tr>
						<td><img src="<?php echo $line['path_img']?>" width="80px" height="100px"/></td>
						<td><?php echo $line['name']?></td>
						<td><?php echo formatMoney($line['price'])?> đ</td>
						<td><?php echo $line['count']?></td>
						<td><?php echo formatMoney($line['price']*$line['count'])?> đ</td>
					</tr>

				<?php }?>
				<tr style="height: 50px;">
					<td>Total Payment</td><td></td><td></td><td></td>
					<td><?php echo formatMoney($total)?> đ</td>
				</tr>
			</table>

			<div><button id="btnPayment"style="background-color: transparent; border: none; font-size: 15px; float:right;margin-right: 30px;"><h3>Payment</h3></button></div>
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