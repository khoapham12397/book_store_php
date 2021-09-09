
<?php
	//header("Content-Type: application/json;charset=UTF-8");
	$conn=new PDO('mysql:host=localhost;dbname=book_store;charset=utf8','root','');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	require_once('utils.php');
	if(!isset($_GET['category'])){
		if(!isset($_GET['key'])){
			$stmt=$conn->prepare('select * from tb_book order by rand() limit 200');
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->execute();
			$res=$stmt->fetchAll();
		}else{
			$key=$_GET['key'];
			$key=convert_vi_to_en($key);
			$stmt=$conn->prepare('select id,name,price,author,path_img from tb_book');
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->execute();
			$bs=$stmt->fetchAll();
			$res=[];
			for($i=0;$i<count($bs);$i++){
				if(strpos($bs[$i]['name'], $key)){
					array_push($res, $bs[$i]);
				}
			}
		}

	}else{
		$id_category=$_GET['category'];
		$stmt=$conn->prepare('select tb.id,tb.name,tb.price,tb.author,tb.path_img from tb_book tb inner join book_category bc on tb.id=bc.id_book and bc.id_category=? order by rand() limit 100');
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->bindParam(1,$id_category);
		$stmt->execute();
		$res=$stmt->fetchAll();
	}
	//echo var_dump($res);
	echo json_encode($res,JSON_UNESCAPED_UNICODE);
?>