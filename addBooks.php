<?php
	$conn= new PDO('mysql:host=localhost;dbname=books_db;charset=utf8','root','');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$prods = json_decode($_POST['prods'],true);
	$len = count($prods);
	// dau tien thuc hien them vao cai dang gi day :
	foreach ($prods as $p) {

		$stmt=$conn->prepare("insert into tb_book(name,price,count,path_img,subject) values(?,?,?,?,?)");
		$name= $p["name"];
		$price = $p["price"];
		$count=50;
		$pathImg= $p["path_img"];
		$subject= 9;
		$stmt->bindParam(1,$name); $stmt->bindParam(2,$price); $stmt->bindParam(3, $count);
		$stmt->bindParam(4,$pathImg); $stmt->bindParam(5,$subject);
		$stmt->execute();
	}
	echo $len;

?>