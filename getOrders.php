<?php
	session_start();
	if(!isset($_SESSION['id_account'])) header("Location: login.php");
	$conn=new PDO("mysql:host=localhost;dbname=book_store;charset=utf8",'root','');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$type=$_GET['orders_type'];
	$id_account=$_SESSION['id_account'];
	if($type==5){
		$stmt= $conn->prepare('select * from order_acc where status in (1,2,3) and id_customer=?');
		$stmt->bindParam(1,$id_account);
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute();
		$orders=$stmt->fetchAll();
		for($i=0;$i<count($orders);$i++){
			$id_order= $orders[$i]['id'];
			$stmt=$conn->prepare('select * from order_item where id_order=?');
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->bindParam(1,$id_order);
			$stmt->execute();
			$order_items=$stmt->fetchAll();

			for($j=0;$j<count($order_items);$j++){
				$stmt=$conn->prepare('select name,path_img from tb_book where id=?');
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
				$stmt->bindParam(1,$order_items[$j]['id_book']);
				$stmt->execute();
				$book=$stmt->fetch();
				$order_items[$j]['name']=$book['name'];
				$order_items[$j]['path_img']=$book['path_img'];
			}
			$orders[$i]['order_items']=$order_items;
		}
		
	}
	else{
		$stmt= $conn->prepare('select * from order_acc where status=? and id_customer=?');
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->bindParam(1,$type);
		$stmt->bindParam(2,$id_account);
		$stmt->execute();
		$orders=$stmt->fetchAll();
		for($i=0;$i<count($orders);$i++){
			
			$id_order= $orders[$i]['id'];
			$stmt=$conn->prepare('select * from order_item where id_order=?');
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->bindParam(1,$id_order);
			$stmt->execute();
			$order_items=$stmt->fetchAll();
			
			//cu 1 orderitem thi minh lai phai get 2 thu : name and path img:
			for($j=0;$j<count($order_items);$j++){
				$stmt=$conn->prepare('select name,path_img from tb_books where id=?');
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
				$stmt->bindParam(1,$order_items[$j]['id_book']);
				$stmt->execute();
				$book=$stmt->fetch();
				$order_items[$j]['name']=$book['name'];
				$order_items[$j]['path_img']=$book['path_img'];
			}
			$orders[$i]['order_items']=$order_items;
		}
	}
	echo json_encode($orders);
?>