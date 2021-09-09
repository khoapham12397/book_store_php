<?php
	header("Access-Control-Allow-Origin: *");
	$arr=[["id"=>1, "name"=>"khoa pham","age"=>24],["id"=>2,"name"=>"yutaka","age"=>22]];
	echo json_encode($arr);
?>