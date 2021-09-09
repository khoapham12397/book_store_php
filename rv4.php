<?php
	if(isset($_POST['lst'])){
		$ds= json_decode($_POST['lst'],true);
		echo json_encode($ds);
	}

	// gia dinh neu nhu vay thi cai app nay can set den 1 cai ben ngoai : 


?>