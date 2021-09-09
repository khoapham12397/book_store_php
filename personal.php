<?php
	session_start();
	if(!isset($_SESSION['id_account'])){
		header('Location: login.php');
	}
	$action=NULL;
	if(isset($_GET['action'])){
		$action=$_GET['action'];
	}
	//$action=$_GET['action'];
	$conn=new PDO('mysql:host=localhost;dbname=book_store;charset=utf8','root','');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$books_viewed=NULL;
	if($action=='2'){
			
	}
	
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
			var decodeCookie= decodeURIComponent(document.cookie);
			
			var ca=decodeCookie.split(";");
			var s="products_viewed=";
			var pagesVNumber=0,pageVIndex=0,booksVNumber=0;
			var pl="";
			for(let i=0;i<ca.length;i++){
				let c=ca[i];
				while(c.charAt(0)==' ') c=c.substring(1);
				if(c.indexOf(s)==0){
					pl=c.substring(s.length);
					pl=pl.substring(1);
					pl=pl.substring(0,pl.length-1);
				}
			}
			var viewedBooks=pl.split(",");

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
			function reduceName(s){
				if(s.length<=36) return s;
				s1=s.substring(0,30);
				s1+="...";
				return s1;
			}
			function showViewedBooks(){
				let endInd;
					if(pageVIndex*4+4 < booksVNumber) endInd=pageVIndex*4+4;
					else endInd=booksVNumber;
					for(let i=pageVIndex*4;i<endInd;i++){
						let li1=$("<li></li>");li1.addClass("book-item");
							li1.attr("style","border-bottom:1px solid #ccc;border-right:1px solid #ccc;");
					let slink= "product.php?id="+books[i].id.toString();

					let link=$("<a></a>");link.attr("href",slink);
					
					let container=$("<div></div>");container.attr("id","contain-book");
					let img=$("<img></img>");img.attr("src",books[i].path_img);
					let name=$("<h3></h3>");name.text(reduceName(books[i].name));
					name.attr("style","height:50px");
					//name.attr("style","margin-top: 0px;margin-bottom: 0px;text-align: center;");
					
					let price=$("<div></div>");price.text(formatMoney(books[i].price));
					//price.attr("style","margin-left: 0px;margin-top: 0px;text-align: center;");
					container.append(img,name,price);
					link.append(container);
					let divBtn=$("<div></div>");
					let btn=$("<button></button>");
				btn.attr("style","width: 130px; height:40px; margin-left: 25px;background-color: #000022; color: white; border-radius: 50px;margin-top: 5px; margin-bottom: 3px;border: none;");
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
					$("#list-books").append(li1);		
					}
			}
			function nextPage(){
				$("#btnPrev").attr("style","visibility: visible");
				u=$("#list-books").get(0);
					if(pageVIndex<pagesVNumber-1){
					
					while(u.firstChild){
						u.removeChild(u.firstChild);
					}
					
					pageVIndex++;
					showViewedBooks();
					if(pageVIndex==pagesVNumber-1) $("#btnNext").attr("style","visibility: hidden");
					}
			}
			function prevPage(){
				$("#btnNext").attr("style","visibility: visible");
				u=$("#list-books").get(0);
					if(pageVIndex>0){
						while(u.firstChild){
							u.removeChild(u.firstChild);
						}
				
						pageVIndex--;
						showViewedBooks();
						if(pageVIndex==0) $("#btnPrev").attr("style","visibility: hidden");
					}
			}
			function getViewedBooks(){
				let vbs=JSON.stringify(viewedBooks);
				$.ajax({url: 'getProductsIds.php',method: 'GET',dataType:'json', data:{idList: vbs}}).done(function(data){
				
					books=data;
					booksVNumber=books.length;
					pagesVNumber=Math.floor(booksVNumber/4);
					if(booksVNumber%4!=0) pagesVNumber++;
					showViewedBooks();
				});

				$("#btnNext").click(function(){
					nextPage();
				});
				$("#btnPrev").click(function(){
					prevPage();
				});
				$("#area-viewed-books").attr("style","visibility:visible;");
				document.addEventListener("keydown",function(event){
					if(event.keyCode==39) nextPage();
					if(event.keyCode==37) prevPage();
				});
			}
		
			//do da thay doi co ban ve data type -> change loi ok
			getViewedBooks();
			var statuses=["Reiceived","Wrapped","Transporting","Successed"];
			function getUFOrders(){
				$.ajax({url:'getOrders.php',method:'GET',dataType: 'json',data:{orders_type: 5}}).done(function(data){
					
					//nen nho 1 dieu  :
					for(let i=0;i<data.length;i++){
						let orderArea=$("<div></div>"); orderArea.addClass("order-info");
						let orderItemArea=$("<div></div>"); orderItemArea.addClass("order-item-info");
						let tblOrder=$("<table></table>").attr("style","width: 299px; margin-top: 20px;padding-top:20px;");
						//alert(data[i].order_items[0].name);
						let orderID= $("<tr></tr>").append($("<td></td>").text("Mã đơn hàng"),$("<td></td>").text(data[i].id)); 

						let st= statuses[parseInt(data[i].status)-1];
						
						let orderStatus=$("<tr></tr>").append($("<td></td>").text("Trạng thái"));
						orderStatus.append($("<td></td>").text(st));

						let orderPayment=$("<tr></tr").append($("<td></td>").text("Tổng hóa đơn"));
						orderPayment.append($("<td></td>").text(formatMoney(data[i].total_payment)));
						//cai minh can co la gi ????
						//dau tien phai xac dinh ro nhung thu do truoc da : 

						tblOrder.append(orderID,orderStatus,orderPayment);
						orderArea.append(tblOrder);
						
						let tblOrderItems=$("<table></table>").attr("style","margin-top:20px;min-width:460px;");
					
						for(let j=0;j<data[i].order_items.length;j++){
							let obj= data[i].order_items[j];
							let row=$("<tr></tr>");
							
							let img=$("<td></td>").append($("<img/>").attr("width","60px").attr("height","75px").attr("src",obj.path_img));
							let name=$("<td></td>").text(obj.name);
							let price=$("<td></td>").text(formatMoney(obj.price));
							let count=$("<td></td>").text(obj.quantity);
							row.append(img,name,price,count);
							tblOrderItems.append(row);
						}
						orderItemArea.append(tblOrderItems);
						
						let el=$("<div></div>").attr("style","border-bottom: 1px solid #ccc");
						el.append(orderArea,orderItemArea);
						$("#uf-list").append(el);
						$("#uf-list").append($("<div></div>").attr("style","clear: left;"));

					}
				});
			}

			$("#btn_uforder").click(function(){

				getUFOrders();
			})
			function getSuccessOrders(){

			}

		});
	</script>
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
								<li class="sub-title"><a href="#">Thuật toán</a></li>
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
					<a href="#">
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
		
	</div>
	<div id="main">
		<div id="left">
			<div id="area-viewed-books" style="visibility: hidden;">
			<h2 style="margin-top: 10px; margin-bottom: 10px;">Sản phẩm đã xem</h2>
			
				<ul id="list-books">
				
				</ul>
				
				<div style="clear: left;">
				<button id=btnPrev style="visibility: hidden;"><i class="fa fa-arrow-circle-left" style="font-size:36px"></i></button>
				<button id="btnNext"><i class="fa fa-arrow-circle-right" style="font-size:36px"></i></button>
				</div>
			</div>

			<div style="clear: left; padding-top: 20px;"><button id="btn_uforder" style="font-size: 15px; background-color: transparent; border: none;"><h2>Theo dõi đơn hàng<h2> </button>
				<div id="uf-list" style="border-bottom: 1px solid #ccc; padding-bottom: 10px;">
					
				</div>

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