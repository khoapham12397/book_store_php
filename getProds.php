<?php
	header("Access-Control-Allow-Origin: *");
	$arr= [["name"=>"Conan 96", "price" => 18000, "quantity"=> 1],["name"=>"Conan 97", "price" => 18000, "quantity"=> 1],["name"=>"Conan 98", "price" => 20000, "quantity"=> 1]];
	echo json_encode($arr);
?>