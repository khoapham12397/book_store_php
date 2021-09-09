<?php 
	$conn= new PDO('mysql:host=localhost;dbname=book_store','root','');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$id_customer=1;
	$d= date('Y-m-d H:i:s');
	try{
		
		$total=730000;
		$conn->beginTransaction();
		$newOrderID= uniqid();
		$stmt= $conn->prepare('insert into order_new(id,id_customer,date,total_payment) values(?,?,?,?)');
		$stmt->bindParam(1,$newOrderID);
		$stmt->bindParam(2,$id_customer);
		$stmt->bindParam(3,$d);
		$stmt->bindParam(4,$total);
		$stmt->execute();
		//cartItem -> id_book, count,price , va vai thu khac-> sau do se co : nhieu day la du roi 	
		//create a cart ok
		
		$cart=[["idBook"=>"1","count"=>2,"price"=>"150000"],["idBook"=>"2","count"=>2,"price"=>"150000"],["idBook"=>"3","count"=>1,"price"=>"130000"]];
		foreach($cart as $line){
			$stmt=$conn->prepare('insert into order_item_new(id_order,id_book,count,price) values(?,?,?,?)');
			$stmt->bindParam(1,$newOrderID);
			$stmt->bindParam(2,$line['idBook']);
			$stmt->bindParam(3,$line['count']);
			$stmt->bindParam(4,$line['price']);
			$stmt->execute();
		}

		$conn->commit();

	}catch(PDOException $e){
		echo $e;
		$conn->rollBack();
	}
?>
