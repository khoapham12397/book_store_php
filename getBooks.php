<?php
	header('Content-Type: application/json');

	$obj = json_decode(file_get_contents('php://input'),true);
	$cate= $obj['cate'];
	$conn= new PDO('mysql:host=localhost;dbname=books_db;charset=utf8','root','');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// van de la sai cau lenh dung vay :
	
	$stmt= $conn->prepare('select * from tb_book where subject=? limit 10' );

	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->bindParam(1,$cate);	
	$stmt->execute();
  	$books= $stmt->fetchAll();
  	echo json_encode($books);

?>