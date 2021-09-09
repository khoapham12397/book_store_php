<?php
	/*
	$conn= new PDO('mysql:host=localhost;dbname=books_db;charset=utf8','root','');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//dung roi do ma just doit : 
	# cai do la no o ben js dung la vay :
	# sau do la cai gi nua dung vay do ma just do it and something else???/
	# vi du them khi nhan nut ???
	# dung la vay : 
	# tu tu can xem xe la no chuyen ve phia client 1 lan la bn record dung vay:
	# thiet ke tran qua 2 ben sau do set up sl san pham vi du neu thuc hien dieu nay thi sao ???
	# dung la vya :
	# dung la the do ma just do it and something else????
	# tiep theo nua la cai gi ???

	
	$stmt= $conn->prepare('select * from tb_book');
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->execute();
	$books= $stmt->fetchAll();
	echo sizeof($books);
	*/
	// ro rang la khi thuc hien cai do thi no ko lam 1 cach tuan tu ma duoc lap lich de thuc hien duy nhat tren 1 cai luong co ban dung vay tu do se chang bie tduoc 


?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/vdstyle.css">

	<script type="text/javascript">
		$(document).ready(function(){
			function formatPrice(price){
				let p=price.substring(0,price.length-2);
				return parseInt(p)*1000;
			}
			var doc, products=[];

			$("#btn1").click(function(){
				let linkurl= $("#lurl").val();
				products=[];
				$.ajax({url : linkurl, method:"POST"}).done(function(data){
				doc =new DOMParser().parseFromString(data,"text/html");
				let boxs= doc.getElementsByClassName("book_item");
				alert(boxs.length);
				for(let i=0;i< Math.min(18,boxs.length);i++){
					let box = boxs[i];

					let img= box.getElementsByTagName("img")[0];
					let pathImg= img.getAttribute("src");
					let name= img.getAttribute("alt");
					let price = box.getElementsByClassName("gia left")[0].textContent;
					let imgEl = $("<img/>").attr("style","width: 150px;height: 200px; margin-left: 10px;");
					imgEl.attr("src",pathImg);
					console.log(price);
					let link = $("<a></a>").attr("href","#");
					
					let contain = $("<div></div>");
					contain.addClass("container");
					contain.append(imgEl, $("<div></div>").text(name));
					let li = $("<li></li>"); li.addClass("book-item");
					let btn= $("<button></button>");
					btn.attr("style","width: 150px; height: 30px; background-color: transparent; border-radius: 50px; margin-top:0px; padding-top: 0px; border: 1px solid;");

					btn.text("view");
					// cai nay no la JQuery Object not DOMObjec 

					btn.click(function(){
						alert("hello my name: "+ name);
					});
					link.append(contain);
					li.append(link,btn);
					$("#list_book").append(li);
					let priceF= formatPrice(price);
					products.push({name: name, price: priceF, path_img: pathImg});
					//$("#tbl_book").append(tr);
				}
				let sendData =  {prods : JSON.stringify(products)};  

				$.ajax({url: "addBooks.php", method: "POST", dataType: "JSON", data: sendData}).done(function(result){
					alert("ok " + result);
				});
			});
			});
			
		});
	</script>
</head>
<body style="background-color: #EEEEEE;">	
	<input type="text" name="linkurl" id="lurl" style="width: 500px;">
	<button id="btn1">Press</button>
	<ul id="list_book">
		
	</ul>	
	<table id="tbl_book">
		
	</table>

	<div style="clear: left;">Hello</div>
	</div>
</body>
</html>