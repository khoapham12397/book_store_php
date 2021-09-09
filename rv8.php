<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<body>
	<ul id="lst"></ul>
	<table id= "tbl"></table>
	<script type="text/javascript">
		const lst = document.getElementById("lst");

		function addItems(data){
			var len =data.length;
			alert(len);
			// dau ien thuc 
			for(let i=0;i<5*len;i++){
				let item = data[i%len].item;
				let name=  item.name; 
				let artists = item.byArtist;
				let arrAt = artists[0].name;
				for(let j=1;j<artists.length;j++) {
					arrAt+="- "+ artists[j].name;
				}
				let li = document.createElement("li");
				li.textContent = name+" by "+arrAt; 
				lst.appendChild(li);
			}
		}
		// tuc la ngay sau do minh nhet no vao 1 cai function kieu gi do la co the duoc dung chua 

		// sau do neu minh thuc hien theo cach nay thi se tinh toan the nao 

		// dau tien thuc hien de phan chia dung vay:
		// ta co 1 tap cac val duoc dua ra ??
		// no bi gioi han hay khong ???
		// co the la 1000000
		function requestProducts(){
			$.ajax({url : 'rv5.php', method: 'GET' , dataType: 'JSON'}).done(function(data){
				var len =data.length;
			//alert(len);
			for(let i=0;i<5*len;i++){
				let item = data[i%len].item;
				let name=  item.name; 
				let artists = item.byArtist;
				let arrAt = artists[0].name;
				for(let j=1;j<artists.length;j++) {
					arrAt+=" ft "+ artists[j].name;
				}
				let li = document.createElement("li");
				li.textContent = name+" - "+arrAt; 
				lst.appendChild(li);
			}
			});
		}

	</script>
	<script type="text/javascript">
		console.log(window.innerHeight);
		const tbl = document.getElementById("tbl");
		function checkScrollY(){
			console.log(this.scrollY);

			setTimeout(checkScrollY,200);
		}
		// dau tien hien thi ra 100 product ok just do it :
		// sau do co them cai gi nua ??

		function addRow(){
			for(let i=0;i<100;i++){
			let li = document.createElement("li");
			li.textContent= "hello";
			lst.appendChild(li);
			}
		}
		requestProducts();
		//addRow();
		console.log(document.body.scrollHeight);
		console.log(window.innerHeight);
		//		

		window.addEventListener("scroll", function(event){
			var numLi = lst.getElementsByTagName("li").length.toString();
			console.log("scrolled " +  " "+window.pageYOffset);
			var totalHeight = document.body.scrollHeight -window.innerHeight;
			if(this.scrollY >= 3*totalHeight/4) {
				requestProducts();
			}
		});
		//setTimeout(checkScrollY,200);
	</script>
</body>
</html>