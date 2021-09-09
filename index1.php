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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript">
		$(document).ready(function(){
			
			var books,pageNumber,bookOlympics,booksBK,booksManga;
			var pageIndex=0;
			var len;
			var one=16;
			function buyProduct(x){
						
			$.ajax({url: 'buyProduct.php',method: 'GET',dataType: 'json',data:{id: x,count: 1}}).done(function(data){
				
				if(data.code==1){
					if(confirm('Do you want to view cart?')){
						
						window.location="cart.php";
					}
				}
			});
			
			};
			function reduceName(s){
				if(s.length>36){
					s1=s.substring(0,30);
					s1+="...";
				}else s1=s;
				return s1;
			}
			function formatMoney(x){
				let s=x.toString();
				let len=s.length;
				let t=0;
				let s1="",s2="";
				for(let i=len-1;i>=0;i--){
					s1+=s[i];
					t++;
					if(t%3==0 && i!=0) s1+=".";
				}
				for(let i=s1.length-1;i>=0;i--) s2+=s1[i];
				return s2;
			}
			function getDataCategory(cate,ds,list,one){
				$.ajax({url : 'getProducts.php',method :'GET',dataType: 'json', data:{category: cate}}).done(function(data){
						ds=data;
						let len=ds.length;
						showData(one,list,0,len,ds);
				});
			}

			function showData(one,list,pageIndex,len,ds){
				
				let endInd;
				let books=ds;
				if(pageIndex*one+one<len) endInd=pageIndex*one+one;
				else endInd=len;
				
				for(let i=pageIndex*one;i<endInd;i++){
					let li1=$("<li></li>");li1.addClass("book-item");
					//li1.attr("style","border-bottom:1px solid #ccc;");
					

					let slink= "product.php?id="+books[i].id.toString();

					let link=$("<a></a>");link.attr("href",slink);
					
					let container=$("<div></div>");container.attr("id","contain-book");
					let bao=$("<div></div>").attr("style","width: 185px;height: 255px;");

					let img=$("<img></img>");img.attr("src",books[i].path_img);
					//img.attr("style","width: 160px;height: 200px;padding-left: 10px;");
					let name=$("<h3></h3>");name.text(reduceName(books[i].name));
					
					//name.attr("style","margin-top: 0px;margin-bottom: 0px;text-align: center;");

					let price=$("<div></div>");price.text(formatMoney(books[i].price)+" đ");
					price.attr("style","color: red;margin-top:10px;");
					//price.attr("style","margin-left: 0px;margin-top: 0px;text-align: center;");
					bao.append(img,name);
					container.append(bao,price);
					link.append(container);
					let divBtn=$("<div></div>");
					let btn=$("<button></button>");
				btn.attr("style","width: 130px; height:40px; margin-left: 25px;background-color: 	#000022; color: white; border-radius: 50px;margin-top: 5px; margin-bottom: 3px;border: none;");
					let id1=books[i].id;
					btn.click(function(){
						$.ajax({url: 'buyProduct.php',method: 'GET',dataType: 'json',data:{id: id1,count: 1}}).done(function(data){
				
							if(data.code==1){
								if(confirm('Do you want to view cart?')){
						
								window.location="cart.php";
								}
							}
						});
					});
					btn.text("Buy now");
					divBtn.append(btn);
					li1.append(link,divBtn);
					list.append(li1);
					
				}
			}
			//set up font-weight la ok:
			//doi voi android: 
			//sau do: co the thuc hien duoc 
			
			$.ajax({url: 'getProducts.php',method: 'GET',dataType: 'json'}).done(function(data){
				
				books=data;
				len=books.length;
				//ban dau pageIndex =0:
				pageNumber=Math.floor(len/one);
				if(len%one!=0) pageNumber+=1;
				
				showData(12,$("#list-books"),pageIndex,len,books);
			});
			

			getDataCategory(1,bookOlympics,$("#list-olympics"),10);
			getDataCategory(12,booksManga,$("#list-mangas"),10);
			getDataCategory(10,booksBK,$("#list-bks"),10);
			
			function nextPage(){
				if(pageIndex<pageNumber-1) {
					$("#btnPrev").attr("style","visibility:visible;");
					pageIndex++;

					let lb=document.getElementById("list-books");
					while(lb.firstChild){
						lb.removeChild(lb.firstChild);
					}
					showData(12,$("#list-books"),pageIndex,len,books);
					if(pageIndex==pageNumber-1) $("#btnNext").attr("style","visibility:hidden");
				}
			}
			function prevPage(){
				if(pageIndex>0){
					$("#btnNext").attr("style","visibility:visible;");
					pageIndex--;
					let lb=document.getElementById("list-books");
					while(lb.firstChild){
						lb.removeChild(lb.firstChild);
					}
					if(pageIndex==0) $("#btnPrev").attr("style","visibility:hidden");
					showData(12,$("#list-books"),pageIndex,len,books);

				}
			}
			$("#btnNext").click(function(){
				nextPage();
			});
			$("#btnPrev").click(function(){
				prevPage();
			})
			document.addEventListener('keydown', function(event){
 			   
 			   if(event.keyCode=="39"){
 			   		nextPage();
 			   }
 			   if(event.keyCode=="37") prevPage();
			});

		});
		
	</script>

</head>
<body>
	<div id="banner-top">
		<img src="https://media.digistormhosting.com.au/kcs/_pageBannerImage/book-banner-new.jpg?mtime=20190214135259" width="1000px" height="180px" style="object-fit: cover;" />
	
	</div>
	<div id="menu-top">
		<ul>
			<li class="main-title"><a href="index1.php">Trang chủ</a></li>
			<li class="main-title"><a href="#" >Giới thiệu</a></li>
			<li class="main-title">
				<div class="drop-out">
				<a href="documents.php">
					<div>Tài liệu</div>
					<div class="drop-out-content" style="width: 500px;">
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
	
	

	<div>
		<form class="formSearch" style="margin-top: 20px; margin-left: 10px;" action="products.php" method="POST">
				<input type="text" id="keyword" placeholder="Nhập từ khóa cần tìm kiếm" class="keyinput" style="width: 600px;" name="key">
				<input type="submit" value="Find" class="keyinput" style="width: 80px; height: 30px;margin-top: 5px; margin-left: 30px; float: left;background-color: #000022;color:white;"/>
		</form>
		<div style="float: right; margin-right: 10px; margin-top: 0px;">
			<a href="cart.php"><i class="fa fa-shopping-cart" style="font-size:48px;color:red"></i></a>
			
		</div>
	</div>

	<div style="clear: left; margin-top: 100px;">
		<ul id="list-icons" style="margin-left: 10px;padding-left: 0px; margin-top: 20px;">
			<li>
				<div class="contain-icon">
					<img src="https://cdn0.fahasa.com/media/wysiwyg/icon-menu/ico_flashsale@3x.png"/>
					<div>Flash Sale</div>
				</div>
			</li>
			<li>
				<div class="contain-icon">
					<img src="https://cdn0.fahasa.com/media/wysiwyg/icon-menu/ico_dealhot@3x.png" />
					<div>Deals Hot</div>
				</div>
			</li>
			<li>
				<div class="contain-icon">
					<img src="https://cdn0.fahasa.com/media/wysiwyg/icon-menu/ico_Fpointstore@3x.png" />
					<div>Point Store</div>
				</div>
			</li>
			
			<li>
				<div class="contain-icon">
					<img src="https://cdn0.fahasa.com/media/wysiwyg/icon-menu/ico_goiy@3x.png" />
					<div>Gợi ý cho bạn</div>
				</div>
			</li>
			<li>
				<div class="contain-icon">
					<img src="https://cdn0.fahasa.com/media/wysiwyg/icon-menu/ico_dochoi@3x.png" />
					<div>Đồ chơi</div>
				</div>
			</li>
			<li>
				<div class="contain-icon">
					<img src="https://cdn0.fahasa.com/media/wysiwyg/icon-menu/ico_vpp@3x.png" />
					<div>Văn Phòng Phẩm</div>
				</div>
			</li>
			<li>
				<div class="contain-icon">
					<img src="https://cdn0.fahasa.com/media/wysiwyg/icon-menu/ico_vanhoc@3x.png" />
					<div>Văn Học</div>
				</div>
			</li>
			<li>
				<div class="contain-icon">
					<img src="https://cdn0.fahasa.com/media/wysiwyg/icon-menu/ico_thieunhi@3x.png" />
					<div>Thiếu nhi</div>
				</div>
			</li>
			
		</ul>
	</div>
	<div id="main">
		
		<div id="left" style="padding-bottom: 20px;">
			
			<div style="clear: right;"></div>
			<h2 style="margin-top: 0px; width: 300px;">Recommended Books</h2>
			
			
			<ul id="list-books">
				
			</ul>
			<div style="clear: left;"></div>
			<div>
				<button id=btnPrev style="visibility: hidden;"><i class="fa fa-arrow-circle-left" style="font-size:36px"></i></button>
				<button id="btnNext"><i class="fa fa-arrow-circle-right" style="font-size:36px"></i></button>
			</div>
		</div>

		<div id="right">
			<div style="background-color: black;color: white;">
			<h3>Danh mục sách toán</h3>
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
			<div style="background-color: black;color: white; margin-top: 20px;">
			<h3>Danh mục sách tin học</h3>
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
	<div style="clear: left; margin-bottom: 10px;" >
		<h2 style="width:300px;">Tủ sách Olympic</h2>
		<ul id="list-olympics" style="margin-left: 20px; padding: 0px;">
				
		</ul>
		<div style="clear: left; height: 20px;"></div>
		<div style="clear:left;width: 1000px;text-align: center; margin-top: 10px;"><a href="productsCate.php?category=1">Xem thêm >></a></div>
	</div>
	
	<div  style="">
		<h2>Thế giới Manga</h2>
		<ul id="list-mangas" style="margin-left: 20px; padding: 0px;">
			
		</ul>
		<div style="clear: left; height: 20px;"></div>
		<div style="clear:left;width: 1000px;text-align: center; margin-top: 10px;"><a href="productsCate.php?category=12">Xem thêm >></a></div>
	</div>
	<div  style="">
		<h2>Thiếu nhi-Kiến thức bách khoa</h2>
		<ul id="list-bks" style="margin-left: 20px; padding: 0px;">
			
		</ul>
		<div style="clear: left; height: 20px;"></div>
		<div style="clear:left;width: 1000px;text-align: center; margin-top: 10px;"><a href="productsCate.php?category=10">Xem thêm >></a></div>
	</div>
	<div style="clear: left; height:35px;"></div>
</body>
</html>