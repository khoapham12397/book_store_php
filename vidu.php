<?php
   /*
	$conn= new PDO('mysql:host=localhost;dbname=book_store;charset=utf8','root','');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt=$conn->prepare('select tb.id,tb.name from tb_book tb, book_category bc where tb.id=bc.id_book and bc.id_category=12');
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->execute();

	$bs= $stmt->fetchAll();
	$needs=[];
	foreach($bs as $b){
		if(strpos($b['name'], "Kindaichi")!=false){
			array_push($needs, $b);
		}
	}
	echo var_dump($needs);
	// trong cai code he thong de thuc hien dieu gi do thi hau nhu no cung kha la don gian,
	//vi thu nhat no duoc xay dung dua tren cai gi ???



	*/
	/*
	require_once("utils.php");
		$conn= new PDO('mysql:host=localhost;dbname=book_store;charset=utf8','root','');
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$stmt=$conn->prepare('select id,name,price,author,path_img from tb_book');
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute();
		$bs=$stmt->fetchAll();
		$names=[];
		$key="toan tu hoc tuoi tre nam 2017 va nam 2018";
		//dau tien can dam bao ok
		$arrKey=explode(' ', $key);
		if(count($arrKey)>6) {
			$arrKey=array_slice($arrKey, 0,6);
		}

		$lenKey=count($arrKey);
		$pq=new SplPriorityQueue();
		
		function solve($name){
			$lenKey=$GLOBALS['lenKey'];
			$arrKey=$GLOBALS['arrKey'];
			$pq=$GLOBALS['pq'];
			for($st=0;$st<$lenKey;$st++){
				for($sl=$lenKey-$st;$sl>=1;$sl--){
					$str="";
					for($j=$st;$j<$st+$sl;$j++){
						$str.=$arrKey[$j];
					}
					if(strpos($name,$str)!==false){
						$pq->insert($name,$lenKey-$sl);
						return;	
					}
									
				}
			}
			
		}
		for($i=0;$i<count($bs);$i++){
			$name=strtolower(convert_vi_to_en($bs[$i]['name'])); 
			solve($name);
		}
		//sau do ta se co duoc :???
		while($pq->valid()){
			array_push($names, $pq->current());
			$pq->next();
		}
		*/
		//echo var_dump($names);
				

//		echo var_dump($x);
	#co day du cac value nay  -> ok
	#setcookie("products_viewed",$_COOKIE['products_viewed'],time()-100);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript">
		$(document).ready(function(){
			//van de no chinh la nhu vay khong the su dung cai XMLHttpRequest duoc :
			//Voi viec su dung : XMLHttpRequest-> truy xuat trinh duyet thi ok
			//gia su co 1 tap cac object tac dong qua lai,
			//trong ham cua object nay nhin thay duoc object kia van duoc dung la nuvay:
			//vi du : neu tu trong nay ta huc hien:
			$.ajax({url: 'http://localhost:8080/Review2/index1.php' ,method: 'GET'}).done(function(data){
				alert(typeof(data));
			});
			
			/*var procs= [{name: "chuyen khao day so", price: 200},{name: "chuyen khao da thuc",price: 140}];
			var strProcs= JSON.stringify(procs);
			
			var sendData={sender: 'khoa pham', products : strProcs};
			$("#btn").click(function(){
				$.ajax({url: "getJsonArr.php", method:"POST", dataType:"json",data: sendData}).done(function(data){
						alert(data[0].name+" "+data[0].price);
						
				});
			})
			*/
			//sau do ta nen su dung pt POST se hay hon dung la nhu vay sau do dung may cai framework cho client ta se thuc hhien duoc binding data with html element
			//dung day ta chia lam 2 dang sau do copy hoac pass parameter gen -> 
			/*
			$.ajax({url: 'getProducts.php',method: 'GET',dataType: 'json'}).done(function(data){
				alert(data[0].name);
			});
				

			$.ajax({url: 'getProducts.php',method: 'GET',dataType: 'json',data:{category: 1}}).done(function(data){
				alert(data.length);
			});
			*/
		});


	</script>
</head>
<body>
	<button id="btn">Press</button>
</body>
</html>