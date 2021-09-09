<?php
	$cate=$_GET['cate_id'];
	$conn= new PDO('mysql:host=localhost;dbname=id11431148_book_store','id11431148_id11431148_khoakmap','Khoabaria_970924');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 	
	$stmt=$conn->prepare('select tb.name,tb.price,tb.author,tb.path_img from tb_book tb inner join book_category bc on tb.id=bc.id_book where bc.id_category=?');
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->bindParam(1,$cate);
	$stmt->execute();
	$res= $stmt->fetchAll();
	echo json_encode($res);
?>