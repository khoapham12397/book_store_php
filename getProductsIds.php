<?php
	$conn= new PDO('mysql:host=localhost;dbname=book_store;charset=utf8','root','');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$idList=$_GET['idList'];
	
	$ids=json_decode($idList);

	if(count($ids)>0){
		$sql0="select * from tb_book where id in ";
		$sql="(";$sql1="";
		$sql1.=$ids[0];
		for($i=1;$i<count($ids);$i++){
			$sql1.=',';$sql1.=$ids[$i];
		}
		$sql1.=')';$sql.=$sql1;
		$sql0.=$sql;$sql0.=" order by field(id,".$sql1;
		$stmt=$conn->prepare($sql0);
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute();
		$books=$stmt->fetchAll();
		echo json_encode($books);
	}else{
		echo json_encode([]);
	}
?>
