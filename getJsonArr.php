<?php
	$conn= new PDO('mysql:host=localhost;dbname=book_store;charset=utf8','root','');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//tu tu : 

	/*
	$stmt=$conn->prepare('select oi.id_book as id from order_acc od inner join order_item oi on od.id=oi.id_order where od.id_customer=1');
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->execute();
	$ids= $stmt->fetchAll();
	echo var_dump($ids);
	$s="";
	for($i=1;$i< count($ids);$i++) {
		$s.=','.$ids[$i]['id'];
	}$s.=')';
	$sql='select name from tb_book where id in ('.$ids[0]['id'].$s;
	$stmt=$conn->prepare($sql);
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->execute();
	$names=$stmt->fetchAll();
	*/
	//fullstack in php thi lam the nao ???/
	//dau tien : 

//	echo json_encode($names,JSON_UNESCAPED_UNICODE);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<body>
	<div>
		<h2 id="nameCourse"></h2>
	</div>
	<table id="tblScore">
		<tr>
			<th>Student ID</th>
			<th>Student name</th>
			<th>Project</th>
			<th>Mid-term</th>
			<th>Final</th>
		</tr>

	</table>
	<table id="tblEx">
		<tr><td>223</td><td>234</td></tr>
		<tr><td>223</td><td>234</td></tr>
	</table>
	<button onclick="updateAll()" id="btnUpdate">Update all</button>
	<button id="btnP">Press it</button>
</body>
<script type="text/javascript">
		
		const gens=['male','female'];
		
		var students=[],teachers=[],courseList=[];

		const person={
			name: 'general name',
			eat(x) {
				console.log(this.name +' eats '+ x.toString());
			},
			sleep(t){
				console.log(this.name+' sleeps '+ t.toString()+' every night');
			}
		};
		

		function Teacher(id,name,age,gender){
			let teacher = Object.create(person);
			teacher.id=id;
			teacher.name= name;
			teacher.age=age;
			teacher.gender=gender;
			teacher.teachingCourses=[];
			teacher.teachedCourses=[];
			teacher.openCourse=function(subject,start,time){
				course= new Course(subject,this,start,time);
				this.teachingCourses.push(course);
				courseList.push(course);
			}
			return teacher;
		}
		function Course(subject,teacher,start,time){
			this.subject=subject;
			this.teacher=teacher;
			this.start=start;
			this.time=time;
			this.students=[];
			this.viewStudents=function(){
				for(let i=0;i<this.students.length;i++){
					console.log(this.students[i].name);
				}
			}

		}

		//ta thu get data ve luu vao cac object thi no cung chi la hien thi len thoi khong co gi de lam nua ???
		//dung k???
		//dieu do minh lai thay kha la don gian ????
		//vi nhung cai hoat dong ben trong 1 cai ham thi ro rang la jno chi xay ra khi ma ta kick hoat cho cai ham chay thoi
		
		document.addEventListener("keydown",function(event){
			if(event.keyCode==37) alert(event.keyCode.toString());
		});
		//quan trong nhat la can co id ???
		//tiep theo quan tri vien se them thong tin cua student + teacher vao trong database dung 
		//thuc chat thi moi tac vu deu get tu data base ma ra het dung:

		function Student(id,name,age,gender){
			let student= Object.create(person);
			//id cua 1 nguoi duoc an dinh la mssv:
			//va no la dang string 7 ky tu : 
			student.id=id;
			student.name=name;
			student.age=age;
			student.gender=gender;
			student.learnedCourses=[];
			student.learningCourses=[];

			student.registerCourse=function(course){
				this.learningCourses.push(course);
				course.students.push(this);
			}
			student.viewMyCourses=function(){
				for(let i=0;i<this.learningCourses.length;i++){
					console.log(this.learningCourses[i].subject);
				}
			}
			student.viewOpenCourse=function(){
				for(let i=0;i<courseList.length;i++){
					console.log(courseList[i].subject);
				}	
			}
			return student;
		}
		

		function initStudents(){
			
			for(let i=0;i<3;i++){
				let student1=Student(1711791+i,"Pham minh khoa "+i.toString(),23+i,0);
				students.push(student1);
			}
		}
		function initTeachers(){
			
			for(let i=0;i<3;i++){
			let t=Teacher("TC00"+i.toString(),"Nguyen Thanh Trung "+i.toString(),23+i,0);
			teachers.push(t);
			}
		}

		function CourseStudent(idCourse,idStudent,mid,pro,final){
			this.idCourse=idCourse;
			this.idStudent=idStudent;
			this.mid=mid;
			this.project=pro;
			this.final=final;
		}

		initStudents();
		initTeachers();
		//ro rang la co vai van de can nhan xet: 

		teachers[0].openCourse('Machine Learning','20/08/2020',5);
		teachers[1].openCourse('Data structure','22/09/2020',4);
		teachers[2].openCourse('Data Minining','29/10/2020',4);
		students[0].viewOpenCourse();

		for(let i=0;i<students.length;i++){
			students[i].registerCourse(courseList[0]);
		}
		person.live=function(){
			console.log(this.name + " is living");
		}
		students[0].live();
		scores=[[10,9,9],[9,9,9],[9,8,10]];
		//do du lieu vao dung cai phan nao can thoi dung roi don gian :

	
		courseList[0].viewStudents();
		for(let i=0;i<students.length;i++){
			let line= $("<tr></tr>").attr("id","tr"+students[i].id.toString());
			let id=$("<td></td>").text(students[i].id);
			let name=$("<td></td>").text(students[i].name);
			let mid=$("<td></td>");
			let inpMid=$("<input/>").attr("type","text");
				
			mid.append(inpMid);
			let project=$("<td></td>");
			let inpPro=$("<input/>").attr("type","text");
			project.append(inpPro);

			let final=$("<td></td>");
			let inpFinal= $("<input/>").attr("type","text"); 
			final.append(inpFinal);
			let inp=$("<input>").attr("type","hidden");inp.val(students[i].id.toString());
			line.append(id,name,mid,project,final);
			$("#tblScore").append(line);
		}	
		var arrCourseStudent=[];
		function try1(){
			//let tbl = document.getElementById("tblEx");
			let tbl=$("#tblEx")[0];
			alert(typeof(tbl));
			let row1= tbl.getElementsByTagName("tr")[0];
			alert(row1.getElementsByTagName("td")[0].textContent);
		}
		function updateAll(){

			for(let i=0;i<students.length;i++){
				let line=$("#tr"+students[i].id.toString())[0];
				
				scores= line.getElementsByTagName("input");
				let id= scores[0].value;
				let x=new CourseStudent(1,id,parseFloat(scores[0].value),parseFloat(scores[1].value),parseFloat(scores[2].value));
				arrCourseStudent.push(x);
			}
			alert(arrCourseStudent[0].mid);
		}
		//ta dinh nghia truoc 1 function :
		var obj1= {
			name: 'khoa pham',
			age: '23',
			work: function(){
				console.log(this.name+" is working");
			}
		};

		var f={name:'khoa ba ria'};

		f.doit=obj1.work.bind(obj1);
		f.doit();
		var x1={
			name: 'pham minh khoa',
			kickit: function(){
				let self=this;
				$("#btnP").click(function(){
					this.name="khoa ba ria";
					alert(this.name);
				});
			}
		}
		x1.kickit();
		document.getElementById("nameCourse").innerHTML="KMP Product";
		$("#nameCourse")[0].textContent="KMP Training";
		
		var y1={};
		u1=343;
		//moi thu chinh xac se la nhu vay :
		


		//alert(y1.toString());
	</script>
</html>