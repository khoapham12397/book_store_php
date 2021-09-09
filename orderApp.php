<?php
	$conn=new PDO('mysql:host=localhost;dbname=id11431148_book_store','id11431148_id11431148_khoakmap','Khoabaria_970924');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$idAccount=$_POST['id_account'];
	$totalPay= $_POST['total_payment'];
	$cart = json_decode($_POST['cart'],true);//cast object to array type
	//tu day nen giai them bai moi hay la tim cac y tuong khac ???
	# dau tien nhan xet cai  tuong bai kia la ko he moi me ???
	# co the noi la nhu vay, do		
	//cart nay la 1 json array -> can pass ve php array dung la nhu vay ok just do it 
	//nhung bien array trong php la pass by value ???
	try{
		$conn->beginTransaction();
		$newOid= uniqid();
		$d= date('Y-m-d H:i:s');
		$stmt=$conn->prepare('insert into order_acc(id,id_customer,total_payment,status,date) values(?,?,?,?,?)');
		$status=1;
		$stmt->bindParam(1,$newOid);
		$stmt->bindParam(2,$idAccount);
		$stmt->bindParam(3,$totalPay);
		$stmt->bindParam(4,$status);
		$stmt->bindParam(5,$d);
		
		$stmt->execute();

		foreach($cart as $line){
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
		$conn->commit();
		$ret=["code"=>1];

	}catch(PDOException $e){
		$conn->rollBack();
		$ret=["code"=>0];
	}
	echo json_encode($ret);
?>

