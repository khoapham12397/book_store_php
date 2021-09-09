<?php


	
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript">
		console.log(this.name);
		function fib(n){
			if(n==0 || n==1) return 1;
			return fib(n-1) + fib(n-2);
		}
		var a =Array(10);

		var used =Array(10);
		for(let i=0;i<10;i++) {
			used[i] =false;
			a[i] = Math.floor(Math.random()*10000);
		}
		console.log(used.toString());
		console.log(a.toString());
		var b= Array(3);
		var fact =Array(11);
		var ans = 0; fact[0] =1;
		for(let i=1;i<11;i++) fact[i] =fact[i-1]*i;
		function duyet(t,k){
			for(let i=0;i<10;i++) {
				if(!used[i]) {
					b[t] = a[i];
					used[i] =true;
					if(t==k-1) {console.log(b.toString());ans++;}
					else duyet(t+1,k);
					used[i] = false;
				}
			}
		}


		function duyet2(t,k,s){
			for(let i=s;i<10;i++){
				b[t]=i;
				if(t==k-1) {console.log(b.toString()); ans++;}
				else duyet2(t+1,k,i+1);
			}
		}
		// code thu vai cai coi the nao ???
	

		var s= "khoa ba ria 1010";
		var s2= s.split(' ');
		console.log(s2);
		var s1=s.slice(3,7);
		console.log(s1);
		var adj =Array(10);
		
		var arr= Array(10,22,3,12);
		arr.sort();
		console.log(typeof(arr));	
		console.log(arr);			
		var ar1= new Array();
		console.log(this.name);

	</script>
</head>
<body>
	<div id= "main">
		<input type="text" name="searchKey" id="skey" style="width: 500px; height: 30px;">
		<button id="btnSearch" style="width: 60px; height: 30px;">Find</button>
	</div>

	<script type="text/javascript">
		console.log(this.name);
		var d= new Date();
		var st = d.getTime();
		var mainDiv= document.getElementById("main");

		let name = document.createElement("div");
		name.innerHTML= "Pham minh khoa";

		mainDiv.appendChild(name);

		var x= JSON.stringify([{name: "khoa pham", age: 24},{name: "yutaka",age: 22}]);
		var sendData = {lst : x};
		
		function scs(x){
			var ans= 0;
			while(x>0) {x/=10; ans++;}
			return ans;
		}
	
		function solve(){
			var a , b,c,d,x,y;
			a=Math.min(a,b);
			b=Math.max(a,b); 
			var p10= Array(10); p10[0]=1;
			for(let i=1;i<10;i++) p10[i] =p10[i-1]*10;
			d = p10[c-1];
			var del1 = a-(c-1), u=1,del2= b-(c-1),v=1;
			while(scs(u) < del1) u*=3;
			while(scs(v) < del2) v*=7;
			console.log(u*d, v*d);
		}

		var majors = ["Computer Science","Applied Math"];
		const N =100000;
		
		var users = new Array(N);
		for(let i=0;i<N;i++){
			// moi nguoi  kt:
			let name = "";
			for(let j=0;j<6;j++) {
				let x= Math.floor(Math.random()*10000)%26 + 97;
				name +=String.fromCharCode(x);
			}
			users[i]= {};
			users[i].name = name;
			users[i].age= Math.floor(Math.random()*10000)%100;
			users[i].major = majors[Math.floor(Math.random()*10000)%2];
		}

		
		const M =N;
		function showTopData(){
			let tb = document.createElement("table");
			tb.setAttribute("style", "border: 1px solid;")
			for(let i=0;i<M;i++){
				let tr= document.createElement("tr");
				tr.setAttribute("style", "width: 500px; height: 40px;");
				let  tdTT= document.createElement("td"),tdName = document.createElement("td") , tdAge = document.createElement("td"), tdMajor=  document.createElement("td");
				tdTT.textContent = (i+1).toString();
				tdName.textContent= users[i].name; tdAge.textContent= users[i].age; tdMajor.textContent = users[i].major;
				tr.appendChild(tdTT); 
				tr.appendChild(tdName); tr.appendChild(tdAge); tr.appendChild(tdMajor);
				tb.appendChild(tr);
			//	console.log(users[i].name+ " "+users[i].age.toString() + " "+users[i].major);
			}
			mainDiv.appendChild(tb);
		}
		showTopData();
		console.log(d.getTime() - st);
		function sendDataToServer(){
			var sendData = {lst: JSON.stringify(users)};
			console.log("chuan bi pass");
			$.ajax({url : 'http://kmp97.000webhostapp.com/Server/book_store_project/rv1.php', method : 'POST', dataType : 'JSON', data: sendData}).done(function(result){
					alert("vao day");
					var len =result.length;
					console.log("da nhan "+len.toString());
					for(let i=0;i<10;i++){
						console.log(JSON.stringify(result[i]));
					}
			});		
		}
		//setTimeout(sendDataToServer,1000);
		function getData(){
			$.ajax({url : '',method: 'POST'}).done(function(result){
				console.log("success");
			});

		}
		// no se kich hoat chay theo kieu lien tuc duoc khong ???
		// dau tien nen nho la trong js luon ton tai cac xu ly bat dong bo dung la vcay 

		// co  khai niem can hoc : callback, promise , async/await dung la vay chi co the nay thoi d

		// y nghia cua no la vay but lam the deo nao sinh code asynroch???

		// dieu do moi la quan trong 
		// dau tien thuc hien lai cac van de nay the nao ??
		// dung vay tuc la viec request API sau do thuc hien the nao 

		

		// do do ta can xem xet lai all things

		//nhin lai no set up cho nhugn thang nay no chay 1 cach lien tuc vay ??
		// tuc la no se ton 
		var t=0;
		
		function f2(){
			t++;
			for(let i=0;i<100;i++) {
				console.log(t.toString() + ": "+ i.toString());
			}
			if(t<100) setTimeout(f2,100);
		}
		
		//setTimeout(f2,100);
		var obj= {
			name: "khoa pham", 
			setName : function(name){
				this.name= name;
			},
			getName : function(){
				console.log(this.name);
			}
		}
		//obj.setName("pham minh khoa");
		// khi do ta da get duoc dung cgua 
		console.log(window.name);
		
		// don gian van de la the nay:
		function do1(){
			for(let i=0;i<10;i++) {}
		}
		// nhan xet la cai gi ta can 2 bien duoc dua vao trong :
		// gia su ta can sinh ra promise voi tham so duoc su dung:
		// khi do se co cai nay:
		// dau tien can xac dinh 2 cai kia dung chua ???\
		//dieu nay la dung:
		// dieu do kho hieu vl:
		// dung la vay do manjsu 
	/*
	var promise = new Promise(function(resolve, reject) {
	

    var request = new XMLHttpRequest();
    	// no su dung api danh ajax len server ma thang kia no chan roi dung la vya :

    request.open('GET', 'https://shopee.vn/Vi%C3%AAn-u%E1%BB%91ng-t%C4%83ng-t%E1%BA%ADp-trung-t%E1%BB%89nh-t%C3%A1o-t%C4%83ng-c%C6%B0%E1%BB%9Dng-n%C4%83ng-l%C6%B0%E1%BB%A3ng-Neowell-Focus-(30-vi%C3%AAn)-i.309642468.5256894974');
    request.onload = function() {
      if (request.status == 200) {
        resolve(request.response); // we got data here, so resolve the Promise
      } else {
        reject(Error(request.statusText)); // status is not 200 OK, so reject
      }
    };

    request.onerror = function() {
      reject(Error('Error fetching data.')); // error occurred, reject the  Promise
    };

    request.send(); //send the request
  });
	// dieu do co the duoc chu ha dung vay :???
	// vi du thuc hien ham find theo ten:
	// 
  console.log('Asynchronous request made.');
	// with 500 *10^6 record thi lam the nao ??/
	// dieu nay lieu co sinh ra duoc khng??

	// dung la vay L
	// thu su dung trie xem the nao ???
	// cu moi 1 edge la luu 1 ky tu dung vay :


	// tu do sinh ra cai leaf node la gi ???
	// nam all cac name cua 1 thang luon dung vay :
	// cai tien no la ok nhat oi 
  promise.then(function(data) {
    console.log('Got data! Promise fulfilled.');
    document.getElementsByTagName('body')[0].textContent = JSON.parse(data).value.joke;
  }, function(error) {
    console.log('Promise rejected.');
    console.log(error.message);
  });
  */
	// nhap tu khoa vao trong thi no tuong tac don gian thoi ma :
	// no cung la 1 qua trinh xu ly voi goc nhin tu client ??
	// dieu nay co the no cung cap cac function la cac dang api de phan chia ma goi len thoi 
 	var jk= $.ajax({url : 'http://api.icndb.com/jokes/random',method :'GET'}).done(function(data){
 		return data.value.joke;
 	});
 	// co the la nhan vien minh random roi nhet thu coi the nao ??
 	// co 26^6 ban co the xay ra: 
 	//  => bn ???
 	// 2^6 *13 ^6
 	// gia dinh minh luu thu theo cai kia xem the nao???
 	// co the la 1 obejct :dung vcay :
// dieu nay co the la sinh ra theo dang gi do cua no duoc do
	// gia dinh find theo ten thi can sort lai ma insert mat time dung vay:
	// tu do nen lam sao ???
	//
	// build 1 cai tree don gian thoi do la gi ???
	// dau tien nen nho no la vay do ma just do it : and something else??
	// ben canh do ta con co cac ky tu cua 
	var myName="Phạm";
	var emoj = '\uD83D\uDC36';
	document.write(emoj);
	console.log(typeof(emoj));
	// co the la dang string dung do ma:

	console.log("len of myname: " + myName.length.toString());
	var ar1 = [];
	for(let i=0;i<myName.length;i++) ar1.push(myName[i]);
	console.log(ar1);
 
 	// dinh nghia 1 cai ham tao node ??? // co can thiet khong???
 	// tai 1 dinh no co 1 tap cac gia tri se duoc chay dung chua ??
 	// dieu nay la dung do ma just do it :
 	// dau tien no se get theo the nay :
 	// vi du nguoi su dung ma nhap nhieu ky tu thi no se the nao ??
 	// nam 1 cai list theo id dung vay tu do de dang thuc hien hon co the di theo cai dang nay :

 	// dau tien thuc hien theo:
 	// sinh cai kia ra trioc :
 	// add 1 node co the dai qua khong ???
 	// dau tien xem xet 
 	// ten va thu tu dung :
 	var yy = 'a';
 	console.log(typeof(yy));
 	// dac thu 1 node la gi ??
 	

 	// edge : {character : , node : object la dang node : dung vay:}
 	// tiep theo : 1 node thi chua ??  1 list of edge [hoac la no la 1 tap]
 	// ma co the la the nay edges.kt => node ke tiep duoc dung vay :
 	// sau do co the cho luon dung vay:
 	// sau do nen pass 2 type x || y dung vay :
 	// sau do nap full list ten len tren nay ??
 	// dung vay buidl nhieu cay ???
 	// vi du xem the nao ???
 	// dau tien ta co cai nay la the nao ???
 	// build nguoc cung duoc dung vay ???
 	// sau do di nhieu thi se ok hon :
 	//neu co the add no vao trong thi khong duoc dung vay do do nen lam cach khac dung chua ???
 	// nen dua theo dang map ??

 	// can than vi no co the la copy dung chua ???
 	var xx={};
 	xx.emoj=2;
 	var myMap = new Map();
 	myMap.set("khoa",xx);
 	xx.emoj = 10;
 	console.log(myMap.get("khoa").emoj);
 	// cu object la no tham chieu den nhau het nen cung don gian tat ca deu la con tro tham chieuu tjoi 

 	// nen nho cai ham luong do co the thay doi dung la vya 
 	// just eez:
 	console.log(xx.emoj);
 	var lst=[{id: 1, name: 'Khoa'}, {id: 2, name: 'Khôi'},{id: 3, name: 'Khang'},{id: 4,name: 'Khải'},{id: 5, name: 'Khanh'},{id: 6, name: 'Khánh'} , {id: 7 ,name: 'Kiên'},{id: 8, name: 'Khoa'},{id: 9, name: 'Khang'}];
	// them 1 cai Map de luu cho nhanh dung roi do ma:
	// day chinh la no do:

	var mapUsers =new Map(); 
	for(let i=0;i<lst.length;i++) mapUsers.set(lst[i].id, lst[i]);
 	
 	
 	function addTrie(node, name,tt,id){
 		let kt= name[tt];
 		let ptr= node.edges.get(kt);
 		if(ptr==undefined) {
 			let p ={edges: new Map(), ds: [], isLeaf : false};
 			if(tt== name.length-1){
 				p.isLeaf = true; p.ds.push(id);
 				node.edges.set(kt,p);
 				return;
 			}
 			node.edges.set(kt,p);
 			addTrie(p,name,tt+1, id);
 			return;
 		}
 		if(tt== name.length-1){
 			ptr.ds.push(id); 
 			ptr.isLeaf=true;
 			return;
 		}
 		addTrie(ptr, name,tt+1,id);
 	}

 	var root= {edges: new Map(), isLeaf :false, ds :[]};
 	// ro rang la cai gi ??nao ???
 	// dau tien can xac dinh theo cach nao do ???
 	// dung la vay tu do de dang xac dinh hon dung khong

 	// tiep theo : neu co cai ay
 	for(let i=0;i<lst.length;i++){
 		addTrie(root,lst[i].name, 0, lst[i].id);
 		// root la no change??
 	}
 	
 	function duyetTrie(node,name,tt){
 		let kt= name[tt];
 		let ptr =node.edges.get(kt);
 		if(ptr==undefined) return [];
 		if(tt==name.length-1) return ptr.ds;
 		return duyetTrie(ptr,name,tt+1);
 	}
 	

 	function find(name){
 		var ids=  duyetTrie(root,name,0);
 		for(let i=0;i<ids.length;i++) console.log(mapUsers.get(ids[i]));
 	}
 	find('Khang');
 	function showSearchData(){
 		let keyword= $("#skey").val();

 	}
 	// phan tich all chuoi con co trong no vi du the nay :
 	// dau tien ta co cai gi ??/

	// dau tien get all 
	</script>
</body>
</html>