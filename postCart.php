<?php
	$my_order=json_decode($_POST['my_order'],true);
	$email=$my_order['email'];
	$password= $my_order['password'];
	$total= $my_order['total_payment'];
	$items= $my_order['order_items'];
	$conn=new PDO('mysql:host=localhost;dbname=id11431148_book_store','id11431148_id11431148_khoakmap','Khoabaria_970924');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$stmt=$conn->prepare('select id from customer where email=? and password=?');
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->execute();
	$idAccount=$stmt->fetch();

	if($idAccount!=null){
	try{
		$conn->beginTransaction();
		$newOid= uniqid();
		$d= date('Y-m-d H:i:s');
		$stmt=$conn->prepare('insert into order_acc(id,id_customer,total_payment,status,date) values(?,?,?,?,?)');
		$status=1;
		$stmt->bindParam(1,$newOid);
		$stmt->bindParam(2,$idAccount);
		$stmt->bindParam(3,$total);
		$stmt->bindParam(4,$status);
		$stmt->bindParam(5,$d);
		
		$stmt->execute();
		foreach($items as $line){
			$idBook=$line['id_book'];
			$count=$line['count'];
			$price=$line['price'];
			
			$stmt=$conn->prepare('insert into order_item(id_book,id_order,price,quantity) values(?,?,?,?)');
			$stmt->bindParam(1,$idBook);
			$stmt->bindParam(2,$newOid);
			$stmt->bindParam(3,$price);
			$stmt->bindParam(4,$count);
			
			$stmt->exeute();
		}
		$ret=["result"=>"success"];
		$conn->commit();
	}catch(PDOException $e){
		$ret=['result'=>strval($e)];
		$conn->rollBack();
	}
	}else{
		$ret=["result"=>"Fail Account ID"];
	}
	echo json_encode($ret);
?>
