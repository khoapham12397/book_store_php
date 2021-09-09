<?php
	session_start();
	
	$conn=new PDO('mysql:host=localhost;dbname=book_store;charset=utf8','root','');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$id=$_GET['id'];
	$count=$_GET['count'];
	$stmt= $conn->prepare('select * from tb_book where id=?');
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->bindParam(1,$id);
	$stmt->execute();
	$book= $stmt->fetch();

	if(!isset($_SESSION['cart'])){
		
		$cart=[["id"=>$id,"name"=>$book['name'],"price"=>$book['price'],"count"=>$count,"path_img"=>$book['path_img']]];
		$_SESSION['cart']=$cart;
	}else{
		$cart=$_SESSION['cart'];
		
		$flag=0;
		for($i=0;$i<count($cart);$i++){
			if($cart[$i]['id']==$id){
				if($count==0){
					array_splice($cart,$i,1);
				}else $cart[$i]['count']=$count;
				$flag=1;
				break;
			}
		}
		
		if($flag==0 && $count>0){
		array_push($cart,["id"=>$id,"name"=>$book['name'],"price"=>$book['price'],"count"=>$count,"path_img"=>$book['path_img']]);
		}
		$_SESSION['cart']=$cart;

	}

	echo json_encode(["code"=>1]);
	
?>