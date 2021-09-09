<?php
	session_start();
	$cart=$_SESSION['cart'];
	$conn=new PDO('mysql:host=localhost;dbname=book_store;charset=utf8','root','');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$total=$_GET['total'];
	$id_customer= $_SESSION['id_account'];
	$stmt=$conn->prepare('select max(id) as mid from order_acc');
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->execute();
	$new_orderID=$stmt->fetch()['mid'];
	if($new_orderID==NULL) $new_orderID=1;
	else $new_orderID+=1;
	
	$stmt=$conn->prepare('insert into order_acc (id,total_payment,id_customer,status) values (?,?,?,?)');
	$x=1;
	$stmt->bindParam(1,$new_orderID);
	$stmt->bindParam(2,$total);
	$stmt->bindParam(3,$id_customer);
	$stmt->bindParam(4,$x);
	$stmt->execute();
	
	foreach($cart as $line){
		$stmt=$conn->prepare('insert into order_item (id_order,id_book,quantity,price) values(?,?,?,?)');
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->bindParam(1,$new_orderID);
		$stmt->bindParam(2,$line['id']);
		$stmt->bindParam(3,$line['count']);
		$stmt->bindParam(4,$line['price']);
		$stmt->execute();
	}
	$res=["code"=>1];
	echo json_encode($res);
	//do do ta de dang co duoc van de nay :

	require_once('utils.php');
	sendEmail($_SESSION['email']);
	unset($_SESSION['cart']);
	header("Location:index1.php");
?>