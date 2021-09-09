<?php
	$conn= new PDO('mysql:host=localhost;dbname=books_db;charset=utf8','root','');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$products=json_decode($_POST['prods'],true);
	
	$names=[];
	foreach($products as $p){
		
		$stmt= $conn->prepare('insert into tb_book(name,price,author,path_img,supplier,subject) values(?,?,?,?,?,?)');
		$sub =9;
		$stmt->bindParam(1,$p['name']);
		$stmt->bindParam(2,$p['price']);
		$stmt->bindParam(3,$p['author']);
		$stmt->bindParam(4,$p['path_img']);
		$stmt->bindParam(5,$p['supplier']);
		$stmt->bindParam(6,$sub);
		$stmt->execute();
	}	
	$res=['code'=>1];
	echo json_encode($res);
	 

?>