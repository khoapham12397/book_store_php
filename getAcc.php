<?php
	/*
	$conn= new PDO('mysql:host=localhost;dbname=book_store','root','');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt=$conn->prepare('select * from customer');

	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->execute();
	$res=$stmt->fetch();
	#get 1 cai deu la string het don gian dung la nhu vay :

	echo var_dump($res);
	*/
	//dau tien can gui thong tin ve cart len server de kiem tra truoc xem no get duoc qua phuong thuc post hay khong ,sau do tien hanh thuc hien cach khac???
	//dieu nay cung kha la tot do ok just ez :
	//tiep theo ta can xac dinh duoc cu o 1 buoc thi whether server get data successfull ????
	$conn= new PDO('mysql:host=localhost;dbname=book_store;charset=utf8','root','');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//sau do ta nghi nen tien hanh luu cache lai 1 cai la duoc :
	//vi du ve viec neu join qua nhieu se khong tot, ta get all danh sach id Product:
	//tao ra nhieu ban json dung la nhu vay ok, sau do ta can get duoc cai gi ???
	//dau tien 
	//2 cai nay cung kha la tot thuc hien fetch assoc de chuyen ve dinh dang mang trong rat tot 
	//very good -> dung la nhu vay
	/*
	$stmt=$conn->prepare('select od.id,od.date,od.total_payment,oi.id_book,oi.count,oi.price from order_new od,order_item_new oi where od.id_customer=1 and od.id= oi.id_order');
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->execute();
	$res=$stmt->fetchAll();
	echo json_encode($res);
	*/
	//vay thi can tinh toan ntn ???
	//khi su dung graph api cua facebook cung khong the get many data duoc dung la nhu vay 


	$stmt=$conn->prepare('select id,date,total_payment from order_new where id_customer=1');
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->execute();
	$orders=$stmt->fetchAll();
	//dau tien thuc hien cai gi ???
	//dieu nay la kha tot dung la nhu vay :
	//sau do ta co the thuc hien tiep:

	//echo var_dump($orders);
	//neu code luon server = node.js thi the nao ???
	//dau tien can phai cau hinh server thi moi code duoc khong nhu la php 
	for($i=0;$i<count($orders);$i++){
		$id_order=$orders[$i]['id'];
		
		$stmt=$conn->prepare('select oi.price,oi.count,tb.name from order_item_new oi,tb_book tb where oi.id_order=? and oi.id_book=tb.id');
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->bindParam(1,$id_order);
		$stmt->execute();
		

		$order_items= $stmt->fetchAll();
		$orders[$i]['order_items']=$order_items;
		
	}
	//dieu do cung co ve la dung ???
	//nhung ta nen lam gi ??
	//van de do la gi, nen nho day la tu 1 cai domain khac ta truy nhap den no dieu nay khac voi tu chinh  no truy nhap den dung la nhu vay :
	//dieu nay ngan chan duoc cac tool tu dong get data 
	//doi voi stringRequest thi sao no cung danh len 1 cai do  nhung ma day la tu 1 ung dung 
	//do do thi sao , ro rang no xac dinh cai origin ntn /??

	echo var_dump($orders);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style1.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript">
		var st=[],n,arr=[];
		n=100;
		for(let i=0;i<101;i++) {
			let x=Math.floor(Math.random()*1000000);
			arr.push(x);
		}
		for(let i=0;i<401;i++) {
			st.push(0);
		}

		function build(id,l,r){
			if(l==r) {
				st[id]=arr[l];
				return;
			}
			let mid=Math.floor((l+r)/2);
			build(2*id,l,mid);
			build(2*id+1,mid+1,r);
			st[id]=Math.max(st[2*id],st[2*id+1]);
		}
		function getMax(id,l,r,u,v){
			if(l>=u && r<=v) return st[id];
			if(r<u || l>v) return -1;
			let mid=Math.floor((l+r)/2);
			return Math.max(getMax(2*id,l,mid,u,v),getMax(2*id+1,mid+1,r,u,v));
		}
		build(1,1,n);
		function query(){
			var ans=-1;
			for(let i=3;i<11;i++){
				ans=Math.max(ans,arr[i]);
			}
			console.log(ans);
			console.log(getMax(1,1,100,3,10));
		}
		query();
		//di tu 0-> n -1:
		function nkseq(){
			let n=10000,arr=[],s1=[],s2=[],f1=[].f2=[];

			for(let i=0;i<n;i++){
				let x=Math.floor(Math.random()*1000000);
				arr.push(x);
				f1.push(0);f2.push(0);
			}
			s1[0]=arr[0];s2[n-1]=arr[n-1];
			for(let i=1;i<n;i++) s1[i]=s1[i-1]+arr[i];
			for(let i=n-2;i>=0;i--) s2[i]=s2[i+1]+arr[i];
			f1[0]=arr[0];f2[n-1]=arr[n-1];
			for(let i=1;i<n;i++) f1[i]=Math.min(f1[i-1],s1[i]);
			for(let i=n-2;i>=0;i++) f2[i]=Math.max(f2[i+1],s2[i]);
			let ans=0,res=[];
			for(let i=1;i<n-1;i++){
				if(arr[i]<=0) continue;
				let x=s1[n-1]-s1[i-1];
				if(x-f2[i+1]<=0) continue;
				if(x+ f1[i-1]<=0) continue; 
				ans++; res.push(i);
			}
			for(x of res) console.log(x);
			return ans;
		}
		//thu code lai ve cai do xem the nao ???
		function buidDeque(){
			let n=100,a=[],l=[],r=[];
			for(let i=0;i<n;i++) {
				let x=Math.floor(Math.random()*1000000);
				a.push(x);
				l.push(0);r.push(0);
			}
			l[0]=0;r[n-1]=n-1;
			for(let i=1;i<n;i++){
				if(a[i]>a[i-1]) l[i]=i;
				else{
					let j=l[i-1];
					while(j>0 && a[i]<=a[j-1]) j=l[j-1];
					l[i]=j;					
				}
			}
			for(let i=n-2;i>=0;i--){
				if(a[i]>a[i+1]) r[i]=i;
				else{
					let j=r[i+1];
					while(j<n-1 && a[i]<=a[j+1]) j=r[j+1];
					r[i]=j;
				}
			}
		}
		//tinh max tu dau den cuoi: 
		function updateBIT(ind,val,n,bit){
			let i=ind;
			while(i<=n){
				bit[i]=max(bit[i],val);
				i+=(i&(-i));
			}
		}
		function getMaxBIT(ind){
			let ans=0;
			while(ind>0){
				ans=max(ans,bit[ind]);
				ind-=(ind&(-ind));

			}
			return ans;
		}
		function buildBIT(){
			let n=100,a=[],bit=[];

		}
		//dau tien tai sao ta nhan thay la no don gian????
		//y tuong kha la don gian thoi no chi la viec thuc hien theo cach thuc de ma : 		
	</script>
</head>
<body>

</body>
</html>