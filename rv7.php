<?php
	// ro rang he thong cac bean nay duoc tao ra khi start 1 cai server 
	// luon o do ko bi mat di dung vcay :
	// dau tien nen nho 1 dieu cai sessionFactory.getCurrentSession hoac la gi ???
	// can xac dinh ro no 
	// dau tien ta co 1 dai dien cho no trong db dung sau do thi sao ???
	// neu ta gan no voi 1 gia tri session thi ro rang la dieu gi da xay ra vay ???
	// co nhieu cai can xac dinh hon 
	// lai co them cac van de nua roi dung vay ta co cai gi day 1 thang nay co the duoc goi khi 
	// ton tai cai gi ???
	// nen nho la chi 1 tap cac thao tac lien quan voi nhau thi minh nen dat no chay trong 
	// cung 1 cai transaction dung vay :
	// minh nen nho cu the la gi ???
	// 1 cai form la dang nhu vay : khi dat no la transactional thi sao /??
	// ta co the la nhu the nay : dau tien neu hien tai khong ton tai 1 transaction
	// thi khi do ta lam cai gi , ta thuc hien getCurentSession -> beginTransaction
// dieu nay dung la vay, no duoc sinh ra de ho tro cho cac tac vu phuc tap khi truy xuat va update DB => , dau tien nen nho no la 1 the hien vay ly cho viec ket noi toi DB la dang la nhu vay do ma just do it dung chua dung la vay , nen nho cu 1 dot ket noi ma xong thi close session di la duoc dung chua ???
// cau tra loi la 1 session => co 1 transaction dung vay : va 1 transaction cung co 1 session 
// ro rang la tu session  => co the sinh duoc transaction dung vay : 
// va tu do co the bat dau 1 qua trinh tuong tac ok sau khi xong thi transaction.commmit() la duoc con neu co exception co rollback la duoc roi dung vay no kha don gian cho nay thoi
// cai framework nay ham chua qua nhieu cac context moi dung vay :
// va no mang tinh he thong cao day :
// nen nho no ton tai cac problem ve classpath build path > inject , config cac dependencies
// luon ton tai cac tinh trang nhu nay khi thuc hien 1 method ma no co kha nang la 1 phan cua 1 tap cac truy van khac ta gan @Transactional cho no thi can set them cac thuoc tinh xac dinh nua // dung la vay do ma :
// danh dau 1 cai thi app context biet duoc no la dang bean nao ma dua xac dinh khu vuc chuc nang phu hop and dev can determine clearly about system :

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript">
		
	</script>
</head>
<body>
	<form>
		<input type="text" name="keyword" id="kw"/>
	</form>
	<script type="text/javascript">
		const inp = document.getElementById("kw");
		inp.addEventListener("input", function(event){
			console.log(inp.value);
		});
	</script>
</body>
</html>