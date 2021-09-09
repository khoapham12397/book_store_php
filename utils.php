<?php
	function formatMoney($x){
		$s=strval($x);$s1="";$t=0;
		for($i=strlen($s)-1;$i>=0;$i--){
			$s1=$s1.$s[$i];
			$t++;
			if($t%3==0 && $i!=0) $s1=$s1.'.';
		}
		return strrev($s1);
	};
	function reduceName($s){
		if(strlen($s)<=36) return $s;
		$s1=substr($s, 0,32);
		$s1.='...';
		return $s1;
	}
	function convert_vi_to_en($str) {
      $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
      $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
      $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
      $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
      $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
      $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
      $str = preg_replace("/(đ)/", "d", $str);
      $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $str);
      $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $str);
      $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", "I", $str);
      $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $str);
      $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
      $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
      $str = preg_replace("/(Đ)/", "D", $str);
      //$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
      return $str;
  	}
	function sendEmail($x){
		$cart=$_SESSION['cart'];
		$to_email = $x;
		
		$subject = "New Order Today ".date('y-m-d');
		$body = "<html><head><title></title><link rel=\"stylesheet\" type=\"text/css\" href=\"css/style.css\"></head><body><table><tr><th>STT</th><th>Product</th><th>Price</th><th>Number</th><th>Payment</th></tr>";
		$total=0;
		foreach($cart as $ind=>$line){
			$t=$line['price']*$line['count'];
			$body.="<tr>";
			$body.="<td>".($ind+1)."</td>";
			$body.="<td>".$line['name']."</td>";
			$body.="<td>".formatMoney($line['price'])."</td>";
			$body.="<td>".$line['count']."</td>";
			$body.="<td>".formatMoney($t)."</td>";
			$body.="</tr>";
			$total+=$t;
		}
		$body.="<tr>";
		$body.="<td>Total Payment</td><td></td><td></td><td></td><td>".formatMoney($total)."</td></tr>";
		$body.="</table></body></html>";

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers.= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
		if(mail($to_email,$subject,$body,$headers)){
			header("Loacation:index.php");
			
		}else echo "Error";
		
	};

	
?>

