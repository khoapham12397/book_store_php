<?php 
	session_start();
	if(!isset($_SESSION['id_account'])){
		if(isset($_COOKIE['email']) && isset($_COOKIE['password'])){
			$_SESSION['id_account']=$_COOKIE['id_account'];
			$_SESSION['email']=$_COOKIE['email'];
			$_SESSION['password']=$_COOKIE['password'];
			$_SESSION['nickname']=$_COOKIE['nickname'];
		}
	}

	$conn= new PDO('mysql:host=localhost;dbname=book_store;charset=utf8','root','');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt= $conn->prepare('select * from tb_book');
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->execute();
	$books=$stmt->fetchAll();
	$page_index=0;
	
	$num_books= count($books);
	$num_page= $num_books/4;
	if($num_books%4!=0) $num_page+=1; 

	if(!isset($_SESSION['id_account'])) $logined=0;
	else $logined=1;
	require_once('utils.php');
?>
<!DOCTYPE html>
<html>
<head>

	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript">
	
		function buyProduct(x){
			//dau tien neu nhu 1 ta co 2 window cung la cua so o tang tren nu a
			//ngoai ra ta cung co the : 

			//doi voi action =1 thi no se update || thêm vào với 1 so lượng nhât dinh
			$.ajax({url: 'buyProduct.php',method: 'GET',dataType: 'json',data:{id: x,count: 1}}).done(function(data){
				
				if(data.code==1){
					if(confirm('Do you want to view cart?')){
						
						window.location="cart.php";
					}
				}
			});
			
		};

	</script>
</head>
<body>
	<div id="banner-top">
		<img src="http://sachtoan24h.com/wp-content/uploads/2018/11/banner.png" width="1000px" height="180px" />
	</div>

	<div id="menu-top">
		<ul>
			<li class="main-title"><a href="index.php" >Trang chủ</a></li>
			<li class="main-title"><a href="#" >Giới thiệu</a></li>
			<li class="main-title">
				<div class="drop-out">
				<a href="documents.php">
					<div>Tài liệu</div>
					<div class="drop-out-content" style="width: 500px; ">
							<ul>
								<li class="sub-title"><a href="#">Toán học</a></li>
								<li class="sub-title"><a href="#">Lập trình</a></li>
								<li class="sub-title"><a href="#">Thuật toán</a></li>
								<li class="sub-title"><a href="#">Machine Learning</a></li>
							</ul>
						
					</div>
				</a>
				</div>
			</li>
			<li class="main-title"><a href="#">Liên hệ</a></li>
			<li class="main-title"><a href="#">Forum</a></li>
			<li class="main-title"><a href="cart.php">Giỏ hàng</a></li>
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
	<div id="main">
		<div id="left" style="border-bottom: 1px solid #ccc; padding-bottom: 20px;">
			<h2 style="margin-top: 0px;">Recommended Books</h2>
			<ul id="list-books">
			<?php for ($i=0; $i<$num_books;$i++) {?>
				<li class="book-item" style="border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;">
					<a href="product.php?id=<?php echo $books[$i]['id']?>">
					<div id="contain-book">
						<img src="<?php echo $books[$i]['path_img']?>"/>
						<h3><?php echo $books[$i]['name']?></h3>
						<div><?php echo formatMoney($books[$i]['price'])?> đ</div>
					</div>
					
					</a>
					<div><button style="width: 130px; height:40px; margin-left: 25px;background-color: 	#000022; color: white; border-radius: 50px;
						margin-top: 5px; margin-bottom: 3px;
					" onclick="buyProduct(<?php echo $books[$i]['id']?>)">Buy now</button></div>
				</li>
			<?php }?>
			</ul>
				
		</div>	 
		<div id="right" style="position: relative;">
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
</body>
</html>