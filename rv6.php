<?php
	echo "hello";	
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<script type="text/javascript">
		var a = [],b=[];
		var n=a.length;
		a.sort();
		let l = 0;
		for(let i=1;i<n;i++){
			if(a[i]!=a[i-1]){
				b.push([l,i-1]);
				l=i;
			}
		}
		b.push([l,n-1]);
		var ans=0,m = b.length;
		for(let i=0;i<m-1;i++){
			var val = a[b[i][0]];

			if(a[b[i][0]] == a[b[i+1][0]]) ans =Math.max(ans, b[i][1] -b[i][0] +b[i+1][1]-b[i+1][0]+2);
			else ans = Math.max(ans, b[i][1]-b[i][0]+1);
		}
		ans = max(ans, b[m-1][1]-b[m-1][0]+1);
		console.log(ans);
	</script>
</body>
</html>