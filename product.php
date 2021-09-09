<?php
	session_start();
	$id=$_GET['id'];
	$conn= new PDO('mysql:host=localhost;dbname=book_store;charset=utf8','root','');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 	
	$stmt= $conn->prepare('select * from tb_book where id=?');
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->bindParam(1,$id);
	$stmt->execute();
	$book=$stmt->fetch();
	//cai thu 2 do la ta su dung hinh anh tu server cua no luon cho nhanh dung roi ok

	$stmt= $conn->prepare('select * from tb_book order by rand() limit 5');
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->execute();
	$books=$stmt->fetchAll();
	$fl=0;
	for($i=0;$i<count($books);$i++){
		if($books[$i]['id']==$id){
			array_splice($books, $i,1);
			$fl=1;		
			break;
		}
	}
	//thuc hien remove 1 phan tu trong array don gian : 
	if($fl==0) array_splice($books,0,1);
	if(isset($_SESSION['id_account'])){
		if(isset($_COOKIE['products_viewed'])){
			
			$pv=json_decode($_COOKIE['products_viewed']);
			$len=count($pv);

			for($i=0;$i<$len;$i++){
				if($pv[$i]==strval($id)){
					array_splice($pv,$i,1);
					break;
				}
			}
			
			array_unshift($pv, $id);
			
			
			setcookie("products_viewed",json_encode($pv),time()+24*60*60);

		}else{
			
			$pv=[$id];
			setcookie("products_viewed",json_encode($pv),time()+24*60*60);
		}
	}

	
	if(!isset($_SESSION['id_account'])) $logined=0;
	else $logined=1;
	require_once('utils.php');
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<title></title>
	<script type="text/javascript">

		$(document).ready(function(){
			id1=<?php echo $id?>;
			$('#btnBuy').click(function(){
				x=$('#quantity').val();
				
				$.ajax({url:'buyProduct.php', method: 'GET',dataType: 'json',data:{id: id1,count: x}}).done(function(data){
					if(confirm('Do you want to view cart?')){
						window.location='cart.php';
					}
				})
			});
		});

	</script>
</head>
<body>
	<!--thuc hien doi chieu lain-->
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
	
	<div id="main" style="margin-top: 30px;">
		<div id="left">
			<div id="image_book">
				<img src="<?php echo $book['path_img']?>" width="250px" height="350px" style="object-fit: cover"/>
			</div>
			<div id="intro_book">
				<h2><?php echo $book['name']?></h2>
				<h3 style="font-size: 20px; text-indent: 10px;margin-top: 0px; float:right; margin-right: 30px;">Price:<span style="color: red;"> <?php echo formatMoney($book['price'])?> đ</span></h3>
				<table class="ordinary" style="width: 449px; min-height: 180px; font-size: 17px;">
					<tr>
						<th>Author</th>
						<td><?php echo $book['author']?></td>
					</tr>
					<tr>
						<th>Publishing</th>
						<td>NXB ĐH Quốc gia Hà Nội</td>
					</tr>
					<tr>
						<th>Pages number</th>
						<td><?php echo $book['pages_number']?></td>
					</tr>
					<tr>
						<th>Category</th>
						<td>Olympics Math</td>
					</tr>
				</table>
				<div>
					<input type="number" id="quantity" min="1" max="50" style="float: left;
					margin: 30px 50px 10px 20px; width: 100px;
					" value="1"/>
					<button id="btnBuy" style="margin: 15px 30px 0px 30px; width: 150px; height: 50px;
					float: right;background-color: #000033; color: white; border-radius: 50px;border:none;
					">Buy Now</button>
				</div>
			</div>
			
			<div id="detail">
				<h2 style="margin-top: 0px; margin-bottom: 0px;">Description</h2>	
				<div style="font-size: 13px;padding-top: 10px; padding-bottom: 10px;text-align: justify;">
Số học là một phân nhánh toán học lâu đời nhất và sơ cấp nhất, được hầu hết mọi người thường xuyên sử dụng từ những công việc thường nhật cho đến các tính toán khoa học và kinh doanh cao cấp qua các phép tính cộng, trừ, nhân, chia. Người ta thường dùng thuật ngữ này để chỉ một phân nhánh toán học chú trọng đến các thuộc tính sơ cấp của một số phép tính trên các con số. Những nhà toán học đôi khi dùng chữ số học (cao cấp) để nhắc đến môn lý thuyết số, nhưng không nên nhầm lý thuyết này với số học sơ cấp. Các ngôn ngữ sử dụng từ vựng gốc Hán khác lại gọi môn này là toán thuật; từ số học lại được dùng để gọi môn học mà người Việt gọi là toán học. Nhằm giúp cho các em học sinh chuyên Toán, các giáo viên dạy chuyên Toán và các học viên cao học chuyên ngành phương pháp toán sơ cấp có thêm một tài liệu số học để tham khảo trong quá trình học tập, giảng dạy và nghiên cứu tôi mạnh dạn viết cuốn sách này. Trong cuốn sách có trình bày đầy đủ các vấn đề số học từ cơ bản cho đến nâng cao. Mỗi chương sách được chia ra làm nhiều chuyên đề hết sức đa dạng và phong phú. Mỗi chuyên đề là hệ thống lý thuyết được chứng minh, giải thích, lấy ví dụ minh họa rất rõ ràng. Hơn nữa, hệ thống bài tập trong sách được trình bày lời giải một cách chi tiết và cẩn thận; trong đó có rất nhiều bài toán số học được trích từ các cuộc thi Toán quốc gia của các nước, các kỷ yếu Olympic toán học của ban tổ chức toán quốc tế và các tạp chí Toán học nổi tiếng thế giới như Kvant, Crux, AMM, KöMaL, Gazeta,… Cuốn sách được viết lần đầu với tuổi đời còn non trẻ của tác giả nên không thể tránh khỏi những sai sót, rất mong bạn đọc từ khắp mọi miền đất nước mạnh dạn đóng góp ý kiến để những lần tái bản sắp đến cuốn sách sẽ được hoàn thiện.
				</div>
			</div>
			<div>
				<h2 style="margin-top: 5px;">Relative Products</h2>
				<ul>
					<?php foreach($books as  $b){?>
						<li class="book-item">
							<a href="product.php?id=<?php echo $b['id']?>">
								<div id="contain-book">
									<img src="<?php echo $b['path_img']?>"/>
									<h3><?php echo reduceName($b['name'])?></h3>
									<div><?php echo formatMoney($b['price'])?></div>
								</div>
							</a>
						</li>
					<?php }?>
				</ul>
			</div>
		</div>

	<div id="right" style="margin-top: 0px;">
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
