<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript">

		$(document).ready(function(){
			var products=[];
			var doc;
			function formatMoney(price){
				let p= price.getSubString(0,price.length-2);
				return parseInt(p)*1000;
			}
			$("#btn1").click(function(){
				let link = $("#linkUrl").val();// get toan bo val : dunb vay :
				// nen la lam the nao ???
				
				$.ajax({url : link , method : 'POST'}).done(function(data){
					doc =new DOMParser().parseFromString(data, "text/html");
					// dinh dang no convert tu dang string data -> text/html ???
					let boxs= doc.getElementsByClassName("ma-box-content");
					for(let i=0;i<boxs.length;i++){
						let box= boxs[i];
						let imgBox= box.getElementsByClassName("product images-container")[0];
						let pathImg= imgBox.getElementsByTagName("img")[0].getAttribute("data-src");
						let name= imgBox.getElementsByTagName("a")[0].getAttribute("title");
						let price = box.getElementsByClassName("special-price")[0].getElementsByTagName("span")[0].textContent;
						let priceF= formatMoney(price);
						//author tu dau ra ??
						products.push({name: name, })
					}
				});
			});
		});
	</script>
</head>
<body>
	<input type="text" name="url" id= "linkUrl" style="width: 800px">
	<button id="btn1">Press</button>
</body>
</html>