<?php
	$conn=new PDO('mysql:host=localhost;dbname=book_store','root','');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt=$conn->prepare('select * from tb_book where id=1');
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->execute();
	$res=$stmt->fetch();
	echo json_encode($res);
?>