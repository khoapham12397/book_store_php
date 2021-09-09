<?php
	
	session_start();
	if(isset($_SESSION['id_account'])){
		header('Location: index.php');
	}else{
		if(isset($_POST['email']) && isset($_POST['password'])){
			
			$email=$_POST['email'];
			$pass=$_POST['password'];
			$conn=new PDO('mysql:host=localhost;dbname=book_store','root','');
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt=$conn->prepare('select *  from customer where email=? and password=?');
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->bindParam(1,$email);
			$stmt->bindParam(2,$pass);
			$stmt->execute();
			$res=$stmt->fetch();
			//email pass->la duoc nen luu toan bo thong tin vao trong SQLite -> la ok
			
			//khi do voi cookie luu tru lau nhu vay thi ok			
			if($res!=NULL){
				$_SESSION['id_account']=$res['id'];
				$_SESSION['email']=$res['email'];
				$_SESSION['password']=$res['password'];
				$_SESSION['nickname']=$res['nickname'];
				if(!empty($_POST['remember'])){
					setcookie("email",$res['email'],time()+3600);
					setcookie("password",$res['password'],time()+3600);
					setcookie("id_account",$res['id'],time()+3600);
					setcookie("nickname",$res['nickname'],time()+3600);
				}
				if(isset($_SESSION['ordering'])) {
					unset($_SESSION['ordering']);
					header('Location: order.php');
				}
				else header('Location: index1.php');
			}
			
		}
	}
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
			<form id="formRegister" method="POST" action="login.php" style="margin-top: 55px;border-radius: 20px;">
				<input type="text" placeholder="Email Address" name="email" value="<?php if(isset($_COOKIE['email'])) echo $_COOKIE['email']?>"/>
				<input type="password" placeholder="Password" name="password" value="<?php if(isset($_COOKIE['password'])) echo $_COOKIE['password']?>"/>
				<input type="checkbox" name="remember" style="margin-left: 350px;width: 100px; margin-top: 10px;padding-left: 0px;" />
				<span style="margin-top: 0px; padding-top: 0px; float:right; margin-top:20px; margin-right: 200px;">Remember me</span>
				<input type="submit" value="Login" style="width: 100px; height: 40px; background-color: #000022; color: white;margin-bottom: 20px; margin-left: 460px; "/>
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